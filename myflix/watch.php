<?php $src = $_GET['src']; $title = $_GET['t']; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Watching <?php echo $title; ?></title>
</head>
<body style="background:#000;">
    <header><a href="index.php" class="logo">My<span>Flix</span></a></header>
    <div style="max-width:1100px; margin:20px auto; padding:10px;">
        <video width="100%" controls autoplay style="border:1px solid #333; border-radius:10px;">
            <source src="<?php echo $src; ?>" type="video/mp4">
        </video>
        <h1 style="color:white; margin-top:20px;"><?php echo $title; ?></h1>
    </div>
</body>
</html>