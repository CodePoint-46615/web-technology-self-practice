//signup null checking using javascript

function validateName(){
    let fullname = document.getElementById("user-name").value; 
    let message = document.getElementById("nameMessage"); 

    if(fullname.trim() == ""){
        message.textContent = "Invalid";
        message.style.color = "Red";
        return false; 
    }
    else{
        message.textContent="Valid";
        message.style.color="Green"; 
        return true; 
    }
}

function validateContact(){
    let contact = document.getElementById("user-phone").value;
    let message = document.getElementById("phoneMessage");

    if(contact.trim() == ""){
        message.textContent = "Invalid";
        message.style.color = "Red";
        return false; 
    }
    else{
        message.textContent = "Valid";
        message.style.color = "Green";
        return true; 
    }
}

function validateUserName(){
    let username = document.getElementById("user-email").value;
    let message = document.getElementById("emailMessage");

    if(username.trim() == ""){
        message.textContent = "Invalid";
        message.style.color = "Red";
        return false; 
    }
    else{
        message.textContent = "Valid";
        message.style.color = "Green";
        return true; 
    }

}

function validateUserType(){
    let user_type = document.getElementById("user-type").value;
    let message = document.getElementById("utypeMessage");

    if(user_type.trim() == ""){
        message.textContent = "Invalid";
        message.style.color = "Red";
        return false; 
    }
    else{
        message.textContent = "Valid";
        message.style.color = "Green";
        return true; 
    }

}

function validatePassword(){
    let password = document.getElementById("user-pass").value;
    let message = document.getElementById("passMessage");

    if(password.trim() == ""){
        message.textContent = "Invalid"; 
        message.style.color = "Red";
        return false; 
    }
    else{
        message.textContent="valid";
        message.style.color="Green";
        return true; 

    }
}

function ajaxSignup(){

    if((!validateName()|| !validateUserName()|| !validateContact()|| !validateUserType()|| !validatePassword())){
        alert("Correct the highlighted field value");
    }

    let fullname = document.getElementById("user-name").value; 
    let username = document.getElementById("user-email").value; 
    let contact = document.getElementById("user-phone").value; 
    let usertype = document.getElementById("user-type").value; 
    let password = document.getElementById("user-pass").value; 

    let xhttp = new XMLHttpRequest(); 
    xhttp.open("POST" , "../controller/signupCheck.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form urlencoded");
    xhttp.send(
        `submit = true&name=${encodeURIComponent(fullname)}&email=${encodeURIComponent(username)}&phone=${encodeURIComponent(contact)}&utype=${encodeURIComponent(usertype)}&pass=${encodeURIComponent(password)}`
    );

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            let response = this.responseText.trim(); 
        }

        if(response === "success"){
            alert("Signup Successful");
            window.location.href = "../view/signup.php"; 
        }
        else if(response === "null error"){
            alert("null entry.plase try again");
        }
        else if(response === "error"){
            alert("an error occured.try again");
        }
        else if(response === "submit error"){
            alert("submit error.try again.");
        }
        else{
            alert("Unexpected Error: " +response);
        }
    }
}