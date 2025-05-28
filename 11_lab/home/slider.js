document.querySelectorAll('.post__carousel').forEach(carousel => {
    const images = carousel.querySelectorAll('.post__image');
    const prevBtn = carousel.querySelector('.post__arrow-left');
    const nextBtn = carousel.querySelector('.post__arrow-right');
    const counter = carousel.querySelector('.post__counter');
    const leftArrowIcon = prevBtn.querySelector('.post__arrow-icon');
    const rightArrowIcon = nextBtn.querySelector('.post__arrow-icon');

    let currentIndex = 0;
    
    function showImage(index) {
        currentIndex = (index + images.length) % images.length;
        images.forEach(img => img.classList.remove('post__image_active'));
        images.forEach(img => img.classList.add('post__image_disabled'));
        images[currentIndex].classList.add('post__image_active');
        images[currentIndex].classList.remove('post__image_disabled');
        if (images.length > 1) {
            counter.textContent = `${currentIndex + 1}/${images.length}`;
            if (currentIndex === 0) {
                leftArrowIcon.classList.add('post__arrow-icon_dark');
                rightArrowIcon.classList.remove('post__arrow-icon_dark');
            }
            else if (currentIndex === images.length - 1) {
                rightArrowIcon.classList.add('post__arrow-icon_dark');
                leftArrowIcon.classList.remove('post__arrow-icon_dark');
            }
            else {
                leftArrowIcon.classList.remove('post__arrow-icon_dark');
                rightArrowIcon.classList.remove('post__arrow-icon_dark');
            }
        }
        else {
            counter.classList.add('post__arrow-disabled');
            leftArrowIcon.classList.add('post__arrow-disabled');
            rightArrowIcon.classList.add('post__arrow-disabled');
        }
    }

    showImage(0);

    if (prevBtn) {
        prevBtn.addEventListener('click', () => showImage(currentIndex - 1));
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => showImage(currentIndex + 1));
    }
});