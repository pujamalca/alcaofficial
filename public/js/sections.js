/**
 * Sections JavaScript - Frontend Sections Functionality
 * Counter animations, scroll animations, and interactive features
 */

'use strict';

// ===== Counter Animation =====
class CounterAnimation {
    constructor() {
        this.counters = document.querySelectorAll('.counter');
        this.animated = new Set();
        this.init();
    }

    init() {
        if (this.counters.length === 0) return;

        const observer = new IntersectionObserver(
            (entries) => this.handleIntersection(entries),
            { threshold: 0.5 }
        );

        this.counters.forEach(counter => observer.observe(counter));
    }

    handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !this.animated.has(entry.target)) {
                this.animateCounter(entry.target);
                this.animated.add(entry.target);
            }
        });
    }

    animateCounter(element) {
        const target = parseFloat(element.dataset.target || element.textContent);
        const suffix = element.dataset.suffix || '';
        const decimals = parseInt(element.dataset.decimals || '0');
        const duration = 2000;
        const frameDuration = 1000 / 60;
        const totalFrames = Math.round(duration / frameDuration);
        let frame = 0;

        const counter = setInterval(() => {
            frame++;
            const progress = frame / totalFrames;
            const currentCount = target * progress;

            element.textContent = currentCount.toFixed(decimals) + suffix;

            if (frame === totalFrames) {
                clearInterval(counter);
                element.textContent = target.toFixed(decimals) + suffix;
            }
        }, frameDuration);
    }
}

// ===== Intersection Observer for Animations =====
class ScrollAnimations {
    constructor() {
        this.elements = document.querySelectorAll('.animate-on-scroll');
        this.init();
    }

    init() {
        if (this.elements.length === 0) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        // Add stagger delay
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
        );

        this.elements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            observer.observe(element);
        });
    }
}

// ===== FAQ Accordion =====
class FAQAccordion {
    constructor() {
        this.faqItems = document.querySelectorAll('.faq-item');
        this.init();
    }

    init() {
        if (this.faqItems.length === 0) return;

        this.faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');

            question?.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all items
                this.faqItems.forEach(i => i.classList.remove('active'));

                // Open clicked item if it wasn't active
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
    }
}

// ===== Portfolio Filter =====
class PortfolioFilter {
    constructor() {
        this.filterButtons = document.querySelectorAll('[data-filter]');
        this.portfolioItems = document.querySelectorAll('[data-category]');
        this.init();
    }

    init() {
        if (this.filterButtons.length === 0) return;

        this.filterButtons.forEach(button => {
            button.addEventListener('click', () => this.filter(button));
        });
    }

    filter(button) {
        const filterValue = button.dataset.filter;

        // Update active button
        this.filterButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        // Filter items
        this.portfolioItems.forEach((item, index) => {
            const category = item.dataset.category;

            if (filterValue === 'all' || category === filterValue) {
                setTimeout(() => {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                }, index * 50);
            } else {
                item.style.opacity = '0';
                item.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 300);
            }
        });
    }
}

// ===== Contact Form =====
class ContactForm {
    constructor() {
        this.form = document.getElementById('contactForm');
        this.init();
    }

    init() {
        if (!this.form) return;

        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        // Real-time validation
        const inputs = this.form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
        });
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'Field ini wajib diisi';
        } else if (field.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                errorMessage = 'Format email tidak valid';
            }
        } else if (field.type === 'tel' && value) {
            const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
            if (!phoneRegex.test(value)) {
                isValid = false;
                errorMessage = 'Format nomor telepon tidak valid';
            }
        }

        this.showFieldError(field, isValid, errorMessage);
        return isValid;
    }

    showFieldError(field, isValid, errorMessage) {
        const errorElement = field.parentElement.querySelector('.error-message');

        if (isValid) {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300');
            if (errorElement) errorElement.remove();
        } else {
            field.classList.add('border-red-500');
            field.classList.remove('border-gray-300');

            if (!errorElement) {
                const error = document.createElement('p');
                error.className = 'error-message text-red-500 text-sm mt-1';
                error.textContent = errorMessage;
                field.parentElement.appendChild(error);
            }
        }
    }

    async handleSubmit(e) {
        e.preventDefault();

        // Validate all fields
        const inputs = this.form.querySelectorAll('input, textarea, select');
        let allValid = true;

        inputs.forEach(input => {
            if (!this.validateField(input)) {
                allValid = false;
            }
        });

        if (!allValid) return;

        // Get form data
        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData);

        // Show loading state
        const submitButton = this.form.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';

        try {
            // Submit to server
            const response = await fetch(this.form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                this.showSuccessMessage('Pesan berhasil dikirim! Kami akan menghubungi Anda segera.');
                this.form.reset();
            } else {
                this.showErrorMessage(result.message || 'Terjadi kesalahan. Silakan coba lagi.');
            }
        } catch (error) {
            this.showErrorMessage('Terjadi kesalahan. Silakan coba lagi.');
            console.error('Form submission error:', error);
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        }
    }

    showSuccessMessage(message) {
        this.showNotification(message, 'success');
    }

    showErrorMessage(message) {
        this.showNotification(message, 'error');
    }

    showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-24 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-all transform translate-x-full ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } text-white`;
        notification.innerHTML = `
            <div class="flex items-center gap-3">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-xl"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);

        // Auto remove after 4 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(full)';
            setTimeout(() => notification.remove(), 300);
        }, 4000);
    }
}

// ===== WhatsApp Float Button =====
class WhatsAppFloat {
    constructor() {
        this.button = document.getElementById('whatsappFloat');
        this.init();
    }

    init() {
        if (!this.button) return;

        window.addEventListener('scroll', () => this.handleScroll());
    }

    handleScroll() {
        if (window.pageYOffset > 500) {
            this.button.classList.remove('opacity-0', 'pointer-events-none');
            this.button.classList.add('opacity-100');
        } else {
            this.button.classList.add('opacity-0', 'pointer-events-none');
            this.button.classList.remove('opacity-100');
        }
    }
}

// ===== Initialize Everything =====
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all section components
    new CounterAnimation();
    new ScrollAnimations();
    new FAQAccordion();
    new PortfolioFilter();
    new ContactForm();
    new WhatsAppFloat();

    console.log('✓ Sections initialized successfully');
});

// Export for module use (if needed)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        CounterAnimation,
        ScrollAnimations,
        FAQAccordion,
        PortfolioFilter,
        ContactForm,
        WhatsAppFloat
    };
}
