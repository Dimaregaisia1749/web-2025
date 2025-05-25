const modal = document.querySelector('.modal');
const modalImagesContainer = modal.querySelector('.modal__images');
const modalCounter = modal.querySelector('.modal__counter');
const arrows = modal.querySelectorAll('.modal__arrow');
const leftArrowIcon = modal.querySelector('.modal__arrow-left').querySelector('.modal__arrow-icon');
const rightArrowIcon = modal.querySelector('.modal__arrow-right').querySelector('.modal__arrow-icon');

document.querySelectorAll('.post__image').forEach(img => {
    img.addEventListener('click', () => {      
        document.body.style.overflow = 'hidden';
        const post = img.closest('.post');
        const images = Array.from(post.querySelectorAll('.post__image'));
        let currentIndex = 0;

        function showImage(index) {
            const modalImages = modal.querySelectorAll('.modal__image');
            currentIndex = (index + modalImages.length) % modalImages.length;
            modalImages.forEach(img => img.classList.remove('modal__image_active'));
            modalImages.forEach(img => img.classList.add('modal__image_disabled'));
            modalImages[currentIndex].classList.add('modal__image_active');
            modalImages[currentIndex].classList.remove('modal__image_disabled');
            if (images.length > 1) {
                modalCounter.textContent = `${currentIndex + 1}/${modalImages.length}`;
                if (currentIndex === 0) {
                    leftArrowIcon.classList.add('modal__arrow-icon_dark');
                    rightArrowIcon.classList.remove('modal__arrow-icon_dark');
                }
                else if (currentIndex === modalImages.length - 1) {
                    rightArrowIcon.classList.add('modal__arrow-icon_dark');
                    leftArrowIcon.classList.remove('modal__arrow-icon_dark');
                }
                else {
                    leftArrowIcon.classList.remove('modal__arrow-icon_dark');
                    rightArrowIcon.classList.remove('modal__arrow-icon_dark');
                }
            }
            else {
                modalCounter.classList.add('modal__arrow-disabled');
                leftArrowIcon.classList.add('modal__arrow-disabled');
                rightArrowIcon.classList.add('modal__arrow-disabled');
            }
        }

        function closeModal() {
            modal.classList.add('modal_disabled');
            modal.classList.remove('modal_active');
            document.body.style.overflow = 'auto';
        }

        currentIndex = images.findIndex(img => img.classList.contains('post__image_active'));

        modalImagesContainer.innerHTML = images.map((img, index) => `
                <img src="${img.src}" class="modal__image modal__image_disabled">
            `).join('');
        if (images.length > 1) {
            modalCounter.textContent = `${currentIndex + 1} из ${images.length}`;
            arrows.forEach(arrow => arrow.classList.remove('modal__arrow_disabled'));
        } 
        else {
            modalCounter.textContent = '';
            arrows.forEach(arrow => arrow.classList.add('modal__arrow_disabled'));
        }
        
        showImage(currentIndex);

        modal.classList.add('modal_active');
        modal.classList.remove('modal_disabled');

        modal.querySelector('.modal__close').addEventListener('click', closeModal);

        modal.querySelector('.modal__arrow-left').addEventListener('click', () => showImage(currentIndex - 1));
        modal.querySelector('.modal__arrow-right').addEventListener('click', () => showImage(currentIndex + 1));

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    });
});