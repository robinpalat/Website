<?php
/* Redirect browser */

$id_file = htmlspecialchars($_GET["fl"]);
$goto = "https://idiomind.000webhostapp.com/c/".$id_file.".tar.gz";

header("Location: $goto");
/* Make sure that code below does not get executed when we redirect. */
exit;
?>
