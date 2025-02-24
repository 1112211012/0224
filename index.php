<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>text</title>
</head>
<body>
    <h1>我的練習 php & mysql</h1>

    <p>今天的日期是：<?= date("Y年m月d日") ?></p>
    <hr>
    <p>我的身高: <?= $h=165 ?></p>
    <p>我的身高: <?= $w=65 ?></p>
    <p>我的BMI值: <?= $w/($h/100*$h/100) ?></p>
    
</body>
</html>