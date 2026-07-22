{{-- Hallmark · C2 inline-form-as-CTA + three-track triage.
     Replaces "Get in touch" boilerplate. The old <dl> here was self-declared
     filler ("fills the column the form would otherwise leave empty") and
     duplicated the hero meta verbatim. Tracks and terms are quoted from
     BIO.md:141-145; the availability line from BIO.md:145. Nothing invented. --}}
<section id="contact" class="relative px-6 md:px-12 py-24 md:py-32">
    {{-- Bookend: the same divider that closes the fold, so the page opens and
         shuts on the same gesture instead of ending on a 1px hairline. --}}
    <div class="synthwave-divider h-[3px] w-full absolute inset-x-0 top-0" role="presentation"></div>

    <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

        <div class="lg:col-span-4"
             x-data="{ track: 'role', tracks: [
                { id: 'role',       label: 'role',       detail: 'Senior IC / tech-lead at AI-native companies',      terms: 'Full-time remote · contractor or EOR · no US W2' },
                { id: 'consulting', label: 'consulting', detail: 'AI adoption for mid-market teams, via TriageOps',   terms: 'Discovery Sprint · scoped pilot · eval-gated rollout' },
                { id: 'review',     label: 'review',     detail: 'Architecture review on production agentic systems', terms: 'Context engineering · evals · MCP · agent security' },
             ] }">

            <p class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-6">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> available for
            </p>

            <h2 class="font-heading text-fluid-3xl text-body dark:text-dark-body leading-[0.95] tracking-[-0.02em] mb-8">
                Three ways<br />this usually starts.
            </h2>

            <div class="border-t border-border dark:border-dark-border">
                <template x-for="t in tracks" :key="t.id">
                    <button
                        type="button"
                        @click="track = t.id"
                        :aria-pressed="track === t.id"
                        class="group w-full border-b border-border dark:border-dark-border py-5 text-left
                               focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                               focus-visible:outline-[color:var(--brand-cyan)]"
                    >
                        <p class="font-mono text-[10px] uppercase tracking-[0.3em] transition-colors duration-300"
                           :class="track === t.id
                                ? 'text-cyan-700 dark:text-cyan-400'
                                : 'text-muted dark:text-dark-muted group-hover:text-cyan-700 dark:group-hover:text-cyan-400'"
                           x-text="t.label"></p>
                        <p class="mt-2 text-sm text-body dark:text-dark-body leading-snug" x-text="t.detail"></p>
                        <p class="mt-2 font-mono text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted"
                           x-show="track === t.id" x-collapse x-text="t.terms"></p>
                    </button>
                </template>
            </div>

            <p class="mt-8 text-sm text-muted dark:text-dark-muted leading-relaxed max-w-md">
                Based in Mexico, US-timezone friendly. Project-based and retainer engagements.
                Direct line:
                <a href="mailto:alberto.rsesc@protonmail.com" class="text-link text-cyan-700 dark:text-cyan-400">alberto.rsesc@protonmail.com</a>
            </p>
        </div>

        <div class="lg:col-span-7 lg:col-start-6 min-w-0">
            <livewire:contact-form lazy />
        </div>
    </div>
</section>
