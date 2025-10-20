# Guia de Uso - Classes SCSS + TailwindCSS

## 🎨 Sistema de Classes Híbrido

Este tema combina SCSS personalizado com TailwindCSS para máxima flexibilidade.

## 📝 Componentes Personalizados

### Botões (`.btn`)

```html
<!-- Botão primário -->
<a href="#" class="btn btn-primary">Botão Primário</a>

<!-- Botão secundário -->
<a href="#" class="btn btn-secondary">Botão Secundário</a>

<!-- Botão outline -->
<a href="#" class="btn btn-outline">Botão Outline</a>

<!-- Botão ghost -->
<a href="#" class="btn btn-ghost">Botão Ghost</a>

<!-- Tamanhos -->
<a href="#" class="btn btn-primary btn-sm">Pequeno</a>
<a href="#" class="btn btn-primary btn-lg">Grande</a>
```

### Cards (`.card`)

```html
<!-- Card básico -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Título do Card</h3>
  </div>
  <div class="card-body">
    <p class="card-content">Conteúdo do card...</p>
    <a href="#" class="card-link">Leia mais</a>
  </div>
</div>

<!-- Card com imagem -->
<div class="card card-post">
  <img src="image.jpg" alt="" class="card-image" />
  <div class="card-body">
    <h3 class="card-title">Post Title</h3>
    <div class="card-meta"><span>Data</span> • <span>Autor</span></div>
    <p class="card-content">Resumo do post...</p>
  </div>
</div>

<!-- Card de depoimento -->
<div class="card card-testimonial">
  <div class="card-body">
    <p class="card-content">"Excelente trabalho!"</p>
    <p class="card-meta">- Cliente Satisfeito</p>
  </div>
</div>
```

### Header (`.site-header`)

```html
<header class="site-header">
  <div class="container">
    <div class="site-branding">
      <h1><a href="/">Logo</a></h1>
    </div>

    <button class="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="main-navigation">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Sobre</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
    </nav>
  </div>
</header>
```

## 🎯 Usando TailwindCSS

Você pode usar todas as classes do TailwindCSS normalmente:

```html
<!-- Layout -->
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Conteúdo -->
  </div>
</div>

<!-- Tipografia -->
<h1 class="text-4xl font-bold text-gray-900 mb-6">Título</h1>
<p class="text-gray-600 leading-relaxed">Parágrafo...</p>

<!-- Cores personalizadas -->
<div class="bg-primary text-white p-4">Cor primária</div>
<div class="bg-secondary text-white p-4">Cor secundária</div>

<!-- Espaçamento -->
<div class="mt-8 mb-4 p-6">Conteúdo</div>

<!-- Flexbox -->
<div class="flex items-center justify-between">
  <span>Esquerda</span>
  <span>Direita</span>
</div>
```

## 🔧 Customização SCSS

### Variáveis (em `_variables.scss`)

```scss
// Cores personalizadas
$color-primary: #0073aa;
$color-secondary: #23282d;
$color-text: #333;
$color-bg: #fff;

// Tipografia
$font-primary: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
$font-size-base: 16px;

// Breakpoints
$breakpoint-mobile: 480px;
$breakpoint-tablet: 768px;
$breakpoint-desktop: 1024px;
```

### Mixins (em `_mixins.scss`)

```scss
// Usar mixins personalizados
.meu-componente {
  @include responsive(tablet) {
    // Estilos para tablet
  }

  @include flex-center;
}
```

### Combinar SCSS com Tailwind

```scss
.meu-componente {
  // Usar @apply para classes do Tailwind
  @apply bg-white rounded-lg shadow-md p-6;

  // Misturar com SCSS tradicional
  border-left: 4px solid $color-primary;

  &:hover {
    @apply shadow-lg;
    transform: translateY(-2px);
  }

  .titulo {
    @apply text-xl font-bold mb-4;
    color: $color-primary;
  }
}
```

## 📱 Responsividade

### Breakpoints TailwindCSS

- `sm:` 640px+
- `md:` 768px+
- `lg:` 1024px+
- `xl:` 1280px+

### Breakpoints SCSS Personalizados

```scss
.componente {
  @include responsive(mobile) {
    // Até 480px
  }

  @include responsive(tablet) {
    // Até 768px
  }

  @include responsive(desktop) {
    // 1024px+
  }
}
```

## 🎨 Blocks WordPress

O tema inclui estilos para blocks do Gutenberg:

```scss
// Personalizar blocks
.wp-block-quote {
  @apply border-l-4 border-primary pl-6 italic;
}

.wp-block-button .wp-block-button__link {
  @apply btn btn-primary;
}
```

## 🚀 Performance

- Classes CSS são compiladas e otimizadas pelo Vite
- TailwindCSS remove classes não utilizadas automaticamente
- SCSS permite organização modular
- Hot Module Replacement para desenvolvimento rápido

## 💡 Dicas de Uso

1. **Priorize componentes SCSS** para elementos reutilizáveis
2. **Use TailwindCSS** para ajustes rápidos e layouts
3. **Combine ambos** quando necessário
4. **Mantenha consistência** nas cores e espaçamentos
5. **Use variáveis SCSS** para valores personalizados
