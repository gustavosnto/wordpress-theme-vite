/**
 * Plugin personalizado para WordPress + Vite HMR
 * Versão simplificada para evitar problemas de decodificação
 */
export function wordpressHmrPlugin() {
  return {
    name: "wordpress-hmr",
    configureServer(server) {
      // Log de conexões HMR
      server.ws.on("connection", () => {
        console.log("🔥 Cliente HMR conectado!");
      });

      // Log de requisições para debug
      server.middlewares.use((req, res, next) => {
        if (
          req.url &&
          !req.url.startsWith("/@") &&
          !req.url.startsWith("/src/")
        ) {
          console.log(`📄 Servindo página: ${req.url}`);
        }
        next();
      });
    },
  };
}
