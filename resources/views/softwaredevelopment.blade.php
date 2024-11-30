@extends('layouts.app')

@section('title', 'Software Development - Waveron Technologies')

@push('styles')
<style>
    :root {
        --waveron-accent: #00ff9d;
        --waveron-dark: #1a1a1a;
        --primary-color: #006400;
        --secondary-color: #004d00;
    }

    /* Navbar styles from navbar.blade.php */
    .navbar {
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
    }

    .nav-link {
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #fff;
    }

    .dropdown-item {
        font-weight: 500;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #2d2d2d;
        color: #fff;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
    }

    /* Hero Section */
    .service-hero {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        position: relative;
        overflow: hidden;
    }

    .shape-blob {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 300px;
        height: 300px;
        background: linear-gradient(45deg, #006400, #004d00);
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        opacity: 0.1;
        animation: blob-animation 8s infinite;
    }

    .shape-blob2 {
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 250px;
        height: 250px;
        background: linear-gradient(45deg, #004d00, #003300);
        border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
        opacity: 0.1;
        animation: blob-animation 8s infinite reverse;
    }

    @keyframes blob-animation {
        0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        50% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; }
        100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
    }

    /* Particle Effect */
    .hero-particles {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    /* Glow Effect */
    .hero-glow {
        position: absolute;
        inset: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(0, 255, 157, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(0, 255, 157, 0.1) 0%, transparent 50%);
        z-index: 1;
        pointer-events: none;
    }

    /* Content Styling */
    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-content h1 {
        color: var(--primary-color);
        font-size: 3.5rem;
        line-height: 1.2;
    }

    /* Code Window */
    .code-window {
        background: #1E1E1E;
        border-radius: 12px;
        box-shadow: 
            0 8px 30px rgba(0, 0, 0, 0.1),
            0 0 40px rgba(0, 255, 157, 0.1);
        overflow: hidden;
        transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
        transition: transform 0.3s ease;
    }

    .code-window:hover {
        transform: perspective(1000px) rotateY(-2deg) rotateX(2deg);
    }

    .code-header {
        background: rgba(255, 255, 255, 0.1);
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ff5f57;
    }

    .dot:nth-child(2) {
        background: #febc2e;
    }

    .dot:nth-child(3) {
        background: #28c840;
    }

    .code-content {
        padding: 20px;
    }

    .code-content pre {
        margin: 0;
        color: #fff;
        font-family: 'Fira Code', monospace;
        font-size: 14px;
        line-height: 1.5;
    }

    /* Animated Underline */
    .nav-link {
        position: relative;
        overflow: hidden;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #fff;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .nav-link:hover::after {
        transform: translateX(0);
    }

    /* Button Styling */
    .btn {
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
        z-index: -1;
    }

    .btn:hover::before {
        width: 300%;
        height: 300%;
    }

    .btn-primary {
        background: #2d2d2d;
        border: none;
        color: #fff;
    }

    .btn-outline-light:hover {
        background: transparent;
        color: #fff;
        border-color: #fff;
    }

    /* Animations */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    @keyframes glow {
        0%, 100% {
            box-shadow: 0 0 40px rgba(255, 255, 255, 0.2);
        }
        50% {
            box-shadow: 0 0 60px rgba(255, 255, 255, 0.4);
        }
    }

    /* Service Cards */
    .service-card {
        background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
        border-radius: 16px;
        padding: 2rem;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(255, 255, 255, 0.15);
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.03));
        pointer-events: none;
    }

    .service-icon {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 1.5rem;
    }

    .service-card h3 {
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .service-card p {
        color: #a0a0a0;
        margin-bottom: 1.5rem;
    }

    .service-features {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem 0;
    }

    .service-features li {
        color: #d0d0d0;
        margin-bottom: 0.5rem;
        padding-left: 1.5rem;
        position: relative;
    }

    .service-features li::before {
        content: '→';
        position: absolute;
        left: 0;
        color: #fff;
    }

    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: auto;
    }

    .tech-stack span {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .section-title.gradient-text {
        background: linear-gradient(135deg, #fff, #009960);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    /* Process Section Styles */
    .process-section {
        background: linear-gradient(180deg, #1a1a1a 0%, #2d2d2d 100%);
        position: relative;
    }

    .process-timeline {
        position: relative;
        padding: 2rem 0;
    }

    .process-timeline::before {
        content: '';
        position: absolute;
        left: 50px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #fff 0%, rgba(255, 255, 255, 0.2) 100%);
    }

    .process-step {
        display: flex;
        margin-bottom: 4rem;
        position: relative;
    }

    .process-number {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
        border: 2px solid #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
        position: relative;
        z-index: 2;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
    }

    .process-content {
        flex: 1;
        padding-left: 2rem;
    }

    .process-content h3 {
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .process-details {
        background: rgba(26, 26, 26, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .process-details ul {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem 0;
    }

    .process-details ul li {
        color: #d0d0d0;
        margin-bottom: 0.5rem;
        padding-left: 1.5rem;
        position: relative;
    }

    .process-details ul li::before {
        content: '→';
        position: absolute;
        left: 0;
        color: #fff;
    }

    .process-duration {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .process-deliverables {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .process-deliverables strong {
        color: #fff;
        display: block;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .process-timeline::before {
            left: 30px;
        }

        .process-number {
            width: 60px;
            height: 60px;
            font-size: 1.25rem;
        }

        .process-content {
            padding-left: 1rem;
        }
    }

    /* Updated Process Section Styles */
    .process-header {
        background: rgba(26, 26, 26, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .process-header:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .expand-icon {
        position: absolute;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        color: #fff;
        transition: transform 0.3s ease;
    }

    .process-header[aria-expanded="true"] .expand-icon i {
        transform: rotate(180deg);
    }

    .process-details {
        background: rgba(26, 26, 26, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0 0 12px 12px;
        margin-top: -1px;
        padding: 1.5rem;
    }

    .tasks-section,
    .deliverables-section {
        margin-bottom: 1.5rem;
    }

    .tasks-section h4,
    .deliverables-section h4 {
        color: #fff;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .process-duration {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* Pricing Section Styles */
    .pricing-card {
        background: #fff;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .price-tag {
        font-size: 2.5rem;
        color: var(--waveron-dark);
        font-weight: 700;
    }

    .price-tag .currency {
        font-size: 1.5rem;
        vertical-align: super;
    }

    .price-tag .period {
        font-size: 1rem;
        color: #666;
    }

    .btn-quote {
        background: linear-gradient(135deg, var(--waveron-dark), #2d2d2d);
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        border: none;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-quote:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: var(--waveron-accent);
    }

    /* Technologies Section */
    .tech-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.05);
        transition: background 0.3s ease;
    }

    .tech-card:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .tech-card i {
        font-size: 2rem;
        color: var(--waveron-accent);
    }

    .tech-card span {
        font-size: 1.1rem;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="service-hero position-relative overflow-hidden">
    <div class="shape-blob"></div>
    <div class="shape-blob2"></div>
    <div class="hero-content container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-6 py-5">
                <div class="hero-content" data-aos="fade-up">
                    <h1 class="display-4 fw-bold mb-4" style="color: var(--primary-color)">Software Development</h1>
                    <p class="lead text-secondary mb-4">Transforming ideas into powerful digital solutions with cutting-edge technology and innovative development practices.</p>
                    <div class="d-flex gap-3">
                        <a href="#contact" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="#process" class="btn btn-outline-primary btn-lg">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 py-5">
                <div class="hero-image" data-aos="fade-left">
                    <div class="code-window">
                        <div class="code-header">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                        <div class="code-content">
                            <pre><code class="language-javascript">
class WaveronTech {
    constructor() {
        this.innovation = true;
        this.technology = "cutting-edge";
    }

    createSolution() {
        return {
            quality: "exceptional",
            scalable: true,
            innovative: true
        };
    }
}
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
            <h2 class="section-title gradient-text mb-4">Our Software Development Services</h2>
            <p class="lead text-muted">Empowering businesses with cutting-edge software solutions that drive innovation and growth.</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-window-desktop"></i>
                </div>
                <h3>Custom Web Applications</h3>
                <p>Scalable and robust web applications tailored to your business needs:</p>
                <ul class="service-features">
                    <li>Full-stack development</li>
                    <li>Progressive Web Apps (PWA)</li>
                    <li>E-commerce solutions</li>
                    <li>Enterprise applications</li>
                </ul>
                <div class="tech-stack">
                    <span>Laravel</span>
                    <span>React</span>
                    <span>Vue.js</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-phone"></i>
                </div>
                <h3>Mobile App Development</h3>
                <p>Native and cross-platform mobile solutions:</p>
                <ul class="service-features">
                    <li>iOS development</li>
                    <li>Android development</li>
                    <li>Cross-platform apps</li>
                    <li>App maintenance</li>
                </ul>
                <div class="tech-stack">
                    <span>Flutter</span>
                    <span>React Native</span>
                    <span>Swift</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-gear-wide-connected"></i>
                </div>
                <h3>API Development</h3>
                <p>Secure and scalable API solutions:</p>
                <ul class="service-features">
                    <li>RESTful APIs</li>
                    <li>GraphQL</li>
                    <li>Microservices</li>
                    <li>API Integration</li>
                </ul>
                <div class="tech-stack">
                    <span>Node.js</span>
                    <span>Express</span>
                    <span>GraphQL</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-cloud-arrow-up"></i>
                </div>
                <h3>Cloud Solutions</h3>
                <p>Modern cloud infrastructure and services:</p>
                <ul class="service-features">
                    <li>Cloud migration</li>
                    <li>Serverless architecture</li>
                    <li>Cloud optimization</li>
                    <li>DevOps integration</li>
                </ul>
                <div class="tech-stack">
                    <span>AWS</span>
                    <span>Azure</span>
                    <span>GCP</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3>Enterprise Solutions</h3>
                <p>Comprehensive enterprise software solutions:</p>
                <ul class="service-features">
                    <li>ERP systems</li>
                    <li>CRM integration</li>
                    <li>Business automation</li>
                    <li>Data analytics</li>
                </ul>
                <div class="tech-stack">
                    <span>Java</span>
                    <span>.NET</span>
                    <span>Python</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-braces"></i>
                </div>
                <h3>Custom Software</h3>
                <p>Tailored software solutions for unique needs:</p>
                <ul class="service-features">
                    <li>Desktop applications</li>
                    <li>System integration</li>
                    <li>Legacy modernization</li>
                    <li>Maintenance & support</li>
                </ul>
                <div class="tech-stack">
                    <span>C++</span>
                    <span>Python</span>
                    <span>Java</span>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Process Section -->
<div class="process-section py-5">
    <div class="container py-4">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title gradient-text mb-4">Our Development Process</h2>
                <p class="lead text-muted">A systematic approach to deliver high-quality software solutions</p>
            </div>
        </div>
        <div class="process-timeline">
            @foreach([
                [
                    'number' => '01',
                    'title' => 'Discovery & Planning',
                    'description' => 'Initial project planning and requirement gathering phase',
                    'duration' => '1-2 weeks',
                    'tasks' => [
                        'Requirements gathering and analysis',
                        'Technical feasibility assessment',
                        'Project scope definition',
                        'Technology stack selection',
                        'Timeline and budget planning'
                    ],
                    'deliverables' => [
                        'Project proposal',
                        'Technical specifications',
                        'Project timeline'
                    ]
                ],
                [
                    'number' => '02',
                    'title' => 'Design & Architecture',
                    'description' => 'Creating the blueprint for your software solution',
                    'duration' => '2-3 weeks',
                    'tasks' => [
                        'UI/UX design creation',
                        'System architecture design',
                        'Database schema design',
                        'API endpoints planning',
                        'Security architecture planning'
                    ],
                    'deliverables' => [
                        'UI/UX mockups',
                        'Architecture diagrams',
                        'Technical documentation'
                    ]
                ],
                [
                    'number' => '03',
                    'title' => 'Development & Testing',
                    'description' => 'Building and testing your software solution',
                    'duration' => '8-12 weeks',
                    'tasks' => [
                        'Agile development sprints',
                        'Continuous integration/deployment',
                        'Unit and integration testing',
                        'Code quality assurance',
                        'Regular client updates'
                    ],
                    'deliverables' => [
                        'Sprint releases',
                        'Test reports',
                        'Development documentation'
                    ]
                ],
                [
                    'number' => '04',
                    'title' => 'Quality Assurance',
                    'description' => 'Ensuring the highest quality standards',
                    'duration' => '2-3 weeks',
                    'tasks' => [
                        'Comprehensive testing',
                        'Performance optimization',
                        'Security testing',
                        'User acceptance testing',
                        'Bug fixing and refinement'
                    ],
                    'deliverables' => [
                        'QA test reports',
                        'Performance metrics',
                        'Security audit report'
                    ]
                ],
                [
                    'number' => '05',
                    'title' => 'Deployment & Launch',
                    'description' => 'Taking your solution live',
                    'duration' => '1-2 weeks',
                    'tasks' => [
                        'Production environment setup',
                        'Data migration',
                        'Deployment automation',
                        'Monitoring setup',
                        'Launch coordination'
                    ],
                    'deliverables' => [
                        'Deployed application',
                        'Deployment documentation',
                        'Monitoring dashboard'
                    ]
                ],
                [
                    'number' => '06',
                    'title' => 'Maintenance & Support',
                    'description' => 'Ongoing support and improvements',
                    'duration' => 'Ongoing',
                    'tasks' => [
                        '24/7 monitoring',
                        'Regular updates and patches',
                        'Performance optimization',
                        'Technical support',
                        'Feature enhancements'
                    ],
                    'deliverables' => [
                        'Monthly status reports',
                        'Performance analytics',
                        'Update documentation'
                    ]
                ]
            ] as $step)
            <div class="process-step" data-aos="fade-up">
                <div class="process-number">{{ $step['number'] }}</div>
                <div class="process-content">
                    <div class="process-header" data-bs-toggle="collapse" data-bs-target="#process{{ $step['number'] }}" aria-expanded="false">
                        <h3>{{ $step['title'] }}</h3>
                        <p class="mb-0">{{ $step['description'] }}</p>
                        <div class="process-duration">Duration: {{ $step['duration'] }}</div>
                        <div class="expand-icon">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="collapse" id="process{{ $step['number'] }}">
                        <div class="process-details">
                            <div class="tasks-section">
                                <h4>Tasks</h4>
                                <ul>
                                    @foreach($step['tasks'] as $task)
                                    <li>{{ $task }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="deliverables-section">
                                <h4>Deliverables</h4>
                                <ul>
                                    @foreach($step['deliverables'] as $deliverable)
                                    <li>{{ $deliverable }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Pricing Section -->
<div class="pricing-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title gradient-text mb-2">Our Pricing Plans</h2>
                <p class="text-muted">Starting from $160</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="pricing-card">
                    <div class="price-tag mb-4">
                        <span class="currency">$</span>
                        <span class="amount">160</span>
                        <span class="period">/project</span>
                    </div>
                    <div class="mt-4">
                        <a href="#contact" class="btn btn-quote">Request a Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Technologies Section -->
<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
            <h2 class="mb-4">Technologies We Use</h2>
            <p class="lead text-muted">We leverage the latest technologies to build robust and scalable solutions.</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-6 col-md-4 col-lg-2">
            <div class="tech-card">
                <i class="bi bi-filetype-html"></i>
                <span>HTML5/CSS3</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="tech-card">
                <i class="bi bi-filetype-js"></i>
                <span>JavaScript</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="tech-card">
                <i class="bi bi-filetype-php"></i>
                <span>PHP/Laravel</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="tech-card">
                <i class="bi bi-filetype-sql"></i>
                <span>MySQL</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="tech-card">
                <i class="bi bi-git"></i>
                <span>Git</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="tech-card">
                <i class="bi bi-aws"></i>
                <span>AWS</span>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section bg-primary text-white py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mb-4">Ready to Start Your Project?</h2>
                <p class="lead mb-4">Let's discuss how we can help bring your software vision to life.</p>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Contact Us Today</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize particles
    particlesJS('hero-particles', {
        particles: {
            number: { value: 80, density: { enable: true, value_area: 800 } },
            color: { value: '#00ff9d' },
            shape: { type: 'circle' },
            opacity: {
                value: 0.5,
                random: true,
                animation: { enable: true, speed: 1, minimumValue: 0.1, sync: false }
            },
            size: {
                value: 3,
                random: true,
                animation: { enable: true, speed: 2, minimumValue: 0.1, sync: false }
            },
            lineLinked: {
                enable: true,
                distance: 150,
                color: '#00ff9d',
                opacity: 0.4,
                width: 1
            },
            move: {
                enable: true,
                speed: 1,
                direction: 'none',
                random: true,
                straight: false,
                outMode: 'out',
                bounce: false,
                attract: { enable: false, rotateX: 600, rotateY: 1200 }
            }
        },
        interactivity: {
            detectsOn: 'canvas',
            events: {
                onhover: { enable: true, mode: 'grab' },
                onclick: { enable: true, mode: 'push' },
                resize: true
            },
            modes: {
                grab: { distance: 140, lineLinked: { opacity: 1 } },
                bubble: { distance: 400, size: 40, duration: 2, opacity: 8, speed: 3 },
                repulse: { distance: 200, duration: 0.4 },
                push: { particles_nb: 4 },
                remove: { particles_nb: 2 }
            }
        },
        retina_detect: true
    });
});

// Navbar scroll effect from navbar.blade.php
window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
        document.querySelector('.navbar').classList.add('scrolled');
    } else {
        document.querySelector('.navbar').classList.remove('scrolled');
    }
});
</script>
@endpush