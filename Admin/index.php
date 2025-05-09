<!DOCTYPE html>
<html>
<head>
    <title>Admin Login | Care Compass Hospital</title>
    <link rel="icon" href="Img/Logo5.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="post">
            <div class="input-group">
            <i class="fa fa-user"></i>
            <input type="text" id="username" name="username" required placeholder="Username">
                <label for="emial">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password1" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div>
                <input type="submit" class="submit-btn" value="Sign In" name="signIn">
            </div>
        </form>
        <div id="error-message"></div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
