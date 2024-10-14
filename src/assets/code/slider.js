let slideIndex = 1;
let playing = true;
let slideInterval;

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("slides");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  
}

function plusSlides(n) {
  showSlides(slideIndex += n);
  resetInterval();
}

function currentSlide(n) {
  showSlides(slideIndex = n);
  resetInterval();
}

function togglePlay() {
  let button = document.querySelector('.pausePlay');
  if (playing) {
    clearInterval(slideInterval);
    button.innerHTML = 'Play';
  } else {
    slideInterval = setInterval(function() { plusSlides(1); }, 3000);
    button.innerHTML = 'Pause';
  }
  playing = !playing;
}

function resetInterval() {
  if (playing) {
    clearInterval(slideInterval);
    slideInterval = setInterval(function() { plusSlides(1); }, 3000);
  }
}

showSlides(slideIndex);
slideInterval = setInterval(function() { plusSlides(1); }, 3000);
