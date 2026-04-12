import './styles/app.css';

const toggle = document.getElementById('nav-toggle');
const mobileLinks = document.querySelectorAll('[data-nav-close]');

mobileLinks.forEach((link) => {
    link.addEventListener('click', () => {
        if (toggle instanceof HTMLInputElement) {
            toggle.checked = false;
        }
    });
});

/** Reveal elements on scroll (respects prefers-reduced-motion via CSS) */
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

function initScrollReveals() {
    if (prefersReducedMotion.matches) {
        document.querySelectorAll('.scroll-reveal').forEach((el) => {
            el.classList.add('is-visible');
        });
        return;
    }

    const elements = document.querySelectorAll('.scroll-reveal:not(.is-visible)');
    if (elements.length === 0) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            root: null,
            rootMargin: '0px 0px -8% 0px',
            threshold: 0.08,
        },
    );

    elements.forEach((el) => observer.observe(el));
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollReveals);
} else {
    initScrollReveals();
}
