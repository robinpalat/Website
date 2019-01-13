<html>
<head>
<title>Idiomind</title>
<link href="/css/bootstrap.css" rel="stylesheet">
<link href="/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<div align="center">
        <br>
        <font color=green><h4>Your message has been sent.</h4></font><br><h5>Thanks for taking the time to give us feedback!</h5>
        <br><br>
    </div>
</body>

<?php

$buffer = str_replace(array("\r", "\n"), " ", $_POST['note']);

$txt = './doc/feedback/'.$_POST['user'].'.txt';
if (isset($_POST['user']) && isset($_POST['note']) && isset($_POST['email'])) { // check if both fields are set
    $fh = fopen($txt, 'a'); 
    $txt='Name: '.$_POST['user'].'  |  '.'Email: '.$_POST['email'].'  |  '.$buffer. PHP_EOL;
    fwrite($fh,$txt); // Write information to the file
    fclose($fh); // Close the file
}

?>
