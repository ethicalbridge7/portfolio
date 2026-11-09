@php
    $site = rtrim(config('app.url'), '/');
    $seoTitle = 'Prosper Amutah | Software Engineer & QA Engineer';
    $seoDescription = 'Software engineer and QA engineer building and testing web and mobile apps with Laravel, React, Next.js and Flutter. Available for remote work worldwide.';
    $seoSkills = ['Software Engineering', 'Full-Stack Web Development', 'Laravel', 'PHP', 'React', 'Next.js', 'TypeScript', 'Node.js', 'Python', 'Flutter', 'Mobile App Development', 'REST API Development', 'PostgreSQL', 'MySQL', 'Docker', 'Software Quality Assurance', 'API Testing', 'Regression Testing', 'User Acceptance Testing'];
    $person = [
        '@type' => 'Person',
        '@id' => $site.'/#prosper',
        'name' => 'Prosper Amutah',
        'url' => $site.'/',
        'image' => $site.(file_exists(public_path('img/prosper.jpg')) ? '/img/prosper.jpg' : '/img/og.jpg'),
        'jobTitle' => ['Software Engineer', 'Quality Assurance Engineer'],
        'description' => $seoDescription,
        'email' => 'mailto:contact@prosperamutah.online',
        'telephone' => '+2349077989776',
        'address' => ['@type' => 'PostalAddress', 'addressCountry' => 'NG'],
        'alumniOf' => ['@type' => 'CollegeOrUniversity', 'name' => 'Michael Okpara University of Agriculture, Umudike'],
        'knowsAbout' => $seoSkills,
        'sameAs' => ['https://linkedin.com/in/prosper-amutah-667530241', 'https://github.com/ethicalbridge7'],
    ];
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            $person,
            ['@type' => 'WebSite', '@id' => $site.'/#website', 'url' => $site.'/', 'name' => 'Prosper Amutah', 'inLanguage' => 'en'],
            ['@type' => 'ProfilePage', 'url' => $site.'/', 'name' => $seoTitle, 'mainEntity' => ['@id' => $site.'/#prosper'], 'isPartOf' => ['@id' => $site.'/#website']],
        ],
    ];
    $services = [
        ['Full-stack web development', 'Web applications and SaaS products built with Laravel, PHP, React, Next.js, TypeScript and Node.js.'],
        ['Mobile app development', 'Cross-platform Android and iOS apps built with Flutter and Dart.'],
        ['API development', 'Secure REST APIs with authentication, rate limiting and payment integration.'],
        ['Databases and deployment', 'Relational schemas in PostgreSQL and MySQL, row-level security, and Docker.'],
        ['Software QA testing', 'Manual test plans covering functional, regression, integration and user acceptance testing.'],
        ['API testing', 'Test cases that verify responses, behavior and failure paths, with defect reports developers can act on.'],
    ];
    $skills = [
        'left' => [
            ['Web', 'React, Next.js, Tailwind CSS'],
            ['Mobile', 'Flutter, Dart'],
            ['Backend', 'Laravel, Node.js, REST APIs'],
        ],
        'right' => [
            ['Languages', 'TypeScript, Python, PHP'],
            ['Data and delivery', 'PostgreSQL, MySQL, Docker'],
            ['Testing', 'API, functional, regression, integration, UAT'],
        ],
    ];
    // Drop a picture at the given public path and it replaces the placeholder.
    $projects = [
        [
            'name' => 'JobProfi', 'image' => 'img/projects/jobprofi.jpg', 'url' => 'https://usejobprofi.com',
            'stack' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Flutter'],
            'text' => 'A SaaS platform for job seekers, with application tracking, a career coach, a job analyzer and a résumé builder that exports PDFs. Used by more than 70 people, with Flutterwave and Paystack payments.',
        ],
        [
            'name' => 'Voice Of The Youths', 'image' => 'img/projects/voty.jpg', 'url' => 'https://voty.ng',
            'stack' => ['TypeScript', 'Next.js', 'PostgreSQL', 'Supabase'],
            'text' => 'An educational video platform for young members, with subscriptions, trivia and voting. 34 REST endpoints, phone login over SMS, rate limiting and row-level security.',
        ],
        [
            'name' => 'DYL Logistics', 'image' => 'img/projects/dyl.jpg', 'url' => 'https://dyllogistics.com',
            'stack' => ['PHP', 'Laravel', 'Livewire', 'Flux UI', 'MySQL', 'Tailwind CSS', 'JavaScript'],
            'text' => 'A delivery service across Enugu for food, groceries, pharmacy items, parcels and errands, with verified riders, partner stores and a dashboard that tracks every order.',
        ],
        [
            'name' => 'University Academic Management System', 'image' => 'img/projects/uams.jpg', 'url' => null,
            'stack' => ['React', 'Laravel', 'PostgreSQL', 'Docker', 'TypeScript'],
            'text' => 'Enrollment, results and student self-service, shaped by interviews and surveys with more than 100 students and staff. A working prototype, demonstrated to university management.',
        ],
    ];
    $bugs = [
        ['Typo', '#27408B', 'plain', 56, 150, 'People read what they expect to read, so I write defect reports with exact steps to reproduce.'],
        ['Wrong date', '#C98A12', 'spots', 66, 140, 'An empty date shows as 1 January 1970. VOTY login codes expire in 10 minutes, so time has to be right.'],
        ['Off-by-one error', '#0E6B5B', 'band', 60, 165, 'A change upstream quietly breaks something far away. Regression test plans exist to catch it.'],
        ['Broken layout', '#B80F4A', 'striate', 54, 180, 'Screens have to hold on every browser and phone, especially at checkout.'],
        ['Exposed admin control', '#2A1238', 'spots', 70, 150, 'Hiding a button is not access control. I enforce roles on the server, in Laravel.'],
        ['Bad number', '#27408B', 'striate', 64, 160, 'A figure on a screen is only as good as the path it took to get there. I check the path.'],
        ['Runaway progress', '#0E6B5B', 'spots', 58, 172, 'Idempotent saves on VOTY mean a repeated request can’t push a video past 100%.'],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="Prosper Amutah, software engineer, software developer, full-stack developer, QA engineer, software tester, Laravel developer, React developer, Next.js developer, Flutter developer, API testing, hire remote software engineer">
    <meta name="author" content="Prosper Amutah">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
    <meta name="theme-color" content="#2A1238">
    <link rel="canonical" href="{{ $site }}/">
    <meta property="og:type" content="profile">
    <meta property="og:site_name" content="Prosper Amutah">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $site }}/">
    <meta property="og:image" content="{{ $site }}/img/og.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Prosper Amutah, Software Engineer and QA Engineer">
    <meta property="profile:first_name" content="Prosper">
    <meta property="profile:last_name" content="Amutah">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $site }}/img/og.jpg">
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    <link rel="icon" href="/favicon.ico" sizes="48x48">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=alegreya:400,400i,500,700|besley:500,800,900" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="page">

<flux:brand class="site-logo" href="/" logo="/favicon.svg" alt="Prosper Amutah, home" />

<flux:navbar class="site-nav" aria-label="Sections">
    <flux:navbar.item href="#story">Story</flux:navbar.item>
    <flux:navbar.item href="#projects">Projects</flux:navbar.item>
    <flux:navbar.item href="#contact">Contact</flux:navbar.item>
    <flux:navbar.item x-on:click="openResume()">Resume</flux:navbar.item>
    <flux:navbar.item x-on:click="openIdentify()">Identify bugs</flux:navbar.item>
    <flux:navbar.item x-on:click="openSim()">Simulation</flux:navbar.item>
</flux:navbar>

<flux:dropdown class="site-menu" position="bottom" align="end">
    <flux:button class="site-menu-button" icon="bars-2">Menu</flux:button>
    <flux:navmenu>
        <flux:navmenu.item href="#story">Story</flux:navmenu.item>
        <flux:navmenu.item href="#projects">Projects</flux:navmenu.item>
        <flux:navmenu.item href="#contact">Contact</flux:navmenu.item>
        <flux:navmenu.item x-on:click="openResume()">Resume</flux:navmenu.item>
        <flux:navmenu.item x-on:click="openIdentify()">Identify bugs</flux:navmenu.item>
        <flux:navmenu.item x-on:click="openSim()">Simulation</flux:navmenu.item>
    </flux:navmenu>
</flux:dropdown>

<header class="hero">
    <div class="intro">
        <h1 class="name">Prosper Amutah <span>Software Engineer &amp; QA Engineer</span></h1>
        <p class="tagline">I build software and test it before your users have to.</p>
        <p class="lede">I’m a full-stack software engineer and QA tester based in Nigeria, working remotely with teams worldwide. I design and ship web and mobile products, then test them the way a stranger would use them.</p>
        <x-contact-links />
    </div>

    <figure class="plate">
        @foreach ($skills as $side => $notes)
            <dl class="notes-col {{ $side }}">
                @foreach ($notes as [$title, $detail])
                    <div class="note" style="--i: {{ $loop->index * 2 + ($side === 'right' ? 1 : 0) }}"><dt>{{ $title }}</dt><dd>{{ $detail }}</dd></div>
                @endforeach
            </dl>
        @endforeach
        <div class="portrait">
            @if (file_exists(public_path('img/prosper.jpg')))
                <img src="{{ asset('img/prosper.jpg') }}" alt="Portrait of Prosper Amutah">
            @else
                <span class="monogram" aria-hidden="true">PA</span>
            @endif
            <svg class="pinned" viewBox="-130 -190 260 370" aria-hidden="true"><x-beetle /></svg>
        </div>
        <figcaption>Fig. 1. The software engineer, with tools.</figcaption>
    </figure>
</header>

<main id="story" class="story" x-ref="story">
    <svg class="trail" aria-hidden="true"><path x-ref="trail" /></svg>
    <svg class="walker" x-ref="walker" viewBox="-130 -190 260 370" aria-hidden="true"><x-beetle /></svg>

    <x-chapter where="Michael Okpara University of Agriculture" place="Umudike, Abia State" when="December 2019 to October 2024">
        <p class="chapter-no">Chapter 1</p>
        <h2>It started with learning how the machine thinks.</h2>
        <p>I studied Computer Science at Michael Okpara University of Agriculture and finished in October 2024 with a 3.92 GPA.</p>
    </x-chapter>

    <x-chapter class="drift" where="Berge Technology Hub" place="Umuahia, Abia State" when="June 2023 to October 2024">
        <p class="chapter-no">Chapter 2</p>
        <h2>Then real people had to get through checkout.</h2>
        <p>While still studying, I joined Berge Technology Hub and built features for an e-commerce platform in Laravel and MySQL. Checkout speed and user engagement improved by 30%.</p>
        <p>I delivered the interface across browsers and phones in Bootstrap, Tailwind CSS and TypeScript.</p>
        <p>I also learned the habit of Git-based code review: someone else reads your work before your users do.</p>
    </x-chapter>

    <x-chapter where="University Academic Management System" place="React, Laravel, PostgreSQL, Docker, TypeScript" when="Over 100 students and staff consulted">
        <p class="chapter-no">Chapter 3</p>
        <h2>Before writing the code, I asked a hundred people.</h2>
        <p>Students and staff told me, through interviews and surveys, how academic records really moved through a university. From that I designed and built a working prototype: enrollment, self-service for students, dashboards for administrators, and uploading and editing of results.</p>
        <p>Students sign in with their matriculation numbers, and I demonstrated the system to university management, using institutional data, during their workflow evaluation.</p>
    </x-chapter>

    <x-chapter class="drift" where="JobProfi" place="Laravel, MySQL, Tailwind CSS, Flutter" when="Used by more than 70 people">
        <p class="chapter-no">Chapter 4</p>
        <h2>Next I built a workspace for job seekers.</h2>
        <p>JobProfi tracks applications and manages résumés. It has a career coach, interview preparation, and a job analyzer that compares your qualifications with what a role asks for. Its résumé builder previews live and exports a PDF in one click.</p>
        <p>Automated follow-up emails increased engagement by 35%. Payments run through Flutterwave and Paystack, and there is a Flutter mobile app.</p>
    </x-chapter>

    <x-chapter where="Nu3careplus LTD, remote, since December 2024" place="iHealth Wellness Foundation, New York" when="February 2025 to January 2026">
        <p class="chapter-no">Chapter 5</p>
        <h2>So I crossed to the other side of the bug report.</h2>
        <p>At Nu3careplus I design test cases for applications and APIs, checking responses and behavior, and reporting what fails. At iHealth Wellness Foundation I wrote and ran manual test plans for web and mobile apps: functional, regression, integration and UAT.</p>
        <p>The teams sat across time zones, so a bug report had to make sense to someone who was asleep when I filed it. Release schedules depended on that.</p>
    </x-chapter>

    <x-chapter class="drift" where="Voice Of The Youths" place="TypeScript, Next.js, PostgreSQL, Supabase" when="34 endpoints, 18 migrations">
        <p class="chapter-no">Chapter 6</p>
        <h2>After that, I built as if I would be the one attacking it.</h2>
        <p>VOTY is an educational platform where young members subscribe to videos, answer trivia on what they watched, and vote. I shipped its 34 REST endpoints.</p>
        <p>Login is by phone, through a Nigerian carrier SMS gateway. Codes die after 10 minutes. A sliding-window limiter allows 5 code requests a minute and 10 verification attempts in 5 minutes. Row-level security keeps each member’s progress, votes and profile to themselves.</p>
        <p>Playback resumes where you left off and completes at 90% watched.</p>
    </x-chapter>

    <x-chapter where="Havilla University" place="Nde-Ikom, Cross River State" when="December 2025 to October 2026">
        <p class="chapter-no">Chapter 7</p>
        <h2>And then I stood in front of a class and taught it.</h2>
        <p>As lecturer and Software Engineering Department Coordinator, I taught undergraduate Computer Science, Software Engineering and Cyber Security. I wrote the lectures, practicals and examinations, and supported curriculum development and academic planning.</p>
        <p>The lesson I most wanted to pass on: assume it’s broken, then find out how.</p>
    </x-chapter>
</main>

<section id="projects" class="projects" aria-labelledby="projects-title">
    <h2 id="projects-title">Things I’ve built</h2>
    @foreach ($projects as $project)
        <article class="project">
            <div class="shot">
                @if (file_exists(public_path($project['image'])))
                    <img src="{{ asset($project['image']) }}" alt="Screenshot of {{ $project['name'] }}" loading="lazy">
                @else
                    <span aria-hidden="true">{{ $project['name'] }}</span>
                @endif
            </div>
            <div class="project-text">
                <h3>{{ $project['name'] }}</h3>
                <p>{{ $project['text'] }}</p>
                @if ($project['stack'])
                    <div class="stack">
                        @foreach ($project['stack'] as $tool)
                            <flux:badge size="sm" class="tool">{{ $tool }}</flux:badge>
                        @endforeach
                    </div>
                @endif
                @if ($project['url'])
                    <flux:button icon:trailing="arrow-top-right-on-square" href="{{ $project['url'] }}" target="_blank" rel="noopener">Visit site</flux:button>
                @endif
            </div>
        </article>
    @endforeach
</section>

<section id="services" class="services" aria-labelledby="services-title">
    <h2 id="services-title">What you can hire me for</h2>
    <p class="services-intro">I work remotely with startups, companies and universities in any time zone.</p>
    <dl>
        @foreach ($services as [$service, $detail])
            <div><dt>{{ $service }}</dt><dd>{{ $detail }}</dd></div>
        @endforeach
    </dl>
</section>

<section id="bugs" class="drawer" aria-labelledby="drawer-title">
    <h2 id="drawer-title">Bugs I’ve learned to look for</h2>
    <ul class="specimens">
        @foreach ($bugs as [$plain, $color, $pattern, $w, $l, $note])
            <li>
                <svg viewBox="-130 -190 260 370" aria-hidden="true"><x-beetle :w="$w" :l="$l" :color="$color" :pattern="$pattern" /></svg>
                <div>
                    <h3>{{ $plain }}</h3>
                    <p>{{ $note }}</p>
                </div>
            </li>
        @endforeach
        <li class="eighth"><a href="mailto:contact@prosperamutah.online?subject=Found%20a%20bug">Found another one on this site? Tell me.</a></li>
    </ul>

    <div id="contact" class="hire">
        <p>If you need software that’s built well and tested properly, write to me.</p>
        <x-contact-links />
    </div>

    <dl class="cv-notes">
        <div><dt>Education</dt><dd>BSc Computer Science, Michael Okpara University of Agriculture, 2024. GPA 3.92.</dd></div>
        <div><dt>Teaching</dt><dd>Computer Science, Software Engineering and Cyber Security at Havilla University.</dd></div>
        <div><dt>Certificates</dt><dd>Software Engineering Job Simulation, Wells Fargo on Forage, September 2025. Software Development Job Simulation, Datacom on Forage, September 2025.</dd></div>
        <div><dt>Research interests</dt><dd>Machine learning, AI and security.</dd></div>
    </dl>
</section>

<flux:modal name="identify" class="identify-modal">
    <flux:heading size="xl" level="2">Identify the bugs</flux:heading>
    <flux:text class="identify-intro">This checkout has four bugs. Click each part you think is broken.</flux:text>
    <x-bug-hunt />
    <p class="hunt-done" x-show="huntDone">All four fixed. These were planted, but it’s how I report the real ones.</p>
</flux:modal>

<flux:modal name="simulate" class="sim-modal">
    <flux:heading size="xl" level="2">Hire me: a simulation</flux:heading>
    <flux:text class="identify-intro">You play the client. Sample project, sample timeline, computer-generated client photo.</flux:text>

    <ol class="sim-steps">
        <template x-for="(name, i) in stages" x-bind:key="name">
            <li x-bind:class="{ now: i === stage, done: i < stage }" x-text="name"></li>
        </template>
    </ol>

    <div class="sim-talk" x-show="stage < 2">
        <div class="sim-people">
            <x-sim-person image="img/sim/client.jpg" initial="A" name="Ani" role="Sample client" />
            <x-sim-person image="img/prosper.jpg" initial="P" name="Prosper" role="Engineer" />
        </div>
        <div class="sim-thread">
            <div class="sim-chat">
                <template x-for="(message, i) in messages" x-bind:key="i">
                    <p x-bind:class="message.who" x-text="message.text"></p>
                </template>
            </div>
            <div class="sim-choices">
                <template x-for="option in options" x-bind:key="option.label">
                    <flux:button class="sim-choice" x-on:click="choose(option)"><span x-text="option.label"></span></flux:button>
                </template>
            </div>
        </div>
    </div>

    <div class="sim-build" x-show="stage === 2">
        <ul class="sim-tasks">
            <template x-for="(task, i) in project?.tasks ?? []" x-bind:key="task.name">
                <li x-bind:class="{ done: i < taskIndex, now: i === taskIndex }" x-text="task.name"></li>
            </template>
        </ul>
        <pre class="sim-editor"><code x-text="code"></code></pre>
    </div>

    <div class="sim-test" x-show="stage === 3">
        <p class="sim-note" x-text="hunt.staging"></p>
        <x-bug-hunt />
        <flux:button variant="primary" x-show="huntDone" x-on:click="ship()">Ship it</flux:button>
    </div>

    <div class="sim-ship" x-show="stage === 4">
        <pre class="sim-editor"><code x-text="deploy"></code></pre>
        <div x-show="shipped">
            <dl class="sim-stats">
                <div><dt>Delivered on</dt><dd>Day <span x-text="day"></span></dd></div>
                <div><dt>Tasks finished</dt><dd x-text="project?.tasks.length"></dd></div>
                <div><dt>Bugs that reached users</dt><dd>0</dd></div>
            </dl>
            <p class="sim-note">That was the sample version. The real one starts with an email.</p>
            <div class="actions">
                <flux:button icon="envelope" href="mailto:contact@prosperamutah.online?subject=Let%27s%20build%20something">Do this for real</flux:button>
                <flux:button x-on:click="openSim()">Play again</flux:button>
            </div>
        </div>
    </div>
</flux:modal>

<flux:modal name="resume" class="resume-modal">
    <div class="resume-head">
        <flux:heading size="lg" level="2">Resume</flux:heading>
        <flux:button size="sm" icon="arrow-down-tray" href="/cv.pdf" download>Download PDF</flux:button>
    </div>
    <p class="resume-status" x-show="resumeStatus" x-text="resumeStatus" role="status"></p>
    <div class="resume-pages" tabindex="0" aria-label="Resume pages"></div>
</flux:modal>

@livewireScripts
@fluxScripts
</body>
</html>
