# Design Direction — alberto-rosas.dev Overhaul

## The Vision

**Alberto Rosas is not a template. His site shouldn't be one either.**

The current site says "AI Engineer who does consulting." The new site should say: "A multi-dimensional human who happens to be brilliant at AI engineering — and here's proof."

### Design Pillars

1. **Human First, Engineer Second** — Lead with personality, not credentials
2. **Warm Minimalism** — Clean and spacious, but not cold or clinical
3. **Crafted, Not Assembled** — Every detail intentional, nothing default
4. **Alive, Not Static** — Subtle motion, dynamic content, a site that breathes
5. **Dual Identity** — Professional precision (cyan) meets personal warmth (amber)

---

## Mood & Aesthetic

### The Feel
- Like walking into a well-designed home office — warm, personal, but clearly where serious work happens
- Think Dieter Rams meets a Mexican workshop — precision with soul
- Not "tech bro portfolio" — not dark mode with neon gradients
- Not "agency template" — not grid of project cards with hover effects
- **YES:** Editorial confidence, considered typography, breathing room, authentic photography

### Visual References
- **Lee Robinson** (leerob.io) — writing-first minimalism, content confidence
- **Paco Coursey** (paco.me) — extreme refinement, every pixel earned
- **Cassidy Williams** (cassidoo.co) — personality forward, playful but professional
- **Josh Comeau** (joshwcomeau.com) — interactive proof of craft

### What Makes This Different From Current Site
| Current | New Direction |
|---|---|
| GitHub avatar | Real lifestyle photography |
| "I architect Intelligent Systems..." | Human-first tagline with personality |
| Cyan monochrome | Dual palette: cyan (tech) + amber (personal) |
| Single Inter font weight | Serif/sans pairing with fluid sizing |
| Generic section layout | Bento grid with editorial feel |
| IntersectionObserver only | GSAP + Lenis + CSS scroll-driven animations |
| Hardcoded data dump | Narrative storytelling with hierarchy |
| No 404 or Easter eggs | Personality at every touchpoint |
| Blog as separate section | Writing integrated into identity |

---

## Color Direction

### Primary: Cool Professional
- **Cyan/Blue** — `oklch(65% 0.2 250)` — tech, trust, precision
- Used for: links, CTAs, code blocks, tech-related sections

### Secondary: Warm Personal
- **Amber/Rust** — `oklch(70% 0.15 70)` — warmth, craft, Mexico
- Used for: personal sections, /now page, about narrative, accent highlights

### Neutrals
- **Off-white surface** — `oklch(98% 0.005 250)` — warm, not stark
- **Deep dark** — `oklch(15% 0.01 260)` — rich, not black
- **Text** — `oklch(25% 0.01 260)` — readable, warm

### Dark Mode
- Invert surfaces, keep accent colors
- Dark mode should feel like evening light, not a void

---

## Typography Direction

### Heading: Serif with Authority
- **DM Serif Display** or **Playfair Display** — for hero, section headings
- Communicates: depth, experience, craft, not just "tech guy"

### Body: Clean Sans
- **Inter Variable** — self-hosted, full weight range
- Fluid sizing with `clamp()` — no breakpoint jumps

### Mono: Code Moments
- **JetBrains Mono** or **Fira Code** — for inline code, /uses page, tech details

### Scale
```
Hero:    clamp(2.5rem, 1rem + 6.5vw, 7rem)
H2:      clamp(2rem, 1.2rem + 4.2vw, 4.5rem)
H3:      clamp(1.5rem, 1rem + 2.6vw, 3rem)
Body:    clamp(1rem, 0.95rem + 0.26vw, 1.125rem)
Small:   clamp(0.875rem, 0.82rem + 0.29vw, 1rem)
```

---

## Layout Direction

### Homepage: Bento-Inspired Editorial
- **NOT** a linear scroll of full-width sections
- Bento grid with varied card sizes creating visual rhythm
- Hero section: full-width, immersive, text + photography
- Below: asymmetric grid mixing professional + personal cards

### Content Hierarchy (Homepage)
1. **Hero** — Name, human-first tagline, real photo, time-based greeting
2. **Bento Grid** — Mixed cards:
   - Currently building (live/dynamic)
   - Latest blog post
   - Quick about snippet
   - Tech stack visual
   - Harley/personal card
   - Contact CTA
3. **About Narrative** — Full origin story with photos
4. **Selected Work** — Not all services, just highlights
5. **Writing** — Recent posts with editorial feel
6. **Contact** — Warm, personal CTA

### Interior Pages
- `/blog` — Editorial index, beautiful typography
- `/blog/{slug}` — Reading-focused, prose-first
- `/now` — Current state, updated monthly
- `/uses` — Tools, setup, AI stack
- `/about` — Full narrative with timeline + photos

---

## Motion Direction

### Philosophy: Motion as Communication, Not Decoration
- Every animation must convey information or create connection
- Fast and subtle > slow and dramatic
- Scroll-driven where possible (off main thread)
- Always respect `prefers-reduced-motion`

### Specific Animations
1. **Page transitions** — View Transitions API (`@view-transition { navigation: auto; }`)
2. **Scroll reveals** — CSS `animation-timeline: view()` for cards
3. **Smooth scrolling** — Lenis with GSAP ticker sync
4. **Hero** — Staggered text entrance, photo scale-in
5. **Bento cards** — Staggered batch reveal on scroll
6. **Nav** — Variable font weight animation on hover
7. **Reading progress** — CSS scroll-driven progress bar on blog posts

### What to Remove
- Current decorative gradient blurs (cyan blobs)
- Overly long stagger delays
- The mobile drawer — replace with cleaner pattern

---

## Photography Direction

### Must-Have Shots
1. **Professional candid** — natural light, working environment, approachable
2. **The Harley** — riding or with the bike, shows personality
3. **Family moment** — authentic, not staged
4. **Mexico connection** — landscape, culture, or subtle visual nod

### Style
- Natural lighting, slightly desaturated
- Not Instagram-filtered, not corporate-sterile
- Warm tones that complement the amber accent
- Consistent editing style across all photos

---

## Key Micro-Interactions

1. **Time-based greeting** — "Buenos días/tardes/noches" in hero
2. **Console message** — Styled dev greeting in browser console
3. **Custom 404** — Harley-themed dead-end page
4. **Nav hover** — Font weight animation + color shift
5. **Card hover** — Subtle 3D tilt via CSS perspective
6. **Link hover** — Underline draws in from left
7. **Dark mode toggle** — Smooth color transition, not instant swap
