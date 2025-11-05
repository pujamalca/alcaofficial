/**
 * Navigation JavaScript - Extracted from Frontend
 * Interactive navigation functionality
 */

'use strict';

// ===== Theme Management =====
class ThemeManager {
    constructor() {
        this.themeToggle = document.getElementById('themeToggle');
        this.html = document.documentElement;
        this.prefersDarkQuery = window.matchMedia('(prefers-color-scheme: dark)');
        this.sunIcon = this.themeToggle?.querySelector('[data-theme-icon="sun"]');
        this.moonIcon = this.themeToggle?.querySelector('[data-theme-icon="moon"]');
        this.init();
    }

    init() {
        // Load saved theme or detect system preference
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = this.prefersDarkQuery.matches;
        const initialTheme = savedTheme || (systemPrefersDark ? 'dark' : 'light');

        this.applyTheme(initialTheme);

        if (!savedTheme) {
            localStorage.setItem('theme', initialTheme);
        }

        // Add event listener
        if (this.themeToggle) {
            this.themeToggle.addEventListener('click', () => this.toggleTheme());
        }

        // Listen for system theme changes
        this.prefersDarkQuery.addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                this.applyTheme(e.matches ? 'dark' : 'light');
            }
        });
    }

    applyTheme(theme) {
        if (theme === 'dark') {
            this.html.classList.add('dark');
        } else {
            this.html.classList.remove('dark');
        }

        this.updateToggleButton(theme);
    }

    setTheme(theme) {
        localStorage.setItem('theme', theme);
        this.applyTheme(theme);
    }

    updateToggleButton(theme) {
        if (!this.themeToggle) return;

        this.themeToggle.dataset.theme = theme;
        this.themeToggle.setAttribute(
            'aria-label',
            theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode'
        );

        if (this.sunIcon && this.moonIcon) {
            if (theme === 'dark') {
                this.sunIcon.classList.remove('is-hidden');
                this.moonIcon.classList.add('is-hidden');
            } else {
                this.sunIcon.classList.add('is-hidden');
                this.moonIcon.classList.remove('is-hidden');
            }
        }
    }

    toggleTheme() {
        const newTheme = this.html.classList.contains('dark') ? 'light' : 'dark';
        this.setTheme(newTheme);

        // Add transition effect
        document.body.style.transition = 'all 0.3s ease';
        setTimeout(() => {
            document.body.style.transition = '';
        }, 300);
    }
}

// ===== Mobile Menu =====
class MobileMenu {
    constructor() {
        this.menuBtn = document.getElementById('mobileMenuBtn');
        this.menu = document.getElementById('mobileMenu');
        this.menuLinks = this.menu?.querySelectorAll('a');
        this.icon = this.menuBtn?.querySelector('i');
        this.init();
    }

    init() {
        if (this.menuBtn && this.menu) {
            this.setInitialState();

            this.menuBtn.addEventListener('click', () => this.toggle());

            // Close menu when clicking links
            this.menuLinks?.forEach(link => {
                link.addEventListener('click', () => this.close());
            });

            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (this.menu.dataset.state !== 'open') return;
                if (!this.menu.contains(e.target) && !this.menuBtn.contains(e.target)) {
                    this.close();
                }
            });
        }
    }

    setInitialState() {
        const isHidden = this.menu.classList.contains('hidden');
        this.menu.dataset.state = isHidden ? 'closed' : 'open';
        this.menu.style.display = isHidden ? 'none' : 'block';
        this.menuBtn.setAttribute('aria-expanded', isHidden ? 'false' : 'true');
        this.updateIcon(!isHidden);
    }

    toggle() {
        if (this.menu.dataset.state === 'open') {
            this.close();
        } else {
            this.open();
        }
    }

    open() {
        this.menu.classList.remove('hidden');
        this.menu.dataset.state = 'open';
        this.menu.style.display = 'block';
        this.menuBtn.setAttribute('aria-expanded', 'true');
        this.updateIcon(true);
    }

    updateIcon(isOpen) {
        if (!this.icon) return;
        this.icon.classList.toggle('fa-bars', !isOpen);
        this.icon.classList.toggle('fa-times', isOpen);
    }

    close() {
        this.menu.classList.add('hidden');
        this.menu.dataset.state = 'closed';
        this.menu.style.display = 'none';
        this.menuBtn.setAttribute('aria-expanded', 'false');
        this.updateIcon(false);
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
                const href = anchor.getAttribute('href');
                if (href === '#' || href === '#!') return;

                e.preventDefault();
                const target = document.querySelector(href);

                if (target) {
                    const offsetTop = target.offsetTop - 80; // 80px offset for navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobileMenu');
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        const icon = document.querySelector('#mobileMenuBtn i');
                        if (icon) {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    }
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
        if (window.pageYOffset > 500) {
            this.button.classList.remove('opacity-0', 'pointer-events-none');
            this.button.classList.add('opacity-100');
        } else {
            this.button.classList.add('opacity-0', 'pointer-events-none');
            this.button.classList.remove('opacity-100');
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
            if (window.pageYOffset > 100) {
                this.navbar.classList.add('scrolled');
            } else {
                this.navbar.classList.remove('scrolled');
            }
        });
    }
}

// ===== Active Link Detection =====
class ActiveLinkDetector {
    constructor() {
        this.sections = document.querySelectorAll('section[id]');
        this.navLinks = document.querySelectorAll('.nav-link');
        this.init();
    }

    init() {
        if (this.sections.length === 0 || this.navLinks.length === 0) return;

        window.addEventListener('scroll', () => this.updateActiveLink());

        // Initial check
        this.updateActiveLink();
    }

    updateActiveLink() {
        let current = '';

        this.sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;

            // Check if section is in viewport
            if (window.pageYOffset >= sectionTop - 100) {
                current = section.getAttribute('id');
            }
        });

        // Update active state
        this.navLinks.forEach(link => {
            link.classList.remove('text-blue-600');
            const href = link.getAttribute('href');

            // Check if link matches current section
            if (href === `#${current}` || href === `/#${current}`) {
                link.classList.add('text-blue-600');
            }
        });
    }
}

// ===== Initialize Everything =====
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all navigation components
    new ThemeManager();
    new MobileMenu();
    new SmoothScroll();
    new ScrollToTop();
    new NavbarScroll();
    new ActiveLinkDetector();

    console.log('✓ Navigation initialized successfully');
});

// Export for module use (if needed)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        ThemeManager,
        MobileMenu,
        SmoothScroll,
        ScrollToTop,
        NavbarScroll,
        ActiveLinkDetector
    };
}
