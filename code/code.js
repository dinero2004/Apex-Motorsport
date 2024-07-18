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

// gsap banner animation for the hero-section

document.addEventListener("DOMContentLoaded", function () {
    gsap.registerPlugin(TextPlugin);
    
    const tl = gsap.timeline();
  
    tl.from(
      ".banner-text h1",
      { duration: 1, y: -50, opacity: 1, ease: "linear" }
    )
    .to(".banner-text h1", {
      duration: 2,
      ease: "none",
      text: "Your way to Luxury Cars",
    })
  });
  
  
  document.addEventListener("DOMContentLoaded", function () {
    gsap.registerPlugin(TextPlugin);
  
    const tl = gsap.timeline();
  
    tl.to(".overlay", { duration: 1, opacity: 0.5 })
      .from(
        ".explore-section h2",
        { duration: 1, y: -50, opacity: 0, ease: "linear" },
        "-=0.5"
      )
      .from(
        ".explore-section p",
        {
          duration: 1,
          y: 50,
          opacity: 0,
          ease: "linear"
        },
        "-=0.5"
      )
  });

//   explore section animations

document.addEventListener("DOMContentLoaded", function () {
    gsap.registerPlugin(TextPlugin, ScrollTrigger);

    // Set initial states to avoid flickering
    gsap.set('.explore-overlay', { opacity: 1 });
    gsap.set('.explore-section h2', { y: -100, opacity: 0 });
    gsap.set('.explore-section .explore-text p', { y: 50, opacity: 0 });

    // ScrollTrigger instance for entering
    ScrollTrigger.create({
        trigger: '.explore-section',
        start: 'top 80%',
        end: 'top 40%',
        scrub: true,
        onEnter: animateIn,
        onLeave: animateOut,
    });

    function animateIn() {
        gsap.to('.explore-overlay', { opacity: 0, duration: 1 });
        gsap.to('.explore-section h2', { y: 0, opacity: 1, duration: 1, ease: 'linear', delay: 0.5 });
        gsap.to('.explore-section .explore-text p', { y: 0, opacity: 1, duration: 1, ease: 'linear', delay: 1 });
    }

    function animateOut() {
        gsap.to('.explore-section h2', { y: -100, opacity: 0, duration: 1, ease: 'linear' });
        gsap.to('.explore-section .explore-text p', { y: 50, opacity: 0, duration: 1, ease: 'linear', delay: 0.5 });
        gsap.to('.explore-overlay', { opacity: 1, duration: 1, delay: 1 });
    }
});

