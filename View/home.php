<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>HOOOOOME</h1>
<p><?=$prenom?></p>
<ul>
    <?php foreach ($pageList as $onePage) :?>
    <li><?=$onePage->h1?> <strong><?=$onePage->body?></strong></li>
    <?php endforeach;?>
</ul>
</body>
</html>
