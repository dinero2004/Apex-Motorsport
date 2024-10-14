document.querySelectorAll('.image-container').forEach(container => {
    const currentImage = container.querySelector('.main-img img');
    const allImages = container.querySelectorAll('.images img');
    const opacity = 0.3;


    if (allImages.length > 0) {
        allImages[0].style.opacity = opacity;
    }

    allImages.forEach(element => {
        element.addEventListener('click', event => {

            if (currentImage.src === event.target.src) {
                return;
            }


            allImages.forEach(img => {
                img.style.opacity = 1;
            });


            currentImage.src = event.target.src;


            currentImage.classList.add('fade-in');


            setTimeout(() => {
                currentImage.classList.remove('fade-in');
            }, 500);


            event.target.style.opacity = opacity;
        });
    });
});
