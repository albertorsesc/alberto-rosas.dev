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

// Newsletter subscribe: progressive enhancement over a plain POST form. Sends the
// form (including the honeypot) via fetch and swaps in inline feedback, so it works
// on cached blog pages where a full-page redirect can't show a session flash.
function initSubscribeForms() {
    document.querySelectorAll('form[data-subscribe]').forEach((form) => {
        if (form.dataset.enhanced) return;
        form.dataset.enhanced = '1';

        const wrap = form.closest('[data-subscribe-wrap]');
        const btn = form.querySelector('[data-subscribe-btn]');
        const label = btn?.querySelector('[data-label]');
        const loading = btn?.querySelector('[data-loading]');
        const success = wrap?.querySelector('[data-subscribe-success]');
        const error = wrap?.querySelector('[data-subscribe-error]');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (error) error.hidden = true;
            if (btn) btn.disabled = true;
            if (label) label.hidden = true;
            if (loading) loading.hidden = false;

            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: { Accept: 'application/json' },
                    body: new FormData(form),
                });

                if (res.ok) {
                    form.hidden = true;
                    if (success) {
                        const msg = success.textContent.trim()
                            || 'Check your inbox to confirm your subscription.';
                        // Reset the text so the polite live region registers a change
                        // and announces it (un-hiding alone doesn't), then take focus,
                        // which hiding the form dropped to <body>.
                        success.textContent = '';
                        success.hidden = false;
                        success.setAttribute('tabindex', '-1');
                        success.focus();
                        requestAnimationFrame(() => { success.textContent = msg; });
                    }
                    return;
                }

                const data = await res.json().catch(() => ({}));
                if (error) {
                    error.textContent = data?.errors?.email?.[0] ?? 'Something went wrong. Please try again.';
                    error.hidden = false;
                }
            } catch {
                if (error) {
                    error.textContent = 'Network error. Please try again.';
                    error.hidden = false;
                }
            } finally {
                if (btn) btn.disabled = false;
                if (label) label.hidden = false;
                if (loading) loading.hidden = true;
            }
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSubscribeForms);
} else {
    initSubscribeForms();
}

// A note in the console for anyone who opens DevTools, framed as one of my own
// eval runs. The audience that opens the console is the audience I want to reach.
{
    const head = 'color:#00f5ff;font-weight:700;font-family:monospace;font-size:12px';
    const run = 'color:#c9d1d9;font-family:monospace;font-size:12px;line-height:1.6';
    const sig = 'color:#00f5ff;font-weight:600;font-size:12px';
    const dim = 'color:#7a8590;font-size:11px';

    console.log('%c$ eval --target visitor', head);
    console.log(
        '%c  intent ........... curious_engineer\n'
        + '  opened_console ... ✓\n'
        + '  faithfulness ..... high\n'
        + '  verdict .......... we should talk',
        run,
    );
    console.log('%cAlberto Rosas · AI & Agentic Systems Engineer', sig);
    console.log('%c/work · github.com/albertorsesc · alberto.rsesc@protonmail.com', dim);
}

// Konami code: a five-second synthwave flourish for anyone who knows it.
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
            // Activate synthwave mode. Remember whether the visitor was in light
            // mode so we can put it back instead of stranding them in dark.
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
