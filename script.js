/**
 * AlcaOfficial - Main JavaScript
 * Modern Website Development Services
 */

// ===== Theme Management =====
class ThemeManager {
    constructor() {
        this.themeToggle = document.getElementById('themeToggle');
        this.html = document.documentElement;
        this.init();
    }

    init() {
        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        this.setTheme(savedTheme);

        // Add event listener
        if (this.themeToggle) {
            this.themeToggle.addEventListener('click', () => this.toggleTheme());
        }
    }

    setTheme(theme) {
        this.html.classList.toggle('dark', theme === 'dark');
        localStorage.setItem('theme', theme);
    }

    toggleTheme() {
        const newTheme = this.html.classList.contains('dark') ? 'light' : 'dark';
        this.setTheme(newTheme);
    }
}

// ===== Mobile Menu =====
class MobileMenu {
    constructor() {
        this.menuBtn = document.getElementById('mobileMenuBtn');
        this.menu = document.getElementById('mobileMenu');
        this.menuLinks = this.menu?.querySelectorAll('a');
        this.init();
    }

    init() {
        if (this.menuBtn && this.menu) {
            this.menuBtn.addEventListener('click', () => this.toggle());

            // Close menu when clicking links
            this.menuLinks?.forEach(link => {
                link.addEventListener('click', () => this.close());
            });

            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!this.menu.contains(e.target) && !this.menuBtn.contains(e.target)) {
                    this.close();
                }
            });
        }
    }

    toggle() {
        this.menu.classList.toggle('hidden');
    }

    close() {
        this.menu.classList.add('hidden');
    }
}

// ===== Smooth Scroll =====
class SmoothScroll {
    constructor() {
        this.init();
    }

    init() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));

                if (target) {
                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
}

// ===== Scroll to Top Button =====
class ScrollToTop {
    constructor() {
        this.button = document.getElementById('scrollTop');
        this.init();
    }

    init() {
        if (!this.button) return;

        window.addEventListener('scroll', () => this.handleScroll());
        this.button.addEventListener('click', () => this.scrollToTop());
    }

    handleScroll() {
        if (window.pageYOffset > 300) {
            this.button.classList.remove('opacity-0', 'pointer-events-none');
        } else {
            this.button.classList.add('opacity-0', 'pointer-events-none');
        }
    }

    scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
}

// ===== Navbar Scroll Effect =====
class NavbarScroll {
    constructor() {
        this.navbar = document.querySelector('.navbar');
        this.init();
    }

    init() {
        if (!this.navbar) return;

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 50) {
                this.navbar.classList.add('shadow-lg');
            } else {
                this.navbar.classList.remove('shadow-lg');
            }
        });
    }
}

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
        const target = parseFloat(element.textContent);
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += increment;

            if (current < target) {
                element.textContent = Math.floor(current) + (element.dataset.suffix || '');
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + (element.dataset.suffix || '');
            }
        };

        updateCounter();
    }
}

// ===== FAQ Accordion =====
class FAQAccordion {
    constructor() {
        this.faqItems = document.querySelectorAll('.faq-item');
        this.init();
    }

    init() {
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
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('slide-up');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1 }
        );

        this.elements.forEach(element => observer.observe(element));
    }
}

// ===== Form Validation =====
class FormValidator {
    constructor() {
        this.form = document.getElementById('contactForm');
        this.init();
    }

    init() {
        if (!this.form) return;

        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    handleSubmit(e) {
        e.preventDefault();

        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData);

        // Validate
        if (this.validate(data)) {
            this.submitForm(data);
        }
    }

    validate(data) {
        let isValid = true;

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(data.email)) {
            this.showError('email', 'Email tidak valid');
            isValid = false;
        }

        // Phone validation
        const phoneRegex = /^[0-9+\-\s()]+$/;
        if (!phoneRegex.test(data.phone)) {
            this.showError('phone', 'Nomor telepon tidak valid');
            isValid = false;
        }

        return isValid;
    }

    showError(field, message) {
        const input = this.form.querySelector(`[name="${field}"]`);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-500 text-sm mt-1';
        errorDiv.textContent = message;

        // Remove existing error
        const existingError = input.parentElement.querySelector('.text-red-500');
        if (existingError) {
            existingError.remove();
        }

        input.parentElement.appendChild(errorDiv);
        input.classList.add('border-red-500');

        // Remove error on input
        input.addEventListener('input', () => {
            errorDiv.remove();
            input.classList.remove('border-red-500');
        }, { once: true });
    }

    async submitForm(data) {
        // Show loading state
        const submitBtn = this.form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
        submitBtn.disabled = true;

        try {
            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 2000));

            // Success
            this.showSuccess();
            this.form.reset();
        } catch (error) {
            this.showError('general', 'Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    showSuccess() {
        const successDiv = document.createElement('div');
        successDiv.className = 'bg-green-100 dark:bg-green-900 border border-green-500 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg mb-4';
        successDiv.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Pesan berhasil dikirim! Kami akan menghubungi Anda segera.';

        this.form.insertBefore(successDiv, this.form.firstChild);

        setTimeout(() => successDiv.remove(), 5000);
    }
}

// ===== Typing Animation =====
class TypingAnimation {
    constructor(element, texts, speed = 100) {
        this.element = element;
        this.texts = texts;
        this.speed = speed;
        this.textIndex = 0;
        this.charIndex = 0;
        this.isDeleting = false;
        this.init();
    }

    init() {
        if (!this.element) return;
        this.type();
    }

    type() {
        const currentText = this.texts[this.textIndex];

        if (this.isDeleting) {
            this.element.textContent = currentText.substring(0, this.charIndex - 1);
            this.charIndex--;
        } else {
            this.element.textContent = currentText.substring(0, this.charIndex + 1);
            this.charIndex++;
        }

        let typeSpeed = this.speed;

        if (this.isDeleting) {
            typeSpeed /= 2;
        }

        if (!this.isDeleting && this.charIndex === currentText.length) {
            typeSpeed = 2000;
            this.isDeleting = true;
        } else if (this.isDeleting && this.charIndex === 0) {
            this.isDeleting = false;
            this.textIndex = (this.textIndex + 1) % this.texts.length;
            typeSpeed = 500;
        }

        setTimeout(() => this.type(), typeSpeed);
    }
}

// ===== Portfolio Filter =====
class PortfolioFilter {
    constructor() {
        this.filterBtns = document.querySelectorAll('.portfolio-filter-btn');
        this.portfolioItems = document.querySelectorAll('.portfolio-item');
        this.init();
    }

    init() {
        this.filterBtns.forEach(btn => {
            btn.addEventListener('click', () => this.filter(btn.dataset.filter));
        });
    }

    filter(category) {
        // Update active button
        this.filterBtns.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.filter === category);
        });

        // Filter items
        this.portfolioItems.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
                item.classList.add('slide-up');
            } else {
                item.style.display = 'none';
            }
        });
    }
}

// ===== Stats Observer =====
class StatsObserver {
    constructor() {
        this.stats = [
            { current: 0, target: 1250, element: document.getElementById('projectCount'), suffix: '+' },
            { current: 0, target: 950, element: document.getElementById('clientCount'), suffix: '+' },
            { current: 0, target: 4.9, element: document.getElementById('ratingCount'), suffix: '' },
            { current: 0, target: 100, element: document.getElementById('satisfactionCount'), suffix: '%' }
        ];
        this.init();
    }

    init() {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animateStats();
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );

        const statsSection = document.getElementById('statsSection');
        if (statsSection) {
            observer.observe(statsSection);
        }
    }

    animateStats() {
        this.stats.forEach(stat => {
            if (!stat.element) return;

            const increment = stat.target / 100;
            const updateStat = () => {
                stat.current += increment;

                if (stat.current < stat.target) {
                    stat.element.textContent = Math.floor(stat.current) + stat.suffix;
                    requestAnimationFrame(updateStat);
                } else {
                    stat.element.textContent = stat.target + stat.suffix;
                }
            };

            updateStat();
        });
    }
}

// ===== Particle Background =====
class ParticleBackground {
    constructor(canvasId) {
        this.canvas = document.getElementById(canvasId);
        if (!this.canvas) return;

        this.ctx = this.canvas.getContext('2d');
        this.particles = [];
        this.particleCount = 50;
        this.init();
    }

    init() {
        this.resize();
        window.addEventListener('resize', () => this.resize());
        this.createParticles();
        this.animate();
    }

    resize() {
        this.canvas.width = this.canvas.offsetWidth;
        this.canvas.height = this.canvas.offsetHeight;
    }

    createParticles() {
        for (let i = 0; i < this.particleCount; i++) {
            this.particles.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                radius: Math.random() * 2 + 1,
                vx: Math.random() * 0.5 - 0.25,
                vy: Math.random() * 0.5 - 0.25
            });
        }
    }

    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        this.particles.forEach(particle => {
            particle.x += particle.vx;
            particle.y += particle.vy;

            if (particle.x < 0 || particle.x > this.canvas.width) particle.vx *= -1;
            if (particle.y < 0 || particle.y > this.canvas.height) particle.vy *= -1;

            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
            this.ctx.fillStyle = 'rgba(0, 102, 255, 0.5)';
            this.ctx.fill();
        });

        requestAnimationFrame(() => this.animate());
    }
}

// ===== Initialize All Components =====
document.addEventListener('DOMContentLoaded', () => {
    // Core functionality
    new ThemeManager();
    new MobileMenu();
    new SmoothScroll();
    new ScrollToTop();
    new NavbarScroll();

    // Animations
    new CounterAnimation();
    new ScrollAnimations();

    // Interactive components
    new FAQAccordion();
    new FormValidator();

    // Optional: Typing animation for hero
    const typingElement = document.getElementById('typingText');
    if (typingElement) {
        new TypingAnimation(
            typingElement,
            [
                'Website Professional',
                'E-Commerce Modern',
                'Landing Page Menarik',
                'Company Profile',
                'Sistem Informasi'
            ]
        );
    }

    // Optional: Portfolio filter
    const hasPortfolioFilter = document.querySelector('.portfolio-filter-btn');
    if (hasPortfolioFilter) {
        new PortfolioFilter();
    }
});

// ===== Utility Functions =====

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Format currency
function formatCurrency(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
}

// Copy to clipboard
async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        return true;
    } catch (err) {
        console.error('Failed to copy:', err);
        return false;
    }
}

// Export for use in other scripts
export {
    ThemeManager,
    MobileMenu,
    SmoothScroll,
    ScrollToTop,
    CounterAnimation,
    FAQAccordion,
    FormValidator,
    TypingAnimation,
    debounce,
    throttle,
    formatCurrency,
    copyToClipboard
};