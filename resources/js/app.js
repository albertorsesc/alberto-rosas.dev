import './bootstrap';

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
const konamiCode = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];

document.addEventListener('keydown', (e) => {
    if (e.keyCode === konamiCode[konamiIndex]) {
        konamiIndex++;
        if (konamiIndex === konamiCode.length) {
            // Activate synthwave mode
            document.body.classList.add('synthwave-mode');
            document.documentElement.classList.add('dark'); // Force dark for full effect

            // Flash the dividers
            document.querySelectorAll('.synthwave-divider').forEach(el => {
                el.style.opacity = '1';
                el.style.height = '2px';
            });

            // Revert after 5 seconds
            setTimeout(() => {
                document.body.classList.remove('synthwave-mode');
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
