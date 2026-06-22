@extends('layouts.app')

@section('title', 'Free Modern CV Builder & Resume Maker | Waveron Technologies')
@section('meta_description', 'Create a professional, job-winning CV in minutes with Waveron Technologies\' free online CV builder. Choose themes, upload photo, add work history, and print/download A4 PDF.')

@section('content')
<div class="container-fluid py-4 no-print" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">CV Builder</li>
            </ol>
        </nav>
        
        <div class="row g-4">
            <!-- Left Side: CV Form Inputs -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h3 class="fw-bold mb-4 text-primary d-flex align-items-center">
                        <i class="bi bi-file-earmark-person me-2"></i> Professional CV Builder
                    </h3>

                    <!-- Color Accent Selection -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Select CV Accent Theme</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn active" data-color="#006400" style="width: 32px; height: 32px; background-color: #006400; border-color: #006400;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#1e3a8a" style="width: 32px; height: 32px; background-color: #1e3a8a; border-color: #1e3a8a;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#1f2937" style="width: 32px; height: 32px; background-color: #1f2937; border-color: #1f2937;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#7f1d1d" style="width: 32px; height: 32px; background-color: #7f1d1d; border-color: #7f1d1d;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#0d9488" style="width: 32px; height: 32px; background-color: #0d9488; border-color: #0d9488;"></button>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">1. Personal Information</h5>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Full Name</label>
                            <input type="text" id="full-name" class="form-control" value="Alex M. Njoroge" placeholder="e.g. Jane Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Professional Title</label>
                            <input type="text" id="prof-title" class="form-control" value="Senior Software Engineer" placeholder="e.g. Lead Designer">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" id="email" class="form-control" value="alex.njoroge@email.com" placeholder="e.g. jane@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Phone Number</label>
                            <input type="text" id="phone" class="form-control" value="+254 712 345678" placeholder="e.g. +254 700 000 000">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Location</label>
                            <input type="text" id="location" class="form-control" value="Nairobi, Kenya" placeholder="e.g. Nairobi, Kenya">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">LinkedIn URL</label>
                            <input type="text" id="linkedin" class="form-control" value="linkedin.com/in/alexnjoroge" placeholder="e.g. linkedin.com/in/username">
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold">Upload Profile Photo</label>
                            <input type="file" id="profile-photo" class="form-control" accept="image/*">
                            <div class="form-text small text-muted">Upload a professional headshot to display on the CV.</div>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold">Professional Summary</label>
                            <textarea id="summary" class="form-control" rows="3" placeholder="Brief statement summarizing your expertise...">Results-driven Software Engineer with 5+ years of experience building modern web architectures and APIs. Proven ability to lead cross-functional development sprints and deploy scalable cloud solutions.</textarea>
                        </div>
                    </div>

                    <!-- Work Experience -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h5 class="fw-semibold text-dark mb-0">2. Work Experience</h5>
                            <button type="button" id="add-experience-btn" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="bi bi-plus-lg me-1"></i> Add Position
                            </button>
                        </div>

                        <div id="experience-list" class="d-flex flex-column gap-3">
                            <!-- Dynamic positions will load here -->
                        </div>
                    </div>

                    <!-- Education -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h5 class="fw-semibold text-dark mb-0">3. Education</h5>
                            <button type="button" id="add-education-btn" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="bi bi-plus-lg me-1"></i> Add Education
                            </button>
                        </div>

                        <div id="education-list" class="d-flex flex-column gap-3">
                            <!-- Dynamic education items will load here -->
                        </div>
                    </div>

                    <!-- Skills & Languages -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">4. Skills & Languages</h5>
                        
                        <div class="col-12">
                            <label class="form-label small fw-bold">Key Skills (Comma-separated)</label>
                            <textarea id="skills" class="form-control" rows="2" placeholder="e.g. PHP, Laravel, React, Git, Project Management">Laravel, React, Node.js, Python, AWS, Docker, Git, RESTful APIs, Agile Methodologies</textarea>
                            <div class="form-text small text-muted">Separate each skill with a comma to generate skill badges.</div>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold">Languages (Comma-separated)</label>
                            <input type="text" id="languages" class="form-control" value="English (Fluent), Swahili (Native)" placeholder="e.g. English, French, Swahili">
                        </div>
                    </div>
                </div>

                <!-- Contextual Lead Capture CTA -->
                <div class="card border-0 rounded-4 p-4 text-center" style="background-color: rgba(21, 128, 61, 0.06); border: 1px solid rgba(21, 128, 61, 0.15) !important;">
                    <h5 class="fw-bold mb-2" style="color: #15803d;">Upgrade Your Tech Infrastructure</h5>
                    <p class="small mb-3" style="color: #4b5563;">Are you hiring tech talent or looking to streamline your engineering pipeline? Waveron builds custom enterprise recruitment tools and HR dashboards tailored for modern scale.</p>
                    <div>
                        <a href="{{ route('contact') }}" class="btn rounded-pill px-4 py-2 fw-semibold btn-sm shadow-sm text-white" style="background-color: #15803d; border: none;">
                            Consult Our Tech Experts <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Sticky Live Preview -->
            <div class="col-lg-6">
                <div class="preview-sticky">
                    <h5 class="text-muted small font-monospace mb-2"><i class="bi bi-eye"></i> LIVE PREVIEW</h5>

                    <!-- A4 Sheet Card -->
                    <div id="cv-preview" class="cv-paper shadow-sm bg-white p-4 p-md-5 rounded-4 border border-light" style="min-height: 297mm;">
                        <!-- CV Top Header Layout -->
                        <div class="row align-items-center border-bottom pb-4 mb-4">
                            <div class="col-md-8 d-flex align-items-center gap-3">
                                <!-- Profile Photo container -->
                                <div id="prev-photo-container" class="rounded-circle overflow-hidden d-none" style="width: 75px; height: 75px; flex-shrink: 0; border: 2px solid #006400;">
                                    <img id="prev-photo-img" src="" alt="Profile Headshot" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <!-- If no photo, standard initials placeholder -->
                                <div id="prev-initials-container" class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold fs-3" style="width: 75px; height: 75px; flex-shrink: 0; font-family: 'Inter', sans-serif;">
                                    AN
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0 text-theme" id="prev-full-name" style="color: #006400;">Alex M. Njoroge</h3>
                                    <h6 class="text-muted fw-semibold mb-0" id="prev-prof-title">Senior Software Engineer</h6>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0 small font-monospace text-muted">
                                <div class="mb-1"><i class="bi bi-envelope me-1"></i> <span id="prev-email">alex.njoroge@email.com</span></div>
                                <div class="mb-1"><i class="bi bi-telephone me-1"></i> <span id="prev-phone">+254 712 345678</span></div>
                                <div class="mb-1"><i class="bi bi-geo-alt me-1"></i> <span id="prev-location">Nairobi, Kenya</span></div>
                                <div><i class="bi bi-linkedin me-1"></i> <span id="prev-linkedin">linkedin.com/in/alexnjoroge</span></div>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="mb-4">
                            <h5 class="fw-bold border-bottom pb-1 text-theme mb-2" style="color: #006400; border-bottom-color: rgba(0,100,0,0.1) !important;">PROFESSIONAL SUMMARY</h5>
                            <p class="text-muted small" id="prev-summary" style="line-height: 1.5;">Results-driven Software Engineer with 5+ years of experience building modern web architectures and APIs. Proven ability to lead cross-functional development sprints and deploy scalable cloud solutions.</p>
                        </div>

                        <!-- Work History -->
                        <div class="mb-4">
                            <h5 class="fw-bold border-bottom pb-1 text-theme mb-2" style="color: #006400; border-bottom-color: rgba(0,100,0,0.1) !important;">WORK EXPERIENCE</h5>
                            <div id="prev-experience-list" class="d-flex flex-column gap-3">
                                <!-- Dynamic experiences load here -->
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="mb-4">
                            <h5 class="fw-bold border-bottom pb-1 text-theme mb-2" style="color: #006400; border-bottom-color: rgba(0,100,0,0.1) !important;">EDUCATION</h5>
                            <div id="prev-education-list" class="d-flex flex-column gap-2">
                                <!-- Dynamic education loads here -->
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="mb-4">
                            <h5 class="fw-bold border-bottom pb-1 text-theme mb-2" style="color: #006400; border-bottom-color: rgba(0,100,0,0.1) !important;">KEY SKILLS</h5>
                            <div id="prev-skills" class="d-flex flex-wrap gap-1.5 pt-1">
                                <!-- Dynamic badges -->
                            </div>
                        </div>

                        <!-- Languages -->
                        <div>
                            <h5 class="fw-bold border-bottom pb-1 text-theme mb-2" style="color: #006400; border-bottom-color: rgba(0,100,0,0.1) !important;">LANGUAGES</h5>
                            <p class="text-muted small mb-0" id="prev-languages">English (Fluent), Swahili (Native)</p>
                        </div>

                        <!-- Watermark -->
                        <div class="pt-3 border-top text-center watermark-print mt-5" style="border-top: 1px dashed #e5e7eb !important;">
                            <span class="text-muted small" style="font-size: 0.7rem; font-family: monospace;">Generated by <a href="https://waverontechnologies.co.ke/tools" target="_blank" style="text-decoration: none; color: #15803d; font-weight: bold;">waverontechnologies.co.ke/tools</a></span>
                        </div>
                    </div>

                    <!-- Print CTA Button -->
                    <button id="print-cv-btn" class="btn btn-success w-100 rounded-pill py-2.5 fw-semibold shadow-sm mt-4">
                        <i class="bi bi-printer me-2"></i> Print / Save CV
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print-Only Page Wrapper -->
<div id="print-cv-sheet" class="print-only"></div>
@endsection

@push('styles')
<style>
    .preview-sticky {
        position: sticky;
        top: 96px;
    }

    .cv-paper {
        font-family: 'Inter', sans-serif;
    }

    .text-theme {
        transition: color 0.2s ease;
    }

    @page {
        size: auto;
        margin: 12mm;
    }

    /* Print media styling */
    @media print {
        body {
            background-color: white !important;
            color: black !important;
            font-size: 10.5pt !important;
            margin: 0 !important;
            padding: 0 !important;
            padding-bottom: 20mm !important;
            width: 100% !important;
            max-width: 100% !important;
            zoom: 1 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .no-print, header, footer, .navbar, .navbar-spacer, #navbarNav, .navbar-toggler, .tools-hero, .btn, .card, .AI-widget, #AI-chatbot-widget {
            display: none !important;
        }
        .print-only {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .cv-paper {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            page-break-inside: avoid;
            break-inside: avoid;
        }
        .watermark-print {
            position: fixed !important;
            bottom: 12mm !important;
            left: 12mm !important;
            right: 12mm !important;
            border-top: 1px dashed #e5e7eb !important;
            background-color: white !important;
            padding-top: 8px !important;
            text-align: center !important;
            z-index: 9999 !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let activeThemeColor = '#006400';
    let workExperiences = [
        {
            id: 1,
            title: 'Senior Software Developer',
            company: 'Vanguard Systems',
            dates: '2022 - Present',
            description: 'Lead engineer for microservice APIs and enterprise database models. Reduced deployment pipeline times by 35%.'
        },
        {
            id: 2,
            title: 'Full Stack Engineer',
            company: 'Pinnacle Softlabs',
            dates: '2020 - 2022',
            description: 'Developed SaaS dashboards using React and Laravel. Optimized query indexes to handle high concurrent writes.'
        }
    ];

    let educationItems = [
        {
            id: 1,
            degree: 'B.Sc. in Computer Science',
            school: 'University of Nairobi',
            dates: '2016 - 2020'
        }
    ];

    // Read elements
    const fullNameInput = document.getElementById('full-name');
    const profTitleInput = document.getElementById('prof-title');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const locationInput = document.getElementById('location');
    const linkedinInput = document.getElementById('linkedin');
    const summaryInput = document.getElementById('summary');
    const skillsInput = document.getElementById('skills');
    const languagesInput = document.getElementById('languages');
    const photoInput = document.getElementById('profile-photo');

    // Theme selector
    document.querySelectorAll('.theme-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.theme-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeThemeColor = this.getAttribute('data-color');
            updateThemeStyles();
        });
    });

    function updateThemeStyles() {
        document.querySelectorAll('.text-theme').forEach(el => {
            el.style.color = activeThemeColor;
        });
        const photoContainer = document.getElementById('prev-photo-container');
        if (photoContainer) {
            photoContainer.style.borderColor = activeThemeColor;
        }
    }

    // Photo upload handling
    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                document.getElementById('prev-photo-img').src = evt.target.result;
                document.getElementById('prev-photo-container').classList.remove('d-none');
                document.getElementById('prev-initials-container').classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    });

    // Experience Management
    function renderExperienceForm() {
        const list = document.getElementById('experience-list');
        list.innerHTML = '';
        workExperiences.forEach(exp => {
            const container = document.createElement('div');
            container.className = 'border p-3 rounded-3 position-relative';
            container.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-exp" data-id="${exp.id}"></button>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Job Title</label>
                        <input type="text" class="form-control form-control-sm exp-title" data-id="${exp.id}" value="${exp.title}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Company / Employer</label>
                        <input type="text" class="form-control form-control-sm exp-company" data-id="${exp.id}" value="${exp.company}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small fw-bold">Employment Dates</label>
                        <input type="text" class="form-control form-control-sm exp-dates" data-id="${exp.id}" value="${exp.dates}" placeholder="e.g. 2021 - Present">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Responsibilities / Achievements</label>
                        <textarea class="form-control form-control-sm exp-desc" data-id="${exp.id}" rows="2">${exp.description}</textarea>
                    </div>
                </div>
            `;
            list.appendChild(container);
        });

        // Add event listeners
        document.querySelectorAll('.remove-exp').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.getAttribute('data-id'));
                workExperiences = workExperiences.filter(x => x.id !== id);
                renderExperienceForm();
                updateLivePreview();
            });
        });

        document.querySelectorAll('.exp-title').forEach(input => {
            input.addEventListener('input', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const item = workExperiences.find(x => x.id === id);
                if (item) item.title = this.value;
                updateLivePreview();
            });
        });

        document.querySelectorAll('.exp-company').forEach(input => {
            input.addEventListener('input', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const item = workExperiences.find(x => x.id === id);
                if (item) item.company = this.value;
                updateLivePreview();
            });
        });

        document.querySelectorAll('.exp-dates').forEach(input => {
            input.addEventListener('input', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const item = workExperiences.find(x => x.id === id);
                if (item) item.dates = this.value;
                updateLivePreview();
            });
        });

        document.querySelectorAll('.exp-desc').forEach(input => {
            input.addEventListener('input', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const item = workExperiences.find(x => x.id === id);
                if (item) item.description = this.value;
                updateLivePreview();
            });
        });
    }

    // Education Management
    function renderEducationForm() {
        const list = document.getElementById('education-list');
        list.innerHTML = '';
        educationItems.forEach(edu => {
            const container = document.createElement('div');
            container.className = 'border p-3 rounded-3 position-relative';
            container.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-edu" data-id="${edu.id}"></button>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Degree / Certification</label>
                        <input type="text" class="form-control form-control-sm edu-degree" data-id="${edu.id}" value="${edu.degree}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">School / University</label>
                        <input type="text" class="form-control form-control-sm edu-school" data-id="${edu.id}" value="${edu.school}">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Dates attended</label>
                        <input type="text" class="form-control form-control-sm edu-dates" data-id="${edu.id}" value="${edu.dates}" placeholder="e.g. 2016 - 2020">
                    </div>
                </div>
            `;
            list.appendChild(container);
        });

        // Add event listeners
        document.querySelectorAll('.remove-edu').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.getAttribute('data-id'));
                educationItems = educationItems.filter(x => x.id !== id);
                renderEducationForm();
                updateLivePreview();
            });
        });

        document.querySelectorAll('.edu-degree').forEach(input => {
            input.addEventListener('input', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const item = educationItems.find(x => x.id === id);
                if (item) item.degree = this.value;
                updateLivePreview();
            });
        });

        document.querySelectorAll('.edu-school').forEach(input => {
            input.addEventListener('input', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const item = educationItems.find(x => x.id === id);
                if (item) item.school = this.value;
                updateLivePreview();
            });
        });

        document.querySelectorAll('.edu-dates').forEach(input => {
            input.addEventListener('input', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const item = educationItems.find(x => x.id === id);
                if (item) item.dates = this.value;
                updateLivePreview();
            });
        });
    }

    // Add buttons
    document.getElementById('add-experience-btn').addEventListener('click', function() {
        const nextId = workExperiences.length ? Math.max(...workExperiences.map(x => x.id)) + 1 : 1;
        workExperiences.push({
            id: nextId,
            title: '',
            company: '',
            dates: '',
            description: ''
        });
        renderExperienceForm();
        updateLivePreview();
    });

    document.getElementById('add-education-btn').addEventListener('click', function() {
        const nextId = educationItems.length ? Math.max(...educationItems.map(x => x.id)) + 1 : 1;
        educationItems.push({
            id: nextId,
            degree: '',
            school: '',
            dates: ''
        });
        renderEducationForm();
        updateLivePreview();
    });

    // Update Initials
    function updateInitials(name) {
        if (!name) return 'CV';
        const parts = name.trim().split(' ');
        if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
        return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
    }

    // Live update function
    function updateLivePreview() {
        // Personal info
        document.getElementById('prev-full-name').innerText = fullNameInput.value || 'Your Full Name';
        document.getElementById('prev-prof-title').innerText = profTitleInput.value || 'Professional Title';
        document.getElementById('prev-email').innerText = emailInput.value || 'email@example.com';
        document.getElementById('prev-phone').innerText = phoneInput.value || '+254 700 000000';
        document.getElementById('prev-location').innerText = locationInput.value || 'Nairobi, Kenya';
        document.getElementById('prev-linkedin').innerText = linkedinInput.value || 'linkedin.com/in/username';
        document.getElementById('prev-summary').innerText = summaryInput.value || 'Professional Summary details...';
        
        // Initials fallback
        document.getElementById('prev-initials-container').innerText = updateInitials(fullNameInput.value);

        // Experience list
        const expPreview = document.getElementById('prev-experience-list');
        expPreview.innerHTML = '';
        if (workExperiences.length === 0) {
            expPreview.innerHTML = '<div class="text-muted small">No work experience listed yet.</div>';
        } else {
            workExperiences.forEach(exp => {
                const block = document.createElement('div');
                block.className = 'mb-1';
                block.innerHTML = `
                    <div class="d-flex justify-content-between flex-wrap">
                        <strong class="text-dark small">${exp.title || 'Job Title'}</strong>
                        <span class="text-muted small font-monospace">${exp.dates || 'Dates'}</span>
                    </div>
                    <div class="text-muted small fw-medium mb-1">${exp.company || 'Company Name'}</div>
                    <p class="text-muted small mb-0" style="line-height: 1.4;">${exp.description || 'Position details and achievements.'}</p>
                `;
                expPreview.appendChild(block);
            });
        }

        // Education list
        const eduPreview = document.getElementById('prev-education-list');
        eduPreview.innerHTML = '';
        if (educationItems.length === 0) {
            eduPreview.innerHTML = '<div class="text-muted small">No education details listed yet.</div>';
        } else {
            educationItems.forEach(edu => {
                const block = document.createElement('div');
                block.className = 'mb-1';
                block.innerHTML = `
                    <div class="d-flex justify-content-between flex-wrap">
                        <strong class="text-dark small">${edu.degree || 'Degree/Certificate'}</strong>
                        <span class="text-muted small font-monospace">${edu.dates || 'Dates'}</span>
                    </div>
                    <div class="text-muted small">${edu.school || 'School/Institution'}</div>
                `;
                eduPreview.appendChild(block);
            });
        }

        // Skills Badges
        const skillsContainer = document.getElementById('prev-skills');
        skillsContainer.innerHTML = '';
        const skillsList = skillsInput.value.split(',').map(s => s.trim()).filter(s => s.length > 0);
        if (skillsList.length === 0) {
            skillsContainer.innerHTML = '<div class="text-muted small">No skills listed yet.</div>';
        } else {
            skillsList.forEach(skill => {
                const badge = document.createElement('span');
                badge.className = 'badge bg-light text-dark border px-2.5 py-1.5 font-monospace';
                badge.style.fontSize = '0.7rem';
                badge.innerText = skill;
                skillsContainer.appendChild(badge);
            });
        }

        // Languages
        document.getElementById('prev-languages').innerText = languagesInput.value || 'Languages';

        // Reapply selected color theme
        updateThemeStyles();
    }

    // Input listeners
    fullNameInput.addEventListener('input', updateLivePreview);
    profTitleInput.addEventListener('input', updateLivePreview);
    emailInput.addEventListener('input', updateLivePreview);
    phoneInput.addEventListener('input', updateLivePreview);
    locationInput.addEventListener('input', updateLivePreview);
    linkedinInput.addEventListener('input', updateLivePreview);
    summaryInput.addEventListener('input', updateLivePreview);
    skillsInput.addEventListener('input', updateLivePreview);
    languagesInput.addEventListener('input', updateLivePreview);

    // Initial setup
    renderExperienceForm();
    renderEducationForm();
    updateLivePreview();

    // Print logic
    document.getElementById('print-cv-btn').addEventListener('click', function() {
        const printSheet = document.getElementById('print-cv-sheet');
        printSheet.innerHTML = document.getElementById('cv-preview').outerHTML;
        window.print();
    });
});
</script>
@endpush
