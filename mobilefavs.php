<!doctype html>
<html>
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" href="/favicon.ico">
   <title>Topics</title>

   <link rel="stylesheet" href="/css/mobilebox.css">

</head>

<body>
<div id="container">

    <table class="sortable">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <?php
            include_once("analyticstracking.php");
            
            $language = htmlspecialchars($_GET["lang"]);
            if(!isset($_COOKIE[$language[0].'PINS'])) {
                $favs = "";
            } else {
                  $favs = $_COOKIE[$language[0].'PINS'];
                  $favs =  ucfirst($favs);
            }
            $place = "/".$language."/".$category."/";
            $favs = explode('|', $favs);
            foreach($favs as $fav) {
                    if($fav!="|" AND $fav!=""){
                         echo"<tr id=\"box\">
                    <td style=\"width:5%\"><a  href=\"/mobileview.php?l=".$language."&c=fav&set=".$fav."\"><img class='expand' src='/images/idmnd.png'></a></td>
                    <td style=\"width:90%\"><a href=\"/mobileview.php?l=".$language."&c=fav&set=".$fav."\">{$fav}</a></td>
                </tr>";
                }
            }
        ?>
        </tbody>
    </table>
</div>
</body>
