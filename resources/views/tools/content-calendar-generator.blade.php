@extends('layouts.app')

@section('title', 'Content Calendar Generator | Waveron Technologies')
@section('meta_description', 'Generate a customized weekly marketing content calendar for your business. Tailored hooks, post templates, and calls-to-action for LinkedIn, Twitter, Instagram, and blogs.')

@section('content')
<div class="container-fluid py-4" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">Content Calendar</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Left Column: Generator Inputs -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h3 class="fw-bold mb-4 text-primary d-flex align-items-center">
                        <i class="bi bi-calendar3 me-2"></i> Content Calendar
                    </h3>

                    <!-- Industry Select -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Business Industry</label>
                        <select id="industry" class="form-select">
                            <option value="technology">Technology & SaaS</option>
                            <option value="realestate">Real Estate & Construction</option>
                            <option value="ecommerce">E-commerce & Retail</option>
                            <option value="consulting">Professional Consulting & Finance</option>
                            <option value="healthcare">Fitness & Healthcare</option>
                        </select>
                    </div>

                    <!-- Target Audience -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Target Audience</label>
                        <input type="text" id="audience" class="form-control" value="Small business owners and startup founders" placeholder="e.g. Job seekers, homeowners">
                    </div>

                    <!-- Tone of Voice -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tone of Voice</label>
                        <select id="tone" class="form-select">
                            <option value="professional">Professional & Authoritative</option>
                            <option value="casual">Casual & Conversational</option>
                            <option value="inspirational">Inspirational & Bold</option>
                            <option value="educational">Educational & Analytical</option>
                        </select>
                    </div>

                    <!-- Duration / Weeks -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Calendar Duration</label>
                        <select id="duration" class="form-select">
                            <option value="1">1 Week Schedule (5 Posts)</option>
                            <option value="2">2 Week Schedule (10 Posts)</option>
                        </select>
                    </div>

                    <!-- Platforms Checkbox -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Target Channels</label>
                        <div class="form-check mb-1.5">
                            <input class="form-check-input platform-check" type="checkbox" value="linkedin" id="platform-linkedin" checked>
                            <label class="form-check-label small" for="platform-linkedin">
                                <i class="bi bi-linkedin text-primary me-1"></i> LinkedIn
                            </label>
                        </div>
                        <div class="form-check mb-1.5">
                            <input class="form-check-input platform-check" type="checkbox" value="twitter" id="platform-twitter" checked>
                            <label class="form-check-label small" for="platform-twitter">
                                <i class="bi bi-twitter-x text-dark me-1"></i> Twitter / X
                            </label>
                        </div>
                        <div class="form-check mb-1.5">
                            <input class="form-check-input platform-check" type="checkbox" value="instagram" id="platform-instagram">
                            <label class="form-check-label small" for="platform-instagram">
                                <i class="bi bi-instagram text-danger me-1"></i> Instagram
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input platform-check" type="checkbox" value="blog" id="platform-blog" checked>
                            <label class="form-check-label small" for="platform-blog">
                                <i class="bi bi-file-text-fill text-success me-1"></i> Blog article idea
                            </label>
                        </div>
                    </div>

                    <button id="generate-btn" class="btn btn-primary w-100 rounded-pill py-2.5 fw-semibold shadow-sm">
                        <i class="bi bi-arrow-repeat me-1"></i> Generate Calendar Schedule
                    </button>
                </div>
            </div>

            <!-- Right Column: Interactive Calendar Board -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-muted small font-monospace mb-0"><i class="bi bi-grid-3x3-gap"></i> CONTENT SCHEDULE BOARD</h5>
                    <button id="export-csv-btn" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-medium">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Schedule (CSV)
                    </button>
                </div>

                <!-- Calendar Weekly Layout -->
                <div id="calendar-board" class="d-flex flex-column gap-4">
                    <!-- Week rows injected here dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="editPostModalLabel">Edit Content Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Topic</label>
                    <input type="text" id="modal-post-topic" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Post Hook</label>
                    <textarea id="modal-post-hook" class="form-control" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Body Template</label>
                    <textarea id="modal-post-body" class="form-control" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Call to Action (CTA)</label>
                    <input type="text" id="modal-post-cta" class="form-control">
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="save-modal-btn" class="btn btn-primary rounded-pill px-4">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .platform-badge {
        font-size: 0.65rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-weight: 700;
        font-family: monospace;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }

    .gap-1.5 {
        gap: 0.35rem !important;
    }
    
    .mb-1.5 {
        margin-bottom: 0.35rem !important;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const generateBtn = document.getElementById('generate-btn');
    const board = document.getElementById('calendar-board');
    const exportCsvBtn = document.getElementById('export-csv-btn');

    // Modal elements
    const editModalEl = document.getElementById('editPostModal');
    let editModal = null;
    if (typeof bootstrap !== 'undefined') {
        editModal = new bootstrap.Modal(editModalEl);
    }
    
    const modalTopic = document.getElementById('modal-post-topic');
    const modalHook = document.getElementById('modal-post-hook');
    const modalBody = document.getElementById('modal-post-body');
    const modalCta = document.getElementById('modal-post-cta');
    const saveModalBtn = document.getElementById('save-modal-btn');
    
    let activePostId = null;

    // Generated post storage
    let activeSchedule = [];

    // Local content templates database mapped to Industry + Channel + Day indices
    const templates = {
        technology: {
            linkedin: [
                {
                    topic: "Bootstrap SaaS Scaling",
                    hook: "Scaling a SaaS with zero marketing budget sounds impossible. We did it by doing one thing.",
                    body: "Instead of running costly advertisements, we focused on building custom tools that users loved. By launching small, free utility tools, we generated over [insert number] high-quality organic leads.\n\nHere is our methodology:\n1. Find common daily friction points in [insert industry].\n2. Package simple calculators or templates on the client-side.\n3. Make sharing reports standard.\n\nHave you tried engineering-as-marketing in your startup?",
                    cta: "Check out our free tools library here: [insert link]"
                },
                {
                    topic: "Cloud Cost Optimization Tips",
                    hook: "Your cloud bill is probably 30% higher than it needs to be. Here is why.",
                    body: "Many SaaS founders automatically set up large cluster instances when simple hosting satisfies demand. After auditing our client projects last month, we discovered:\n- Orphaning volumes accounts for 12% waste.\n- Over-provisioning standard memory adds another 18%.\n\nWe optimized this by configuring automated resource monitors and switching to localized serverless API designs.",
                    cta: "Share this list with your CTO. Let us know how much you saved!"
                }
            ],
            twitter: [
                {
                    topic: "Developer Productivity Hook",
                    hook: "Stop writing boilerplates from scratch in 2026.",
                    body: "Use modular utility templates and custom wrappers. It saves our engineers 8 hours per week.",
                    cta: "What is your go-to optimization setup? 👇"
                },
                {
                    topic: "API Speed Win",
                    hook: "100ms API response latency can cost 1% in SaaS conversions.",
                    body: "Keep database queries flat, configure database indexing, and cache client-side calculations.",
                    cta: "Speed matters."
                }
            ],
            instagram: [
                {
                    topic: "Clean UI/UX Showcase",
                    hook: "Modern web architecture starts with a clean, functional workspace.",
                    body: "Minimal designs, glassmorphism accents, and micro-animations improve click-through rates by up to 25%. Our designers share the tools they used to construct this week's storefront dashboard update.",
                    cta: "Link in bio to view the case study."
                }
            ],
            blog: [
                {
                    topic: "How to Build a Client-Side PDF Compiler",
                    hook: "Serverless file manipulation is the future of secure document pipelines.",
                    body: "In this comprehensive guide, we demonstrate how to leverage JavaScript, pdf-lib, and client FileReader instances to merge PDFs directly inside the user's browser, eliminating hosting overheads.",
                    cta: "Read full guide on our engineering blog."
                }
            ]
        },
        realestate: {
            linkedin: [
                {
                    topic: "Commercial Real Estate ROI",
                    hook: "How to audit commercial property values in Nairobi's expanding business hubs.",
                    body: "Assessing office yields requires studying commuter accessibility and infrastructure developments (like the Expressway). We compiled pricing metrics showing a 9% return rate in Westlands compared to 7.2% in CBD.",
                    cta: "Download the full market research report here: [insert link]"
                }
            ],
            twitter: [
                {
                    topic: "Property Buying Tip",
                    hook: "First-time property buyers: never skip land registry search checks.",
                    body: "It takes 2 days at Ardhi House and prevents costly title ownership disputes down the line.",
                    cta: "Be secure."
                }
            ],
            instagram: [
                {
                    topic: "Modern Office Architectural Design",
                    hook: "Flooding workspaces with natural light increases tenant retention.",
                    body: "Take a tour through our newly completed mixed-use commercial space in Kilimani, Nairobi. Sleek open layouts, eco-friendly cooling, and smart security integrations.",
                    cta: "Link in bio for leasing options."
                }
            ],
            blog: [
                {
                    topic: "Nairobi Residential Housing Outlook 2026",
                    hook: "An analytical breakdown of rental yields across Nairobi suburbs.",
                    body: "We review the impact of infrastructure expansion on land value and apartment demand in Syokimau, Ruaka, and Kitengela.",
                    cta: "Read our comprehensive quarterly summary."
                }
            ]
        },
        ecommerce: {
            linkedin: [
                {
                    topic: "Reducing Checkout Cart Abandonment",
                    hook: "68% of e-commerce carts are abandoned at checkout. Here is how to recover them.",
                    body: "After analyzing client checkout flows, we noticed that multi-page registration forms were the primary culprit. By implementing a single-page checkout and caching shipping locations locally, conversions jumped by 14%.",
                    cta: "Ready to optimize your checkout? Connect with our team."
                }
            ],
            twitter: [
                {
                    topic: "Mobile Storefront Speed",
                    hook: "Is your online store loading in under 2 seconds on mobile data?",
                    body: "Compress product images using WebP format and defer secondary Javascript packages.",
                    cta: "Every millisecond counts."
                }
            ],
            instagram: [
                {
                    topic: "Product Customization Live Demo",
                    hook: "Custom colored presets let shoppers visualize items before buying.",
                    body: "Interactive product configurators decrease returns by 30%. Watch our latest UI demonstration showing live visual shifts.",
                    cta: "See custom shop demo in bio link."
                }
            ],
            blog: [
                {
                    topic: "Building Scalable Storefronts with Laravel & Stripe",
                    hook: "A developer guide to setting up high-performance regional e-commerce portals.",
                    body: "We review secure payment callback handling, database catalog queries indexing, and tax rules caching.",
                    cta: "Read full developer walkthrough."
                }
            ]
        },
        consulting: {
            linkedin: [
                {
                    topic: "Corporate Tax Strategy Audits",
                    hook: "Kenyan SMEs: Are you maximizing your legal corporate tax deductions?",
                    body: "With changing PAYE, NSSF, and health insurance bands, automated salary calculators prevent costly filing mistakes. Ensure your accounting systems are synchronized with the latest Finance Bill schedules.",
                    cta: "Check our free calculators hub."
                }
            ],
            twitter: [
                {
                    topic: "Business Growth Advice",
                    hook: "Stop trading hours for income. Productize your advisory solutions.",
                    body: "Package standard assessments or tools to generate consultative leads automatically.",
                    cta: "Build leverage."
                }
            ],
            instagram: [
                {
                    topic: "Consulting Roadmap Workshop",
                    hook: "Fostering client transparency builds multi-year service contracts.",
                    body: "We share our internal project alignment roadmap used to transition developers and stakeholders smoothly.",
                    cta: "Link in bio for workshop materials."
                }
            ],
            blog: [
                {
                    topic: "Financial Modeling: Estimating Break-Even and Target Yields",
                    hook: "A step-by-step guide to calculating contribution margins for product launches.",
                    body: "We review fixed expenses allocations, unit cost distributions, and target volume charting methods.",
                    cta: "Read full advisory brief."
                }
            ]
        },
        healthcare: {
            linkedin: [
                {
                    topic: "Workspace Ergonomics & Wellness",
                    hook: "Sedentary desks are decreasing employee health and productivity levels.",
                    body: "Sitting for over 6 hours a day reduces metabolic rates and triggers spinal strain. We designed a simple corporate micro-break routine to keep staff active and alert.",
                    cta: "Explore workplace wellness solutions."
                }
            ],
            twitter: [
                {
                    topic: "Daily Health Routine",
                    hook: "Hydration and walking 2,000 steps during work breaks is highly effective.",
                    body: "It reduces brain fatigue and optimizes cognitive output.",
                    cta: "Stay moving."
                }
            ],
            instagram: [
                {
                    topic: "Nutritional Planning Guides",
                    hook: "Meal planning reduces daily fatigue and decision burnout.",
                    body: "Review our balanced meal calendar templates tailored for busy professional schedules.",
                    cta: "Guides available via bio link."
                }
            ],
            blog: [
                {
                    topic: "Managing Digital Eye Strain in Tech Teams",
                    hook: "A wellness review of display configurations, lighting, and visual breaks.",
                    body: "We examine the effectiveness of the 20-20-20 rule and workspace lighting designs on eye strain.",
                    cta: "Read full analysis."
                }
            ]
        }
    };

    const daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

    function generateCalendar() {
        const ind = document.getElementById('industry').value;
        const dur = parseInt(document.getElementById('duration').value);
        
        // Get checked platforms
        const selectedPlatforms = [];
        document.querySelectorAll('.platform-check').forEach(chk => {
            if (chk.checked) selectedPlatforms.push(chk.value);
        });

        if (selectedPlatforms.length === 0) {
            if (window.showToast) {
                window.showToast('Please select at least one social media channel.', 'error');
            } else {
                alert('Please select at least one social media channel.');
            }
            return;
        }

        activeSchedule = [];
        board.innerHTML = '';

        const db = templates[ind] || templates['technology'];

        // Generate schedule
        let postCounter = 0;
        for (let week = 1; week <= dur; week++) {
            const weekCard = document.createElement('div');
            weekCard.className = 'card border-0 shadow-sm rounded-4 p-4 mb-3';
            
            const weekTitle = document.createElement('h5');
            weekTitle.className = 'fw-bold text-success mb-3 font-monospace border-bottom pb-2';
            weekTitle.innerText = `WEEK ${week} SCHEDULE`;
            weekCard.appendChild(weekTitle);

            const dayGrid = document.createElement('div');
            dayGrid.className = 'd-flex flex-column gap-3';

            daysOfWeek.forEach((day, dayIdx) => {
                // Select a platform round-robin
                const plat = selectedPlatforms[dayIdx % selectedPlatforms.length];
                const pool = db[plat] || db['linkedin'];
                
                // Get template item
                const itemTemplate = pool[postCounter % pool.length] || pool[0];

                const postObj = {
                    id: `post-${week}-${dayIdx}-${plat}`,
                    week: week,
                    day: day,
                    platform: plat,
                    topic: itemTemplate.topic,
                    hook: itemTemplate.hook,
                    body: itemTemplate.body,
                    cta: itemTemplate.cta,
                    status: 'Draft'
                };

                activeSchedule.push(postObj);

                // Render Day card
                const dayCard = document.createElement('div');
                dayCard.className = 'p-3 border rounded-3 bg-light d-flex flex-column justify-content-between';
                dayCard.id = `card-${postObj.id}`;

                let platBadgeClass = 'bg-primary';
                let platIcon = 'linkedin';
                if (plat === 'twitter') { platBadgeClass = 'bg-dark'; platIcon = 'twitter-x'; }
                if (plat === 'instagram') { platBadgeClass = 'bg-danger'; platIcon = 'instagram'; }
                if (plat === 'blog') { platBadgeClass = 'bg-success'; platIcon = 'file-text'; }

                dayCard.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold text-dark font-monospace small">${day}</span>
                            <span class="badge ${platBadgeClass} platform-badge"><i class="bi bi-${platIcon} me-1"></i>${plat}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-secondary text-uppercase cursor-pointer status-toggle-btn" data-id="${postObj.id}" id="status-badge-${postObj.id}" style="font-size: 0.65rem;">${postObj.status}</span>
                            <button class="btn btn-light btn-xs rounded-circle edit-post-btn" data-id="${postObj.id}">
                                <i class="bi bi-pencil-fill" style="font-size:0.75rem;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h6 class="fw-bold text-dark mb-1 small" id="topic-text-${postObj.id}">${postObj.topic}</h6>
                        <p class="small text-muted mb-2 font-italic" id="hook-text-${postObj.id}">"${postObj.hook}"</p>
                        <p class="small text-dark mb-2" id="body-text-${postObj.id}" style="white-space: pre-line;">${postObj.body}</p>
                        <div class="small fw-semibold text-primary" id="cta-text-${postObj.id}">CTA: ${postObj.cta}</div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-light btn-xs rounded-pill px-3 py-1 copy-post-btn text-muted fw-semibold" data-id="${postObj.id}">
                            <i class="bi bi-clipboard me-1"></i> Copy Content
                        </button>
                    </div>
                `;

                dayGrid.appendChild(dayCard);
                postCounter++;
            });

            weekCard.appendChild(dayGrid);
            board.appendChild(weekCard);
        }

        // Bind interactive event listeners inside board
        bindBoardEvents();
    }

    function bindBoardEvents() {
        // Edit button listener
        document.querySelectorAll('.edit-post-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const post = activeSchedule.find(p => p.id === id);
                if (post && editModal) {
                    activePostId = id;
                    modalTopic.value = post.topic;
                    modalHook.value = post.hook;
                    modalBody.value = post.body;
                    modalCta.value = post.cta;
                    editModal.show();
                }
            });
        });

        // Copy button listener
        document.querySelectorAll('.copy-post-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const post = activeSchedule.find(p => p.id === id);
                if (post) {
                    const fullText = `[${post.platform.toUpperCase()}] ${post.topic}\n\nHook:\n${post.hook}\n\nBody:\n${post.body}\n\nCTA: ${post.cta}`;
                    navigator.clipboard.writeText(fullText).then(() => {
                        const originalHtml = this.innerHTML;
                        this.innerHTML = '<i class="bi bi-check-lg text-success me-1"></i> Copied!';
                        setTimeout(() => {
                            this.innerHTML = originalHtml;
                        }, 2000);
                    });
                }
            });
        });

        // Status badge click to toggle
        document.querySelectorAll('.status-toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const post = activeSchedule.find(p => p.id === id);
                if (post) {
                    if (post.status === 'Draft') {
                        post.status = 'Approved';
                        this.className = 'badge bg-success text-uppercase cursor-pointer status-toggle-btn';
                    } else if (post.status === 'Approved') {
                        post.status = 'Scheduled';
                        this.className = 'badge bg-primary text-uppercase cursor-pointer status-toggle-btn';
                    } else {
                        post.status = 'Draft';
                        this.className = 'badge bg-secondary text-uppercase cursor-pointer status-toggle-btn';
                    }
                    this.innerText = post.status;
                }
            });
        });
    }

    // Save modal changes
    saveModalBtn.addEventListener('click', function() {
        if (activePostId) {
            const post = activeSchedule.find(p => p.id === activePostId);
            if (post) {
                post.topic = modalTopic.value;
                post.hook = modalHook.value;
                post.body = modalBody.value;
                post.cta = modalCta.value;

                // Update UI text
                document.getElementById(`topic-text-${activePostId}`).innerText = post.topic;
                document.getElementById(`hook-text-${activePostId}`).innerText = `"${post.hook}"`;
                document.getElementById(`body-text-${activePostId}`).innerText = post.body;
                document.getElementById(`cta-text-${activePostId}`).innerText = `CTA: ${post.cta}`;
            }
            if (editModal) {
                editModal.hide();
            }
        }
    });

    // Generate initially on load
    generateBtn.addEventListener('click', generateCalendar);
    generateCalendar();

    // Export CSV Schedule
    exportCsvBtn.addEventListener('click', function() {
        if (activeSchedule.length === 0) return;

        // Add UTF-8 BOM to ensure Excel opens special characters and formatting correctly
        let csvContent = "\uFEFF";
        csvContent += "Week,Day,Platform,Topic,Hook,Content Template,CTA,Status\n";

        activeSchedule.forEach(p => {
            // Helper to clean fields for CSV/Excel formatting
            const cleanField = (text) => {
                if (!text) return '""';
                // Double up double-quotes and replace line-breaks with space for clean Excel row formatting
                const escaped = text.toString().replace(/"/g, '""').replace(/\r?\n|\r/g, ' ');
                return `"${escaped}"`;
            };

            const row = [
                `"Week ${p.week}"`,
                `"${p.day}"`,
                `"${p.platform}"`,
                cleanField(p.topic),
                cleanField(p.hook),
                cleanField(p.body),
                cleanField(p.cta),
                `"${p.status}"`
            ].join(",");
            csvContent += row + "\n";
        });

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement("a");
        link.setAttribute("href", url);
        link.setAttribute("download", "marketing-content-calendar.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Clean up URL object after a safe delay to prevent filename fallback race conditions
        setTimeout(() => URL.revokeObjectURL(url), 15000);
    });
});
</script>
@endpush
