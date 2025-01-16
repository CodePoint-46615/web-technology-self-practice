// Validation for Fullname
function validateFullname() {
    let fullname = document.getElementById("name").value;
    let message = document.getElementById("nameMessage");

    // console.log("name: ", fullname); // Debugging log

    if (fullname.trim() == "") {
        message.textContent = "Invalid";
        message.style.color = "red";
        return false;
    } 
    else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

//validation for Username:
function validationUsername(){
    let username = document.getElementById("userName").value; 
    let usernameMessage = document.getElementById("emailMessage"); 

    if(username.trim() == ""){
        usernameMessage.textContent = "Invalid";
        usernameMessage.style.color = "Red";
        return false; 
    }
    else{
        usernameMessage.textContent = "Valid";
        usernameMessage.style.color = "Green";
        return true; 
    }

}


// Validation for Phone number
function validatePhone() {
    let phone = document.getElementById("phone").value;
    let message = document.getElementById("phoneMessage");

    if (phone.trim() === "") {
        message.textContent = "Invalid";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

// // Submit function to send the data via AJAX
function ajaxUpdate() {
    if (!validationUsername() || !validateFullname() || !validatePhone()) {
        alert("Invalid data. Please correct the highlighted errors.");
        return;
    }

    let fullname = document.getElementById("name").value;
    let username = document.getElementById("userName").value;
    let phone = document.getElementById("phone").value;

    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "../controller/editProfile.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
        `submit=true&username=${encodeURIComponent(username)}&name=${encodeURIComponent(fullname)}&phone=${encodeURIComponent(phone)}`
    );

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();

            if (response === "success") {
                alert("User updated successfully! Redirecting to user list...");
                window.location.href = "../view/viewSearch.php";
            } 
            else if (response === "null error") {
                alert("Null entries. Please try again.");
            } 
            else if (response === "error") {
                alert("An error occurred. Please try again.");
            } 
            else if (response === "submit error") {
                alert("Submit error. Please try again.");
            } 
            else {
                alert("Unexpected error: " + response);
            }
        }
    };
}