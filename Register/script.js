function formValidation() {
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim(); 
    var password = document.getElementById("password").value.trim();
    var cpassword = document.getElementById("cpassword").value.trim();
    var error = document.getElementById("error");
    error.textContent = "";
    var passwordregex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
    var emailregex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(name.length < 3){
        error.textContent = "Name must be at least 3 characters long.";
        return false;
    }
    if(name === "" || email === "" || password === "" || cpassword === ""){
        error.textContent = "All fields are required.";
        return false;
    }
    if(password !== cpassword){
        error.textContent = "Passwords do not match.";
        return false;
    }
    if(!passwordregex.test(password)){
        error.textContent = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.";
        return false;
    }
    if(!emailregex.test(email)){
        error.textContent = "Invalid email format.";
        return false;
    }
    alert("Form submitted successfully!");
    return true;
}