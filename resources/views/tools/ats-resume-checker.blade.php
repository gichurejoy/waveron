@extends('layouts.app')

@section('title', 'ATS Resume Checker & Matcher | Waveron Technologies')
@section('meta_description', 'Check your resume compatibility against job descriptions in seconds. Get match scores, identify missing keywords, and verify formatting for applicant tracking systems.')

@section('content')
<div class="container-fluid py-4" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">ATS Resume Checker</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Left Column: Inputs Form -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h3 class="fw-bold mb-4 text-primary d-flex align-items-center">
                        <i class="bi bi-file-earmark-check me-2"></i> ATS Resume Matcher
                    </h3>

                    <!-- Job Title -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Target Job Title</label>
                        <input type="text" id="target-title" class="form-control" placeholder="e.g. Senior Software Engineer" value="Software Engineer">
                    </div>

                    <!-- Resume Paste Text -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Paste Your Resume Text</label>
                        <textarea id="resume-text" class="form-control font-monospace small" rows="8" placeholder="Paste all the text from your PDF or Word resume here...">Alex M. Njoroge
alex.njoroge@email.com | +254 712 345678 | linkedin.com/in/alexnjoroge

PROFESSIONAL SUMMARY
Results-driven Software Engineer with 5+ years of experience building modern web architectures and APIs using PHP, Laravel, and Python.

WORK EXPERIENCE
Senior Developer | Vanguard Systems | 2022 - Present
- Lead development of scalable web REST APIs.
- Integrated PostgreSQL databases and AWS S3 storage.

EDUCATION
B.Sc. Computer Science | University of Nairobi | 2020</textarea>
                    </div>

                    <!-- Job Description Paste Text -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Paste Job Description</label>
                        <textarea id="job-desc-text" class="form-control font-monospace small" rows="8" placeholder="Paste the job requirements and description here...">We are looking for a Software Engineer to join our growing tech team. 

Key Responsibilities:
- Design and maintain backend applications in PHP, Laravel, or Node.js.
- Build clean RESTful APIs and integrate cloud databases.
- Work closely with AWS infrastructure and Docker containers.
- Write robust unit tests to ensure high code quality.

Requirements:
- Bachelor's degree in Computer Science or related field.
- Experience with Git version control, SQL, and database indexing.</textarea>
                    </div>

                    <button id="analyze-btn" class="btn btn-primary w-100 rounded-pill py-2.5 fw-semibold shadow-sm">
                        <i class="bi bi-cpu me-1"></i> Scan Resume Compatibility
                    </button>
                </div>
            </div>

            <!-- Right Column: Dashboard Results -->
            <div class="col-lg-6">
                <div class="preview-sticky" id="analysis-results-container">
                    
                    <!-- Scoring Summary Card -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="text-muted small font-monospace mb-4"><i class="bi bi-speedometer2"></i> COMPATIBILITY SCORE</h5>
                        
                        <div class="row align-items-center">
                            <!-- Circular Gauge -->
                            <div class="col-sm-5 text-center mb-3 mb-sm-0">
                                <div class="position-relative d-inline-block" style="width: 140px; height: 140px;">
                                    <svg width="140" height="140" class="rotate-n90">
                                        <!-- Background Circle -->
                                        <circle cx="70" cy="70" r="60" fill="none" stroke="#e5e7eb" stroke-width="12"></circle>
                                        <!-- Foreground Circle -->
                                        <circle cx="70" cy="70" r="60" fill="none" stroke="#15803d" stroke-width="12"
                                                stroke-dasharray="377" stroke-dashoffset="377" id="score-circle"
                                                stroke-linecap="round" style="transition: stroke-dashoffset 1s ease-out;"></circle>
                                    </svg>
                                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                                        <span class="fs-1 fw-bold text-dark" id="prev-score">0%</span>
                                        <div class="small text-muted font-monospace" style="font-size: 0.65rem;" id="prev-status">SCANNING</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Meta description -->
                            <div class="col-sm-7">
                                <h4 class="fw-bold mb-1 text-dark" id="match-verdict">Ready to analyze</h4>
                                <p class="small text-muted mb-0" id="match-verdict-desc">Paste your resume and target job requirements on the left, then click Scan to run our ATS algorithm checks.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Critical Formatting Checks -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="text-muted small font-monospace mb-3"><i class="bi bi-shield-check"></i> ATS FORMAT COMPLIANCE AUDIT</h5>
                        
                        <div class="d-flex align-items-start gap-3 py-2 border-bottom">
                            <div id="check-contact" class="rounded-circle bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; flex-shrink:0;">
                                <i class="bi bi-dash-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">Contact Information Check</h6>
                                <span class="small text-muted" id="desc-contact">Verify email, phone number, and social links are parsed correctly.</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 py-2 border-bottom">
                            <div id="check-sections" class="rounded-circle bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; flex-shrink:0;">
                                <i class="bi bi-dash-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">Standard Section Headings</h6>
                                <span class="small text-muted" id="desc-sections">Checks if standard ATS section headers (Work History, Education) exist.</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 py-2">
                            <div id="check-layout" class="rounded-circle bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; flex-shrink:0;">
                                <i class="bi bi-dash-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">Resume Complexity & Columns</h6>
                                <span class="small text-muted" id="desc-layout">Scans for tables, tab columns, or complex layouts that confuse parser parsers.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Keywords Audit -->
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="text-muted small font-monospace mb-3"><i class="bi bi-tag"></i> KEYWORD COMPARATIVE SCAN</h5>
                        
                        <div class="mb-3">
                            <h6 class="fw-bold text-success small mb-2"><i class="bi bi-check-circle-fill me-1"></i> Matched Keywords (<span id="matched-count">0</span>)</h6>
                            <div id="matched-tags" class="d-flex flex-wrap gap-1.5 pt-1">
                                <span class="text-muted small">No keywords matched yet.</span>
                            </div>
                        </div>

                        <div>
                            <h6 class="fw-bold text-danger small mb-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> Missing / Recommended Keywords (<span id="missing-count">0</span>)</h6>
                            <div id="missing-tags" class="d-flex flex-wrap gap-1.5 pt-1">
                                <span class="text-muted small">No scanning results yet.</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .preview-sticky {
        position: sticky;
        top: 96px;
    }

    .rotate-n90 {
        transform: rotate(-90deg);
    }

    .rotate-n90 circle {
        transform-origin: center;
    }

    .gap-1.5 {
        gap: 0.35rem !important;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const analyzeBtn = document.getElementById('analyze-btn');
    const resumeTextArea = document.getElementById('resume-text');
    const jobDescTextArea = document.getElementById('job-desc-text');
    const targetTitleInput = document.getElementById('target-title');

    // List of common English stop words to filter out when checking keywords
    const stopWords = new Set([
        'the', 'and', 'a', 'to', 'for', 'in', 'of', 'on', 'with', 'at', 'by', 'an', 'is', 'are', 'was', 'were', 
        'be', 'been', 'being', 'have', 'has', 'had', 'do', 'does', 'did', 'but', 'if', 'or', 'because', 'as', 
        'until', 'while', 'about', 'into', 'through', 'during', 'before', 'after', 'above', 'below', 'from', 
        'up', 'down', 'in', 'out', 'off', 'over', 'under', 'again', 'further', 'then', 'once', 'here', 'there', 
        'when', 'where', 'why', 'how', 'all', 'any', 'both', 'each', 'few', 'more', 'most', 'other', 'some', 
        'such', 'no', 'nor', 'not', 'only', 'own', 'same', 'so', 'than', 'too', 'very', 's', 't', 'can', 'will', 
        'just', 'should', 'now', 'we', 'our', 'us', 'you', 'your', 'he', 'she', 'it', 'they', 'them', 'their', 
        'this', 'that', 'these', 'those', 'must', 'key', 'job', 'work', 'required', 'responsibilities'
    ]);

    function cleanText(text) {
        return text.toLowerCase()
            .replace(/[^\w\s\+\-\#]/g, ' ') // preserve symbols like C++, C#, F#
            .replace(/\s+/g, ' ');
    }

    function extractKeywords(text) {
        const cleaned = cleanText(text);
        const words = cleaned.split(' ');
        const map = new Map();
        
        words.forEach(w => {
            const word = w.trim();
            if (word.length > 2 && !stopWords.has(word) && isNaN(word)) {
                map.set(word, (map.get(word) || 0) + 1);
            }
        });
        
        // Sort by frequency
        return Array.from(map.entries())
            .sort((a, b) => b[1] - a[1])
            .map(entry => entry[0]);
    }

    analyzeBtn.addEventListener('click', function () {
        const resumeText = resumeTextArea.value.trim();
        const jobDescText = jobDescTextArea.value.trim();

        if (!resumeText || !jobDescText) {
            alert('Please paste both your resume text and the job description requirements.');
            return;
        }

        // 1. Keyword extraction and matching
        const resumeKeywords = new Set(cleanText(resumeText).split(' ').map(w => w.trim()));
        const jobKeywords = extractKeywords(jobDescText).slice(0, 20); // Top 20 keywords from requirements

        const matched = [];
        const missing = [];

        jobKeywords.forEach(kw => {
            if (resumeKeywords.has(kw)) {
                matched.push(kw);
            } else {
                missing.push(kw);
            }
        });

        // Calculate score
        let score = 0;
        if (jobKeywords.length > 0) {
            score = Math.round((matched.length / jobKeywords.length) * 100);
        }

        // 2. Format compliance audits
        // Contact details check (Looks for email, phone, LinkedIn patterns)
        const emailRegex = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/;
        const phoneRegex = /(\+?\d{1,3}[-.\s]?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4,6}/;
        const linkedinRegex = /linkedin\.com/;

        const hasEmail = emailRegex.test(resumeText);
        const hasPhone = phoneRegex.test(resumeText);
        const hasLinkedin = linkedinRegex.test(resumeText);

        const contactCheck = document.getElementById('check-contact');
        const contactDesc = document.getElementById('desc-contact');
        if (hasEmail && (hasPhone || hasLinkedin)) {
            contactCheck.className = 'rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center';
            contactCheck.innerHTML = '<i class="bi bi-check-lg"></i>';
            contactDesc.innerHTML = 'Found email and phone/LinkedIn contact links.';
        } else {
            contactCheck.className = 'rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center';
            contactCheck.innerHTML = '<i class="bi bi-exclamation-triangle"></i>';
            contactDesc.innerHTML = 'Missing email or phone number in details.';
            score = Math.max(0, score - 10); // Deduct 10 points for missing contact details
        }

        // Section Headings check
        const headings = ['experience', 'work', 'education', 'skills', 'summary', 'projects'];
        const resumeLower = resumeText.toLowerCase();
        let headingCount = 0;
        headings.forEach(h => {
            if (resumeLower.includes(h)) {
                headingCount++;
            }
        });

        const sectionsCheck = document.getElementById('check-sections');
        const sectionsDesc = document.getElementById('desc-sections');
        if (headingCount >= 3) {
            sectionsCheck.className = 'rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center';
            sectionsCheck.innerHTML = '<i class="bi bi-check-lg"></i>';
            sectionsDesc.innerHTML = 'Found standard headings (Experience, Education, Skills).';
        } else {
            sectionsCheck.className = 'rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center';
            sectionsCheck.innerHTML = '<i class="bi bi-x-lg"></i>';
            sectionsDesc.innerHTML = 'Missing standard headings (e.g. Work History, Education).';
            score = Math.max(0, score - 15);
        }

        // Layout complexity check (Checks for indicators of tables or tab characters)
        const tabCount = (resumeText.match(/\t/g) || []).length;
        const barSeparatorCount = (resumeText.match(/\|/g) || []).length;

        const layoutCheck = document.getElementById('check-layout');
        const layoutDesc = document.getElementById('desc-layout');
        if (tabCount > 8) {
            layoutCheck.className = 'rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center';
            layoutCheck.innerHTML = '<i class="bi bi-exclamation-triangle"></i>';
            layoutDesc.innerHTML = 'Complex layout tabs detected. Use simple single-column blocks.';
            score = Math.max(0, score - 5);
        } else {
            layoutCheck.className = 'rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center';
            layoutCheck.innerHTML = '<i class="bi bi-check-lg"></i>';
            layoutDesc.innerHTML = 'Clean layout parsed successfully. Normal tab structure.';
        }

        // 3. Render scoring gauges
        const scoreCircle = document.getElementById('score-circle');
        const prevScore = document.getElementById('prev-score');
        const prevStatus = document.getElementById('prev-status');

        prevScore.innerText = score + '%';

        // Animate circular gauge using SVG stroke-dashoffset
        const strokeLength = 377; // 2 * PI * 60 (approx)
        const offset = strokeLength - (score / 100) * strokeLength;
        scoreCircle.style.strokeDashoffset = offset;

        // Colors based on score
        if (score >= 75) {
            scoreCircle.setAttribute('stroke', '#15803d');
            prevStatus.innerText = 'HIGH MATCH';
            prevStatus.className = 'small text-success font-monospace fw-bold';
            document.getElementById('match-verdict').innerText = 'Excellent Match!';
            document.getElementById('match-verdict-desc').innerText = 'Your resume is highly optimized for this position. It features the key keywords, standard headers, and is ATS parser compliant.';
        } else if (score >= 45) {
            scoreCircle.setAttribute('stroke', '#ca8a04');
            prevStatus.innerText = 'MEDIUM MATCH';
            prevStatus.className = 'small text-warning font-monospace fw-bold';
            document.getElementById('match-verdict').innerText = 'Moderate Match';
            document.getElementById('match-verdict-desc').innerText = 'Your resume matches several parameters but lacks key vocabulary. Add the missing industry keywords highlighted below.';
        } else {
            scoreCircle.setAttribute('stroke', '#b91c1c');
            prevStatus.innerText = 'LOW MATCH';
            prevStatus.className = 'small text-danger font-monospace fw-bold';
            document.getElementById('match-verdict').innerText = 'Low Compatibility';
            document.getElementById('match-verdict-desc').innerText = 'This resume may be rejected by automated parser screening tools. Revise headings, add contact details, and match vocabulary.';
        }

        // 4. Keywords rendering
        document.getElementById('matched-count').innerText = matched.length;
        const matchedContainer = document.getElementById('matched-tags');
        matchedContainer.innerHTML = '';
        if (matched.length === 0) {
            matchedContainer.innerHTML = '<span class="text-muted small">No matched keywords found.</span>';
        } else {
            matched.forEach(kw => {
                const tag = document.createElement('span');
                tag.className = 'badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-2.5 py-1.5 font-monospace';
                tag.innerText = kw;
                matchedContainer.appendChild(tag);
            });
        }

        document.getElementById('missing-count').innerText = missing.length;
        const missingContainer = document.getElementById('missing-tags');
        missingContainer.innerHTML = '';
        if (missing.length === 0) {
            missingContainer.innerHTML = '<span class="text-muted small">No missing keywords! You are fully optimized.</span>';
        } else {
            missing.forEach(kw => {
                const tag = document.createElement('span');
                tag.className = 'badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-2.5 py-1.5 font-monospace';
                tag.innerText = kw;
                missingContainer.appendChild(tag);
            });
        }
    });

    // Run initial demo analysis on load
    analyzeBtn.click();
});
</script>
@endpush
