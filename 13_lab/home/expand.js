const textBlocks = document.querySelectorAll('.post__content');

textBlocks.forEach(textBlock => {
    const text = textBlock.querySelector('.post__text');
    const moreBtn = textBlock.querySelector('.post__more');

    function checkTextOverflow() {
        text.style.webkitLineClamp = 'unset';
        const fullHeight = text.scrollHeight;
        text.style.webkitLineClamp = '2';
        const clampedHeight = text.clientHeight;
        const isOverflowing = fullHeight > clampedHeight;

        if (!isOverflowing) {
            moreBtn.classList.add('post__more_disabled');
        }
    }

    function toggleText() {
        if (text.classList.toggle('expanded')) {
            text.style.webkitLineClamp = 'unset';    
        } 
        else {
            text.style.webkitLineClamp = '2';
        }

        moreBtn.textContent = text.classList.contains('expanded')
            ? 'свернуть'
            : 'ещё';
    }

    moreBtn.addEventListener('click', toggleText);

    checkTextOverflow();
    window.addEventListener('resize', () => {if (!text.classList.contains('expanded')) {
            checkTextOverflow();
        }
    });
});