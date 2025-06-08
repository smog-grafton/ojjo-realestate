import './bootstrap';

// Custom JavaScript for OjjoEstates - Template compatibility mode

document.addEventListener('DOMContentLoaded', function() {
    // Wait for template scripts to load first
    setTimeout(function() {
        
        // Only add functionality that doesn't conflict with template
        console.log('OjjoEstates app.js loaded - Template mode');
        
        // Custom smooth scrolling (non-conflicting)
        const customLinks = document.querySelectorAll('a[href^="#custom-"]');
        customLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
    }, 500); // Give template time to initialize
});

// Let the template handle page loading
console.log('Laravel app.js initialized in template compatibility mode');
