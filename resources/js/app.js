import './bootstrap';

// After a failed submit, Livewire's DOM morph replaces the focused element and
// focus falls to <body>; a screen reader user hears nothing. Restore focus to
// the first invalid field so the error is announced via its aria-describedby.
document.addEventListener('livewire:init', () => {
    window.Livewire.hook('commit', ({ component, succeed }) => {
        succeed(() => {
            queueMicrotask(() => {
                const invalid = component.el.querySelector('[aria-invalid="true"]');
                if (invalid && document.activeElement === document.body) {
                    invalid.focus();
                }
            });
        });
    });
});

// Console Easter Egg — The Hermetic Greeting
console.log(
    '%c \u7121\u5FC3 \u2625',
    'font-size: 32px; color: #00f5ff;'
);
console.log(
    '%c "Consider everything. Believe nothing. Build anyway."',
    'color: #00f5ff; font-size: 13px; font-style: italic;'
);
console.log(
    '%c \u2609 As above, so below. As within, so without. \u263D',
    'color: #8b5cf6; font-size: 11px;'
);
console.log(
    '%c The mind is the interface. The code is the output. \u2192 alberto.rsesc@protonmail.com',
    'color: #666; font-size: 11px;'
);

// Konami Code — Synthwave Mode
let konamiIndex = 0;
let wasLight = false;
// e.keyCode is deprecated; e.key is the current standard.
const konamiCode = [
    'ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown',
    'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'a',
];

document.addEventListener('keydown', (e) => {
    if (e.key.toLowerCase() === konamiCode[konamiIndex].toLowerCase()) {
        konamiIndex++;
        if (konamiIndex === konamiCode.length) {
            // Activate synthwave mode
            // Remember whether the visitor was in light mode so we can put it
            // back. Previously this forced dark and never reverted, stranding
            // light-mode visitors and desyncing the Alpine toggle.
            wasLight = !document.documentElement.classList.contains('dark');
            document.body.classList.add('synthwave-mode');
            document.documentElement.classList.add('dark');

            // Flash the dividers
            document.querySelectorAll('.synthwave-divider').forEach(el => {
                el.style.opacity = '1';
                el.style.height = '2px';
            });

            // Revert after 5 seconds
            setTimeout(() => {
                document.body.classList.remove('synthwave-mode');
                if (wasLight) document.documentElement.classList.remove('dark');
                document.querySelectorAll('.synthwave-divider').forEach(el => {
                    el.style.opacity = '';
                    el.style.height = '';
                });
            }, 5000);

            konamiIndex = 0;
        }
    } else {
        konamiIndex = 0;
    }
});
