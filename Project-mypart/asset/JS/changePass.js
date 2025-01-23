function validCurrentPass(){
    document.getElementById('current-password').addEventListener('input', function () {
        const password = this.value;
    
        fetch('../controller/validatePassword.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `current-password=${encodeURIComponent(password)}`,
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                console.log('Password is valid!');
                message.textContent = "Valid";
                message.style.color = "Green";
                return true;
            } else {
                console.log('Invalid password!');
                message.textContent = "Invalid";
                message.style.color = "Red";
                return false;
            }
        })
        .catch(error => console.error('Error:', error));
    });
}

function validateCurrentPass() {
    const current_pass = document.getElementById("current-password").value.trim();
    const message = document.getElementById("currentPassMessage");

    if (current_pass === "" || isNaN(current_pass) || current_pass.length !== 5) {
        message.textContent = "Invalid";
        message.style.color = "Red";
        return false;
    }
    else{
        validCurrentPass(current_pass); 
    }
}

function validateNewPass() {
    let new_pass = document.getElementById('new-password').value.trim();
    let message = document.getElementById('newPassMessage'); 

    if (new_pass === "" || isNaN(new_pass) || new_pass.length !== 5) {
        message.textContent = "Invalid";
        message.style.color = "Red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "Green";
        return true; 
    }
}

function validateConfirmPass() {
    let confirm_pass = document.getElementById('confirm-password').value.trim();
    let new_pass = document.getElementById('new-password').value.trim();
    let message = document.getElementById('confirmPassMessage'); 

    if (confirm_pass === "" || confirm_pass !== new_pass) {
        message.textContent = "Passwords do not match";
        message.style.color = "Red";
        return false;
    } else {
        message.textContent = "Passwords match";
        message.style.color = "Green";
        return true; 
    }
}


function ajaxUpdatePass() {
    // Validate fields before proceeding
    if (!validateCurrentPass() || !validateNewPass() || !validateConfirmPass()) {
        alert("Please fix the errors before submitting.");
        return;
    }

    // Prevent default form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', (event) => event.preventDefault());
    }

    const current_pass = document.getElementById("current-password").value.trim();
    const new_pass = document.getElementById("new-password").value.trim();
    const confirm_pass = document.getElementById("confirm-password").value.trim();

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/changePass.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);
            const responseMessage = document.getElementById("updatePassMessage");
            if (response.status === "Success") {
                alert(response.message);
                window.location.href = "../view/viewProfile.php";
            } else {
                responseMessage.textContent = response.message;
                responseMessage.style.color = "Red";
            }
        }
    };

    xhttp.send(
        `current-password=${encodeURIComponent(current_pass)}&new-password=${encodeURIComponent(new_pass)}&confirm-password=${encodeURIComponent(confirm_pass)}`
    );
}

