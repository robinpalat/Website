<?php

$page = htmlspecialchars($_GET["page"]);

$goto = "page".$page.".html";

header("Location: $goto");

?>
