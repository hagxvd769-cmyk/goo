<?php
session_start();
$adminEmail = "admin67@gmail.com";
$adminPass = "admin67@";

if (isset($_POST['login'])) {
    if ($_POST['email'] === $adminEmail && $_POST['pass'] === $adminPass) {
        $_SESSION['admin_auth'] = true;
    }
}
if (isset($_GET['logout'])) { session_destroy(); header("Location: ../index.php"); }

if (!isset($_SESSION['admin_auth'])): ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <div class="admin-container">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
<?php else: ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <div class="admin-container">
        <h2>Upload Content</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required>
            <select name="type"><option value="anime">Anime</option><option value="movie">Movie</option></select>
            <p>Thumbnail Image:</p>
            <input type="file" name="thumb" accept="image/*" required>
            <p>Video Source:</p>
            <input type="text" name="link" placeholder="Paste Link (URL)">
            <p>OR Upload File:</p>
            <input type="file" name="video" accept="video/*">
            <button type="submit" name="upload">Publish Now</button>
        </form>
        <a href="?logout=1" style="color:red; display:block; text-align:center; margin-top:10px;">Logout</a>
    </div>
    <?php
    if (isset($_POST['upload'])) {
        $videoSrc = $_POST['link'];
        $folder = ($_POST['type'] == "movie") ? "movies/" : "anime/";

        if (!empty($_FILES['video']['name'])) {
            $videoName = time() . "_" . $_FILES['video']['name'];
            $videoSrc = "uploads/" . $folder . $videoName;
            move_uploaded_file($_FILES['video']['tmp_name'], "../" . $videoSrc);
        }
        $thumbName = time() . "_" . $_FILES['thumb']['name'];
        $thumbPath = "assets/thumbnails/" . $thumbName;
        move_uploaded_file($_FILES['thumb']['tmp_name'], "../" . $thumbPath);

        $db = json_decode(file_get_contents('../database.json'), true);
        $db[] = ["title" => $_POST['title'], "type" => $_POST['type'], "thumb" => $thumbPath, "video" => $videoSrc];
        file_put_contents('../database.json', json_encode($db));
        echo "<script>alert('Uploaded Successfully!');</script>";
    }
endif; ?>