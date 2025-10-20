/**
 * Plugin personalizado para WordPress + Vite HMR com Auto-Refresh
 */
const chokidar = require("chokidar");

export function wordpressHmrPlugin() {
  return {
    name: "wordpress-hmr",
    configureServer(server) {
      console.log("🔥 WordPress HMR Plugin ativo!");

      // Listener para mudanças de arquivos
      const watcher = chokidar.watch(
        ["**/*.php", "src/**/*.js", "src/**/*.scss"],
        {
          ignored: ["node_modules/**", "vendor/**"],
          persistent: true,
          cwd: process.cwd(),
        }
      );

      watcher.on("change", (path) => {
        console.log(`🔄 Arquivo alterado: ${path}`);

        // Força reload completo da página
        server.ws.send({
          type: "full-reload",
          path: "*",
        });
      });

      // Cleanup ao fechar
      server.httpServer?.on("close", () => {
        watcher.close();
      });
    },
  };
}
