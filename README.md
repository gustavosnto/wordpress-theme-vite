# Tema WordPress Moderno

Tema WordPress com Vite, SCSS + TailwindCSS integrado e Swiper para desenvolvimento moderno e performance otimizada.

## 🚀 Tecnologias

- **Vite 5** - Build tool rápido com HMR (Hot Module Replacement)
- **SCSS + TailwindCSS** - SCSS como principal com TailwindCSS integrado via @apply
- **Swiper** - Slider/carousel moderno e responsivo
- **PostCSS** - Processamento de CSS
- **WordPress** - CMS robusto e flexível

## 🎨 Sistema de Estilos Híbrido

Este tema combina o melhor dos dois mundos:

- **SCSS** para componentes reutilizáveis e organização modular
- **TailwindCSS** integrado via `@apply` para utilidades e rapidez
- **Componentes personalizados** como `.btn`, `.card`, etc.
- **Classes TailwindCSS** disponíveis para uso direto no HTML

## 📦 Instalação

1. Clone o repositório no diretório de temas do WordPress:

```bash
cd wp-content/themes/
git clone <url-do-repositorio> meu-tema
cd meu-tema
```

2. Instale as dependências:

```bash
npm install
```

## 🛠️ Desenvolvimento

1. Ative o tema no WordPress
2. Ative `WP_DEBUG` no wp-config.php:

```php
define('WP_DEBUG', true);
```

3. Inicie o servidor de desenvolvimento:

```bash
npm run dev
```

4. Acesse seu site WordPress - o HMR estará ativo!

## 🏗️ Build para Produção

```bash
npm run build
```

Os arquivos otimizados serão gerados na pasta `assets/`.

## 🎨 Estrutura do Projeto

```
tema/
├── src/
│   ├── scss/
│   │   ├── style.scss          # SCSS principal + TailwindCSS
│   │   ├── _variables.scss     # Variáveis personalizadas
│   │   ├── _mixins.scss        # Mixins SCSS
│   │   ├── _reset.scss         # Reset CSS
│   │   └── components/
│   │       ├── _header.scss    # Componente header
│   │       ├── _footer.scss    # Componente footer
│   │       ├── _buttons.scss   # Sistema de botões
│   │       └── _cards.scss     # Sistema de cards
│   ├── js/
│   │   ├── main.js            # Entry point JavaScript
│   │   └── modules/
│   │       ├── menu.js        # Funcionalidade do menu
│   │       └── slider.js      # Configuração do Swiper
│   └── images/                # Imagens do tema
├── assets/                    # Arquivos compilados (produção)
├── inc/                       # Funções PHP modulares
├── parts/                     # Partes reutilizáveis do tema
├── templates/                 # Templates customizados
├── SCSS-GUIDE.md             # Guia de uso do sistema SCSS+Tailwind
└── *.php                     # Templates principais
```

## 🎯 Recursos

### Design e Layout

- ✅ Sistema híbrido SCSS + TailwindCSS
- ✅ Componentes SCSS personalizados (`.btn`, `.card`, etc.)
- ✅ Classes TailwindCSS disponíveis via `@apply` e HTML
- ✅ Design responsivo com breakpoints customizados
- ✅ Sistema de grid flexível
- ✅ Tipografia otimizada
- ✅ Paleta de cores customizável via variáveis SCSS

### Performance

- ✅ Hot Module Replacement (HMR)
- ✅ Build otimizado com Vite
- ✅ CSS e JavaScript minificados
- ✅ Carregamento condicional (dev/prod)
- ✅ Otimização de imagens

### Funcionalidades WordPress

- ✅ Suporte a menus customizados
- ✅ Suporte a imagens destacadas
- ✅ Suporte a logo customizado
- ✅ Custom Post Types ready
- ✅ SEO otimizado
- ✅ Estrutura semântica HTML5

### JavaScript/Interatividade

- ✅ Swiper slider configurado
- ✅ Menu responsivo
- ✅ Componentes modulares
- ✅ ES6+ modules

## 🎨 Customização

### Sistema SCSS + TailwindCSS

O tema usa um sistema híbrido único:

```scss
// Em arquivos SCSS, use @apply para classes Tailwind
.meu-componente {
  @apply bg-white rounded-lg shadow-md p-6;

  // Misture com SCSS tradicional
  border-left: 4px solid $color-primary;

  &:hover {
    @apply shadow-lg;
    transform: translateY(-2px);
  }
}
```

```html
<!-- No HTML, use componentes SCSS ou classes Tailwind -->
<button class="btn btn-primary">Componente SCSS</button>
<div class="bg-primary text-white p-4">Classes Tailwind diretas</div>
```

Veja o arquivo `SCSS-GUIDE.md` para exemplos completos.

### Variáveis SCSS

Personalize o tema editando `src/scss/_variables.scss`:

```scss
// Cores personalizadas (também disponíveis como classes Tailwind)
$color-primary: #0073aa; // Disponível como bg-primary, text-primary, etc.
$color-secondary: #23282d; // Disponível como bg-secondary, text-secondary, etc.

// Tipografia
$font-primary: "Sua Fonte", sans-serif;

// Breakpoints customizados
$breakpoint-tablet: 768px;
```

### Swiper

Configure sliders no arquivo `src/js/modules/slider.js`. Exemplos incluídos:

- Hero slider com fade effect
- Gallery slider responsivo
- Navegação e paginação
- Autoplay configurável

### Cores do Tema

Defina suas cores principais em `src/scss/_variables.scss` e elas ficarão disponíveis tanto como variáveis SCSS quanto como classes TailwindCSS:

```scss
// _variables.scss
$color-primary: "#0073aa";
$color-secondary: "#23282d";
```

```html
<!-- Automaticamente disponível como classes Tailwind -->
<div class="bg-primary text-white">Usando classe Tailwind</div>
```

```scss
// Também disponível como variável SCSS
.componente {
  background: $color-primary;
  @apply text-white; // Misturando ambos
}
```

## 📝 Templates Disponíveis

- `front-page.php` - Página inicial com hero slider
- `index.php` - Loop principal com grid de posts
- `single.php` - Post individual otimizado
- `page.php` - Páginas estáticas
- `archive.php` - Arquivos de categoria/tag
- `404.php` - Página de erro personalizada
- `searchform.php` - Formulário de busca estilizado

## 🔧 Configuração de Desenvolvimento

### VS Code (Recomendado)

Instale as extensões:

- Tailwind CSS IntelliSense
- PostCSS Language Support
- PHP Intelephense

### Configuração do WordPress

No `wp-config.php`:

```php
// Modo desenvolvimento
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);

// Modo produção
define('WP_DEBUG', false);
```

## 📚 Comandos Úteis

```bash
# Desenvolvimento com HMR
npm run dev

# Build para produção
npm run build

# Preview do build
npm run preview

# Instalar dependências
npm install
```

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença GNU General Public License v2 ou posterior.

## 🆘 Suporte

- Documentação: [WordPress Developer Reference](https://developer.wordpress.org/)
- TailwindCSS: [Documentação oficial](https://tailwindcss.com/docs)
- Swiper: [Documentação oficial](https://swiperjs.com/)
- Vite: [Documentação oficial](https://vitejs.dev/)
