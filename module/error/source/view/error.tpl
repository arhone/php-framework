<?php
/**
 * @var $this arhone\tpl\Tpl
 * @var string $title
 * @var string $message
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?=$title?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel='stylesheet' href='/module/error/source/view/template/css/style.css' type='text/css'>
</head>
<body>
    <div id="message">
        <?=$message?>
    </div>
</body>
</html>
