import { defineConfig, loadEnv } from "vite";
import liveReload from "vite-plugin-live-reload";
import { wordpressHmrPlugin } from "./vite-wordpress-plugin.js";

export default defineConfig(({ mode }) => {
  // Carrega variáveis de ambiente
  const env = loadEnv(mode, process.cwd(), "");
  const wordpressUrl = env.WORDPRESS_URL || "http://developer.etc";
  const vitePort = parseInt(env.VITE_PORT) || 5173;

  return {
    plugins: [liveReload([__dirname + "/**/*.php"]), wordpressHmrPlugin()],

    root: "src",

    build: {
      outDir: "../assets",
      emptyOutDir: true,
      manifest: true,

      rollupOptions: {
        input: {
          main: "./src/js/main.js",
          style: "./src/scss/style.scss",
        },
        output: {
          entryFileNames: "js/[name].js",
          chunkFileNames: "js/[name].js",
          assetFileNames: (assetInfo) => {
            if (assetInfo.name.endsWith(".css")) {
              return "css/[name][extname]";
            }
            return "images/[name][extname]";
          },
        },
      },

      minify: "esbuild",
      sourcemap: false,
    },

    css: {
      postcss: "./postcss.config.js",
    },

    server: {
      host: "localhost",
      port: vitePort,
      strictPort: true,
      cors: true,

      // Proxy para o WordPress
      proxy: {
        // Intercepta todas as requisições que NÃO são assets do Vite
        "^(?!.*(@vite|src/|node_modules)).*": {
          target: wordpressUrl,
          changeOrigin: true,
          secure: false,
          // Desabilita compressão para evitar ERR_CONTENT_DECODING_FAILED
          headers: {
            "accept-encoding": "identity",
          },
          configure: (proxy, options) => {
            proxy.on("proxyReq", (proxyReq, req, res) => {
              // Remove headers de compressão
              proxyReq.removeHeader("accept-encoding");
              // Log das requisições proxied para debug
              console.log(
                `🔄 Proxying: ${req.url} -> ${options.target}${req.url}`
              );
            });

            proxy.on("proxyRes", (proxyRes, req, res) => {
              // Remove headers de compressão da resposta
              delete proxyRes.headers["content-encoding"];
              delete proxyRes.headers["content-length"];
            });
          },
        },
      },

      hmr: {
        host: "localhost",
        port: vitePort,
        protocol: "ws",
      },
    },
  };
});
