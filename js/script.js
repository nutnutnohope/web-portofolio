// Smooth scrolling for navigation links
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        document.querySelector(targetId).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Animated skill bars
const skillIcons = document.querySelectorAll('.skill-icons span');
skillIcons.forEach(skill => {
    skill.addEventListener('mouseover', function() {
        this.style.transform = 'translateY(-10px) rotate(5deg)';
    });
    skill.addEventListener('mouseout', function() {
        this.style.transform = 'translateY(0) rotate(0)';
    });
});

// Animate elements on scroll
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.project-card, .skill-icons span, #about p');
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
        if (elementTop < windowHeight - 50) {
            element.classList.add('fade-in');
        }
    });
};

// Add scroll event listener
window.addEventListener('scroll', animateOnScroll);

// Dark mode toggle
const createDarkModeToggle = () => {
    const toggle = document.createElement('button');
    toggle.innerHTML = '🌙';
    toggle.className = 'dark-mode-toggle';
    document.body.appendChild(toggle);

    toggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        toggle.innerHTML = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
    });
};

// Typing effect for hero section
const typeWriter = (text, element, speed = 100) => {
    let i = 0;
    element.innerHTML = '';
    const typing = setInterval(() => {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
        } else {
            clearInterval(typing);
        }
    }, speed);
};

// Initialize all features when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    createDarkModeToggle();
    animateOnScroll();
    
    // Typing effect for hero section
    const heroText = document.querySelector('.hero p');
    if (heroText) {
        const originalText = heroText.textContent;
        typeWriter(originalText, heroText);
    }

    // Add animation classes
    document.querySelectorAll('.project-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
        card.classList.add('animate-on-scroll');
    });
});