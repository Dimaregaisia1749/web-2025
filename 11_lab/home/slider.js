document.querySelectorAll('.post__carousel').forEach(carousel => {
    const images = carousel.querySelectorAll('.post__image');
    const prevBtn = carousel.querySelector('.post__arrow-left');
    const nextBtn = carousel.querySelector('.post__arrow-right');
    const counter = carousel.querySelector('.post__counter');
    let currentIndex = 0;

    function showImage(index) {
        currentIndex = (index + images.length) % images.length;
        images.forEach(img => img.classList.remove('post__image_active'));
        images.forEach(img => img.classList.add('post__image_disabled'));
        images[currentIndex].classList.add('post__image_active');
        images[currentIndex].classList.remove('post__image_disabled');
        if (counter) {
            counter.textContent = `${currentIndex + 1}/${images.length}`;
        }
    }

    if (counter) {
        counter.textContent = `1/${images.length}`;
    }

    showImage(0);

    if (prevBtn) {
        prevBtn.addEventListener('click', () => showImage(currentIndex - 1));
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => showImage(currentIndex + 1));
    }
});