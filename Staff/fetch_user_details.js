function fetchUserDetails() {
    var mobileNumber = document.getElementById("mobileNumber").value;
    if (mobileNumber.length > 0) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_user_details.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var user = JSON.parse(xhr.responseText);
                if (user) {
                    document.getElementById("name").value = user.lastName;
                    document.getElementById("email").value = user.email;
                } else {
                    alert("User not found.");
                }
            }
        };
        xhr.send("mobileNumber=" + mobileNumber);
    }
}