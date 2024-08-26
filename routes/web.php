<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $links = [
        [
            'name' => 'Home',
            'hash' => '#home',
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
            'title' => 'Web Applications',
            'description' => 'Elevate your business with custom web applications that boost user engagement and drive growth. Partner with me to build secure, scalable, and high-performance solutions that convert visitors into loyal customers.',
            'tags' => ['React', 'Next.js', 'MongoDB', 'Tailwind', 'Prisma'],
        ],
        [
            'title' => 'Mobile Applications',
            'description' => 'Turn your ideas into engaging mobile apps that captivate users and expand your brand’s reach. I create intuitive, high-quality mobile applications that transform downloads into active, loyal users.',
            'tags' => ['React', 'TypeScript', 'Next.js', 'Tailwind', 'Redux'],
        ],
        [
            'title' => 'Consulting',
            'description' => 'Optimize your software strategy and drive success with expert consulting. I provide actionable insights and solutions to streamline your processes, innovate effectively, and achieve your business goals.',
            'tags' => ['React', 'Next.js', 'SQL', 'Tailwind', 'Framer'],
        ],
    ];
    
    $experiences = array_reverse([
        [
            'title' => 'Engineer Manager | Global Cybersec',
            'location' => 'Remote',
            'description' => 'I developed internal applications to automate processes, enhance service efficiency, and protect client assets. I created a microservice ecosystem, upgraded legacy systems with security integrations, built a central data management app, and a Helpdesk system. I also engaged in blue team tasks, including threat detection, vulnerability analysis, incident response, and firewall and IDS sensor configuration.',
            'icon' => 'CgWorkAlt',
            'date' => '2017 - 2020',
        ],
        [
            'title' => 'Full Stack Engineer | Fulcrum',
            'location' => 'Remote',
            'description' => 'As part of a 10+ developer team, I helped maintain a U.S.-based Medical SaaS, focusing on refactoring and testing legacy code, implementing fully tested new features, and redesigning app components using TailwindCSS.',
            'icon' => 'CgWorkAlt',
            'date' => '2020 - 2021',
        ],
        [
            'title' => 'Senior Software Engineer | Buddhi',
            'location' => 'Remote',
            'description' => "As part of a small team, I contributed to developing Buddhi, a single-page application (SPA) platform for the cancer community, focusing on building a safe space for discussions. I implemented fully tested features and integrated with third-party services.",
            'icon' => 'CgWorkAlt',
            'date' => '2021 - 2022',
        ],
        [
            'title' => 'Senior Software Engineer | HQ Rental Software',
            'location' => 'Remote',
            'description' => "I optimized application performance and provided strategic guidance to enhance software efficiency, usability, and scalability, aligning with technological standards and business goals. I resolved client issues promptly, initiated a comprehensive test suite, developed an email parsing application to streamline workflows, and led refactoring efforts to reduce code duplication and improve maintainability.",
            'icon' => 'CgWorkAlt',
            'date' => '2021 - 2022',
        ],
        [
            'title' => 'Senior Software Engineer | Bizee',
            'location' => 'Remote',
            'description' => "As the Project Technical Lead, I guided the rebuilding of the main product, enforced development standards and processes, and contributed to the architecture of new and existing projects. I mentored team members to deliver high-quality, testable code, implemented documentation, and assisted in reviewing pull requests.",
            'icon' => 'CgWorkAlt',
            'date' => '2022 - Present',
        ],
    ]);
    
    $skillsData = [
        'Frontend' => [
            'JavaScript' => 'javascript.svg',
            'React' => 'reactjs.svg',
            'React Native' => 'reactjs.svg',
            'Next.js' => 'nextjs.svg',
            'Vue.js' => 'vuejs.svg',
            'Nuxt.js' => 'nuxtjs.svg',
            'Alpine.js' => 'alpinejs.svg',
            'TailwindCSS' => 'tailwindcss.svg',
        ],
        'Backend' => [
            'TypeScript' => 'typescript.svg',
            'Node.js' => 'nodejs.svg',
            'Express' => 'expressjs.svg',
            'Nest.js' => 'nestjs.svg',
            'PHP' => 'php.svg',
            'Laravel' => 'laravel.svg',
            'Livewire' => 'livewire.png',
        ],
        'Databases' => [
            'PostgreSQL' => 'postgresql.svg',
            'MySQL' => 'mysql.svg',
            'MongoDB' => 'mongodb.svg',
        ],
        'DevOps' => [
            'Docker' => 'docker.svg',
            'AWS' => 'aws.png',
            'Google Cloud' => 'googlecloud.svg',
            'CircleCI' => 'circleci.svg',
            'GitHub Actions' => 'githubactions.svg',
        ],
    ];
    
    $aiTools = [
        'AI' => [
            'RAG',
            'Langchain',
            'LM Studio'
        ]
    ];
    
    return view('welcome', [
        'links' => $links,
        'services' => $services,
        'experiences' => $experiences,
        'skillsData' => $skillsData,
        'aiTools' => $aiTools,
    ]);
});

require __DIR__.'/prezet.php';
