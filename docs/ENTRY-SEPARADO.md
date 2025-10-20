# ✅ Configuração Entry Separado - WordPress + Vite

## 🎯 **Configuração Implementada:**

### **Entry Points Separados:**
```javascript
// vite.config.js
rollupOptions: {
  input: {
    main: "src/js/main.js",    // ✅ Entry para JavaScript
    style: "src/scss/style.scss", // ✅ Entry para CSS/SCSS
  }
}
```

### **Arquivos Gerados:**
- 📁 `/assets/js/main.js` - JavaScript compilado (89KB)
- 📁 `/assets/css/main.css` - CSS do Swiper e componentes JS (13KB)
- 📁 `/assets/css/style.css` - SCSS + TailwindCSS compilado (25KB)

## 🚀 **Vantagens desta configuração:**

### **✅ Arquivos Independentes:**
- CSS não depende do JavaScript
- WordPress pode carregar CSS e JS separadamente
- Melhor performance e cache independente

### **✅ JavaScript Limpo:**
```javascript
// src/js/main.js - SEM import de SCSS!
import { initMenu } from "./modules/menu";
import { initSlider } from "./modules/slider";

document.addEventListener("DOMContentLoaded", () => {
  console.log("🚀 Tema carregado!");
  initMenu();
  initSlider();
});
```

### **✅ WordPress Carrega Separadamente:**
```php
// inc/enqueue.php
// Modo desenvolvimento:
wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client');
wp_enqueue_script('theme-main', 'http://localhost:5173/src/js/main.js');

// Modo produção:
wp_enqueue_script('theme-main', '/assets/js/main.js');
wp_enqueue_style('theme-style-0', '/assets/css/main.css');
wp_enqueue_style('theme-style-1', '/assets/css/style.css');
```

## 🔧 **Como funciona:**

### **Desenvolvimento (`yarn dev`):**
1. Vite serve `/src/js/main.js` transformado
2. Vite processa SCSS automaticamente via entry separado
3. Hot reload funciona para ambos (JS e CSS)
4. Proxy serve WordPress em `localhost:5173`

### **Produção (`npm run build`):**
1. Gera `assets/js/main.js` otimizado
2. Gera `assets/css/style.css` (SCSS compilado)
3. Gera `assets/css/main.css` (CSS do Swiper)
4. WordPress carrega arquivos estáticos

## 📊 **Comparação com Import no JS:**

| Aspecto | Entry Separado ✅ | Import no JS ❌ |
|---------|------------------|-----------------|
| **Arquivos** | CSS e JS separados | CSS dentro do JS |
| **Performance** | Melhor (paralelo) | Pior (sequencial) |
| **Cache** | Independente | Dependente |
| **WordPress** | Nativo | Hack necessário |
| **Hot Reload** | Funciona | Funciona |
| **Configuração** | Simples | Mais simples |

## 🎯 **Comandos:**

```bash
# Desenvolvimento com proxy + HMR
yarn dev
# Acesse: http://localhost:5173/

# Build para produção
npm run build
# Gera arquivos em /assets/

# Build com watch
npm run watch
# Reconstrói automaticamente
```

## 🔍 **Verificação:**

### **Build bem-sucedido:**
```bash
✓ 43 modules transformed.
../assets/css/main.css         13.50 kB │ gzip:  4.03 kB
../assets/css/style.css        25.38 kB │ gzip:  4.44 kB
../assets/js/main.js           89.62 kB │ gzip: 27.02 kB
✓ built in 722ms
```

### **Servidor funcionando:**
```bash
VITE v5.4.20  ready in 180 ms
➜  Local:   http://localhost:5173/
📄 Servindo página: /
🔄 Proxying: / -> http://developer.etc/
```

---

**🎊 Configuração otimizada para WordPress com entry points separados!**