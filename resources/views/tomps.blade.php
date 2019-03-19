<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1> Hello <?php echo $name; ?></h1>
    <ul>
        <?php foreach ($goals as $goal) : ?>
            <li><?= $goal; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>