function generateColorFromEmail(email) {
    let hash = 0;
    for (let i = 0; i < email.length; i++) {
        hash = email.charCodeAt(i) + ((hash << 5) - hash);
    }
    const hue = hash % 360;
    return `hsl(${hue}, 80%, 30%)`;
}

function updateUserIcon() {
    const icon = document.querySelector(".user-icon");
    const email = icon.textContent.trim()
    if (email == '-1') {
        userWrapper.classList.add('user-wrapper_disabled')   
    }
    icon.textContent = email.charAt(0).toUpperCase();
    icon.style.backgroundColor = generateColorFromEmail(email);
}

async function exitAccount() {
    try {
        const response = await fetch('http://localhost:8001/api/logout/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        window.location.href = `http://localhost:8001/home/`;
        if (response.ok) {
            userWrapper.classList.add("user-wrapper_disabled");
        } else {
            userWrapper.classList.remove("user-wrapper_disabled");
        }
    } catch (err) {
        userWrapper.classList.remove("user-wrapper_disabled");
    }
}

const userWrapper = document.querySelector('.user-wrapper');
const icon = userWrapper.querySelector(".user-icon");
const exit = userWrapper.querySelector('.exit');
updateUserIcon();
exit.addEventListener('click', () => exitAccount());