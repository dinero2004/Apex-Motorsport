
// Assign variables using class selectors
const modal = document.querySelector('.image-modal');
const modalImg = document.querySelector('.modal-image');
const captionText = document.querySelector('.modal-caption');
const closeBtn = document.querySelector('.close');

// Get all images in the gallery
const galleryImages = document.querySelectorAll('.gallery-image');

// Add click event listeners to each gallery image
galleryImages.forEach(img => {
    img.addEventListener('click', function () {
        modal.style.display = 'block';
        modalImg.src = this.src;
        captionText.textContent = this.alt;
    });
});

// Close the modal when the user clicks on <span> (x)
closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Close the modal when clicking outside of the image
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
