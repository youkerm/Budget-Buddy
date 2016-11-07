function addAccount() {
    var account = document.getElementById("account").cloneNode(true);
    var container = document.getElementById("account-column");
    container.appendChild(account);
}

function createAccount() {
    var firstName = document.getElementById("first");
    var lastName = document.getElementById("last");
    var user = document.getElementById("user");
    var password1 = document.getElementById("pass1");
    var password2 = document.getElementById("pass2");
}