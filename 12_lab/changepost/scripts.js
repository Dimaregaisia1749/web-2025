const MAX_WIDTH = 474;
const MAX_HEIGHT = 474;

const fileInput = document.querySelector('.file-input');
const imagePlaceholder = document.querySelector('.add-post__image-placeholder');
const btnAddFirst = document.querySelector('.btn-upload_first');
const btnAddSecond = document.querySelector('.btn-upload_second');
const addPostContainer = document.querySelector('.add-post');
const imagesContainer = document.querySelector('.add-post__images');
const contentInput = document.querySelector('.add-post__text');
const shareBtn = document.querySelector('.btn-share');
const arrows = document.querySelectorAll('.add-post__arrow');
const imagesCounter = document.querySelector('.add-post__counter');
const leftArrow = document.querySelector('.add-post__arrow-left')
const leftArrowIcon = leftArrow.querySelector('.add-post__arrow-icon');
const rightArrow = document.querySelector('.add-post__arrow-right')
const rightArrowIcon = rightArrow.querySelector('.add-post__arrow-icon');
const addPostResult = document.querySelector('.add-post-result');
const addPostResultText = document.querySelector('.add-post-result__text');
const removeButton = document.querySelector('.remove-button');
const darkArrow = "add-post__arrow-icon_dark"


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
    if (postImages.length > 0) {
        postImages[currentIndex].classList.remove('add-post__image_disabled');
    }

    if (images.length > 1) {
        imagesCounter.textContent = `${currentIndex + 1} из ${postImages.length}`;
        
    } else {
        
    }

    if (images.length > 0) {
        imagesCounter.textContent = `${currentIndex + 1} из ${postImages.length}`;
        removeButton.classList.remove('remove-button_disabled');
    } else {
        removeButton.classList.add('remove-button_disabled');
    }

    if (currentIndex === 0) {
        leftArrowIcon.classList.add(darkArrow);
        rightArrowIcon.classList.remove(darkArrow);
    }
    else if (currentIndex === images.length - 1) {
        rightArrowIcon.classList.add(darkArrow);
        leftArrowIcon.classList.remove(darkArrow);
    }
    else {
        leftArrowIcon.classList.remove(darkArrow);
        rightArrowIcon.classList.remove(darkArrow);
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

function removeImage(index) {
    images.splice(index, 1);
    const deletedImage = document.querySelector(`.add-post__image:not(add-post__image_disabled)`);
    deletedImage.remove();
    updateShareButton();
    updateArrowsAndCounter();
    showImage(images.length - 1);
}

async function addPost(postData) {
    try {
        const response = await fetch('http://localhost:8001/api/add_post/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(postData)
        });

        addPostResult.classList.remove("add-post-result_disabled");

        if (response.ok) {
            addPostResultText.textContent = "Пост успешно сохранен!";
            addPostResult.classList.remove("add-post-result_error");
            addPostResult.classList.add("add-post-result_success");
            addPostContainer.classList.add("add-post_disabled");
        } else {
            addPostResultText.textContent = "Ошибка в сохранении поста!"
            addPostResult.classList.add("add-post-result_error");
        }
    } catch (err) {
        addPostResultText.textContent = "Ошибка в сохранении поста!"
        addPostResult.classList.add("add-post-result_error");
      }
         
}

function changePost() {
    const params = new URLSearchParams(document.location.search);
    const postId = params.get("id");
    
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
        addPost(postData);
    }
});

changePost();
leftArrow.addEventListener('click', () => showImage(currentIndex - 1));
rightArrow.addEventListener('click', () => showImage(currentIndex + 1));
removeButton.addEventListener('click', () => removeImage(currentIndex));