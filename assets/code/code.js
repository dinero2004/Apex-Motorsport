// Accordion code
document.addEventListener("DOMContentLoaded", () => {
    const accordionItems = document.querySelectorAll(".accordion-item");

    accordionItems.forEach(item => {
        const header = item.querySelector(".accordion-header");
        const content = item.querySelector(".accordion-content");
        const viewMoreButton = item.querySelector(".view-more");

        header.addEventListener("click", () => {
            const isOpen = content.style.maxHeight;
            content.style.maxHeight = isOpen ? null : `${content.scrollHeight}px`;
        });

        viewMoreButton.addEventListener("click", () => {
            const isOpen = content.style.maxHeight;
            content.style.maxHeight = isOpen ? null : `${content.scrollHeight}px`;
            viewMoreButton.textContent = isOpen ? "View More" : "View Less";
        });
    });
});

// Hamburger Menu Functionality Code 

    // JavaScript to handle dropdown toggle and image display
    const hamburger = document.querySelector('.hamburger');
    const dropdown = document.getElementById('dropdown');
    const links = document.querySelectorAll('.links-container a');
    const images = document.querySelectorAll('.image-container img');

    // Toggle dropdown visibility
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        dropdown.classList.toggle('show');
    });

    // Change active image on link hover
    links.forEach(link => {
        link.addEventListener('mouseenter', () => {
            const imageId = link.dataset.image;
            images.forEach(img => img.classList.remove('active'));
            document.getElementById(imageId).classList.add('active');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target) && !hamburger.contains(e.target)) {
            dropdown.classList.remove('show');
            hamburger.classList.remove('active');
        }
    });


// Explore section animations
document.addEventListener("DOMContentLoaded", function () {
    gsap.registerPlugin(TextPlugin, ScrollTrigger);

    const bannerTimeline = gsap.timeline();
    bannerTimeline
        .from(".hero-text h1", { duration: 1, y: -50, opacity: 0, ease: "linear" })
        .from(".hero-text h2", { duration: 2, y: -400, opacity: 0, ease: "linear" }, "-=0.5");

    gsap.set('.explore-overlay', { opacity: 1 });
    gsap.set('.explore-section h2', { y: -100, opacity: 0 });
    gsap.set('.explore-section .explore-text p', { y: 50, opacity: 0 });

    ScrollTrigger.create({
        trigger: '.explore-section',
        start: 'top 80%',
        end: 'bottom 20%',
        scrub: true,
        onEnter: animateIn,
        onLeave: animateOut,
        onEnterBack: animateIn,
        onLeaveBack: animateOut,
    });

    function animateIn() {
        gsap.to('.explore-overlay', { opacity: 0, duration: 0.5 });
        gsap.to('.explore-section h2', { y: 0, opacity: 1, duration: 0.5, ease: 'power1.out', delay: 0.2 });
        gsap.to('.explore-section .explore-text p', { y: 0, opacity: 1, duration: 0.5, ease: 'power1.out', delay: 0.6 });
    }

    function animateOut() {
        gsap.to('.explore-section h2', { y: -100, opacity: 0, duration: 0.5, ease: 'power1.in' });
        gsap.to('.explore-section .explore-text p', { y: 50, opacity: 0, duration: 0.5, ease: 'power1.in', delay: 0.4 });
        gsap.to('.explore-overlay', { opacity: 1, duration: 0.5, delay: 0.4 });
    }
});

// Sidebar animations

    // JavaScript to open and close the sidebar
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("show"); // Toggle the "show" class
    }
