{{-- Hallmark · macrostructure: Marquee Hero · genre: atmospheric
   · enrichment: Tier-A CSS art (agent-trace console)
   · polish: HP3 Cursor-spotlight (hero-scoped, reduced-motion pinned)
   · design-system: design.md · designed-as-app
   The right half used to be dead canvas. It now carries a live trace panel:
   on-brand for agentic work, and it gives the fold something that moves.
   Every figure in the trace is one Alberto already publishes — nothing invented. --}}
<section
    id="home"
    x-data="heroFold()"
    x-init="init()"
    @mousemove.window="track($event)"
    class="relative min-h-[92svh] flex flex-col justify-between gap-10 overflow-hidden pt-28 pb-10"
>
    {{-- Layer 1 · circuit texture --}}
    <div class="circuit-bg pointer-events-none absolute inset-0 -z-20 opacity-70 dark:opacity-100" aria-hidden="true"></div>

    {{-- Layer 2 · HP3 cursor-spotlight. Pinned centre-left when reduced-motion. --}}
    <div
        class="pointer-events-none absolute inset-0 -z-10 transition-opacity duration-700 motion-reduce:!opacity-40"
        :style="`background: radial-gradient(38rem 38rem at ${mx}% ${my}%, rgb(var(--neon-cyan-rgb) / 0.10), transparent 70%)`"
        aria-hidden="true"
    ></div>

    <div class="w-full px-6 md:px-12">
        <p class="font-mono text-xs sm:text-sm uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 opacity-0" data-fold="1">
            <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> <span x-text="greeting" lang="es"></span><span class="typing-cursor"></span>
        </p>
    </div>

    {{-- Marquee + console share the fold. Console fills what was empty canvas. --}}
    <div class="w-full px-6 md:px-12 grid lg:grid-cols-12 lg:gap-10 items-center min-w-0">

        <div class="lg:col-span-7 min-w-0">
            {{-- Each line is masked and rises into view: the cinematic move for big type --}}
            <h1 class="font-heading text-body dark:text-dark-body neon-text glitch-hover
                       leading-[0.86] tracking-[-0.03em] [overflow-wrap:anywhere] min-w-0
                       text-[clamp(3.25rem,12vw,10rem)]">
                <span class="block overflow-hidden"><span class="block translate-y-full" data-fold-line data-text="Alberto">Alberto</span></span>
                <span class="block overflow-hidden"><span class="block translate-y-full" data-fold-line data-text="Rosas">Rosas</span></span>
            </h1>

            <p class="mt-6 md:mt-8 font-heading text-fluid-xl text-body dark:text-dark-body leading-snug max-w-xl opacity-0" data-fold="2">
                Eval-first AI engineering.
            </p>
        </div>

        {{-- Tier-A CSS art: an agent trace. Hidden from AT — it is decorative proof, not content. --}}
        <div class="lg:col-span-5 mt-10 lg:mt-0 min-w-0 opacity-0" data-fold="3" aria-hidden="true">
            <div class="scan-lines relative rounded-xl border border-border dark:border-dark-border bg-surface-alt/70 dark:bg-dark-surface-alt/70 backdrop-blur-sm overflow-hidden">
                <div class="flex items-center gap-2 border-b border-border dark:border-dark-border px-4 py-2.5">
                    {{-- Live pulse. animate-pulse-slow is already reduced-motion guarded in app.css. --}}
                    <span class="relative flex h-2 w-2 shrink-0">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-brand-cyan/40 animate-pulse-slow"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-brand-cyan/70"></span>
                    </span>
                    <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-muted dark:text-dark-muted">agent trace</p>
                </div>
                <div class="p-4 font-mono text-[11px] sm:text-xs leading-relaxed">
                    <p class="text-cyan-700 dark:text-cyan-400 mb-2.5">$ agent run --task nl2sql --eval ragas</p>
                    {{-- Stage names and identifiers are the real ones, checked against
                         current docs: Qdrant's query_points/prefetch + FusionQuery(RRF),
                         Qdrant/bm25 as the sparse model, and Ragas' faithfulness /
                         answer_relevancy metric identifiers. The stack mirrors what the
                         Retrieval and Evals entries below already describe. --}}
                    <ul class="space-y-1.5 text-muted dark:text-dark-muted">
                        @foreach ([
                            ['router',   'intent → analytical_query'],
                            ['retrieve', 'query_points · prefetch ×2'],
                            ['fuse',     'RRF · bm25 + modernbert-768d'],
                            ['rerank',   'cross-encoder · 24 → 6'],
                            ['graph',    'neo4j · 2-hop traversal'],
                            ['generate', 'sql · 7 joins · 2 CTEs'],
                            ['grade',    'faithfulness ✓ answer_relevancy ✓'],
                            ['trace',    'langfuse'],
                        ] as $i => $row)
                            <li class="flex gap-3 opacity-0 min-w-0" data-trace="{{ $i }}">
                                <span class="text-cyan-700 dark:text-cyan-400/70 shrink-0 w-[4.5rem]">{{ $row[0] }}</span>
                                <span class="min-w-0 [overflow-wrap:anywhere]">{{ $row[1] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3 pt-3 border-t border-border dark:border-dark-border flex items-baseline justify-between gap-3 opacity-0" data-trace="8">
                        <span class="text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">SADIE · NL2SQL accuracy</span>
                        <span class="font-heading text-xl text-cyan-700 dark:text-cyan-400 neon-text tabular-nums">93&ndash;97%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full px-6 md:px-12">
        <div class="flex flex-col-reverse gap-8 md:flex-row md:items-end md:justify-between opacity-0" data-fold="4">
            <dl class="font-mono text-[11px] sm:text-xs uppercase tracking-[0.08em] sm:tracking-[0.18em] text-muted dark:text-dark-muted space-y-1.5 min-w-0 max-w-full">
                <div class="flex gap-3 min-w-0">
                    <dt class="text-cyan-700 dark:text-cyan-400/70 shrink-0">role</dt>
                    <dd class="text-cyan-700 dark:text-cyan-400 min-w-0 [overflow-wrap:anywhere]">AI &amp; Agentic Systems Engineer</dd>
                </div>
                <div class="flex gap-3 min-w-0">
                    <dt class="text-cyan-700 dark:text-cyan-400/70 shrink-0">exp</dt>
                    <dd class="min-w-0 [overflow-wrap:anywhere]">12+ yrs software / 5+ yrs production AI</dd>
                </div>
                <div class="flex gap-3 min-w-0">
                    <dt class="text-cyan-700 dark:text-cyan-400/70 shrink-0">base</dt>
                    <dd class="min-w-0 [overflow-wrap:anywhere]"><span class="text-cyan-700 dark:text-cyan-400">Mexico</span> &middot; EN/ES native</dd>
                </div>
            </dl>

            <figure class="shrink-0">
                <div class="scan-lines relative w-20 h-20 md:w-28 md:h-28 overflow-hidden rounded-lg border border-border dark:border-dark-border">
                    <img src="https://avatars.githubusercontent.com/u/22654040?v=4" alt="Alberto Rosas"
                         width="160" height="160" loading="eager" fetchpriority="high"
                         class="w-full h-full object-cover grayscale-[35%] contrast-[1.05]" />
                </div>
            </figure>
        </div>
    </div>
</section>

<div class="synthwave-divider h-[3px] w-full" role="presentation"></div>

@push('scripts')
<script>
    function heroFold() {
        return {
            greeting: '',
            mx: 30, my: 40,
            reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
            track(e) {
                if (this.reduced) return;
                this.mx = (e.clientX / window.innerWidth) * 100;
                this.my = (e.clientY / window.innerHeight) * 100;
            },
            init() {
                const h = new Date().getHours();
                this.greeting = h < 12 ? 'Buenos días' : h < 18 ? 'Buenas tardes' : 'Buenas noches';

                const lines  = document.querySelectorAll('[data-fold-line]');
                const steps  = document.querySelectorAll('[data-fold]');
                const trace  = document.querySelectorAll('[data-trace]');

                // Reduced motion: land everything immediately, no movement.
                if (this.reduced || typeof gsap === 'undefined') {
                    lines.forEach(el => el.classList.remove('translate-y-full'));
                    [...steps, ...trace].forEach(el => { el.style.opacity = 1; });
                    return;
                }

                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
                tl.to('[data-fold="1"]', { opacity: 1, duration: 0.5 }, 0.15)
                  .to(lines, { yPercent: -100, duration: 1.05, stagger: 0.09 }, 0.25)
                  .to('[data-fold="2"]', { opacity: 1, y: 0, duration: 0.7 }, 0.85)
                  .to('[data-fold="3"]', { opacity: 1, duration: 0.7 }, 0.95)
                  .to(trace, { opacity: 1, duration: 0.28, stagger: 0.11 }, 1.15)
                  .to('[data-fold="4"]', { opacity: 1, duration: 0.7 }, 1.35);
            },
        };
    }
</script>
@endpush
