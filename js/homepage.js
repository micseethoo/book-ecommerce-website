function confirmlogout() {
    let x = confirm("Are you sure you want to log out?");

    if (x) {
        window.location.href = "logout.php";
    }
}