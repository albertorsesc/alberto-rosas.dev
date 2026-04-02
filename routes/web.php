<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $services = [
        [
            'title' => 'AI Engineering & Agentic Systems',
            'description' => "I build custom AI agents and intelligent systems that automate complex workflows. From RAG pipelines to autonomous agents, I turn manual operational drag into automated efficiency.",
            'tags' => ['Python', 'LangGraph', 'Vector Databases', 'Agentic RAG', 'CAG', 'Docker', 'MongoDB'],
            'icon' => "\u{1F916}",
        ],
        [
            'title' => 'Strategic Consulting',
            'description' => 'Stop guessing with your technical strategy. I provide high-level architectural guidance and "Triage" audits to identify operational waste, ensuring your engineering efforts are aligned with business ROI. Co-founder of Triage Ops.',
            'tags' => ['System Design', 'Operational Audit', 'Tech Strategy'],
            'url' => 'https://triageops.com',
            'icon' => "\u{1F4C8}",
        ],
        [
            'title' => 'Full-Stack Architecture',
            'description' => "Solid foundations matter. I architect and build scalable, secure web applications using modern standards. Whether it's a SaaS platform or a complex internal tool, I deliver production-grade code.",
            'tags' => ['SaaS Platforms', 'Microservices', 'System Scalability', 'Security Automation'],
            'icon' => "\u{1F3D7}",
        ],
    ];

    $experiences = [
        [
            'title' => 'AI Engineer',
            'company' => 'Storage360',
            'type' => 'Contract',
            'description' => "Developing 'SADIE', a Natural Language to SQL engine. Architected a multi-agent system using LangGraph for orchestrating query understanding and SQL generation. Achieved sub-300ms response times and implemented MCP servers for secure database connectivity.",
            'logo' => '',
            'date' => 'July 2024 - Present',
        ],
        [
            'title' => 'Consultant AI Engineer Lead',
            'company' => 'Founders Workshop',
            'type' => 'Contract',
            'description' => "Leading AI strategy and development for enterprise clients. Guiding the implementation of custom AI solutions, from internal automation tools to customer-facing products.",
            'logo' => 'logos/foundersworkshop.png',
            'date' => 'Present',
        ],
        [
            'title' => 'Technical Lead & Senior Software Engineer',
            'company' => 'Bizee (IncFile)',
            'type' => 'Remote',
            'description' => "Leading technical initiatives and rebuilding core products. Architected internal AI tools, including a multi-agent document processing system (1,000+ daily requests) and a Hybrid RAG pipeline.",
            'logo' => 'logos/bizee.png',
            'date' => 'Dec 2022 - Present',
        ],
        [
            'title' => 'Previous Experience',
            'company' => 'Multiple Companies',
            'type' => 'Remote',
            'description' => 'Nearly a decade as a Senior Full-Stack Engineer and Manager for companies including Global Cybersec, HQ Rental, Buddhi, and Fulcrum Digital. Architected microservices, led security integrations, and built scalable SaaS platforms.',
            'logo' => '',
            'date' => '2014 - 2022',
        ],
    ];

    $skillsData = [
        'Agentic Frameworks' => ['LangGraph', 'CrewAI', 'AutoGen', 'LangChain'],
        'LLM Ops & Evaluation' => ['LangSmith', 'LangFuse', 'Opik', 'W&B'],
        'Vector Databases' => ['MongoDB Atlas', 'Qdrant', 'Pinecone', 'Weaviate'],
        'Cloud & Infrastructure' => ['AWS', 'Google Cloud', 'Docker', 'Python'],
    ];

    return view('welcome', [
        'services' => $services,
        'experiences' => $experiences,
        'skillsData' => $skillsData,
    ]);
});

Route::view('/about', 'pages.about')->name('about');
Route::view('/now', 'pages.now')->name('now');
Route::view('/uses', 'pages.uses')->name('uses');

require __DIR__.'/prezet.php';
