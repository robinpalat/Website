<?php

$lang = htmlspecialchars($_GET["l"]);
$catg = htmlspecialchars($_GET["c"]);
$set = htmlspecialchars($_GET["set"]);

$filename = "/".$lang."/".$catg."/".$set.".idmnd";

if (file_exists('/var/www/idiomind.com/public/english/others/NEN.Septiembre te.idmnd')) {
    echo "The file $filename exists";
    header("Location:".$filename);
} else {
    echo "The file $filename does not exist";
}
?>
