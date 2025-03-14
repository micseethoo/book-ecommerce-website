function seepassword() {
    var x = document.getElementById("password");
    var y = document.getElementById("revealpw");
    if (x.type === "password") {
        x.type = "text";
        y.innerHTML = "Hide password"
    } else {
        x.type = "password";
        y.innerHTML = "Show password"
    }
}