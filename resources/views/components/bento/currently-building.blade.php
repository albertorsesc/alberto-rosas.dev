{{-- SADIE stats card — big numbers, not paragraphs --}}
<div class="bento-card col-span-1 md:col-span-8 md:row-span-2 relative overflow-hidden" data-reveal>
    <div class="flex flex-col h-full justify-between">
        <div>
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-flex items-center gap-2">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-mono uppercase tracking-widest text-emerald-600 dark:text-emerald-400">In Production</span>
                </span>
            </div>

            <h3 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-2">SADIE</h3>
            <p class="text-fluid-sm text-muted dark:text-dark-muted mb-8">Storage360 AI Data Intelligence Engine &mdash; natural language to SQL, multi-agent orchestration via LangGraph.</p>
        </div>

        {{-- Big stat numbers --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <p class="font-heading text-fluid-3xl text-brand-cyan leading-none">86%</p>
                <p class="text-xs font-mono text-muted dark:text-dark-muted mt-1">query success</p>
            </div>
            <div>
                <p class="font-heading text-fluid-3xl text-brand-cyan leading-none">&lt;300<span class="text-fluid-base">ms</span></p>
                <p class="text-xs font-mono text-muted dark:text-dark-muted mt-1">latency</p>
            </div>
            <div>
                <p class="font-heading text-fluid-3xl text-brand-cyan leading-none">6x</p>
                <p class="text-xs font-mono text-muted dark:text-dark-muted mt-1">improvement</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-2 mt-6">
            <span class="tag">Python</span>
            <span class="tag">LangGraph</span>
            <span class="tag">MCP Servers</span>
            <span class="tag">Vector Search</span>
        </div>
    </div>
</div>
