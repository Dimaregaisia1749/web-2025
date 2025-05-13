const MAX_WIDTH = 474;
const MAX_HEIGHT = 474;

const fileInput = document.querySelector('.file-input');
const imagePlaceholder = document.querySelector('.add-post__image-placeholder');
const btnAddFirst = document.querySelector('.btn-upload_first');
const btnAddSecond = document.querySelector('.btn-upload_second');
const imagesContainer = document.querySelector('.add-post__images');
const contentInput = document.querySelector('.add-post__text');
const shareBtn = document.querySelector('.btn-share');
const arrows = document.querySelectorAll('.add-post__arrow');
const imagesCounter = document.querySelector('.add-post__counter');
const leftArrowIcon = document.querySelector('.add-post__arrow-left').querySelector('.add-post__arrow-icon');
const rightArrowIcon = document.querySelector('.add-post__arrow-right').querySelector('.add-post__arrow-icon');;


let currentIndex = 0;
let images = [];
let content = '';

function updateShareButton() {
    if (images.length > 0 && content.trim() !== '') {
        shareBtn.classList.remove('btn-share_disabled');
    } 
    else {
        shareBtn.classList.add('btn-share_disabled');
    }
}

function showImage(index) {
    const postImages = document.querySelectorAll('.add-post__image');
    currentIndex = (index + postImages.length) % postImages.length;
    postImages.forEach(img => img.classList.add('add-post__image_disabled'));
    postImages[currentIndex].classList.remove('add-post__image_disabled');
    if (images.length > 1) {
        imagesCounter.textContent = `${currentIndex + 1} из ${postImages.length}`;
    }

    if (currentIndex === 0) {
        leftArrowIcon.classList.add('add-post__arrow-icon_dark');
        rightArrowIcon.classList.remove('add-post__arrow-icon_dark');
    }
    else if (currentIndex === images.length - 1) {
        rightArrowIcon.classList.add('add-post__arrow-icon_dark');
        leftArrowIcon.classList.remove('add-post__arrow-icon_dark');
    }
    else {
        leftArrowIcon.classList.remove('add-post__arrow-icon_dark');
        rightArrowIcon.classList.remove('add-post__arrow-icon_dark');
    }
}

function updateArrowsAndCounter() {
    if (images.length > 1) {
        imagesCounter.textContent = `${currentIndex + 1} из ${images.length}`;
        arrows.forEach(arrow => arrow.classList.remove('add-post__arrow_disabled'));
        imagesCounter.classList.remove('add-post__counter_disabled');
    }
    else {
        imagesCounter.textContent = '';
        arrows.forEach(arrow => arrow.classList.add('add-post__arrow_disabled'));
        imagesCounter.classList.add('add-post__counter_disabled');
    }
}

function addImages(files) {
    files.forEach(file => {
        const reader = new FileReader();
        reader.addEventListener("load", (e) => {
            images.push(e.target.result);
            imagesContainer.innerHTML += `
                <img src="${e.target.result}" class="add-post__image add-post__image_disabled">
            `;
            updateShareButton();
            updateArrowsAndCounter();
            showImage(images.length-1);
        });
        reader.readAsDataURL(file);
    });

    btnAddFirst.classList.add('btn-upload_disabled');
    imagePlaceholder.classList.add('add-post__image-placeholder_disabled');
    fileInput.value = '';
}

contentInput.addEventListener('input', (e) => {
    content = e.target.value;
    updateShareButton();
});

[btnAddFirst, btnAddSecond].forEach(btn => {
    btn.addEventListener('click', () => fileInput.click());
});

fileInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    addImages(files);
});

shareBtn.addEventListener('click', () => {
    if (!shareBtn.classList.contains("btn-share_disabled")) {
        const postData = {
            content: content,
            images: images
        };
        console.log('Новый пост:', postData);
    }
});

document.querySelector('.add-post__arrow-left').addEventListener('click', () => showImage(currentIndex - 1));
document.querySelector('.add-post__arrow-right').addEventListener('click', () => showImage(currentIndex + 1));