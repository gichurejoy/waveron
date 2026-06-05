<div id="waveron-chatbot-container" class="position-fixed" style="bottom: 30px; right: 30px; z-index: 1050;">
    
    <!-- Chat Window -->
    <div id="chatbot-window" class="card shadow-lg border-0 rounded-4 d-none mb-3 overflow-hidden" style="width: 350px; max-height: 500px; display: flex; flex-direction: column;">
        
        <!-- Header -->
        <div class="bg-primary text-white p-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-robot fs-4"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Waveron Assistant</h6>
                    <small class="text-white-50" style="font-size: 0.75rem;">Online</small>
                </div>
            </div>
            <button class="btn btn-sm btn-link text-white p-0" onclick="toggleChatbot()" style="text-decoration: none;">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Chat History -->
        <div id="chat-history" class="card-body bg-light" style="flex: 1 1 auto; overflow-y: auto; height: 300px; padding: 1rem;">
            <!-- Greeting Message -->
            <div class="mb-3 d-flex gap-2 align-items-end">
                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                    <i class="bi bi-robot small"></i>
                </div>
                <div class="bg-white border rounded-3 p-2 shadow-sm text-dark small" style="max-width: 80%;">
                    Hi there! 👋 I'm the Waveron Assistant. How can I help you today?
                </div>
            </div>
        </div>

        <!-- Options Container -->
        <div id="chat-options" class="p-3 bg-white border-top">
            <p class="small text-muted mb-2 fw-medium">Please select an option:</p>
            <div class="d-flex flex-column gap-2">
                <button class="btn btn-outline-primary btn-sm text-start rounded-pill px-3 py-2" onclick="handleChatOption('software')">
                    💻 I need a custom software solution
                </button>
                <button class="btn btn-outline-primary btn-sm text-start rounded-pill px-3 py-2" onclick="handleChatOption('brand')">
                    🎨 I'm looking to rebrand my business
                </button>
                <button class="btn btn-outline-primary btn-sm text-start rounded-pill px-3 py-2" onclick="handleChatOption('refer')">
                    🤝 I want to refer a client to Waveron
                </button>
                <button class="btn btn-outline-primary btn-sm text-start rounded-pill px-3 py-2" onclick="handleChatOption('career')">
                    🚀 Are you currently hiring?
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Toggle Button -->
    <button id="chatbot-toggle-btn" class="btn btn-primary rounded-circle shadow-lg d-flex justify-content-center align-items-center ms-auto" style="width: 60px; height: 60px; transition: transform 0.3s ease;" onclick="toggleChatbot()">
        <i class="bi bi-chat-dots-fill fs-3"></i>
    </button>
</div>

<style>
    #chatbot-toggle-btn:hover {
        transform: scale(1.1);
    }
    .chat-user-message {
        background-color: var(--waveron-green, #006400);
        color: white;
        border-radius: 12px 12px 0 12px;
        padding: 8px 12px;
        font-size: 0.875rem;
        max-width: 80%;
        margin-left: auto;
        margin-bottom: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .chat-bot-message {
        background-color: white;
        color: #333;
        border: 1px solid #dee2e6;
        border-radius: 12px 12px 12px 0;
        padding: 8px 12px;
        font-size: 0.875rem;
        max-width: 80%;
        margin-bottom: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
</style>

<script>
    function toggleChatbot() {
        const windowEl = document.getElementById('chatbot-window');
        const icon = document.querySelector('#chatbot-toggle-btn i');
        
        if (windowEl.classList.contains('d-none')) {
            windowEl.classList.remove('d-none');
            icon.classList.remove('bi-chat-dots-fill');
            icon.classList.add('bi-x-lg');
            
            // Scroll to bottom
            const history = document.getElementById('chat-history');
            history.scrollTop = history.scrollHeight;
        } else {
            windowEl.classList.add('d-none');
            icon.classList.remove('bi-x-lg');
            icon.classList.add('bi-chat-dots-fill');
        }
    }

    function appendUserMessage(text) {
        const history = document.getElementById('chat-history');
        const msgDiv = document.createElement('div');
        msgDiv.className = 'chat-user-message';
        msgDiv.innerText = text;
        history.appendChild(msgDiv);
        history.scrollTop = history.scrollHeight;
    }

    function appendBotMessage(htmlContent) {
        const history = document.getElementById('chat-history');
        
        const wrapper = document.createElement('div');
        wrapper.className = 'd-flex gap-2 align-items-end mb-3';
        
        wrapper.innerHTML = `
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                <i class="bi bi-robot small"></i>
            </div>
            <div class="chat-bot-message m-0">
                ${htmlContent}
            </div>
        `;
        
        history.appendChild(wrapper);
        history.scrollTop = history.scrollHeight;
    }

    function handleChatOption(type) {
        // Hide options container
        document.getElementById('chat-options').style.display = 'none';

        // Map options
        const responses = {
            'software': {
                user: "💻 I need a custom software solution",
                bot: "Awesome! From CRM platforms to mobile apps, we build scalable software tailored to your business.<br><br><a href='/quote' class='btn btn-sm btn-primary rounded-pill w-100 mt-2'>Schedule a Free Discovery Call</a>"
            },
            'brand': {
                user: "🎨 I'm looking to rebrand my business",
                bot: "A strong brand stands out! We offer full-service branding—from logos and guidelines to digital assets.<br><br><a href='/services' class='btn btn-sm btn-primary rounded-pill w-100 mt-2'>View Our Branding Services</a>"
            },
            'refer': {
                user: "🤝 I want to refer a client to Waveron",
                bot: "We love referrals! And we pay out generous commissions for every successful project you send our way.<br><br><a href='/careers' class='btn btn-sm btn-primary rounded-pill w-100 mt-2'>Go To Our Referral Form</a>"
            },
            'career': {
                user: "🚀 Are you currently hiring?",
                bot: "We are always on the lookout for ambitious talent! As a growing venture studio, we offer dynamic roles.<br><br><a href='/careers' class='btn btn-sm btn-primary rounded-pill w-100 mt-2'>View Open Positions</a>"
            }
        };

        const data = responses[type];

        // 1. Show user message
        appendUserMessage(data.user);

        // 2. Simulate typing delay
        const typingId = 'typing-indicator-' + Date.now();
        const history = document.getElementById('chat-history');
        const typingWrapper = document.createElement('div');
        typingWrapper.className = 'd-flex gap-2 align-items-end mb-3';
        typingWrapper.id = typingId;
        typingWrapper.innerHTML = `
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                <i class="bi bi-robot small"></i>
            </div>
            <div class="chat-bot-message m-0 text-muted">
                <i class="bi bi-three-dots"></i> Typing...
            </div>
        `;
        history.appendChild(typingWrapper);
        history.scrollTop = history.scrollHeight;

        setTimeout(() => {
            // Remove typing indicator
            document.getElementById(typingId).remove();
            
            // 3. Show bot response
            appendBotMessage(data.bot);

            // 4. Offer to reset options after a moment
            setTimeout(() => {
                appendBotMessage("Is there anything else I can help you with?<br><br><button class='btn btn-sm btn-outline-secondary rounded-pill w-100 mt-2' onclick='resetChatOptions()'>Show Options Again</button>");
            }, 1000);

        }, 800);
    }

    function resetChatOptions() {
        document.getElementById('chat-options').style.display = 'block';
        const history = document.getElementById('chat-history');
        history.scrollTop = history.scrollHeight;
    }
</script>
