# 🚀 Configuração Vite + WordPress

## ✅ Status: Configurado e Funcionando!

Os arquivos gerados pelo Vite agora são automaticamente importados no WordPress através do `functions.php`.

## 📁 Arquivos Importantes

### Arquivos Gerados (não editar):
- `/assets/css/main.css` - CSS do Swiper e componentes JS
- `/assets/css/style.css` - SCSS compilado + TailwindCSS
- `/assets/js/main.js` - JavaScript compilado
- `/assets/.vite/manifest.json` - Manifest do Vite

### Arquivos Fonte (editar estes):
- `/src/scss/style.scss` - Arquivo principal SCSS
- `/src/js/main.js` - Arquivo principal JavaScript

## 🛠️ Comandos Disponíveis

### Desenvolvimento com Hot Reload:
```bash
npm run dev
```
- Inicia servidor em `http://localhost:5173/`
- Hot reload automático para CSS/JS
- **Modo detectado automaticamente** quando WP_DEBUG está ativo

### Build para Produção:
```bash
npm run build
```
- Gera arquivos otimizados em `/assets/`
- **Usado automaticamente** quando servidor Vite não está rodando

### Build com Watch (Novo):
```bash
npm run watch
```
- Reconstrói automaticamente quando você salva arquivos
- Útil para desenvolvimento sem hot reload

## 🔧 Como Funciona

### Detecção Automática de Modo:
1. **Desenvolvimento**: Se `WP_DEBUG = true` E servidor Vite (`localhost:5173`) responde
2. **Produção**: Em todos os outros casos

### Arquivos Carregados:

**Modo Desenvolvimento:**
- `http://localhost:5173/@vite/client` (HMR)
- `http://localhost:5173/js/main.js` (JavaScript + CSS via Vite)

**Modo Produção:**
- `/assets/js/main.js` (JavaScript compilado)
- `/assets/css/main.css` (CSS do Swiper)
- `/assets/css/style.css` (SCSS + TailwindCSS)

## 🐛 Debug

### Indicador Visual:
- **Admin Bar** mostra status: `⚡ Vite: DEV (HMR)` ou `⚡ Vite: PROD`
- **HTML Comments** indicam o modo ativo

### Problemas Comuns:

**CSS não atualiza:**
```bash
# Se em desenvolvimento, certifique que Vite está rodando:
npm run dev

# Se em produção, faça o build:
npm run build
```

**Erro "Port 5173 is already in use":**
```bash
# Mate o processo anterior:
lsof -ti:5173 | xargs kill -9
npm run dev
```

**Arquivos não carregam:**
- Verifique se existe `/assets/.vite/manifest.json`
- Execute `npm run build` pelo menos uma vez

## 📝 Workflow Recomendado

### Para Desenvolvimento:
1. `npm run dev` (terminal fica aberto)
2. Edite arquivos em `/src/`
3. Veja mudanças instantâneas no navegador

### Para Deploy/Produção:
1. `npm run build`
2. Commit os arquivos em `/assets/`
3. Upload para servidor

### Para Desenvolvimento sem HMR:
1. `npm run watch` (terminal fica aberto)
2. Edite arquivos em `/src/`
3. Recarregue a página manualmente

## 🎯 Configurações

### wp-config.php:
```php
// Para habilitar modo desenvolvimento
define('WP_DEBUG', true);
```

### Vite detecta automaticamente:
- ✅ Se servidor está rodando
- ✅ Carrega arquivos corretos
- ✅ Adiciona versionamento em produção
- ✅ Remove CSS desnecessário do WordPress