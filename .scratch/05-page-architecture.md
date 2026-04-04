# Page Architecture — alberto-rosas.dev Overhaul

## Site Map

```
/                   → Homepage (bento-style personal landing)
/about              → Full narrative + origin story + photos
/blog               → Editorial blog index
/blog/{slug}        → Article page with reading progress
/now                → Current focus, projects, life (NEW)
/uses               → Tools, stack, setup (NEW)
/404                → Custom Harley-themed error page (NEW)
```

---

## Homepage (`/`)

### Section 1: Hero (Full Viewport)

```
┌──────────────────────────────────────────────────────┐
│                                                      │
│  [Time-based greeting: Buenos días / tardes / noches]│
│                                                      │
│  I'm Alberto Rosas.                    [Real Photo]  │
│  AI Engineer. Harley rider.                          │
│  Father. Builder of things                           │
│  that shouldn't exist yet.                           │
│                                                      │
│  [Let's Build Something →]  [Grab My Resume →]       │
│                                                      │
│  [LinkedIn] [GitHub] [X]                             │
│                                                      │
└──────────────────────────────────────────────────────┘
```

- Serif font for name + tagline
- Staggered GSAP text entrance
- Real lifestyle photo (not avatar)
- Time-based "Buenos días/tardes/noches" based on visitor timezone
- Subtle parallax on photo via CSS scroll-driven animation

### Section 2: Bento Grid

```
┌─────────────────────┬──────────┬──────────┐
│                     │          │          │
│  CURRENTLY          │ LATEST   │ ABOUT    │
│  BUILDING           │ POST     │ SNIPPET  │
│  (dynamic card)     │          │          │
│                     │          │          │
├──────────┬──────────┼──────────┴──────────┤
│          │          │                     │
│ TECH     │ HARLEY / │  SELECTED           │
│ STACK    │ PERSONAL │  WORK               │
│ VISUAL   │ CARD     │                     │
│          │          │                     │
├──────────┴──────────┼──────────┬──────────┤
│                     │          │          │
│  WRITING /          │ CONTACT  │ LOCATION │
│  THINKING ABOUT     │ CTA      │ /MEXICO  │
│                     │          │          │
└─────────────────────┴──────────┴──────────┘
```

**Card Types:**

1. **Currently Building** (span 8 cols, 2 rows) — Hero card
   - Current project name + one-liner
   - Tech tags
   - "In progress" status indicator
   - Updates when Alberto changes it

2. **Latest Blog Post** (span 4 cols, 1 row)
   - Title, date, excerpt
   - Link to full post

3. **About Snippet** (span 4 cols, 1 row)
   - One-paragraph essence
   - "Read my story →" link to /about

4. **Tech Stack** (span 4 cols, 1 row)
   - Visual icon grid of key technologies
   - Subtle hover effects

5. **Personal / Harley Card** (span 4 cols, 1 row)
   - Photo of the bike or riding
   - One personal line
   - Warm amber accent

6. **Selected Work** (span 8 cols, 1 row)
   - 2-3 highlight projects with descriptions
   - Not a full portfolio dump

7. **Writing / Thinking About** (span 8 cols, 1 row)
   - Recent 3 blog posts, editorial style
   - "Things I've Been Thinking About"

8. **Contact CTA** (span 4 cols, 1 row)
   - "Drop me a line"
   - Email + form link
   - Warm tone

9. **Location / Mexico** (span 4 cols, 1 row)
   - "Based in Mexico 🇲🇽"
   - Timezone indicator
   - Subtle cultural nod

### Section 3: Footer
- Minimal: name, links, "Built with Laravel + too much coffee"
- Social links
- Dark mode toggle

---

## About Page (`/about`)

### Structure
1. **Hero**: Full-width photo + "My Story" heading (serif)
2. **The Narrative** — Three acts:
   - **Act 1: The Beginning** — Mexico, early career, traditional web engineering
   - **Act 2: The Shift** — Recognizing the AI moment, making the pivot
   - **Act 3: The Present** — AI engineering, multi-agent systems, consulting
3. **The Human Side** — Equal visual weight:
   - The Harley and what it represents
   - Family
   - Mexico and identity
4. **Timeline** — Career milestones (simplified from current)
5. **CTA** — "Want to build something together?"

---

## Now Page (`/now`)

### Structure
Inspired by Derek Sivers' /now concept.

```
Last updated: [date]

## What I'm Building
- [Current project + description]
- [Side experiment]

## What I'm Learning
- [Topic/course/book]

## What I'm Reading
- [Book title + quick thought]

## What I'm Thinking About
- [Idea or question occupying mental space]

## Life Right Now
- [Personal update — family, bike, travel]
```

Simple Blade page, markdown-like styling, updated manually.

---

## Uses Page (`/uses`)

### Structure

```
## Development Environment
- Editor: [...]
- Terminal: [...]
- Theme: [...]

## AI / ML Stack
- Models: [...]
- Frameworks: LangGraph, Pydantic AI, CrewAI
- Vector DBs: [...]
- Evaluation: LangSmith, LangFuse

## Hardware
- Machine: [...]
- Monitor: [...]
- Keyboard: [...]
- Audio: [...]

## The Harley
- Model: [...]
- Mods: [...]
- (Yes, it counts as a tool)

## Software
- Design: [...]
- Notes: [...]
- Music: [...]
```

---

## Blog Index (`/blog`)

### Redesign
- **Editorial layout** — not a list of cards
- Featured/latest post: large hero card at top
- Remaining posts: 2-column grid below
- Category filter (pills)
- Clean typography, generous whitespace
- Each post shows: title, date, excerpt, category tag, reading time

---

## Blog Post (`/blog/{slug}`)

### Enhancements
- **Reading progress bar** (CSS scroll-driven, fixed top)
- **Table of contents** sidebar (sticky, highlights active)
- **Better typography** — serif headings, fluid sizing
- **Back to blog** breadcrumb
- **Next/Previous post** navigation at bottom
- **Author card** at bottom with photo + "Alberto Rosas" link

---

## 404 Page

```
┌──────────────────────────────────────────┐
│                                          │
│  [Photo: Harley at end of empty road]    │
│                                          │
│  This road's a dead end.                 │
│                                          │
│  Even on the best routes, you hit        │
│  a wrong turn sometimes.                 │
│                                          │
│  [Take me home →]                        │
│                                          │
└──────────────────────────────────────────┘
```

---

## Navigation

### Desktop
- Fixed top, minimal, translucent backdrop
- Left: "Alberto Rosas" (link to /)
- Right: About, Blog, Now, Uses, Contact
- Dark mode toggle (icon only)
- Variable font weight animation on hover

### Mobile
- Fixed top with hamburger
- Full-screen overlay menu (not drawer)
- Large touch targets
- Same links + social icons
