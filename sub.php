<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta charset="utf-8">
    <title>Idiomind | Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/classic.css">
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">
    <link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16"/>
    <link rel="image_src" href="http://idiomind.net/images/logo.png"/><!--formatted-->

</head>

<body>
    
    <div class="wrapper">
        <div class="logo_bar">
            <img class="wrapped_logo" src="/images/logo_trans.png" height="58px" align="left">
            <h1>Idiomind</h1>
            <p>
                Idiomind is a program based in Bash scripts to learn foreign languages
            </p>
        </div>
        <div class="header_bar">
            <div class="navigation_bar" align="left">
                <a class="category" href="index.php" onfocus="this.blur();">Introduction</a>
                <a class="category" href="help.html" onfocus="this.blur();">Getting started</a>
                <a class="current_category" href="contact.html" onfocus="this.blur();">Contact</a>
                <a class="category" href="library.html" onfocus="this.blur();">Library</a>
                <a class="category" href="news.html" onfocus="this.blur();">News</a>
            </div>
        </div>

        <div class = "content_wrapper">
                
            <div class = "content">

            </div>

        </div>
        
    </div>

    <div class="footer">
        
        <p> <b>Your message has been sent</b><br>
        Thanks for taking the time to give us feedback!<br>
        </p>
    </div>    
</body>
</html>

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
