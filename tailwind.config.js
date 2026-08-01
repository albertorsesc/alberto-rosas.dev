import colors from 'tailwindcss/colors'
import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'mr-2',
        'scroll-mt-12',
        // The experiments bento spans are generated in App\Services\Github\Pins
        // (a PHP file Tailwind's content scanner never reads), so their col-span
        // classes must be safelisted or the cards collapse to a single column.
        { pattern: /col-span-[1-6]/, variants: ['sm', 'lg'] },
    ],
    theme: {
        extend: {
            fontFamily: {
                heading: ['"DM Serif Display"', 'Georgia', 'serif'],
                body: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                '8xl': '88rem',
            },
            colors: {
                primary: colors.cyan,
                // The `/ <alpha-value>` placeholder is required for opacity
                // modifiers (text-brand-cyan/50, focus:ring-brand-cyan/50) to
                // compile. Without it Tailwind cannot inject an alpha channel
                // into a bare colour string and silently drops those classes —
                // the utility just never exists and the element inherits.
                // At full opacity the output is equivalent: oklch(… / 1) === oklch(…).
                brand: {
                    cyan: 'oklch(65% 0.2 230 / <alpha-value>)',
                    'cyan-light': 'oklch(75% 0.15 230 / <alpha-value>)',
                    'cyan-dark': 'oklch(55% 0.22 230 / <alpha-value>)',
                    amber: 'oklch(75% 0.15 70 / <alpha-value>)',
                    'amber-light': 'oklch(82% 0.12 70 / <alpha-value>)',
                    'amber-dark': 'oklch(65% 0.18 70 / <alpha-value>)',
                },
                // rgb(var(--x-rgb) / <alpha-value>) so opacity modifiers compile
                // (bg-surface/80, border-border/50). At full opacity the output is
                // identical to the bare hex var.
                surface: {
                    DEFAULT: 'rgb(var(--color-surface-rgb) / <alpha-value>)',
                    alt: 'rgb(var(--color-surface-alt-rgb) / <alpha-value>)',
                },
                body: 'rgb(var(--color-text-rgb) / <alpha-value>)',
                muted: 'rgb(var(--color-text-muted-rgb) / <alpha-value>)',
                subtle: 'rgb(var(--color-text-subtle-rgb) / <alpha-value>)',
                border: 'rgb(var(--color-border-rgb) / <alpha-value>)',
                'dark-surface': {
                    DEFAULT: 'rgb(var(--color-dark-surface-rgb) / <alpha-value>)',
                    alt: 'rgb(var(--color-dark-surface-alt-rgb) / <alpha-value>)',
                },
                'dark-body': 'rgb(var(--color-dark-text-rgb) / <alpha-value>)',
                'dark-muted': 'rgb(var(--color-dark-text-muted-rgb) / <alpha-value>)',
                'dark-subtle': 'rgb(var(--color-dark-text-subtle-rgb) / <alpha-value>)',
                'dark-border': 'rgb(var(--color-dark-border-rgb) / <alpha-value>)',
            },
            borderRadius: {
                card: '0.75rem',
                bento: '1.5rem',
            },
            fontSize: {
                'fluid-xs':   'clamp(0.75rem,  0.7rem  + 0.26vw, 0.875rem)',
                'fluid-sm':   'clamp(0.875rem, 0.82rem + 0.29vw, 1rem)',
                'fluid-base': 'clamp(1rem,     0.95rem + 0.26vw, 1.125rem)',
                'fluid-lg':   'clamp(1.125rem, 1rem    + 0.65vw, 1.5rem)',
                'fluid-xl':   'clamp(1.25rem,  1rem    + 1.3vw,  2rem)',
                'fluid-2xl':  'clamp(1.5rem,   1rem    + 2.6vw,  3rem)',
                'fluid-3xl':  'clamp(2rem,     1.2rem  + 4.2vw,  4.5rem)',
                'fluid-hero': 'clamp(2.5rem,   1rem    + 6.5vw,  5rem)',
            },
        },
    },

    plugins: [forms, typography],
}
