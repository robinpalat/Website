<?php
if($_COOKIE['language']== 'english') {
    header("Location: /english/");
} else {
    header("Location: index.php");
};
?>
