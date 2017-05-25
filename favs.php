<!doctype html>
<html>
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" href="/favicon.ico">
   <title>Topics</title>

   <link rel="stylesheet" href="/css/box.css">
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
    $category = "";
    

   	if(!isset($_COOKIE['Topics_fav'])) {
		$topics_favs = "";
		
	} else {
		  $topics_favs = $_COOKIE['Topics_fav'];
		  $topics_favs =  ucfirst($topics_favs);
		  $category = "";
	}
   
	$place = "/".$language."/".$category."/";
	$topics_favs = explode('|', $topics_favs);
	foreach($topics_favs as $fav) {

			if($fav!="|" AND $fav!=""){
				echo"<tr id=\"box\">
				<td style=\"width:5%\"><a  href=\"/view.php?l=".$language."&c=".$category."&set=".$fav."\"><img class='expand' src='/images/idmnd.png'></a></td>
				<td style=\"width:90%\"><a href=\"/view.php?l=".$language."&c=".$category."&set=".$fav."\">{$fav}</a></td>
				<td style=\"width:5%\"><a href=\"".$place.$namehref."\"><img src='/images/dl.png'></a></td>
			</tr>";
			}
			}
?>

        </tbody>
    </table>
</div>
</body>
