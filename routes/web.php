<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CareerController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/careers', function () {
    return view('careers');
})->name('careers');
Route::post('/careers/submit', [CareerController::class, 'submit'])->name('careers.submit');

// Services Pages
Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/services/software-development', function () {
    return view('softwaredevelopment');
})->name('services.software');

Route::get('/services/graphic-design', function () {
    return view('graphicdesign');
})->name('services.design');

Route::get('/services/branding', function () {
    return view('branding');
})->name('services.branding');

Route::get('/services/digital-marketing', function () {
    return view('digitalmarketing');
})->name('services.marketing');

Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

Route::get('/portfolio/{slug}', function ($slug) {
    $caseStudies = [
        'waveron-crm' => [
            'title' => 'Waveron CRM',
            'subtitle' => 'Low-Latency Sync Pipeline',
            'category' => 'PROPRIETARY SAAS',
            'badges' => ['React', 'Python', 'Docker', 'PostgreSQL'],
            'problem' => 'Sales teams and agents operating in high-volume environments experienced severe bottlenecks due to synchronization lag and latency spikes during concurrent database writes. This resulted in double-booking of leads, out-of-sync agent dashboards, and operational friction that directly impacted customer conversion rates.',
            'solution' => 'Waveron engineered a production-grade low-latency synchronization engine. Using React for an ultra-responsive frontend and Python microservices built on high-performance concurrency models, we integrated an asynchronous queue. The data storage was optimized with PostgreSQL indexed partitions, and the entire app was containerized with Docker for repeatable, zero-downtime deployment scale.',
            'result' => 'Achieved sub-100ms sync times and handled 10,000 matches/sec throughput, resulting in a 40% increase in sales velocity and zero data conflicts for over 50 concurrent agents.',
            'metrics' => [
                ['value' => '< 100ms', 'label' => 'Synchronization Latency'],
                ['value' => '10,000/s', 'label' => 'Engine Throughput'],
                ['value' => '+40%', 'label' => 'Sales Efficiency Gain']
            ],
            'visual_class' => 'dark-block',
            'visual_html' => '
                <div class="jwg-code-header d-flex justify-content-between flex-wrap gap-1">
                    <span class="text-muted small font-monospace">MATCHING_ENGINE_V2.LOG</span>
                    <span class="jwg-green font-monospace small">LIVE: PROCESSING</span>
                </div>
                <div class="jwg-code-body font-monospace mt-3">
                    <div class="text-success opacity-75">&gt; Initializing matching protocol...</div>
                    <div class="text-success opacity-75">&gt; Sorting bids [Price-Time Priority]</div>
                    <div class="jwg-chart mt-3 d-flex gap-1 align-items-end" style="height: 50px;">
                        <div class="bar" style="height: 30px; width: 6px; background-color: #20c997; border-radius: 2px 2px 0 0;"></div>
                        <div class="bar" style="height: 50px; width: 6px; background-color: #20c997; border-radius: 2px 2px 0 0;"></div>
                        <div class="bar" style="height: 20px; width: 6px; background-color: #20c997; border-radius: 2px 2px 0 0;"></div>
                        <div class="bar" style="height: 40px; width: 6px; background-color: #20c997; border-radius: 2px 2px 0 0;"></div>
                    </div>
                    <div class="text-white mt-3 fw-bold">&gt; Throughput: 10,000 matches/sec</div>
                    <div class="progress mt-2 bg-dark" style="height: 4px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 100%;"></div>
                    </div>
                </div>'
        ],
        'brand-book-generator' => [
            'title' => 'Brand Book Generator',
            'subtitle' => 'Automated Brand Guidelines',
            'category' => 'AI AUTOMATION',
            'badges' => ['AI Engine', 'Automation', 'PDF Gen'],
            'problem' => 'Designing and building comprehensive brand guidelines, color palettes, and typographic hierarchies was a repetitive, manual task that occupied up to 8 hours of senior designers\' time per client. This created operational bottlenecks during onboarding and limited the agency\'s capacity to scale.',
            'solution' => 'Waveron developed an automated, AI-driven Brand Book Generator. The solution extracts design semantics from basic inputs (logos, brand adjectives, core business sector) and generates complete PDF brand kits, style guides, and CSS/Tailwind typography configurations ready for immediate deployment.',
            'result' => 'Transformed an 8-hour manual design process into a 30-minute automated execution cycle, reducing operational overhead by 85% and enabling a 16x boost in client onboarding throughput.',
            'metrics' => [
                ['value' => '30 Min', 'label' => 'Onboarding Time'],
                ['value' => '85%', 'label' => 'Overhead Reduction'],
                ['value' => '16x', 'label' => 'Efficiency Boost']
            ],
            'visual_class' => 'light-block',
            'visual_html' => '
                <div class="d-flex flex-column align-items-center justify-content-center h-100 py-3 text-center">
                    <div class="mic-circle shadow-sm mb-3 d-flex align-items-center justify-content-center bg-white animate-pulse" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                        <i class="bi bi-mic-fill text-success fs-3"></i>
                    </div>
                    <div class="audio-waves mb-4 d-flex gap-2 align-items-center" style="height: 40px;">
                        <div class="wave" style="height:10px; width:6px; background-color:#20c997; border-radius:4px;"></div>
                        <div class="wave" style="height:20px; width:6px; background-color:#20c997; border-radius:4px;"></div>
                        <div class="wave" style="height:35px; width:6px; background-color:#20c997; border-radius:4px;"></div>
                        <div class="wave" style="height:20px; width:6px; background-color:#20c997; border-radius:4px;"></div>
                        <div class="wave" style="height:10px; width:6px; background-color:#20c997; border-radius:4px;"></div>
                    </div>
                    <div class="px-3 py-1 bg-white border shadow-sm rounded-pill font-monospace" style="font-size: 0.65rem; font-weight: 700; color: #6b7280; letter-spacing: 1px;">
                        <span class="text-success">&bull;</span> AUTOMATION ACTIVE
                    </div>
                </div>'
        ],
        'career-matcher' => [
            'title' => 'Career Matcher',
            'subtitle' => 'Talent Matching Engine',
            'category' => 'ENTERPRISE DASHBOARD',
            'badges' => ['Python', 'MySQL', 'Algorithmic Match'],
            'problem' => 'Enterprise recruitment teams struggled with manually matching high volumes of resumes to intricate, multi-departmental job criteria. This resulted in long time-to-hire cycles, recruitment bias, and a lack of consolidated tracking across different HR tools.',
            'solution' => 'Waveron engineered an enterprise-ready dashboard featuring a proprietary candidate scoring and matching algorithm. Built with Python backend intelligence and MySQL indexing, the dashboard centralizes candidate tracking, automatically reads resume fields, and executes real-time database synchronization with existing workflow systems.',
            'result' => 'Automated 90% of candidate filtering, reduced time-to-hire by 60%, and maintained 100% platform uptime.',
            'metrics' => [
                ['value' => '90%', 'label' => 'Auto-filtered Resumes'],
                ['value' => '60%', 'label' => 'Time-to-Hire Reduction'],
                ['value' => '100.0%', 'label' => 'System Uptime']
            ],
            'visual_class' => 'dark-block',
            'visual_html' => '
                <div class="d-flex border-bottom border-secondary border-opacity-25">
                    <div class="w-50 p-3 border-end border-secondary border-opacity-25">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <i class="bi bi-shield-check text-success fs-5"></i>
                            <div class="rounded-circle bg-success pulse-dot" style="width:8px; height:8px;"></div>
                        </div>
                        <div class="text-white-50 small mb-1" style="font-size:0.6rem; letter-spacing:1px;">SYSTEM HEALTH</div>
                        <h4 class="text-white m-0">100.0%</h4>
                    </div>
                    <div class="w-50 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <i class="bi bi-download text-white-50 fs-5"></i>
                            <span class="badge border border-success text-success bg-transparent" style="font-size:0.5rem">AUTO</span>
                        </div>
                        <div class="text-white-50 small mb-1" style="font-size:0.6rem; letter-spacing:1px;">REPORTS GEN</div>
                        <h4 class="text-white m-0">REALTIME</h4>
                    </div>
                </div>
                <div class="p-2 bg-black bg-opacity-50 mt-3 rounded font-monospace" style="font-size:0.65rem;">
                    <div class="text-white opacity-50">09:42:01 <span class="text-success">Pull_New_Invoices() - Success</span></div>
                    <div class="text-white opacity-50">09:42:05 <span class="text-white">Sync_Airtable_Database()</span></div>
                    <div class="text-white opacity-50">09:42:08 <span class="text-success">Trigger_Client_Notification()</span></div>
                </div>'
        ],
        'lead-generator' => [
            'title' => 'Lead Generator',
            'subtitle' => 'Automated Pipeline Engine',
            'category' => 'SALES INTELLIGENCE',
            'badges' => ['Prisma', 'BullMQ', 'Python'],
            'problem' => 'Lead sourcing and contact verification took sales teams hours of manual effort daily. Because databases quickly went stale, cold outreach campaigns suffered from high bounce rates and low overall conversion percentages.',
            'solution' => 'We constructed a high-velocity prospect enrichment engine powered by Python scraping agents, coordinated via BullMQ worker queues and managed with Prisma ORM. The architecture performs multi-source profile lookup, live email verification checkbacks, and logs quality-scored leads directly into client pipelines.',
            'result' => 'Provided 240+ fully enriched, high-confidence leads daily with a 95% data accuracy rate, boosting sales conversion probability by 85%.',
            'metrics' => [
                ['value' => '240+', 'label' => 'Daily Enriched Leads'],
                ['value' => '95%', 'label' => 'Contact Accuracy'],
                ['value' => '85%', 'label' => 'Conversion Prob']
            ],
            'visual_class' => 'light-block',
            'visual_html' => '
                <div class="p-3 border-bottom border-secondary border-opacity-10 d-flex justify-content-between flex-wrap gap-1 align-items-center bg-white">
                    <span class="text-muted small font-monospace"><i class="bi bi-funnel-fill text-success"></i> PIPELINE_ACTIVE</span>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill" style="font-size:0.6rem;">+240 LEADS</span>
                </div>
                <div class="p-3 font-monospace" style="font-size:0.7rem; background-color: #fafafa;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Targeting:</span> <span class="fw-bold">Enterprise Tech</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Enrichment:</span> <span class="text-success">100% Complete</span>
                    </div>
                    <div class="progress mt-3 mb-1" style="height: 6px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 85%;"></div>
                    </div>
                    <div class="text-end text-muted" style="font-size:0.6rem;">Conversion Prob: 85%</div>
                </div>'
        ],
        'ecommerce-core' => [
            'title' => 'E-Commerce Core',
            'subtitle' => 'Frictionless Transaction Platform',
            'category' => 'DIGITAL COMMERCE',
            'badges' => ['NextJS', 'Mpesa API', 'Redis'],
            'problem' => 'Slow page loading times and complex, multi-page checkout flows caused significant customer drop-offs and high cart abandonment rates, especially during high-traffic campaign seasons. Integration limits with local mobile payment systems like MPESA further hindered conversions.',
            'solution' => 'Waveron developed E-Commerce Core, a headless storefront design using Next.js for speed, combined with a high-performance Redis database caching layer to handle massive traffic. We integrated custom instant callbacks for MPESA mobile transactions directly into a single-step checkout flow.',
            'result' => 'Reached sub-second page load times and boosted checkout completions by 45% during peak hours.',
            'metrics' => [
                ['value' => '< 1s', 'label' => 'Average Page Load'],
                ['value' => '+45%', 'label' => 'Checkout Conversions'],
                ['value' => '$4,250/m', 'label' => 'Peak Revenue Capacity']
            ],
            'visual_class' => 'dark-block',
            'visual_html' => '
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-white-50 font-monospace small">STOREFRONT_API</span>
                    <i class="bi bi-cart-check text-success fs-5"></i>
                </div>
                <div class="text-center my-3">
                    <div class="text-white-50 small mb-1" style="letter-spacing:1px; font-size:0.65rem;">REVENUE / MIN</div>
                    <h3 class="text-white mb-0 display-6 fw-bold">$4,250<span class="text-success fs-6">.00</span></h3>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-2">
                    <div class="sparkline d-flex align-items-end gap-1" style="height: 30px;">
                        <div class="bg-success opacity-50" style="width: 8px; height: 40%;"></div>
                        <div class="bg-success opacity-50" style="width: 8px; height: 60%;"></div>
                        <div class="bg-success opacity-75" style="width: 8px; height: 80%;"></div>
                        <div class="bg-success" style="width: 8px; height: 100%;"></div>
                    </div>
                    <span class="text-success font-monospace small bg-success bg-opacity-10 px-2 py-1 rounded">+12.4%</span>
                </div>'
        ],
        'security-agent' => [
            'title' => 'Security Agent',
            'subtitle' => 'Real-Time Threat Mitigator',
            'category' => 'CYBERSECURITY',
            'badges' => ['NestJS', 'FastAPI', 'Threat Engine'],
            'problem' => 'Legacy network perimeter firewalls struggled to identify sophisticated zero-day attacks and payload-level malicious requests targeting application-layer endpoints, risking data breaches and ransomware threats.',
            'solution' => 'We developed Security Agent, an autonomous host-level microagent built on NestJS and FastAPI. The system monitors network packets, audits authentication tokens, dynamically identifies request signatures, and executes heuristic threat scanning to isolate malicious activities instantly.',
            'result' => 'Mitigated 99.9% of security threats, triggering automated IP blocking actions in under 2 seconds.',
            'metrics' => [
                ['value' => '99.9%', 'label' => 'Threat Mitigation Rate'],
                ['value' => '< 2s', 'label' => 'IP Quarantine Time'],
                ['value' => '24/7', 'label' => 'Autonomous Audits']
            ],
            'visual_class' => 'dark-block',
            'visual_html' => '
                <div class="d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-50 pb-2">
                    <span class="text-danger font-monospace small"><i class="bi bi-shield-lock-fill"></i> SEC_AGENT_v1</span>
                    <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                        <span class="visually-hidden">Scanning...</span>
                    </div>
                </div>
                <div class="font-monospace mt-3" style="font-size:0.65rem;">
                    <div class="text-white-50">&gt; Scanning net_protocols... <span class="text-success">CLEAN</span></div>
                    <div class="text-white-50">&gt; Analyzing payload_sig... <span class="text-success">CLEAN</span></div>
                    <div class="text-white-50">&gt; Checking auth_tokens...</div>
                    <div class="text-danger fw-bold mt-2 bg-danger bg-opacity-10 p-1 rounded border border-danger border-opacity-25 threat-pulse">&gt; THREAT MITIGATED: IP 192.168.*</div>
                </div>'
        ],
    ];

    if (!array_key_exists($slug, $caseStudies)) {
        abort(404);
    }

    $caseStudy = $caseStudies[$slug];
    return view('case-study', compact('caseStudy'));
})->name('portfolio.case-study');
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms-of-service');

// Quote Calculator
Route::get('/quote', function () {
    return view('quote');
})->name('quote');

Route::get('/quote/configuration-guide', function () {
    return view('quote-guide');
})->name('quote.guide');

Route::post('/quote/email-estimate', [ContactController::class, 'emailEstimate'])->name('quote.email-estimate');

// Blog Routes
use App\Http\Controllers\BlogController;
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{slug}/comments', [BlogController::class, 'storeComment'])->name('blog.comments.store');

// Newsletter Route
use App\Http\Controllers\NewsletterController;
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Tools/Utilities Routes
Route::prefix('tools')->name('tools.')->group(function () {
    Route::get('/', function () {
        return view('tools.index');
    })->name('index');

    Route::get('/invoice-generator', function () {
        return view('tools.invoice-generator');
    })->name('invoice-generator');

    Route::get('/salary-calculator', function () {
        return view('tools.salary-calculator');
    })->name('salary-calculator');

    Route::get('/cv-builder', function () {
        return view('tools.cv-builder');
    })->name('cv-builder');

    Route::get('/cover-letter-generator', function () {
        return view('tools.cover-letter-generator');
    })->name('cover-letter-generator');

    Route::get('/break-even-calculator', function () {
        return view('tools.break-even-calculator');
    })->name('break-even-calculator');

    Route::get('/ats-resume-checker', function () {
        return view('tools.ats-resume-checker');
    })->name('ats-resume-checker');

    Route::get('/pdf-merger', function () {
        return view('tools.pdf-merger');
    })->name('pdf-merger');

    Route::get('/content-calendar-generator', function () {
        return view('tools.content-calendar-generator');
    })->name('content-calendar-generator');

    Route::get('/loan-calculator', function () {
        return view('tools.loan-calculator');
    })->name('loan-calculator');
});

