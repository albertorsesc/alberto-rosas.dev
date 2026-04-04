# Interaction Design & Animation Plan — alberto-rosas.dev

## Philosophy
> Motion is communication, not decoration.
> Every animation must convey information or create emotional connection.
> Fast and subtle > slow and dramatic.

---

## 1. Global Animations

### Page Transitions (View Transitions API)
```css
/* Add to app.css — instant MPA transitions for free */
@view-transition {
    navigation: auto;
}

::view-transition-old(root) {
    animation: 250ms ease-out fade-out;
}
::view-transition-new(root) {
    animation: 250ms ease-out fade-in;
}

@keyframes fade-out { to { opacity: 0; } }
@keyframes fade-in { from { opacity: 0; } }
```

### Smooth Scrolling (Lenis + GSAP)
```javascript
// In app.js or layout script
const lenis = new Lenis({ duration: 1.2, lerp: 0.1 });
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => lenis.raf(time * 1000));
gsap.ticker.lagSmoothing(0);
```

### Scroll Reveals (CSS Scroll-Driven — No JS)
```css
[data-reveal] {
    animation: reveal-up linear both;
    animation-timeline: view();
    animation-range: entry 0% entry 50%;
}

@keyframes reveal-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (prefers-reduced-motion: reduce) {
    [data-reveal] { animation: none; opacity: 1; }
}
```

Usage in Blade:
```html
<div data-reveal>Any element that should fade in on scroll</div>
```

---

## 2. Hero Animations

### Staggered Text Entrance (GSAP)
```javascript
// In hero Alpine component
gsap.from('.hero-line', {
    y: 80,
    opacity: 0,
    duration: 1,
    stagger: 0.15,
    ease: 'power3.out',
    delay: 0.3,
});

gsap.from('.hero-photo', {
    scale: 0.9,
    opacity: 0,
    duration: 1.2,
    ease: 'power3.out',
    delay: 0.6,
});

gsap.from('.hero-cta', {
    y: 20,
    opacity: 0,
    duration: 0.8,
    stagger: 0.1,
    ease: 'power3.out',
    delay: 1,
});
```

### Hero Parallax on Scroll (CSS)
```css
.hero-photo {
    animation: hero-parallax linear;
    animation-timeline: scroll();
    animation-range: 0% 50vh;
}

@keyframes hero-parallax {
    to {
        transform: translateY(-40px) scale(0.95);
        opacity: 0.6;
    }
}
```

---

## 3. Bento Grid Animations

### Staggered Card Reveal (GSAP Batch)
```javascript
gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.batch('.bento-card', {
    onEnter: (elements) => {
        gsap.from(elements, {
            y: 40,
            opacity: 0,
            duration: 0.7,
            stagger: 0.08,
            ease: 'power3.out',
        });
    },
    once: true,
    start: 'top 85%',
});
```

### Card Hover — Subtle Lift
```css
.bento-card {
    transition: transform 300ms cubic-bezier(0.16, 1, 0.3, 1),
                box-shadow 300ms cubic-bezier(0.16, 1, 0.3, 1);
}

.bento-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px oklch(0% 0 0 / 0.08);
}
```

### Card Hover — 3D Tilt (Alpine.js)
```html
<div x-data="{
    rotateX: 0, rotateY: 0,
    handleMove(e) {
        const rect = $el.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        this.rotateX = y * -8;
        this.rotateY = x * 8;
    },
    handleLeave() { this.rotateX = 0; this.rotateY = 0; }
}"
    @mousemove="handleMove($event)"
    @mouseleave="handleLeave()"
    :style="`transform: perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg); transition: transform 0.15s ease-out;`"
    class="bento-card">
    <!-- card content -->
</div>
```

---

## 4. Navigation

### Variable Font Weight on Hover
```css
.nav-link {
    font-family: var(--font-body);
    font-variation-settings: 'wght' 400;
    transition: font-variation-settings 200ms ease;
}

.nav-link:hover,
.nav-link[aria-current="page"] {
    font-variation-settings: 'wght' 650;
}
```

### Active Page Indicator
```css
.nav-link[aria-current="page"]::after {
    content: '';
    display: block;
    height: 2px;
    background: var(--color-cyan-500);
    border-radius: 1px;
    animation: underline-in 300ms ease-out;
}

@keyframes underline-in {
    from { transform: scaleX(0); }
    to { transform: scaleX(1); }
}
```

### Mobile Menu — Full Screen Overlay
```css
.mobile-menu {
    position: fixed;
    inset: 0;
    background: var(--color-surface);
    z-index: 50;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: var(--space-8);

    /* @starting-style entry animation */
    opacity: 1;
    transform: translateY(0);
    transition: opacity 300ms ease, transform 300ms ease, display 300ms allow-discrete;

    @starting-style {
        opacity: 0;
        transform: translateY(20px);
    }
}
```

---

## 5. Blog Interactions

### Reading Progress Bar (CSS-Only)
```css
.reading-progress {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    width: 100%;
    background: var(--color-cyan-500);
    transform-origin: left;
    z-index: 100;
    animation: grow-progress linear;
    animation-timeline: scroll(root block);
}

@keyframes grow-progress {
    from { transform: scaleX(0); }
    to { transform: scaleX(1); }
}
```

### TOC Active Heading Highlight
```css
.toc-link {
    color: var(--color-text-muted);
    transition: color 200ms ease, padding-left 200ms ease;
}

.toc-link.active {
    color: var(--color-cyan-500);
    padding-left: 0.5rem;
    border-left: 2px solid var(--color-cyan-500);
}
```

---

## 6. Link & Button Interactions

### Draw-In Underline
```css
.text-link {
    text-decoration: none;
    background-image: linear-gradient(var(--color-cyan-500), var(--color-cyan-500));
    background-size: 0% 1.5px;
    background-position: left bottom;
    background-repeat: no-repeat;
    transition: background-size 300ms cubic-bezier(0.16, 1, 0.3, 1);
}

.text-link:hover {
    background-size: 100% 1.5px;
}
```

### Button Hover
```css
.btn-primary {
    background: var(--color-cyan-500);
    color: white;
    padding: var(--space-3) var(--space-6);
    border-radius: var(--radius-sm);
    transition: background 200ms ease, transform 150ms ease;
}

.btn-primary:hover {
    background: var(--color-cyan-600);
    transform: translateY(-1px);
}

.btn-primary:active {
    transform: translateY(0);
}
```

---

## 7. Easter Eggs

### Console Greeting
```javascript
// In app.js
console.log(
    '%c Hey, you opened devtools. I respect that. 🔧',
    'color: oklch(65% 0.2 230); font-size: 14px; font-weight: bold;'
);
console.log(
    '%c Built with Laravel, Alpine.js, and too much coffee.',
    'color: gray; font-size: 12px;'
);
console.log(
    '%c Curious about how this works? → alberto.rsesc@protonmail.com',
    'color: gray; font-size: 12px;'
);
```

### Time-Based Greeting (Alpine.js)
```html
<span x-data="{
    greeting: (() => {
        const h = new Date().getHours();
        if (h < 12) return 'Buenos días';
        if (h < 18) return 'Buenas tardes';
        return 'Buenas noches';
    })()
}" x-text="greeting"></span>
```

### Konami Code
```javascript
// In app.js
let konamiIndex = 0;
const konamiCode = [38,38,40,40,37,39,37,39,66,65];

document.addEventListener('keydown', (e) => {
    if (e.keyCode === konamiCode[konamiIndex]) {
        konamiIndex++;
        if (konamiIndex === konamiCode.length) {
            // Trigger Easter egg — e.g., play engine sound, show surprise
            document.body.classList.add('easter-egg-active');
            konamiIndex = 0;
        }
    } else {
        konamiIndex = 0;
    }
});
```

---

## 8. Dark Mode Transition

```css
/* Smooth transition when toggling dark mode */
html {
    transition: background-color 500ms ease, color 300ms ease;
}

html * {
    transition: background-color 300ms ease,
                border-color 300ms ease,
                color 200ms ease,
                box-shadow 300ms ease;
}

/* Disable transitions during page load to prevent flash */
html.no-transition * {
    transition: none !important;
}
```

---

## 9. Performance Guardrails

### Rules
1. **Only animate `transform` and `opacity`** — compositor-only = 60fps
2. **CSS scroll-driven animations > JS** — runs off main thread
3. **`will-change` only on `:hover`** — not globally
4. **Always `prefers-reduced-motion` fallback** — accessibility first
5. **No layout-shifting animations** — no animating width, height, margin, padding
6. **Lazy load below-fold images** — `loading="lazy" decoding="async"`
7. **`fetchpriority="high"` on hero image** — LCP optimization
8. **Preload critical font** — `<link rel="preload" as="font">`

### Reduced Motion
```css
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}
```
