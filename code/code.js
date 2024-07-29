// Navigation functions

const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
});

document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}));

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
        end: 'top 40%',
        scrub: true,
        onEnter: animateIn,
        onLeaveBack: animateOut,
        once: true, // Ensure it only animates once
    });
  
    function animateIn() {
        gsap.to('.explore-overlay', { opacity: 0, duration: 1 });
        gsap.to('.explore-section h2', { y: 0, opacity: 1, duration: 1, ease: 'power1.out', delay: 0.2 });
        gsap.to('.explore-section .explore-text p', { y: 0, opacity: 1, duration: 1, ease: 'power1.out', delay: 0.4 });
    }
  
    function animateOut() {
        gsap.to('.explore-section h2', { y: -100, opacity: 0, duration: 1, ease: 'power1.in' });
        gsap.to('.explore-section .explore-text p', { y: 50, opacity: 0, duration: 1, ease: 'power1.in', delay: 0.2 });
        gsap.to('.explore-overlay', { opacity: 1, duration: 1, delay: 0.4 });
    }
  });
  