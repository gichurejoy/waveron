<!-- Floating WhatsApp Action Button -->
<a href="https://wa.me/254798717800?text=Hi%20Waveron%2C%20I%27d%20like%20to%20discuss%20a%20project." 
   target="_blank" 
   rel="noopener" 
   aria-label="Chat with Waveron on WhatsApp"
   id="floating-whatsapp-btn"
   class="position-fixed shadow-lg d-flex justify-content-center align-items-center text-white text-decoration-none rounded-circle"
   title="Chat with us"
   data-bs-toggle="tooltip"
   data-bs-placement="left">
    <i class="bi bi-whatsapp" style="font-size: 1.6rem;"></i>
    <span class="whatsapp-tooltip-label">Chat with us</span>
</a>

<style>
    #floating-whatsapp-btn {
        bottom: 96px;
        right: 28px;
        width: 56px;
        height: 56px;
        background-color: #25D366;
        z-index: 1040;
        transition: transform 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
    }

    #floating-whatsapp-btn:hover {
        background-color: #20bd5a;
        transform: scale(1.08) translateY(-2px);
        box-shadow: 0 10px 24px rgba(37, 211, 102, 0.4) !important;
        color: #ffffff !important;
    }

    .whatsapp-tooltip-label {
        position: absolute;
        right: 68px;
        background: #1e293b;
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease, transform 0.2s ease;
        transform: translateX(6px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .whatsapp-tooltip-label::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -5px;
        transform: translateY(-50%);
        border-width: 5px 0 5px 5px;
        border-style: solid;
        border-color: transparent transparent transparent #1e293b;
    }

    #floating-whatsapp-btn:hover .whatsapp-tooltip-label {
        opacity: 1;
        transform: translateX(0);
    }

    @media (max-width: 576px) {
        #floating-whatsapp-btn {
            bottom: 92px;
            right: 20px;
            width: 50px;
            height: 50px;
        }
        #floating-whatsapp-btn i {
            font-size: 1.4rem !important;
        }
        .whatsapp-tooltip-label {
            display: none;
        }
    }
</style>
