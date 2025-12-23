<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>MyFlix | Stream</title>
</head>
<body>
    <header>
        <a href="index.php" class="logo">My<span>Flix</span></a>
        <a href="admin/index.php" style="color:white; text-decoration:none;">Admin</a>
    </header>
    <div class="grid">
        <?php
        $data = json_decode(file_get_contents('database.json'), true);
        if($data) {
            foreach(array_reverse($data) as $item) {
                echo "
                <div class='card'>
                    <img src='{$item['thumb']}'>
                    <div class='card-info'>
                        <h3>{$item['title']}</h3>
                        <a href='watch.php?src=".urlencode($item['video'])."&t=".urlencode($item['title'])."' class='watch-btn'>Watch</a>
                    </div>
                </div>";
            }
        }
        ?>
    </div>
</body>
</html>