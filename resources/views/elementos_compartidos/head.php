<?php
$public_folder = explode('/', $_SERVER['SERVER_PROTOCOL'])[0] . '://' . $_SERVER['HTTP_HOST'];

?>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="<?php echo $public_folder ?>/css/styles.css">
<link rel="shortcut icon" href="images/logotipo.png" type="image/x-icon">
<script src="https://kit.fontawesome.com/50ec0b88b6.js" crossorigin="anonymous"></script>