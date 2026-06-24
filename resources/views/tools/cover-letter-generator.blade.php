@extends('layouts.app')

@section('title', 'AI Cover Letter Generator | Waveron Technologies')
@section('meta_description', 'Generate a tailored, professional cover letter instantly. Choose templates, select tones (professional, enthusiastic, creative), edit content in real-time, and download or print A4 PDF.')

@section('content')
<div class="container-fluid py-4 no-print" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">Cover Letter Generator</li>
            </ol>
        </nav>
        
        <div class="row g-4">
            <!-- Left Side: Cover Letter Form Inputs -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h3 class="fw-bold mb-4 text-primary d-flex align-items-center">
                        <i class="bi bi-envelope-paper me-2"></i> Cover Letter Generator
                    </h3>

                    <!-- Color Accent Selection -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Select Letterhead Accent Theme</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn active" data-color="#006400" style="width: 32px; height: 32px; background-color: #006400; border-color: #006400;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#1e3a8a" style="width: 32px; height: 32px; background-color: #1e3a8a; border-color: #1e3a8a;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#1f2937" style="width: 32px; height: 32px; background-color: #1f2937; border-color: #1f2937;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#7f1d1d" style="width: 32px; height: 32px; background-color: #7f1d1d; border-color: #7f1d1d;"></button>
                            <button type="button" class="btn btn-outline-dark rounded-circle theme-btn" data-color="#0d9488" style="width: 32px; height: 32px; background-color: #0d9488; border-color: #0d9488;"></button>
                        </div>
                    </div>

                    <!-- Applicant details -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">1. Your Details (Sender)</h5>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Your Full Name</label>
                            <input type="text" id="sender-name" class="form-control" value="Michael K. Kamau" placeholder="e.g. Jane Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Professional Title</label>
                            <input type="text" id="sender-title" class="form-control" value="Senior Systems Engineer" placeholder="e.g. Graphic Designer">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" id="sender-email" class="form-control" value="michael.kamau@email.com" placeholder="e.g. jane@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Phone Number</label>
                            <input type="text" id="sender-phone" class="form-control" value="+254 722 111 222" placeholder="e.g. +254 700 000 000">
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold">Your Physical Address</label>
                            <input type="text" id="sender-address" class="form-control" value="P.O. Box 100-00100, Nairobi, Kenya" placeholder="e.g. Nairobi, Kenya">
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold">Upload Letterhead Logo</label>
                            <input type="file" id="sender-logo" class="form-control" accept="image/*">
                            <div class="form-text small text-muted">Upload a company or personal logo for the top header.</div>
                        </div>
                    </div>

                    <!-- Recipient Details -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">2. Recipient Details (Hiring Manager)</h5>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Hiring Manager / Recipient Name</label>
                            <input type="text" id="recipient-name" class="form-control" value="Head of Talent Acquisition" placeholder="e.g. John Smith">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Company Name</label>
                            <input type="text" id="recipient-company" class="form-control" value="Innova Solutions Ltd" placeholder="e.g. Innova Solutions Ltd">
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold">Company Address</label>
                            <input type="text" id="recipient-address" class="form-control" value="Delta Corner Towers, Westlands, Nairobi" placeholder="e.g. Westlands, Nairobi">
                        </div>
                    </div>

                    <!-- Job context and tone -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">3. Job Context & Tone</h5>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Target Job Title</label>
                            <input type="text" id="job-title" class="form-control" value="Cloud Infrastructure Lead" placeholder="e.g. DevOps Engineer">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Years of Experience</label>
                            <input type="number" id="experience-years" class="form-control" value="6" min="0" placeholder="e.g. 5">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Key Skills / Focus Areas (Comma-separated)</label>
                            <input type="text" id="key-skills" class="form-control" value="Kubernetes containerization, AWS Cloud optimization, Team leadership" placeholder="e.g. React development, UI design, Git">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Select Draft Tone</label>
                            <select id="letter-tone" class="form-select">
                                <option value="professional">Professional / Corporate</option>
                                <option value="enthusiastic">Enthusiastic / Energetic</option>
                                <option value="creative">Creative / Modern</option>
                            </select>
                        </div>

                        <div class="col-md-6 d-flex align-items-end">
                            <button type="button" id="generate-letter-btn" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-semibold">
                                <i class="bi bi-cpu me-1"></i> Re-Synthesize Draft
                            </button>
                        </div>
                    </div>

                    <!-- Letter Body Editor -->
                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">4. Edit Letter Text</h5>
                        <textarea id="letter-body" class="form-control" rows="8" placeholder="Edit the body text of your cover letter here..."></textarea>
                        <div class="form-text small text-muted">You can edit this generated text directly; it will sync instantly to the preview card on the right.</div>
                    </div>
                </div>

                <!-- Contextual Lead Capture CTA -->
                <div class="card border-0 rounded-4 p-4 text-center" style="background-color: rgba(21, 128, 61, 0.06); border: 1px solid rgba(21, 128, 61, 0.15) !important;">
                    <h5 class="fw-bold mb-2" style="color: #15803d;">Upgrade Your Enterprise Tech</h5>
                    <p class="small mb-3" style="color: #4b5563;">Looking to streamline your operations with cloud, database, or API integrations? Waveron builds custom corporate workflows, CRM, and ERP suites to empower local teams.</p>
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
                    <div id="cover-letter-preview" class="invoice-paper shadow-sm bg-white p-4 p-md-5 rounded-4 border border-light" style="min-height: 297mm; font-family: 'Inter', sans-serif;">
                        <!-- Letterhead Top Bar -->
                        <div class="d-flex justify-content-between border-bottom pb-4 mb-4 align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <!-- Uploaded Logo -->
                                <div id="prev-logo-container" class="d-none" style="max-width: 220px; max-height: 100px; overflow: hidden;">
                                    <img id="prev-logo-img" src="" alt="Letterhead Logo" style="max-height: 80px; max-width: 220px; object-fit: contain;">
                                </div>
                                <div id="prev-initials-container" class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold fs-3 text-theme" style="width: 60px; height: 60px; color: #006400;">
                                    MK
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 text-theme" id="prev-sender-name" style="color: #006400;">Michael K. Kamau</h4>
                                    <div class="text-muted small" id="prev-sender-title">Senior Systems Engineer</div>
                                </div>
                            </div>
                            <div class="text-end small text-muted font-monospace" style="max-width: 45%; word-break: break-all;">
                                <div id="prev-sender-email">michael.kamau@email.com</div>
                                <div id="prev-sender-phone">+254 722 111 222</div>
                                <div id="prev-sender-address">P.O. Box 100-00100, Nairobi, Kenya</div>
                            </div>
                        </div>

                        <!-- Date and Recipient Info -->
                        <div class="mb-4 small text-muted">
                            <div class="mb-3 text-dark fw-semibold" id="prev-letter-date">June 22, 2026</div>
                            <div class="text-dark fw-bold" id="prev-recipient-name">Head of Talent Acquisition</div>
                            <div class="fw-medium text-dark" id="prev-recipient-company">Innova Solutions Ltd</div>
                            <div id="prev-recipient-address">Delta Corner Towers, Westlands, Nairobi</div>
                        </div>

                        <!-- Subject Line -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark text-uppercase" id="prev-subject-line">RE: APPLICATION FOR CLOUD INFRASTRUCTURE LEAD</h6>
                        </div>

                        <!-- Letter Body -->
                        <div class="mb-4 text-muted small" id="prev-letter-body" style="white-space: pre-line; line-height: 1.6;">
                            Dear Head of Talent Acquisition,

                            I am writing to express my strong interest in the Cloud Infrastructure Lead position at Innova Solutions Ltd...
                        </div>

                        <!-- Signature -->
                        <div class="mt-4 small">
                            <div class="text-muted">Sincerely,</div>
                            <div class="fw-bold text-dark mt-3" id="prev-sender-name-sig">Michael K. Kamau</div>
                        </div>

                        <!-- Watermark -->
                        <div class="pt-3 border-top text-end watermark-print mt-5" style="border-top: 1px dashed #e5e7eb !important;">
                            <span class="text-muted small" style="font-size: 0.7rem; font-family: monospace;">Generated by <a href="https://waverontechnologies.co.ke/tools" target="_blank" style="text-decoration: none; color: #15803d; font-weight: bold;">waverontechnologies.co.ke/tools</a></span>
                        </div>
                    </div>

                    <!-- Print CTA Button -->
                    <button id="print-letter-btn" class="btn btn-success w-100 rounded-pill py-2.5 fw-semibold shadow-sm mt-4">
                        <i class="bi bi-printer me-2"></i> Print / Save Letter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print-Only Page Wrapper -->
<div id="print-letter-sheet" class="print-only"></div>
@endsection

@push('styles')
<style>
    .preview-sticky {
        position: sticky;
        top: 96px;
    }

    .invoice-paper {
        position: relative !important;
        padding-bottom: 60px !important;
    }

    .invoice-paper .watermark-print {
        position: absolute !important;
        bottom: 20px !important;
        left: 48px !important;
        right: 48px !important;
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
        .invoice-paper {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            page-break-inside: avoid;
            break-inside: avoid;
            min-height: 0 !important;
            padding-bottom: 0 !important;
        }
        .watermark-print {
            position: fixed !important;
            bottom: 12mm !important;
            left: 12mm !important;
            right: 12mm !important;
            border-top: 1px dashed #e5e7eb !important;
            background-color: white !important;
            padding-top: 8px !important;
            text-align: right !important;
            z-index: 9999 !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let activeThemeColor = '#006400';

    const senderName = document.getElementById('sender-name');
    const senderTitle = document.getElementById('sender-title');
    const senderEmail = document.getElementById('sender-email');
    const senderPhone = document.getElementById('sender-phone');
    const senderAddress = document.getElementById('sender-address');
    const senderLogo = document.getElementById('sender-logo');

    const recipientName = document.getElementById('recipient-name');
    const recipientCompany = document.getElementById('recipient-company');
    const recipientAddress = document.getElementById('recipient-address');

    const jobTitle = document.getElementById('job-title');
    const experienceYears = document.getElementById('experience-years');
    const keySkills = document.getElementById('key-skills');
    const letterTone = document.getElementById('letter-tone');

    const letterBody = document.getElementById('letter-body');

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
    }

    // Logo upload
    senderLogo.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                document.getElementById('prev-logo-img').src = evt.target.result;
                document.getElementById('prev-logo-container').classList.remove('d-none');
                document.getElementById('prev-initials-container').classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    });

    // Date pre-fill
    const today = new Date();
    const formattedDate = today.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    document.getElementById('prev-letter-date').innerText = formattedDate;

    // Generate letter formula
    function generateDraft() {
        const name = senderName.value || 'Michael K. Kamau';
        const title = jobTitle.value || 'Cloud Infrastructure Lead';
        const company = recipientCompany.value || 'Innova Solutions Ltd';
        const years = experienceYears.value || '6';
        const mgr = recipientName.value || 'Head of Talent Acquisition';
        
        const skillsArr = keySkills.value.split(',').map(s => s.trim()).filter(s => s.length > 0);
        const skill1 = skillsArr[0] || 'Kubernetes containerization';
        const skill2 = skillsArr[1] || 'AWS Cloud optimization';
        const skill3 = skillsArr[2] || 'Team leadership';

        let text = '';
        
        if (letterTone.value === 'professional') {
            text = `Dear ${mgr},\n\nI am writing to express my strong interest in the ${title} position at ${company}. With over ${years} years of professional experience, I have built a solid foundation in ${skill1} and ${skill2}, which directly align with the requirements of this role.\n\nThroughout my career, I have focused on optimizing architectures and leading projects to success. Specifically, I have achieved notable results in ${skill3}, enabling teams to improve operational output and scale platforms. I am eager to apply my technical and organizational capabilities to Innova Solutions Ltd.\n\nThank you for your time and consideration of my application. I look forward to the possibility of discussing how my experience can benefit ${company}.\n\nSincerely,\n\n${name}`;
        } else if (letterTone.value === 'enthusiastic') {
            text = `Dear ${mgr},\n\nI was incredibly excited to see the opening for the ${title} role at ${company}! I have long admired ${company}'s commitment to technological excellence, and I would love to contribute my passion and expertise to your team.\n\nOver the last ${years} years, I have dedicated myself to mastering ${skill1} and ${skill2}. In my previous roles, I leveraged ${skill3} to build high-performance products and foster a collaborative team environment. I am highly motivated to bring this same energy and standard of work to your projects.\n\nThank you so much for reading my application. I hope we can connect soon to discuss how I can help ${company} achieve its technical goals!\n\nWarm regards,\n\n${name}`;
        } else {
            text = `Dear ${mgr},\n\nInnovative teams require engineers who look at complex problems through a creative lens. This is why I am eager to apply for the ${title} position at ${company}.\n\nMy ${years}-year background is defined by bridging standard development methodologies with creative optimizations. I specialize in ${skill1} and have successfully resolved complex architecture blocks using ${skill2}. Furthermore, my experience in ${skill3} has allowed me to design cohesive, robust solutions that align with business scale.\n\nI welcome the opportunity to discuss how my creative approach to engineering can support ${company}'s roadmap. Thank you for your time.\n\nBest regards,\n\n${name}`;
        }

        letterBody.value = text;
        syncBodyText();
    }

    function syncBodyText() {
        document.getElementById('prev-letter-body').innerText = letterBody.value;
    }

    function updateLivePreview() {
        document.getElementById('prev-sender-name').innerText = senderName.value || 'Your Full Name';
        document.getElementById('prev-sender-name-sig').innerText = senderName.value || 'Your Full Name';
        document.getElementById('prev-sender-title').innerText = senderTitle.value || 'Professional Title';
        document.getElementById('prev-sender-email').innerText = senderEmail.value || 'email@example.com';
        document.getElementById('prev-sender-phone').innerText = senderPhone.value || '+254 700 000000';
        document.getElementById('prev-sender-address').innerText = senderAddress.value || 'Address Details';

        document.getElementById('prev-recipient-name').innerText = recipientName.value || 'Recipient Name';
        document.getElementById('prev-recipient-company').innerText = recipientCompany.value || 'Company Name';
        document.getElementById('prev-recipient-address').innerText = recipientAddress.value || 'Company Address';

        document.getElementById('prev-subject-line').innerText = `RE: APPLICATION FOR ${jobTitle.value.toUpperCase() || 'POSITION'}`;

        // Initials fallback
        const nameParts = senderName.value.trim().split(' ');
        let initials = 'CL';
        if (nameParts.length === 1 && nameParts[0].length > 0) initials = nameParts[0].substring(0, 2).toUpperCase();
        else if (nameParts.length > 1) initials = (nameParts[0][0] + nameParts[nameParts.length - 1][0]).toUpperCase();
        document.getElementById('prev-initials-container').innerText = initials;

        updateThemeStyles();
    }

    // Input listeners
    senderName.addEventListener('input', updateLivePreview);
    senderTitle.addEventListener('input', updateLivePreview);
    senderEmail.addEventListener('input', updateLivePreview);
    senderPhone.addEventListener('input', updateLivePreview);
    senderAddress.addEventListener('input', updateLivePreview);
    recipientName.addEventListener('input', updateLivePreview);
    recipientCompany.addEventListener('input', updateLivePreview);
    recipientAddress.addEventListener('input', updateLivePreview);
    jobTitle.addEventListener('input', updateLivePreview);

    letterBody.addEventListener('input', syncBodyText);
    document.getElementById('generate-letter-btn').addEventListener('click', generateDraft);

    // Initial setup
    generateDraft();
    updateLivePreview();

    // Print logic
    document.getElementById('print-letter-btn').addEventListener('click', function() {
        const printSheet = document.getElementById('print-letter-sheet');
        printSheet.innerHTML = document.getElementById('cover-letter-preview').outerHTML;
        window.print();
    });
});
</script>
@endpush
