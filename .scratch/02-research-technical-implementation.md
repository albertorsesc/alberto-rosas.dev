# Technical Implementation Research — Modern Portfolio 2026

## Stack: Laravel + Tailwind CSS + Alpine.js (No React/Vue)

### Key Headlines
- **GSAP is now fully free** (Webflow acquired it Oct 2024, all Club plugins included)
- **CSS scroll-driven animations are cross-browser baseline** — production-ready
- **View Transitions API works for MPA** — one CSS line gives free page transitions to Laravel

---

## 1. Animation Libraries

### GSAP + ScrollTrigger (Industry Standard, Now Free)

```html
<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js"></script>
```

**Alpine.js integration:**
```html
<div x-data x-init="$nextTick(() => {
    gsap.registerPlugin(ScrollTrigger);
    gsap.from($el.querySelectorAll('.card'), {
        y: 60, opacity: 0, duration: 0.8, stagger: 0.12,
        ease: 'power3.out',
        scrollTrigger: { trigger: $el, start: 'top 80%' }
    });
})">
```

**Key patterns:** Scrubbed scroll, pin + horizontal scroll, batch reveals, responsive via matchMedia.

### Lenis (Smooth Scrolling, <4kb)

```html
<link rel="stylesheet" href="https://unpkg.com/lenis@1.3.21/dist/lenis.css">
<script src="https://unpkg.com/lenis@1.3.21/dist/lenis.min.js"></script>
```

```javascript
const lenis = new Lenis({ duration: 1.2, lerp: 0.1 });
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => { lenis.raf(time * 1000); });
gsap.ticker.lagSmoothing(0);
```

Maintains compatibility with `position: sticky`.

### Motion (motion.dev) — Lightweight (2.3kb core)

```javascript
import { animate, inView, scroll } from 'https://cdn.jsdelivr.net/npm/motion@latest/+esm';
inView('.project-card', ({ target }) => {
    animate(target, { opacity: [0, 1], y: [40, 0] }, { duration: 0.6 });
});
```

### Auto-Animate (FormKit) — Zero Config
```html
<ul x-data x-init="autoAnimate($el)">
```

---

## 2. CSS Scroll-Driven Animations (Production-Ready)

**Browser support:** Chrome 115+, Edge 115+, Safari 18+, Firefox 129+

```css
/* Fade-in on scroll — replaces 90% of IntersectionObserver setups */
.reveal {
    animation: fade-up linear both;
    animation-timeline: view();
    animation-range: entry 0% entry 60%;
}

@keyframes fade-up {
    from { opacity: 0; transform: translateY(40px) scale(0.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

/* Reading progress bar */
.reading-progress {
    position: fixed; top: 0; left: 0; height: 3px; width: 100%;
    background: oklch(65% 0.2 250);
    transform-origin: left;
    animation: grow-bar linear;
    animation-timeline: scroll(root block);
}

/* Parallax — zero JavaScript */
.parallax-bg {
    animation: parallax-shift linear;
    animation-timeline: view();
    animation-range: cover 0% cover 100%;
}
```

**Always provide reduced-motion fallback:**
```css
@media (prefers-reduced-motion: reduce) { .reveal { animation: none; } }
```

---

## 3. View Transitions API (Game-Changer for Laravel)

**Cross-document MPA transitions — ONE LINE of CSS:**
```css
@view-transition { navigation: auto; }
```

Every Laravel page navigation gets animated transitions with zero JavaScript.

**Named element transitions (card → detail page):**
```css
.project-card[data-id="{{ $project->id }}"] { view-transition-name: project-{{ $project->id }}; }
.project-hero { view-transition-name: project-{{ $project->id }}; }
```

---

## 4. @starting-style (Entry Animations Without JS)

```css
dialog {
    opacity: 1; transform: translateY(0);
    transition: opacity 0.3s, transform 0.3s, display 0.3s allow-discrete;
    @starting-style { opacity: 0; transform: translateY(-20px); }
}
```

---

## 5. Modern CSS Techniques

### oklch Colors + color-mix()
```css
:root {
    --brand: oklch(65% 0.2 250);
    --brand-light: oklch(85% 0.1 250);
    --surface: oklch(98% 0.005 250);
    --text: oklch(20% 0.01 250);
}
.tint { background: oklch(from var(--brand) calc(l + 0.15) c h); }
```

### Container Queries (Tailwind v4)
```html
<div class="@container">
    <div class="grid grid-cols-1 @md:grid-cols-2 @xl:grid-cols-3 gap-4">
```

### CSS Nesting (Native, No Sass)
### :has() Selector (95%+ support)
### CSS Grid Subgrid (97% support)

---

## 6. Typography

### Fluid Typography with clamp()
```css
:root {
    --text-base: clamp(1rem, 0.95rem + 0.26vw, 1.125rem);
    --text-hero: clamp(2.5rem, 1rem + 6.5vw, 7rem);
}
```

### Variable Fonts — One File, All Weights
```css
@font-face {
    font-family: 'Inter Variable';
    src: url('/fonts/InterVariable.woff2') format('woff2');
    font-weight: 100 900;
    font-display: swap;
}
/* Animate weight on hover — only with variable fonts */
.nav-link { font-variation-settings: 'wght' 400; transition: font-variation-settings 0.2s; }
.nav-link:hover { font-variation-settings: 'wght' 700; }
```

### Recommended Pairings 2026
| Heading | Body | Character |
|---|---|---|
| DM Serif Display | Inter Variable | Sophisticated + precise |
| Clash Display | Satoshi | Bold + geometric |
| Space Grotesk | Inter | Clean mono-inspired |
| Playfair Display | Lato | Classic contrast |

---

## 7. Layout Techniques

### Bento Grid
```css
.bento {
    display: grid;
    grid-template-columns: repeat(12, minmax(0, 1fr));
    grid-auto-rows: 200px;
    grid-auto-flow: dense;
    gap: 1rem;
}
.bento-hero { grid-column: span 8; grid-row: span 2; }
.bento-tall { grid-column: span 4; grid-row: span 2; }
```

### Section Snapping
```css
.scroll-container { scroll-snap-type: y proximity; }
.section { scroll-snap-align: start; }
```

### Sticky Scrolling Sections (Pure CSS)
### Parallax Without JavaScript (CSS scroll-driven)

---

## 8. Performance Rules

### Compositor-Only Properties (60fps guaranteed)
- `transform` ✅ and `opacity` ✅ — always use these
- `width`, `height`, `top`, `left` ❌ — triggers layout

### Core Web Vitals
- LCP: Don't start hero with `opacity: 0`; use `@starting-style` instead
- CLS: Only animate transform/opacity; use `aspect-ratio` on images
- INP: Use CSS scroll-driven animations (off main thread)

### Quick Checklist
```
[ ] Lenis + GSAP via CDN
[ ] Wire Lenis to GSAP ticker
[ ] @view-transition { navigation: auto; } in app.css
[ ] Type scale with clamp() in :root
[ ] Color palette in oklch
[ ] [data-reveal] pattern with IntersectionObserver
[ ] prefers-reduced-motion fallbacks
[ ] Variable font with font-display: swap
[ ] Bento grid with grid-auto-flow: dense
[ ] fetchpriority="high" on LCP image
[ ] width + height on all images
```

---

## Sources
- modern-css.com, MDN, Chrome for Developers, CSS-Tricks
- gsapify.com, gsap.com, webflow.com/blog/gsap-becomes-free
- lenis.dev, motion.dev
- evilmartians.com (oklch), fluid-type-scale.com
- smashingmagazine.com, iamsteve.me (bento grids)
