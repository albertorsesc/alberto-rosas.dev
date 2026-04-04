# Design System — alberto-rosas.dev

## Color Tokens (oklch)

```css
:root {
    /* === Brand Colors === */
    --color-cyan-500:    oklch(65% 0.2 230);     /* Primary: tech/professional */
    --color-cyan-400:    oklch(75% 0.15 230);
    --color-cyan-600:    oklch(55% 0.22 230);
    --color-amber-500:   oklch(75% 0.15 70);     /* Secondary: personal/warm */
    --color-amber-400:   oklch(82% 0.12 70);
    --color-amber-600:   oklch(65% 0.18 70);

    /* === Neutrals === */
    --color-surface:     oklch(98% 0.005 260);   /* Light mode bg */
    --color-surface-alt: oklch(95% 0.008 260);   /* Card/section bg */
    --color-border:      oklch(90% 0.01 260);
    --color-text:        oklch(25% 0.01 260);    /* Primary text */
    --color-text-muted:  oklch(50% 0.01 260);    /* Secondary text */
    --color-text-subtle: oklch(65% 0.008 260);   /* Tertiary text */

    /* === Dark Mode === */
    --color-dark-surface:     oklch(12% 0.01 260);
    --color-dark-surface-alt: oklch(18% 0.015 260);
    --color-dark-border:      oklch(25% 0.015 260);
    --color-dark-text:        oklch(90% 0.005 260);
    --color-dark-text-muted:  oklch(65% 0.008 260);
}

/* Dark mode swap */
.dark {
    --color-surface:     var(--color-dark-surface);
    --color-surface-alt: var(--color-dark-surface-alt);
    --color-border:      var(--color-dark-border);
    --color-text:        var(--color-dark-text);
    --color-text-muted:  var(--color-dark-text-muted);
}
```

---

## Typography

### Font Stack
```css
:root {
    --font-heading: 'DM Serif Display', Georgia, serif;
    --font-body: 'Inter Variable', 'Inter', system-ui, sans-serif;
    --font-mono: 'JetBrains Mono', 'Fira Code', monospace;
}
```

### Fluid Type Scale
```css
:root {
    --text-xs:   clamp(0.75rem,  0.7rem  + 0.26vw, 0.875rem);
    --text-sm:   clamp(0.875rem, 0.82rem + 0.29vw, 1rem);
    --text-base: clamp(1rem,     0.95rem + 0.26vw, 1.125rem);
    --text-lg:   clamp(1.125rem, 1rem    + 0.65vw, 1.5rem);
    --text-xl:   clamp(1.25rem,  1rem    + 1.3vw,  2rem);
    --text-2xl:  clamp(1.5rem,   1rem    + 2.6vw,  3rem);
    --text-3xl:  clamp(2rem,     1.2rem  + 4.2vw,  4.5rem);
    --text-hero: clamp(2.5rem,   1rem    + 6.5vw,  7rem);
}
```

### Usage
- **Hero text**: `--text-hero` with `--font-heading`, letter-spacing: -0.02em
- **Section headings**: `--text-3xl` with `--font-heading`
- **Card headings**: `--text-xl` with `--font-body`, weight 600
- **Body**: `--text-base` with `--font-body`, weight 400, line-height 1.7
- **Labels/meta**: `--text-sm` with `--font-body`, weight 500, `--color-text-muted`
- **Code/tech**: `--text-sm` with `--font-mono`

---

## Spacing Scale

```css
:root {
    --space-1:  0.25rem;   /* 4px */
    --space-2:  0.5rem;    /* 8px */
    --space-3:  0.75rem;   /* 12px */
    --space-4:  1rem;      /* 16px */
    --space-6:  1.5rem;    /* 24px */
    --space-8:  2rem;      /* 32px */
    --space-12: 3rem;      /* 48px */
    --space-16: 4rem;      /* 64px */
    --space-24: 6rem;      /* 96px */
    --space-32: 8rem;      /* 128px */
}
```

---

## Border Radius

```css
:root {
    --radius-sm:   0.375rem;  /* 6px - buttons, inputs */
    --radius-md:   0.75rem;   /* 12px - cards */
    --radius-lg:   1rem;      /* 16px - large cards */
    --radius-xl:   1.5rem;    /* 24px - hero cards, bento items */
    --radius-full: 9999px;    /* pills, avatars */
}
```

---

## Shadows

```css
:root {
    --shadow-sm:  0 1px 2px oklch(0% 0 0 / 0.05);
    --shadow-md:  0 4px 6px oklch(0% 0 0 / 0.07), 0 2px 4px oklch(0% 0 0 / 0.05);
    --shadow-lg:  0 10px 15px oklch(0% 0 0 / 0.1), 0 4px 6px oklch(0% 0 0 / 0.05);
    --shadow-xl:  0 20px 25px oklch(0% 0 0 / 0.1), 0 8px 10px oklch(0% 0 0 / 0.04);
}
```

---

## Motion Tokens

```css
:root {
    --ease-out:    cubic-bezier(0.16, 1, 0.3, 1);
    --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
    --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);

    --duration-fast:   150ms;
    --duration-normal: 300ms;
    --duration-slow:   500ms;
    --duration-reveal: 800ms;
}

@media (prefers-reduced-motion: reduce) {
    :root {
        --duration-fast:   0ms;
        --duration-normal: 0ms;
        --duration-slow:   0ms;
        --duration-reveal: 0ms;
    }
}
```

---

## Component Patterns

### Bento Card
```css
.bento-card {
    background: var(--color-surface-alt);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    transition: transform var(--duration-normal) var(--ease-out),
                box-shadow var(--duration-normal) var(--ease-out);
}
.bento-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}
```

### Link Underline
```css
.link {
    text-decoration: none;
    background-image: linear-gradient(var(--color-cyan-500), var(--color-cyan-500));
    background-size: 0% 2px;
    background-position: left bottom;
    background-repeat: no-repeat;
    transition: background-size var(--duration-normal) var(--ease-out);
}
.link:hover {
    background-size: 100% 2px;
}
```

### Tag/Pill
```css
.tag {
    font-family: var(--font-mono);
    font-size: var(--text-xs);
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    background: var(--color-surface-alt);
    border: 1px solid var(--color-border);
    color: var(--color-text-muted);
}
```

---

## Tailwind Config Mapping

```js
// tailwind.config.js additions
module.exports = {
    theme: {
        extend: {
            fontFamily: {
                heading: ['DM Serif Display', 'Georgia', 'serif'],
                body: ['Inter Variable', 'Inter', 'system-ui', 'sans-serif'],
                mono: ['JetBrains Mono', 'Fira Code', 'monospace'],
            },
            colors: {
                brand: {
                    cyan: 'oklch(65% 0.2 230)',
                    amber: 'oklch(75% 0.15 70)',
                },
                surface: {
                    DEFAULT: 'oklch(98% 0.005 260)',
                    alt: 'oklch(95% 0.008 260)',
                },
            },
            borderRadius: {
                'card': '0.75rem',
                'bento': '1.5rem',
            },
        },
    },
};
```
