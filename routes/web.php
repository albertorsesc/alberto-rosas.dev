<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $links = [
        [
            'name' => 'Home',
            'hash' => '/',
        ],
        [
            'name' => 'About',
            'hash' => '#about',
        ],
        [
            'name' => 'Services',
            'hash' => '#services',
        ],
        [
            'name' => 'Blog',
            'hash' => '/blog',
        ],
        [
            'name' => 'Experience',
            'hash' => '#experience',
        ],
        [
            'name' => 'Skills',
            'hash' => '#tech-stack',
        ],
        [
            'name' => 'Contact',
            'hash' => '#contact',
        ],
    ];
    
    $services = [
        [
            'title' => 'AI Engineering & Agentic Systems',
            'description' => "I build custom AI agents and intelligent systems that automate complex workflows. From RAG (Retrieval-Augmented Generation) pipelines to autonomous agents, I turn manual operational drag into automated efficiency.",
            'tags' => ['Python', 'LangGraph', 'Vector Databases', 'Agentic RAG', 'CAG', 'Docker', 'MongoDB'],
            'icon' => '🤖',
        ],
        [
            'title' => 'Strategic Consulting',
            'description' => 'Stop guessing with your technical strategy. I provide high-level architectural guidance and "Triage" audits to identify operational waste, ensuring your engineering efforts are aligned with business ROI. Co-founder of Triage Ops.',
            'tags' => ['System Design', 'Operational Audit', 'Tech Strategy'],
            'url' => 'https://triageops.com',
            'icon' => '📈',
        ],
        [
            'title' => 'Full-Stack Architecture',
            'description' => "Solid foundations matter. I architect and build scalable, secure web applications using modern standards. Whether it's a SaaS platform or a complex internal tool, I deliver production-grade code.",
            'tags' => ['SaaS Platforms', 'Microservices', 'System Scalability', 'Security Automation', 'Legacy Refactoring'],
            'icon' => '🏗️',
        ],
    ];
    
    $experiences = [
        [
            'title' => 'AI Engineer | Storage360',
            'location' => 'Contract',
            'description' => "Developing 'SADIE', a Natural Language to SQL engine. Architected a multi-agent system using LangGraph for orchestrating query understanding and SQL generation. Achieved sub-300ms response times and implemented MCP servers for secure database connectivity.",
            'icon' => 'CgWorkAlt',
            'logo' => '', // Placeholder or missing
            'date' => 'July 2024 - Present',
        ],
        [
            'title' => 'Consultant AI Engineer Lead | Founders Workshop',
            'location' => 'Contract',
            'description' => "Leading AI strategy and development for enterprise clients. I guide the implementation of custom AI solutions, from internal automation tools to customer-facing products, ensuring technical feasibility and alignment with business goals.",
            'icon' => 'CgWorkAlt',
            'logo' => 'logos/foundersworkshop.png',
            'date' => 'Present',
        ],
        [
            'title' => 'Technical Lead & Senior Software Engineer | Bizee (IncFile)',
            'location' => 'Remote',
            'description' => "Leading technical initiatives and rebuilding core products. Additionally, I architected and built internal AI tools, including a multi-agent document processing system (1,000+ daily requests) and a Hybrid RAG pipeline for efficient knowledge retrieval.",
            'icon' => 'CgWorkAlt',
            'logo' => 'logos/bizee.png',
            'date' => 'Dec 2022 - Present',
        ],
        [
            'title' => 'Previous Experience',
            'location' => 'Remote',
            'description' => 'Before specializing in AI, I spent nearly a decade as a Senior Full-Stack Engineer and Manager for various companies including Global Cybersec, HQ Rental, Buddhi, and Fulcrum Digital. I architected microservices, led security integrations, and built scalable SaaS platforms serving 10,000+ users.',
            'icon' => 'CgWorkAlt',
            'logo' => '',
            'date' => '2014 - 2022',
        ],
    ];
    
    $skillsData = [
        'Agentic Frameworks' => [
            'LangGraph' => '',
            'CrewAI' => '',
            'AutoGen' => '',
            'LangChain' => '',
        ],
        'LLM Ops & Evaluation' => [
            'LangSmith' => '',
            'LangFuse' => '',
            'Opik' => '',
            'W&B' => '',
        ],
        'Vector Databases' => [
            'MongoDB Atlas' => 'mongodb.svg',
            'Qdrant' => '',
            'Pinecone' => '',
            'Weaviate' => '',
        ],
        'Cloud & Infrastructure' => [
            'AWS' => 'aws.png',
            'Google Cloud' => 'googlecloud.svg',
            'Docker' => 'docker.svg',
            'Python' => '',
        ],
    ];
    
    return view('welcome', [
        'links' => $links,
        'services' => $services,
        'experiences' => $experiences,
        'skillsData' => $skillsData,
    ]);
});

require __DIR__.'/prezet.php';
