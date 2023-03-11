<?php
session_set_cookie_params(0);
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="css/settings.css" />
    <link rel="icon" type="icons/png" href="icons/fav.png">
</head>

<body>
    <header id="top-bar">
        <a href="index.html" style="text-decoration: none;" id="page-name">
            <h1 id="page-name">File Upload</h1>
        </a>
        <button id="change-password-btn">Change Password</button>
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo '<form action="php/logout.php" method="post">';
            echo '<input type="submit" id="logout-btn" value="Logout">';
            echo '</form>';
        } else {
            header('Location: login.php');
            exit;
        }
        $link_address = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $link_address = $_POST['link_address'];
            file_put_contents('php/link_address.txt', $link_address);
        } else {
            $link_address = file_get_contents('php/link_address.txt');
        }
        ?>
        </div>
    </header>
    <div id="password-change-modal">
        <div id="password-change-modal-content">
            <button class="close" id="close-password-modal">X</button>
            <h2>Change Password</h2>
            <form action="php/change_password.php" method="post">
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password" name="current_password"><br><br>
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new_password"><br><br>
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password"><br><br>
                <input type="submit" value="Save">
            </form>
        </div>
    </div>
    <h1>Settings</h1>
    <form method="post">
        <label for="link_address">Link Address:</label>
        <input type="text" name="link_address" id="link_address" value="<?php echo htmlspecialchars($link_address); ?>">
        <input type="submit" value="Save">
    </form>
    <div id="success-popup"></div>
    <div id="error-popup"></div>
    <script type="text/javascript" src="js/settings.js"></script>
    <script type="text/javascript" src="js/logout.js"></script>
</body>

</html>