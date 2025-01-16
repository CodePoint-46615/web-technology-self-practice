//JavaScript Validation for Login Page

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

function validatePassword(){
    let password = document.getElementById("user-pass").value;
    let message = document.getElementById("passMessage");

    if(password.trim() == ""){
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

function ajaxLogin(){

    if((!validateName()|| !validatePassword())){
        alert("Correct the highlighted field value");
    }

    let fullname = document.getElementById("user-name").value; 
    let password = document.getElementById("user-pass").value; 

    let xhttp = new XMLHttpRequest(); 
    xhttp.open("POST" , "../controller/loginCheck.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form urlencoded");
    xhttp.send(
        `submit = true&name=${encodeURIComponent(fullname)}&pass=${encodeURIComponent(password)}`
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