async function sumbitHandler(e) {
    e.preventDefault();
    const email = document.querySelector('.login-form__email').value;
    const password = document.querySelector('.login-form__password').value;
    try {
        const response = await fetch('http://localhost:8001/api/login/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({email, password}),
            credentials: 'include'
        });
        
        const data = await response.json();
        
        if (response.ok) {
            window.location.href = `http://localhost:8001/profile/?id=${data['user_id']}`;
        } else {
            showError('Email or password is incorrect.');
        }
    } catch (error) {
        showError('Email or password is incorrect.');
    }
}

function showError(message) {
    const errorElement = document.querySelector('.error-message');
    errorElement.textContent = message;
    errorElement.classList.remove('error-message_disabled');
    
    setTimeout(() => {
        errorElement.classList.add('error-message_disabled');
    }, 5000);
}

document.querySelector('.login-form').addEventListener('submit', (e) => sumbitHandler(e));