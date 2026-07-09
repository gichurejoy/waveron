<div id="waveron-chatbot-container" class="position-fixed" style="bottom: 28px; right: 28px; z-index: 1050;">

    <!-- Chat Window -->
    <div id="chatbot-window" class="card shadow-lg border-0 rounded-4 d-none mb-3 overflow-hidden" style="width: 360px; max-height: 540px; display: flex; flex-direction: column;">

        <!-- Header -->
        <div class="bg-primary text-white p-3 d-flex justify-content-between align-items-center flex-shrink-0">
            <div class="d-flex align-items-center gap-2">
                <div class="position-relative">
                    <i class="bi bi-robot fs-5"></i>
                    <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-white" style="width:8px;height:8px;"></span>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Waveron Assistant</h6>
                    <small class="text-white-50" style="font-size: 0.7rem;">Online · Typically replies instantly</small>
                </div>
            </div>
            <button class="btn btn-sm btn-link text-white p-0" onclick="toggleChatbot()" style="text-decoration: none;" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Chat History -->
        <div id="chat-history" class="bg-light flex-grow-1 overflow-y-auto p-3" style="max-height: 340px;">
            <!-- Greeting -->
            <div class="mb-3 d-flex gap-2 align-items-end">
                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width:30px;height:30px;">
                    <i class="bi bi-robot" style="font-size:0.8rem;"></i>
                </div>
                <div class="chat-bot-message m-0">
                    Hi there! 👋 I'm the Waveron Assistant. I can answer questions about our services, pricing, or team. What brings you here today?
                </div>
            </div>

            <!-- Quick option chips -->
            <div id="chat-chips" class="d-flex flex-wrap gap-2 mb-2 ps-5">
                <button class="chat-chip" onclick="handleChatOption('software')">💻 Custom Software</button>
                <button class="chat-chip" onclick="handleChatOption('brand')">🎨 Branding</button>
                <button class="chat-chip" onclick="handleChatOption('pricing')">💰 Pricing</button>
                <button class="chat-chip" onclick="handleChatOption('portfolio')">🏗️ Portfolio</button>
                <button class="chat-chip" onclick="handleChatOption('career')">🚀 Hiring?</button>
                <button class="chat-chip" onclick="handleChatOption('refer')">🤝 Referrals</button>
                <button class="chat-chip" onclick="handleChatOption('timeline')">⏱️ Timelines</button>
                <button class="chat-chip" onclick="handleChatOption('contact')">📞 Contact us</button>
            </div>
        </div>

        <!-- Input Bar -->
        <div class="bg-white border-top p-2 d-flex gap-2 flex-shrink-0">
            <input id="chat-input" type="text" class="form-control form-control-sm rounded-pill border-0 bg-light" placeholder="Type a message…" style="font-size:0.85rem;" onkeydown="if(event.key==='Enter') sendUserMessage()">
            <button class="btn btn-primary btn-sm rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center" style="width:34px;height:34px;" onclick="sendUserMessage()" aria-label="Send">
                <i class="bi bi-send-fill" style="font-size:0.8rem;"></i>
            </button>
        </div>
    </div>

    <!-- Floating Toggle Button -->
    <button id="chatbot-toggle-btn" class="btn btn-primary rounded-circle shadow-lg d-flex justify-content-center align-items-center ms-auto position-relative" style="width:56px;height:56px;transition:transform 0.3s ease;" onclick="toggleChatbot()" aria-label="Open chat">
        <i class="bi bi-chat-dots-fill" style="font-size:1.4rem;"></i>
        <span id="chat-notification-dot" class="position-absolute top-0 end-0 bg-danger rounded-circle border border-white" style="width:12px;height:12px;"></span>
    </button>
</div>

<style>
    #chatbot-toggle-btn:hover { transform: scale(1.08); }
    .chat-user-message {
        background-color: var(--waveron-green, #006400);
        color: white;
        border-radius: 14px 14px 2px 14px;
        padding: 8px 13px;
        font-size: 0.82rem;
        max-width: 78%;
        margin-left: auto;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    .chat-bot-message {
        background-color: white;
        color: #1a1a2e;
        border: 1px solid #e9ecef;
        border-radius: 2px 14px 14px 14px;
        padding: 9px 13px;
        font-size: 0.82rem;
        max-width: 78%;
        margin-bottom: 0;
        line-height: 1.5;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .chat-chip {
        background: white;
        border: 1px solid #d1d5db;
        border-radius: 50px;
        padding: 4px 11px;
        font-size: 0.73rem;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
        line-height: 1.4;
    }
    .chat-chip:hover {
        background: var(--bs-primary, #006400);
        color: white;
        border-color: var(--bs-primary, #006400);
    }
    #chat-history::-webkit-scrollbar { width: 4px; }
    #chat-history::-webkit-scrollbar-track { background: transparent; }
    #chat-history::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
    .chat-typing span {
        display: inline-block;
        width: 6px; height: 6px;
        background: #9ca3af;
        border-radius: 50%;
        animation: typingBounce 1.2s ease-in-out infinite;
        margin: 0 1px;
    }
    .chat-typing span:nth-child(2) { animation-delay: 0.2s; }
    .chat-typing span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-5px); }
    }
</style>

<script>
    const botKnowledge = {
        software: {
            user: "💻 Custom Software",
            bot: "We build end-to-end custom software — from SaaS platforms and enterprise ERPs to mobile apps and AI integrations. Our work includes Waveron PLM (real estate SaaS), Waveron CRM, and an autonomous security agent.<br><br>Every project starts with a free discovery call to scope your requirements, timelines, and budget.<br><br><a href='{{ route('quote') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>Schedule Discovery Call →</a>"
        },
        brand: {
            user: "🎨 Branding",
            bot: "Our branding team handles full visual identity — logo design, brand guidelines, typography, colour systems, and digital assets. We also offer automated Brand Book generation for fast turnaround clients.<br><br>Whether you're launching a startup or rebranding an enterprise, we've got you covered.<br><br><a href='{{ route('services.branding') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>See Branding Services →</a>"
        },
        pricing: {
            user: "💰 Pricing",
            bot: "Our pricing is project-based and transparent:<br><br>• <strong>Portfolio sites:</strong> from Ksh 65,000<br>• <strong>Web apps / MVPs:</strong> from Ksh 250,000<br>• <strong>Enterprise systems:</strong> custom quote<br>• <strong>Branding packages:</strong> from Ksh 35,000<br><br>All engagements include weekly demos, shared roadmaps, and source code delivery.<br><br><a href='{{ route('quote') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>Get a Tailored Quote →</a>"
        },
        portfolio: {
            user: "🏗️ Portfolio",
            bot: "Our portfolio includes:<br><br>• <strong>Waveron PLM</strong> — Real estate B2B SaaS with AI staging<br>• <strong>Waveron CRM</strong> — Low-latency sales pipeline engine<br>• <strong>Brand Book Generator</strong> — AI-powered brand automation<br>• <strong>Career Matcher</strong> — Talent-matching enterprise dashboard<br>• <strong>E-Commerce Core</strong> — High-performance storefront architecture<br>• <strong>Security Agent</strong> — Autonomous threat detection AI<br><br><a href='{{ route('portfolio') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>View Full Portfolio →</a>"
        },
        career: {
            user: "🚀 Hiring?",
            bot: "Yes! Waveron is a growing venture studio and we're always on the lookout for ambitious people. Current open roles include Sales reps and engineering contractors.<br><br>We offer flexible, remote-friendly arrangements with performance-based pay and real ownership of what you build.<br><br><a href='{{ route('careers') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>View Open Positions →</a>"
        },
        refer: {
            user: "🤝 Referrals",
            bot: "We pay generous commissions for successful referrals — typically <strong>10–15%</strong> of the project value, paid out after the client's first milestone payment.<br><br>If you know a business that needs a software solution, branding, or marketing, simply refer them and earn when they sign.<br><br><a href='{{ route('careers') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>Submit a Referral →</a>"
        },
        timeline: {
            user: "⏱️ Timelines",
            bot: "Project timelines vary by scope:<br><br>• <strong>Landing page:</strong> 1–2 weeks<br>• <strong>Web app / MVP:</strong> 4–8 weeks<br>• <strong>Enterprise platform:</strong> 3–6 months<br>• <strong>Branding package:</strong> 1–3 weeks<br><br>Rush delivery is available for most projects at an expedited rate. We share a live roadmap so you always know where things stand.<br><br><a href='{{ route('contact') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>Discuss Your Timeline →</a>"
        },
        contact: {
            user: "📞 Contact us",
            bot: "You can reach us through:<br><br>📧 <strong>Email:</strong> info@waverontechnologies.co.ke<br>📞 <strong>Phone:</strong> +254 798 717 800<br>📍 <strong>Office:</strong> Westlands, Nairobi, Kenya<br><br>We respond within a few hours on weekdays.<br><br><a href='{{ route('contact') }}' class='btn btn-primary btn-sm rounded-pill px-3 mt-2'>Open Contact Form →</a>"
        }
    };

    // Simple keyword intent matcher for free-text input
    const intentMap = [
        { keywords: ['software','app','web','mobile','build','develop','system','saas','platform'], intent: 'software' },
        { keywords: ['brand','logo','design','identity','rebrand','color','colour','visual'], intent: 'brand' },
        { keywords: ['price','cost','how much','pricing','budget','rate','fee','ksh','kes'], intent: 'pricing' },
        { keywords: ['portfolio','project','work','case','past','examples'], intent: 'portfolio' },
        { keywords: ['hire','job','career','opening','vacancy','employ','recruit'], intent: 'career' },
        { keywords: ['refer','referral','commission','earn','introduce'], intent: 'refer' },
        { keywords: ['time','timeline','how long','duration','deadline','rush','week','month'], intent: 'timeline' },
        { keywords: ['contact','reach','phone','email','address','location','office'], intent: 'contact' },
    ];

    function detectIntent(text) {
        const lower = text.toLowerCase();
        for (const { keywords, intent } of intentMap) {
            if (keywords.some(k => lower.includes(k))) return intent;
        }
        return null;
    }

    function toggleChatbot() {
        const windowEl = document.getElementById('chatbot-window');
        const icon = document.querySelector('#chatbot-toggle-btn i');
        const dot = document.getElementById('chat-notification-dot');

        if (windowEl.classList.contains('d-none')) {
            windowEl.classList.remove('d-none');
            icon.className = 'bi bi-x-lg';
            if (dot) dot.style.display = 'none';
            scrollHistory();
        } else {
            windowEl.classList.add('d-none');
            icon.className = 'bi bi-chat-dots-fill';
            icon.style.fontSize = '1.4rem';
        }
    }

    function scrollHistory() {
        const history = document.getElementById('chat-history');
        history.scrollTop = history.scrollHeight;
    }

    function appendUserMessage(text) {
        const history = document.getElementById('chat-history');
        const div = document.createElement('div');
        div.className = 'chat-user-message';
        div.innerText = text;
        history.appendChild(div);
        scrollHistory();
    }

    function appendBotMessage(htmlContent) {
        const history = document.getElementById('chat-history');
        const wrapper = document.createElement('div');
        wrapper.className = 'd-flex gap-2 align-items-end mb-3';
        wrapper.innerHTML = `
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width:30px;height:30px;">
                <i class="bi bi-robot" style="font-size:0.8rem;"></i>
            </div>
            <div class="chat-bot-message m-0">${htmlContent}</div>
        `;
        history.appendChild(wrapper);
        scrollHistory();
    }

    function showTypingIndicator() {
        const history = document.getElementById('chat-history');
        const id = 'typing-' + Date.now();
        const wrapper = document.createElement('div');
        wrapper.id = id;
        wrapper.className = 'd-flex gap-2 align-items-end mb-3';
        wrapper.innerHTML = `
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width:30px;height:30px;">
                <i class="bi bi-robot" style="font-size:0.8rem;"></i>
            </div>
            <div class="chat-bot-message m-0 chat-typing"><span></span><span></span><span></span></div>
        `;
        history.appendChild(wrapper);
        scrollHistory();
        return id;
    }

    function removeTyping(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    function hideChips() {
        const chips = document.getElementById('chat-chips');
        if (chips) chips.style.display = 'none';
    }

    function showResetChip() {
        const history = document.getElementById('chat-history');
        const div = document.createElement('div');
        div.className = 'ps-5 mb-2';
        div.innerHTML = `<button class="chat-chip" onclick="resetChat()">↩ Ask something else</button>`;
        history.appendChild(div);
        scrollHistory();
    }

    function resetChat() {
        const chips = document.getElementById('chat-chips');
        if (chips) chips.style.display = '';
        scrollHistory();
    }

    function handleChatOption(type) {
        const data = botKnowledge[type];
        if (!data) return;
        hideChips();
        appendUserMessage(data.user);
        const typingId = showTypingIndicator();
        setTimeout(() => {
            removeTyping(typingId);
            appendBotMessage(data.bot);
            setTimeout(showResetChip, 600);
        }, 850);
    }

    function sendUserMessage() {
        const input = document.getElementById('chat-input');
        const text = input.value.trim();
        if (!text) return;
        input.value = '';
        hideChips();
        appendUserMessage(text);

        const typingId = showTypingIndicator();
        setTimeout(() => {
            removeTyping(typingId);
            const intent = detectIntent(text);
            if (intent && botKnowledge[intent]) {
                appendBotMessage(botKnowledge[intent].bot);
            } else {
                appendBotMessage("Thanks for your message! I'm best at answering common questions about Waveron's services, pricing, and team. For anything specific, please <a href='{{ route('contact') }}' class='text-primary fw-semibold'>contact us directly</a> — we respond within a few hours. 🙂");
            }
            setTimeout(showResetChip, 600);
        }, 950);
    }
</script>
