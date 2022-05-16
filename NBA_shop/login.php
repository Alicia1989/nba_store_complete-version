<?php
phpinfo();
// Firstly, initialize the session to save the user state
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["is_loggedin"]) && $_SESSION["is_loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Include config file to load our database connection
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        //using MSQL real_scape_string my tutor put some protection.
        $escapeuser = $connection->real_escape_string($username);

        $escapepass = $connection->real_escape_string($password);
        $sql = "SELECT id, username, password FROM users WHERE username = '{$escapeuser}' and password='{$escapepass}'";

        // query the database
        $result = mysqli_query($connection, $sql);

        $row = mysqli_num_rows($result);

        // Password is correct, so start a new session
        if ($row == 1) {
            session_start();

            // Store data in session variables
            $_SESSION["is_loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;

            // Redirect user to welcome page
            header("location: dashboard.php");
        } else {
            $error = "username or password is incorrect";
        }
    }

    // Close connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="uft-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style3.css">
    <title>Members area</title>
    <style>
        .form-box {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<ul class="skip-links">
    <li><a href="#main_nav">Skip to navigation</a></li>
  </ul>
<body>
<header>
      <main class="brandheader">
        <img src="images/logo.jpg" alt="logo" class="homeLogo">
        <h1>UNOFFICIAL STORE</h1>
      </main>
      <h2>NBA Jerseys</h2>
      <nav role="nav" id="main_nav">
        <a href="login.php">Members area</a>
        <a href="index.html">Home</a>
        <a href="lakers.php">New products</a>
        <a href="lakers.html">Lakers</a>
        <a href="bulls.html">Bulls</a>
        <a href="recomendations.html">Customer reviews</a>
        <a href="form.html">Contact us</a>
      </nav>
    </header>
    <h2>Members area</h2>
    <main class="container-x">
        <?php if (!is_null($error) && !empty($error)) {?>
            <div class="error-msg">
                <?php echo $error; ?>
            </div>
        <?php }?>

        <div class="success-msg">
            Welcome Back!
        </div>
        <div class="form-box">
            <div class="form-container">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-input">
                        <div class="">
                            <i class="fa fa-user fa-2x cust" aria-hidden="true"></i>
                            <input class="username" type="text" name="username" value="" placeholder="Enter Username" required>
                        </div>
                        <div class="">
                            <i class="fa fa-lock fa-2x cust" aria-hidden="true"></i>
                            <input class="password" type="password" name="password" value="" placeholder="Enter Password" required minlength="8">
                        </div>
                        <div class="login">
                            <div class="f-password"><a href="#">Forgot Password?</a></div>
                            <input class="submit" type="submit" name="submit" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer">
        <main class="footer-list">
            <a href="#" class="footer-link">Home</a>
            <a href="#" class="footer-link">Lakers</a>
            <a href="#" class="footer-link">Bulls</a>
            <a href="#" class="footer-link">Customer reviews</a>
            <a href="#" class="footer-link">Contact us</a>
        </main>
    </footer>
</body>

</html>