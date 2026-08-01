@php
    // Site-level entity graph, linked by @id so other pages / blog posts can
    // reference the Person and Organization without re-declaring them. Facts
    // here must match BIO.md; drift between structured data and the page hurts
    // trust more than no structured data.
    $base = rtrim(url('/'), '/');
    $graph = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => $base.'/#website',
                'url' => $base,
                'name' => 'Alberto Rosas',
                'inLanguage' => 'en',
                'publisher' => ['@id' => $base.'/#person'],
            ],
            [
                '@type' => 'Person',
                '@id' => $base.'/#person',
                'name' => 'Alberto Rosas',
                'jobTitle' => 'AI & Agentic Systems Engineer',
                'url' => $base,
                'image' => $base.'/og-image.png',
                'worksFor' => ['@id' => $base.'/#triageops'],
                'knowsAbout' => [
                    'Agentic AI systems', 'LLM evaluation', 'Retrieval-augmented generation',
                    'Model Context Protocol', 'AI security', 'NL-to-SQL',
                ],
                'address' => ['@type' => 'PostalAddress', 'addressCountry' => 'MX'],
                'sameAs' => [
                    'https://www.linkedin.com/in/albertorsesc',
                    'https://github.com/albertorsesc',
                    'https://x.com/bcryp7',
                ],
            ],
            [
                '@type' => 'Organization',
                '@id' => $base.'/#triageops',
                'name' => 'TriageOps',
                'url' => 'https://triageops.com',
                'description' => 'AI adoption consultancy for mid-market teams.',
                'founder' => ['@id' => $base.'/#person'],
            ],
            [
                '@type' => 'ProfilePage',
                '@id' => $base.'/#profilepage',
                'url' => $base,
                'mainEntity' => ['@id' => $base.'/#person'],
            ],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
