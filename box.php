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
    $category = htmlspecialchars($_GET["category"]);
    $place = "/".$language."/".$category."/";
    
    if($_SERVER['QUERY_STRING']=="hidden")
    {$hide="";
     $ahref="./";
     $atext="Hide";}
    else
    {$hide=".";
     $ahref="./?hidden";
     $atext="Show";}

     $myDirectory=opendir("./".$language."/".$category."/");

    while($entryName=readdir($myDirectory)) {
       $dirArray[]=$entryName;
    }

    closedir($myDirectory);
    $indexCount=count($dirArray);
    sort($dirArray);
    
    $category = "./".$category."/";
    $files = glob($category . "*.idmnd");
    
    for($index=0; $index < $indexCount; $index++) {
        if(substr("$dirArray[$index]", 0, 1)!=$hide) {
			
        $name=$dirArray[$index];
        $temp = explode('.', $name);
        $ext  = array_pop($temp);
        $namee = implode('.', $temp);
        //$name = substr($namee, 4);
        $name = substr($namee, 0, -4);

        $namehref=$dirArray[$index];

        echo"<tr id=\"box\">
            <td style=\"width:5%\"><a  href=\"/view.php?l=".$language."&c=".$category."&set=".$namee."\"><img class='expand' src='/images/idmnd.png'></a></td>
            <td style=\"width:90%\"><a href=\"/view.php?l=".$language."&c=".$category."&set=".$namee."\">{$name}</a></td>
            <td style=\"width:5%\"><a href=\"".$place.$namehref."\"><img src='/images/dl.png'></a></td>

        </tr>";
       }
    }
?>

        </tbody>
    </table>

</div>
</body>
