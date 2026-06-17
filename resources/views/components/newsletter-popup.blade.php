<!-- Newsletter Popup Component -->
<div id="waveronNewsletterPopup" class="waveron-popup-overlay">
    <div class="waveron-popup-content">
        <button class="waveron-popup-close text-white" id="closeWaveronPopup"><i class="bi bi-x-lg"></i></button>
        
        <div class="text-center">
            <h2 class="fw-bold mb-3 text-white" style="font-size: 2rem; letter-spacing: -0.5px;">Subscribe to Waveron Blog</h2>
            <p class="text-white mb-4 opacity-75">Get the latest posts delivered right to your email.</p>
            
            @if (session('newsletter_success'))
                <div class="alert alert-success py-2 px-3 mb-3 text-start" role="alert" style="font-size: 0.85rem; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                    {{ session('newsletter_success') }}
                </div>
            @endif
            @if (session('newsletter_error'))
                <div class="alert alert-danger py-2 px-3 mb-3 text-start" role="alert" style="font-size: 0.85rem; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                    {{ session('newsletter_error') }}
                </div>
            @endif

            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex flex-column gap-3 mb-4">
                @csrf
                <input type="email" name="email" placeholder="Your email address" required class="form-control waveron-popup-input">
                <button type="submit" class="btn w-100 fw-bold waveron-popup-btn">Subscribe Now</button>
            </form>
            
            <div class="d-flex justify-content-center gap-3 waveron-popup-social">
                <a href="https://www.facebook.com/61563241431145" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>
</div>

<style>
.waveron-popup-overlay {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.waveron-popup-overlay.show {
    display: flex;
    opacity: 1;
}

.waveron-popup-content {
    background-color: var(--waveron-green, #006400);
    color: #fff;
    padding: 3rem;
    border-radius: 12px;
    width: 100%;
    max-width: 450px;
    position: relative;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.waveron-popup-overlay.show .waveron-popup-content {
    transform: translateY(0);
}

.waveron-popup-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.2s;
}

.waveron-popup-close:hover {
    opacity: 1;
}

.waveron-popup-input {
    background-color: rgba(255, 255, 255, 0.1) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    padding: 0.75rem 1rem;
    color: #fff !important;
    text-align: center;
}

.waveron-popup-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.waveron-popup-btn {
    background-color: #fff;
    color: var(--waveron-green, #006400);
    padding: 0.75rem;
    border-radius: 6px;
    transition: all 0.2s;
}

.waveron-popup-btn:hover {
    background-color: #e6e6e6;
    color: var(--waveron-dark-green, #004d00);
}

.waveron-popup-social a {
    color: #fff;
    font-size: 1.2rem;
    opacity: 0.8;
    transition: opacity 0.2s;
}
.waveron-popup-social a:hover {
    opacity: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('waveronNewsletterPopup');
    const closeBtn = document.getElementById('closeWaveronPopup');
    
    const hasStatus = {{ session('newsletter_success') || session('newsletter_error') ? 'true' : 'false' }};
    const isSuccess = {{ session('newsletter_success') ? 'true' : 'false' }};
    
    if (isSuccess) {
        localStorage.setItem('waveronPopupClosed', 'true');
    }
    
    if (hasStatus) {
        popup.classList.add('show');
    } else if (!localStorage.getItem('waveronPopupClosed')) {
        // Show after 3 seconds
        setTimeout(() => {
            popup.classList.add('show');
        }, 3000);
    }
    
    // Close logic
    const closePopup = () => {
        popup.classList.remove('show');
        // Remember that user closed it
        localStorage.setItem('waveronPopupClosed', 'true');
        // Remove from DOM after transition
        setTimeout(() => popup.style.display = 'none', 300);
    };

    closeBtn.addEventListener('click', closePopup);
    
    // Close on outside click
    popup.addEventListener('click', (e) => {
        if(e.target === popup) closePopup();
    });
});
</script>
