{{-- Hallmark · macrostructure: Marquee Hero · genre: atmospheric
   · enrichment: Tier-A CSS art (console with two tabs)
   · polish: HP3 Cursor-spotlight (hero-scoped, reduced-motion pinned)
   · design-system: design.md · designed-as-app
   The right-half console carries two tabs. career.log (default) is the career
   as a readable system log; agent trace is the replayable pipeline. Every line
   in both is a real fact from BIO.md — nothing invented. --}}
<section
    id="home"
    x-data="heroFold()"
    x-init="init()"
    @mousemove.window="track($event)"
    class="relative min-h-[80svh] flex flex-col justify-between gap-10 overflow-hidden pt-28 pb-10"
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

    {{-- Marquee + console share the fold. --}}
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

        {{-- Two-tab console. career.log is the main tab: a plain-language career
             log. agent trace holds the replayable pipeline with its three cases. --}}
        <div class="lg:col-span-5 mt-10 lg:mt-0 min-w-0 opacity-0" data-fold="3">
            <div class="scan-lines relative rounded-xl border border-border dark:border-dark-border bg-surface-alt/70 dark:bg-dark-surface-alt/70 backdrop-blur-sm overflow-hidden">

                {{-- Top-level tab strip --}}
                <div class="flex items-center gap-1 border-b border-border dark:border-dark-border px-3 py-2" role="tablist" aria-label="Console view">
                    <span class="relative flex h-2 w-2 shrink-0 mx-1.5" aria-hidden="true">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-brand-cyan/40 animate-pulse-slow"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-brand-cyan/70"></span>
                    </span>
                    <button type="button" role="tab" id="tab-career" aria-controls="panel-career"
                            @click="panel = 'career'" :aria-selected="panel === 'career'"
                            :class="panel === 'career'
                                ? 'text-cyan-700 dark:text-cyan-400 border-cyan-700/50 dark:border-cyan-400/50'
                                : 'text-muted dark:text-dark-muted border-transparent hover:text-body dark:hover:text-dark-body'"
                            class="px-2.5 py-2 border-b font-mono text-[10px] uppercase tracking-[0.16em] transition-colors duration-200">career.log</button>
                    <button type="button" role="tab" id="tab-trace" aria-controls="panel-trace"
                            @click="showTrace()" :aria-selected="panel === 'trace'"
                            :class="panel === 'trace'
                                ? 'text-cyan-700 dark:text-cyan-400 border-cyan-700/50 dark:border-cyan-400/50'
                                : 'text-muted dark:text-dark-muted border-transparent hover:text-body dark:hover:text-dark-body'"
                            class="px-2.5 py-2 border-b font-mono text-[10px] uppercase tracking-[0.16em] transition-colors duration-200">agent trace</button>
                    <button type="button" x-show="panel === 'career'" @click="replayBoot()"
                            aria-label="Replay career log"
                            class="ml-auto px-2 py-2 font-mono text-[11px] text-muted dark:text-dark-muted hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors duration-200">&#8634;</button>
                </div>

                {{-- ── career.log (main tab) ── --}}
                <div id="panel-career" role="tabpanel" aria-labelledby="tab-career" x-show="panel === 'career'"
                     class="p-4 font-mono text-[11px] sm:text-xs leading-relaxed">
                    <div style="min-height:20rem">
                        <p class="text-muted dark:text-dark-muted mb-3">
                            <span class="text-cyan-700 dark:text-cyan-400/70">&gt;</span> boot alberto-rosas &middot; Mexico &middot; since 2014
                        </p>
                        <template x-for="(line, i) in bootVisible" :key="i">
                            <p class="flex flex-wrap sm:flex-nowrap items-baseline gap-x-3 gap-y-0.5 mb-1.5 min-w-0">
                                <span class="text-cyan-700 dark:text-cyan-400 tabular-nums shrink-0 w-[2.75rem]" x-text="line[0]"></span>
                                <span class="text-cyan-700 dark:text-cyan-400/60 shrink-0 w-[4.5rem]" x-text="line[1]"></span>
                                <span class="text-body dark:text-dark-body min-w-0 basis-full sm:basis-auto [overflow-wrap:anywhere]" x-text="line[2]"></span>
                            </p>
                        </template>
                        <p x-show="bootDone" x-cloak class="mt-3 pt-3 border-t border-border dark:border-dark-border text-cyan-700 dark:text-cyan-400">
                            [ OK ] running
                        </p>
                    </div>
                </div>

                {{-- ── agent trace ── --}}
                <div id="panel-trace" role="tabpanel" aria-labelledby="tab-trace" x-show="panel === 'trace'" x-cloak
                     class="p-4 font-mono text-[11px] sm:text-xs leading-relaxed">
                    <div class="flex items-center gap-1 flex-wrap mb-2.5" role="group" aria-label="Trace case">
                        @foreach (['analytical', 'self-check', 'injection'] as $case)
                            <button
                                type="button"
                                @click="switchTrace('{{ $case }}')"
                                :aria-pressed="trace === '{{ $case }}'"
                                :class="trace === '{{ $case }}'
                                    ? 'text-cyan-700 dark:text-cyan-400'
                                    : 'text-muted dark:text-dark-muted hover:text-body dark:hover:text-dark-body'"
                                class="px-2 py-1.5 font-mono text-[10px] uppercase tracking-[0.14em] transition-colors duration-200"
                            >{{ $case }}</button>
                        @endforeach
                    </div>
                    <p class="text-cyan-700 dark:text-cyan-400 mb-2.5 [overflow-wrap:anywhere]">$ agent run --case <span x-text="trace">analytical</span> --eval ragas</p>
                    <div class="min-h-[15rem] sm:min-h-[15.5rem]">
                        <div data-panel="analytical" x-show="trace === 'analytical'">
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
                                    <li class="flex gap-3 opacity-0 min-w-0" data-trace="{{ $i }}" data-row>
                                        <span class="text-cyan-700 dark:text-cyan-400/70 shrink-0 w-[4.5rem]">{{ $row[0] }}</span>
                                        <span class="min-w-0 [overflow-wrap:anywhere]">{{ $row[1] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 pt-3 border-t border-border dark:border-dark-border flex items-baseline justify-between gap-3 opacity-0" data-trace="8" data-row>
                                <span class="text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">SADIE · NL2SQL accuracy</span>
                                <span class="font-heading text-xl text-cyan-700 dark:text-cyan-400 neon-text tabular-nums">93&ndash;97%</span>
                            </div>
                        </div>

                        <div data-panel="self-check" x-show="trace === 'self-check'" style="display: none;">
                            <ul class="space-y-1.5 text-muted dark:text-dark-muted">
                                @foreach ([
                                    ['router',   'intent → analytical_query', null],
                                    ['retrieve', 'query_points · prefetch ×2', null],
                                    ['generate', 'sql · 3 joins', null],
                                    ['grade',    'faithfulness ✗ · context recall low', 'fail'],
                                    ['rewrite',  'decompose · narrow scope', null],
                                    ['retrieve', '+grounding docs', null],
                                    ['generate', 'sql · rewritten', null],
                                    ['grade',    'faithfulness ✓ answer_relevancy ✓', null],
                                    ['trace',    'langfuse · added to eval set', null],
                                ] as $row)
                                    <li class="flex gap-3 opacity-0 min-w-0" data-row>
                                        <span class="text-cyan-700 dark:text-cyan-400/70 shrink-0 w-[4.5rem]">{{ $row[0] }}</span>
                                        <span @class(['min-w-0 [overflow-wrap:anywhere]', 'text-red-600 dark:text-red-400' => $row[2] === 'fail'])>{{ $row[1] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 pt-3 border-t border-border dark:border-dark-border flex items-baseline justify-between gap-3 opacity-0" data-row>
                                <span class="text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">CRAG · hallucination grading</span>
                                <span class="font-heading text-xl text-cyan-700 dark:text-cyan-400 neon-text">caught ✓</span>
                            </div>
                        </div>

                        <div data-panel="injection" x-show="trace === 'injection'" style="display: none;">
                            <ul class="space-y-1.5 text-muted dark:text-dark-muted">
                                @foreach ([
                                    ['router',  'intent → tool_abuse · flagged', 'fail'],
                                    ['guard',   'prompt injection detected', null],
                                    ['mcp',     'write op requested · denied', null],
                                    ['policy',  'read-only boundary · enforced', null],
                                    ['respond', 'refusal · audit note attached', null],
                                    ['trace',   'langfuse · security event', null],
                                ] as $row)
                                    <li class="flex gap-3 opacity-0 min-w-0" data-row>
                                        <span class="text-cyan-700 dark:text-cyan-400/70 shrink-0 w-[4.5rem]">{{ $row[0] }}</span>
                                        <span @class(['min-w-0 [overflow-wrap:anywhere]', 'text-red-600 dark:text-red-400' => $row[2] === 'fail'])>{{ $row[1] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 pt-3 border-t border-border dark:border-dark-border flex items-baseline justify-between gap-3 opacity-0" data-row>
                                <span class="text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">MCP boundary · policy-enforced</span>
                                <span class="font-heading text-xl text-cyan-700 dark:text-cyan-400 neon-text">denied ✓</span>
                            </div>
                        </div>
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
                <div class="scan-lines relative w-16 h-16 md:w-20 md:h-20 overflow-hidden rounded-lg border border-border dark:border-dark-border">
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
        // career.log: real year, one plain verb, one readable line. Trimmed to
        // the console column but never cryptic — the terminal is only the frame.
        const BOOT = [
            ['2014', 'init',      'Full-stack engineer · PHP, Laravel, JS'],
            ['2015', 'ship',      'Logistics platform, built end to end'],
            ['2017', 'lead',      'Eng manager, cybersecurity · team of 8'],
            ['2019', 'scale',     'Millions of events a day · response −60%'],
            ['2022', 'pivot',     'Senior engineer, SaaS · monolith → services'],
            ['2023', 'agents',    'Multi-agent document system in production'],
            ['2024', 'nl→sql',    'SADIE: natural language → SQL · 93–97%'],
            ['2025', 'architect', 'Compliance AI engine, sole architect · 500K+'],
            ['2026', 'now',       'Production AI engineering and consulting.'],
        ];
        return {
            greeting: '',
            panel: 'career',
            trace: 'analytical',
            traceSeen: false,
            bootVisible: [], bootDone: false, bootTimer: null,
            mx: 30, my: 40,
            reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,

            track(e) {
                if (this.reduced) return;
                this.mx = (e.clientX / window.innerWidth) * 100;
                this.my = (e.clientY / window.innerHeight) * 100;
            },

            // career.log typed reveal
            fillBoot() { this.bootVisible = BOOT.slice(); this.bootDone = true; },
            startBoot() {
                clearTimeout(this.bootTimer);
                this.bootVisible = []; this.bootDone = false;
                if (this.reduced || typeof gsap === 'undefined') { this.fillBoot(); return; }
                const step = (i) => {
                    if (i >= BOOT.length) { this.bootTimer = setTimeout(() => { this.bootDone = true; }, 220); return; }
                    this.bootVisible.push(BOOT[i]);
                    this.bootTimer = setTimeout(() => step(i + 1), 230 + Math.random() * 170);
                };
                step(0);
            },
            replayBoot() { this.panel = 'career'; this.startBoot(); },

            // agent trace
            showTrace() {
                this.panel = 'trace';
                this.$nextTick(() => this.animateTrace(this.trace));
            },
            switchTrace(name) {
                this.trace = name;
                this.$nextTick(() => this.animateTrace(name));
            },
            animateTrace(name) {
                const rows = this.$root.querySelectorAll(`[data-panel="${name}"] [data-row]`);
                if (this.reduced || typeof gsap === 'undefined') { rows.forEach(r => { r.style.opacity = 1; }); return; }
                gsap.fromTo(rows, { opacity: 0 }, { opacity: 1, duration: 0.24, stagger: 0.08, ease: 'power3.out', overwrite: true });
            },

            init() {
                const h = new Date().getHours();
                this.greeting = h < 12 ? 'Buenos días' : h < 18 ? 'Buenas tardes' : 'Buenas noches';

                const lines = document.querySelectorAll('[data-fold-line]');
                const steps = document.querySelectorAll('[data-fold]');

                // Reduced motion: land everything immediately, no movement.
                if (this.reduced || typeof gsap === 'undefined') {
                    lines.forEach(el => el.classList.remove('translate-y-full'));
                    steps.forEach(el => { el.style.opacity = 1; });
                    document.querySelectorAll('[data-row]').forEach(el => { el.style.opacity = 1; });
                    this.fillBoot();
                    return;
                }

                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
                tl.to('[data-fold="1"]', { opacity: 1, duration: 0.5 }, 0.15)
                  .to(lines, { yPercent: -100, duration: 1.05, stagger: 0.09 }, 0.25)
                  .to('[data-fold="2"]', { opacity: 1, y: 0, duration: 0.7 }, 0.85)
                  .to('[data-fold="3"]', { opacity: 1, duration: 0.7 }, 0.95)
                  .to('[data-fold="4"]', { opacity: 1, duration: 0.7 }, 1.35);

                // Boot log types once the console has faded in.
                this.bootTimer = setTimeout(() => this.startBoot(), 1350);
            },
        };
    }
</script>
@endpush
