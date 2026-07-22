---
name: alberto-rosas-dev
description: >
  Personal site of Alberto Rosas. Warm-stone editorial base with a synthwave
  neon layer. Monospace-forward chrome, serif display headings, a rationed cyan
  accent, and a magenta/cyan/violet emission triad used for glows and gradients.
source_of_truth:
  tokens: tailwind.config.js
  css_variables: resources/css/app.css
  voice: BIO.md
tailwind_version: "3.4.13"

colors:
  # --- Accent, mode-adaptive. Ordinary accent text, links, labels. ---
  accent-light:        "#0e7490"   # tailwind cyan-700
  accent-dark:         "#22d3ee"   # tailwind cyan-400

  # --- Brand mark, mode-invariant. Same in light and dark by design. ---
  # Canonical form is OKLCH. Browsers keep it in oklch space; Tailwind emits
  # #009cce as the sRGB fallback for old browsers. Quote the OKLCH, not a hex.
  brand-cyan:          "oklch(65% 0.2 230)"

  # --- Synthwave emission triad. NOT text colours. ---
  # Glows, gradient stops, low-alpha fills only. Fail contrast as text.
  neon-cyan:           "#00f5ff"
  neon-magenta:        "#ff006e"
  neon-violet:         "#8b5cf6"

  # --- Amber, page-local to /uses. ---
  amber-500:           "#f59e0b"
  amber-600:           "#d97706"
  amber-700:           "#b45309"

  # --- Light mode. Warm stone neutrals, never cool grey. ---
  surface:             "#fafaf9"
  surface-alt:         "#f5f5f4"
  border:              "#e7e5e4"
  text:                "#1c1917"
  text-muted:          "#78716c"
  text-subtle:         "#a8a29e"

  # --- Dark mode. Near-black, not navy. ---
  dark-surface:        "#0a0a0a"
  dark-surface-alt:    "#111111"
  dark-border:         "#1e1e1e"
  dark-text:           "#f0f0f0"
  dark-text-muted:     "#a0a0a0"

typography:
  display:
    fontFamily: '"DM Serif Display", Georgia, serif'
    fontWeight: 400
  body:
    fontFamily: "Inter, ui-sans-serif, system-ui, sans-serif"
    fontWeight: 400
  mono:
    fontFamily: '"JetBrains Mono", ui-monospace, monospace'
    fontWeight: 400
  scale:
    fluid-xs:   "clamp(0.75rem, 0.7rem + 0.26vw, 0.875rem)"
    fluid-sm:   "clamp(0.875rem, 0.82rem + 0.29vw, 1rem)"
    fluid-base: "clamp(1rem, 0.95rem + 0.26vw, 1.125rem)"
    fluid-lg:   "clamp(1.125rem, 1rem + 0.65vw, 1.5rem)"
    fluid-xl:   "clamp(1.25rem, 1rem + 1.3vw, 2rem)"
    fluid-2xl:  "clamp(1.5rem, 1rem + 2.6vw, 3rem)"
    fluid-3xl:  "clamp(2rem, 1.2rem + 4.2vw, 4.5rem)"
    fluid-hero: "clamp(2.5rem, 1rem + 6.5vw, 5rem)"

spacing:
  radius-sm:   "0.5rem"
  radius-md:   "0.75rem"
  radius-lg:   "1.5rem"
  radius-pill: "9999px"

components:
  accent-usage: "rationed"
  dark-mode: "class"
  elevation: "neon glow on hover, hairline border at rest"
---

# Design — alberto-rosas.dev

Brand contract, extracted from the implementation rather than invented. The
frontmatter is the normative layer; the prose carries judgment the tokens can't.

Code stays the source of truth: `tailwind.config.js` for scale tokens,
`resources/css/app.css` for CSS custom properties, `BIO.md` for voice.

## 1. Visual Theme & Atmosphere

An engineer's notebook with a synthwave layer over it. Two systems coexist on
purpose, and the tension between them *is* the identity.

The **base** is warm and papery. Every light-mode neutral comes from Tailwind's
stone ramp, so the canvas reads like paper, not a dashboard. The **overlay** is
synthwave: magenta, cyan, and violet used as emission, never as text.

The defining move is typographic. `font-mono` is the most-used type class on the
site (82 uses against 43 for `font-heading`). Monospace carries the chrome:
labels, eyebrows, metadata, `//` markers. Serif display carries headings. Body
sans stays out of the way.

**Key characteristics:**
- Warm stone light mode, near-black dark mode, class-toggled
- Monospace-forward chrome with `//` comment markers as a recurring motif
- DM Serif Display headings, weight 400 only
- Cyan accent rationed; neon triad reserved for glow and gradient
- Fluid `clamp()` type at every level, so nothing steps at breakpoints
- Elevation is a neon glow on hover over a hairline border at rest

## 2. Color Palette & Roles

Cyan does **three distinct jobs**. Confusing them is the most likely way to
break this system, so they're named explicitly.

| Role | Value | Use | Never |
| --- | --- | --- | --- |
| **Accent (mode-adaptive)** | `cyan-700` light · `cyan-400` dark | Ordinary accent text, links, labels. 44 uses. | Not for "you are here" |
| **Brand mark (mode-invariant)** | `oklch(65% 0.2 230)` both modes | `//` glyphs, typing cursor, reading-progress bar, `.text-link` underline. 27 uses. | Not for body text |
| **Active state** | `text-cyan-700 dark:text-brand-cyan` | Current nav item, current TOC heading. Pairs with `border-brand-cyan` / `before:bg-brand-cyan`. 5 uses. | Not for ordinary accents |

The active-state role is why two cyans coexist in the same class string. That is
deliberate, not drift.

**The neon triad** is emission-only: `#ff006e` → `#00f5ff` → `#8b5cf6`. It shows
up as gradient stops, glow shadows, and low-alpha fills. `.synthwave-divider` is
the clearest statement of it. **Never use these as text colours** — at these
chromas they fail contrast on both canvases.

**Amber** is page-local to `/uses` (the motorcycle section) plus the
`.gradient-border-amber` variant. It is not a site-wide brand colour.

**Surfaces.** `#fafaf9` page, `#f5f5f4` inset, `#e7e5e4` border. Dark:
`#0a0a0a`, `#111111`, `#1e1e1e`.

## 3. Typography Rules

Three families, three jobs, no overlap.

| Role | Family | Used for |
| --- | --- | --- |
| Display | DM Serif Display 400 | h1–h3, section titles |
| Body | Inter 400 | paragraphs, long-form |
| Mono | JetBrains Mono | eyebrows, labels, metadata, `//` markers |

DM Serif Display ships one weight. Never fake bold. For more force go up the
fluid scale, not up in weight.

Uppercase mono at `text-xs` with `tracking-widest`, prefixed by a dimmed `//`,
is the established eyebrow pattern. It is load-bearing.

## 4. Component Stylings

**Radii.** `rounded-xl` (0.75rem) for cards, `rounded-full` for pills,
`rounded-lg` (0.5rem) for small controls, `rounded-bento` (1.5rem) for feature
blocks.

**Elevation is a glow, not a shadow.** At rest, a 1px hairline border. On hover,
`translateY(-4px)` plus a neon-cyan glow (`0.08` alpha light, `0.2` dark). The
`.gradient-border` family adds a rotating conic border in the neon triad, paused
at rest and running on hover.

**Motion** (all defined in `app.css`):
- `--duration-fast: 150ms` hovers and state flips
- `--duration-normal: 300ms` default transition
- `--duration-slow: 500ms` larger movements
- `--duration-reveal: 800ms` scroll reveals
- `--ease-out: cubic-bezier(0.16, 1, 0.3, 1)` the workhorse
- `--ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1)` sparingly

## 5. Layout Principles

Single-column, reading-first. Content in a centred column with generous vertical
rhythm. Pages: home, `/about`, `/now`, `/uses`, `/blog` (Prezet, 16 posts), a
Livewire contact form, and a 404.

## 6. Depth & Elevation

Hairline border at rest, neon glow on hover. No conventional drop shadows: the
glow *is* the elevation language. "Make it pop" is answered with glow intensity,
contrast, or scale, never with a grey shadow.

## 7. Do's and Don'ts

**Do**
- Keep the canvas warm. Pure `#ffffff` breaks the base.
- Let mono carry the chrome.
- Ration the accent. Three accent moments on a page means remove one.
- Use the neon triad for emission only.
- Ship both light and dark for anything new.
- Reference `--neon-*`, `--brand-cyan`, `--amber-*` tokens. Never re-hardcode those hex values.

**Don't**
- Don't use neon values as text colour.
- Don't bold DM Serif Display.
- Don't use the active-state cyan pairing for ordinary accents.
- Don't promote amber site-wide while it's scoped to `/uses`.
- Don't write marketing voice. `BIO.md` governs copy and is explicit.

## 8. Responsive Behavior

The fluid type scale removes most breakpoint work. Layout collapses to single
column on small screens. Dark mode is orthogonal to breakpoint; verify both.

## 9. Agent Prompt Guide

> Warm stone canvas (`#fafaf9` light, `#0a0a0a` dark). DM Serif Display 400
> headings, Inter body, JetBrains Mono for all labels and metadata. Accent cyan
> `#0e7490` light / `#22d3ee` dark, used at most twice. Neon triad
> (`#ff006e` `#00f5ff` `#8b5cf6`) for glows and gradients only, never text.
> Elevation is a neon glow over a hairline border. Fluid `clamp()` type.
> Voice per `BIO.md`: short, direct, concrete, no marketing words.

### Video rendering: two gotchas, both verified

Both pass every structural check and still ship an off-brand video. Confirmed by
lossless pixel analysis 2026-07-22.

**1. Paint the background on an element inside the composition, never on
`body`.** The renderer composites onto black and ignores a `body` background. A
composition with `body { background: #0a0a0a }` renders `#000000` for 539,564
pixels with no warning. Use a full-bleed `<div>` inside the composition root.

**2. DM Serif Display needs an explicit `@font-face`.** It is not in the
renderer's auto-resolved list. Without it, text falls through `Georgia`, which
the renderer aliases to **EB Garamond**, and the headline ships in the wrong
face while looking plausible. Inter and JetBrains Mono are auto-resolved.

`hyperframes check` catches the font one, not the background one. Encoding note:
H.264 `yuv420p` shifts values (`#111111` samples back as `#0e1110`); use
`--format png-sequence` for brand-exact verification.

## Known Gaps

Verified against the implementation 2026-07-22.

- ~~**Opacity modifiers on `brand.*` colours did not compile.**~~ **FIXED
  2026-07-22.** All six `brand.*` tokens were bare `'oklch(...)'` strings, so
  Tailwind 3 could not inject an alpha channel and silently dropped every
  opacity variant. Ten usages were affected: the `//` markers **inherited**
  their parent's colour instead of rendering dimmed, and the contact-form focus
  rings fell back to Tailwind's default `rgb(59 130 246 / .5)` (blue-500)
  instead of brand cyan. Fixed by appending the `/ <alpha-value>` placeholder to
  all six tokens in `tailwind.config.js`. Verified: `oklch(… / 1)` at full
  opacity is equivalent to the old output, so the 27 plain uses did not shift.
  **Any new colour added to `theme.extend.colors` as a raw string must carry the
  placeholder, or its opacity modifiers will vanish without an error.**
- **The 3-column feature grid** appears on the homepage and twice on `/about`.
  Named AI-template tell; break the symmetry.
- **Six eyebrows on the homepage.** One or two is the working ceiling.
- **`data-reveal` on 25 elements in `/about`.** Reveal sections, not every card.
- **`rounded-card` and `max-w-8xl` are dead tokens.** `rounded-card` duplicates
  Tailwind's built-in `rounded-xl` at the same `0.75rem`.
- **`text-subtle` has no dark-mode counterpart.** Three tiers light, two dark.
- **Four synthwave classes are defined but unused**: `neon-text-purple`,
  `neon-text-amber`, `sacred-geo-bg`, `cyber-gradient-bg`. Kept deliberately as
  a palette to draw on; wire them up or retire them.
- **No Hallmark stamp** on any page, and no `.hallmark/log.json`.
