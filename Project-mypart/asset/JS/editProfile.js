function validateName() {
    const name = document.getElementById('name').value.trim();
    const message = document.getElementById('nameMessage');
    if (!name || name.split(" ").length < 2 || !/^[a-zA-Z .-]+$/.test(name)) {
        message.textContent = "Invalid Name Format";
        message.style.color = "red";
        return false;
    }
    else{
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
    
}

function validateEmail() {
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('emailMessage');
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        message.textContent = "Invalid Email Format";
        message.style.color = "red";
        return false;
    }
    message.textContent = "Valid";
    message.style.color = "green";
    return true;
}

function validatePhone() {
    const phone = document.getElementById('phone').value.trim();
    const message = document.getElementById('phoneMessage');
    if (!phone || !/^\d{11}$/.test(phone)) {
        message.textContent = "Invalid Phone Number";
        message.style.color = "red";
        return false;
    }
    message.textContent = "Valid";
    message.style.color = "green";
    return true;
}

function ajaxUpdate() {
    if (!validateName() || !validateEmail() || !validatePhone()) {
        alert("Please fix the errors before submitting.");
        return;
    }

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const gender = document.getElementById("gender").value;
    const dob = document.getElementById("dob").value;

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/editProfile.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);
            const messageDiv = document.getElementById('message');
            if (response.status === 'success') {
                alert(response.message);
                window.location.href = "../view/viewProfile.php";
            } else {
                messageDiv.textContent = response.message;
                messageDiv.style.color = "red";
            }
        }
    };
    xhttp.send(`username=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}&gender=${encodeURIComponent(gender)}&dob=${encodeURIComponent(dob)}`);
}
