## AI guide for this WordPress + Vite theme

Big picture

- This is a WordPress theme wired to Vite for fast dev (HMR) and production builds.
- In development, Vite proxies requests to the local WordPress site and injects HMR. In production, assets are served from `assets/` based on the Vite manifest.

Key files and flow

- `vite.config.js`: sets proxy to WordPress (WORDPRESS_URL), HMR (ws), Rollup entries, output structure, and dependency pre-bundling (e.g., Swiper).
- `inc/enqueue.php`: decides dev vs prod; in dev enqueues:
  - `http://localhost:5173/@vite/client` (type="module")
  - `http://localhost:5173/src/js/main.js` (type="module")
  - `http://localhost:5173/src/scss/style.scss` (for CSS HMR)
    In prod, reads `assets/.vite/manifest.json` and enqueues hashed files.
- `vite-wordpress-plugin.js`: Vite plugin using chokidar to watch `**/*.php`, `src/**/*.js`, `src/**/*.scss` and broadcast `full-reload` to browsers.
- `src/` structure:
  - `src/js/main.js` imports feature modules from `src/js/modules/**` (menu, slider, etc.).
  - `src/scss/style.scss` is the single SCSS entry; import component partials here.
- Templates in root (`*.php`) and partials in `parts/`; PHP helpers in `inc/` (enqueue, setup, CPTs).

Dev workflow (do this)

- Run: `npm run dev`.
- Browse the WordPress URL (e.g., `http://developer.etc`), not `http://localhost:5173/`. Vite proxies and injects HMR.
- Set `WP_ENVIRONMENT_TYPE=development` in `wp-config.php` or ensure Vite is reachable so `is_vite_development()` returns true.
- Optional: create `.env` with `WORDPRESS_URL=http://developer.etc` and `VITE_PORT=5173` to match your environment.

Build workflow

- Run: `npm run build`. Output goes to `assets/` with a manifest at `assets/.vite/manifest.json`.
- `inc/enqueue.php` reads the manifest in production to enqueue JS/CSS. Entries are named `js/main.js` and `scss/style.scss` in the manifest.

Patterns and conventions

- CSS: Hybrid SCSS + Tailwind. Use `@apply` inside SCSS partials (see `src/scss/components/**`), and import them in `src/scss/style.scss`.
- JS: ES modules only. Put features in `src/js/modules/` and import in `src/js/main.js`. Avoid inline `<script>` in PHP templates when a module exists (e.g., Swiper).
- Swiper: import from `swiper` and `swiper/modules`. Keep CSS in SCSS or via module CSS imports if needed, but prefer the single SCSS entry approach.
- PHP: Keep enqueue logic in `inc/enqueue.php`. Do not hardcode asset URLs elsewhere.

HMR specifics (what triggers reload)

- CSS changes in `src/scss/**`: hot update (no full page reload).
- JS changes in `src/js/**`: HMR where possible.
- PHP changes `**/*.php`: custom plugin emits `full-reload` (page refresh).

Common pitfalls (and fixes)

- If you see “Cannot use import statement outside a module”, ensure `@vite/client` and `src/js/main.js` are emitted with `type="module"` (the theme enforces this via a filter).
- Do not open `http://localhost:5173/` directly; always browse the WordPress domain so proxy + HMR work.
- Use a single package manager (prefer `npm` since `package-lock.json` exists). Mixing npm/yarn can cause re-optimization loops.
- Proxy compression issues: config sets `accept-encoding: identity` to avoid `ERR_CONTENT_DECODING_FAILED`.

Examples

- Add a new SCSS component: create `src/scss/components/_banner.scss`, then import it in `src/scss/style.scss`.
- Add a new JS feature: create `src/js/modules/tabs.js` and import it in `src/js/main.js`.
- Add markup: edit `parts/*.php` or a template like `front-page.php`; PHP saves trigger a full reload.

Quick checklist for agents

- Editing CSS/JS? Update under `src/` and wire imports in `style.scss` or `main.js`.
- Editing templates? Save any `*.php` and expect a full page reload.
- New external libs? Prefer ESM-compatible packages; add to `optimizeDeps.include` if needed.
- Dev not refreshing? Verify module script tags, HMR WebSocket, and that you are visiting the WP URL.
