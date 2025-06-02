function generateColorFromEmail(email) {
    let hash = 0;
    for (let i = 0; i < email.length; i++) {
        hash = email.charCodeAt(i) + ((hash << 5) - hash);
    }
    const hue = hash % 360;
    return `hsl(${hue}, 80%, 30%)`;
}

function updateUserIcon(email) {
    const icon = document.querySelector(".user-icon");
    icon.textContent = email.charAt(0).toUpperCase();
    icon.style.backgroundColor = generateColorFromEmail(email);
}

updateUserIcon("2@gmail.com");