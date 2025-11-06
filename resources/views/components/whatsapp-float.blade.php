{{-- WhatsApp Float Button Component --}}
<div class="whatsapp-float" id="whatsappFloat">
    <a href="https://wa.me/6288101018577?text=Halo%20AlcaOfficial,%20saya%20ingin%20konsultasi%20tentang%20pembuatan%20website"
       target="_blank"
       rel="noopener noreferrer"
       class="whatsapp-button"
       aria-label="Chat via WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-text">Chat Kami</span>
    </a>

    {{-- Tooltip/Popup --}}
    <div class="whatsapp-tooltip" id="whatsappTooltip">
        <button class="whatsapp-tooltip-close" onclick="closeWhatsappTooltip()" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <div class="flex items-center mb-3">
            <div class="whatsapp-avatar">
                <img src="{{ asset('alca.webp') }}" alt="AlcaOfficial" class="rounded-full">
            </div>
            <div class="ml-3">
                <p class="font-bold text-gray-900 dark:text-white">AlcaOfficial</p>
                <p class="text-xs text-green-600 dark:text-green-400">
                    <i class="fas fa-circle text-xs mr-1"></i> Online
                </p>
            </div>
        </div>
        <p class="text-sm text-gray-700 dark:text-gray-200 mb-4">
            Halo! Ada yang bisa kami bantu? 👋
        </p>
        <a href="https://wa.me/6288101018577?text=Halo%20AlcaOfficial,%20saya%20ingin%20konsultasi%20tentang%20pembuatan%20website"
           target="_blank"
           class="whatsapp-tooltip-button">
            <i class="fab fa-whatsapp mr-2"></i> Mulai Chat
        </a>
    </div>
</div>

<script>
    // Auto-show tooltip after 5 seconds
    setTimeout(() => {
        const tooltip = document.getElementById('whatsappTooltip');
        if (tooltip && !localStorage.getItem('whatsappTooltipClosed')) {
            tooltip.classList.add('show');
        }
    }, 5000);

    // Close tooltip function
    function closeWhatsappTooltip() {
        const tooltip = document.getElementById('whatsappTooltip');
        if (tooltip) {
            tooltip.classList.remove('show');
            localStorage.setItem('whatsappTooltipClosed', 'true');
        }
    }

    // Show WhatsApp button on scroll
    window.addEventListener('scroll', () => {
        const whatsappFloat = document.getElementById('whatsappFloat');
        if (whatsappFloat) {
            if (window.scrollY > 300) {
                whatsappFloat.classList.add('visible');
            } else {
                whatsappFloat.classList.remove('visible');
            }
        }
    });
</script>
