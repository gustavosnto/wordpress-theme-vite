import { defineConfig } from "vite";
import liveReload from "vite-plugin-live-reload";

export default defineConfig({
  plugins: [liveReload([__dirname + "/**/*.php"])],

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
    port: 5173,
    strictPort: true,
    cors: true,

    hmr: {
      host: "localhost",
      port: 5173,
      protocol: "ws",
    },
  },
});
