# 🔥 WordPress + Vite Proxy com Hot Reload

## ✅ Configuração Concluída!

Agora você pode acessar seu WordPress através do Vite com hot reload completo!

## 🚀 Como Usar

### 1. **Inicie o servidor de desenvolvimento:**

```bash
npm run dev
```

### 2. **Acesse seu site através do Vite:**

```
http://localhost:5173/
```

**🎯 O que acontece:**

- Vite funciona como proxy para `http://developer.etc/`
- Todas as páginas WordPress aparecem em `localhost:5173`
- Hot reload funciona para CSS e JavaScript
- Você vê as mudanças instantaneamente sem recarregar a página

## 🔧 Configurações

### **Mudar URL do WordPress:**

Edite o arquivo `.env.development`:

```env
# Mude esta URL para a sua
WORDPRESS_URL=http://developer.etc

# Porta do Vite (opcional)
VITE_PORT=5173
```

### **URLs Suportadas:**

- `WORDPRESS_URL=http://developer.etc`
- `WORDPRESS_URL=http://localhost:8080`
- `WORDPRESS_URL=http://meusite.local`
- `WORDPRESS_URL=https://staging.site.com`

## 🔥 Recursos Ativos

### **Hot Module Replacement (HMR):**

- ✅ **SCSS**: Mudanças aplicadas instantaneamente
- ✅ **JavaScript**: Recarrega módulos sem perder estado
- ✅ **PHP**: Recarrega página automaticamente (via live-reload)

### **Indicadores Visuais:**

- 🟢 **"🔥 HMR ATIVO"** no canto superior direito
- 🟢 **Admin Bar**: `⚡ Vite: DEV (HMR)`
- 🟢 **Console**: Logs de proxy em tempo real

## 📱 Workflow de Desenvolvimento

### **Típico dia de desenvolvimento:**

1. **Inicie uma vez:**

   ```bash
   npm run dev
   ```

2. **Acesse seu site:**

   ```
   http://localhost:5173/
   ```

3. **Edite arquivos e veja mudanças instantâneas:**

   - 📝 Editou SCSS → Vê mudança em 50ms
   - 📝 Editou JS → Módulo recarrega automaticamente
   - 📝 Editou PHP → Página recarrega automaticamente

4. **Para deploy:**
   ```bash
   npm run build
   ```

## 🐛 Debug e Troubleshooting

### **Verificar se está funcionando:**

1. Acesse `http://localhost:5173/`
2. Veja se aparece "🔥 HMR ATIVO" no canto da tela
3. Edite um arquivo SCSS e veja se muda instantaneamente

### **Problemas comuns:**

**❌ "Cannot GET /" ou erro 404:**

```bash
# Verifique se o WordPress está rodando em developer.etc
curl http://developer.etc/

# Se não estiver, inicie seu servidor local
```

**❌ Hot reload não funciona:**

```bash
# Verifique se está acessando pela porta correta
# Deve ser: http://localhost:5173/ (não developer.etc)
```

**❌ Estilos duplicados:**

```bash
# Limpe o cache e rebuilde
npm run build
npm run dev
```

**❌ Porta ocupada:**

```bash
# Mate processos na porta 5173
lsof -ti:5173 | xargs kill -9
npm run dev
```

## 🎯 Benefícios

### **Antes (sem proxy):**

- ❌ Editava SCSS → `npm run build` → F5 no navegador
- ❌ Workflow lento e manual
- ❌ Perdia estado da página

### **Agora (com proxy):**

- ✅ Editou SCSS → Vê mudança em 50ms
- ✅ Workflow fluido e automático
- ✅ Mantém estado da página
- ✅ Desenvolvimento muito mais rápido!

## 🔄 Comandos Úteis

```bash
# Desenvolvimento com proxy + HMR
npm run dev

# Build para produção
npm run build

# Build com watch (sem proxy)
npm run watch

# Parar servidor Vite
Ctrl+C no terminal ou:
lsof -ti:5173 | xargs kill -9
```

---

**🎊 Agora você tem um ambiente de desenvolvimento moderno com hot reload completo para WordPress!**
