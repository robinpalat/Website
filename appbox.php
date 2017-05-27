<!doctype html>
<html>
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" href="/favicon.ico">
   <title>Topics</title>

   <link rel="stylesheet" href="/css/appbox.css">
   <script src="/js/sorttablee.js"></script>
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
    
    // Checks to see if veiwing hidden files is enabled
    if($_SERVER['QUERY_STRING']=="hidden")
    {$hide="";
     $ahref="./";
     $atext="Hide";}
    else
    {$hide=".";
     $ahref="./?hidden";
     $atext="Show";}

     // Opens directory
     $myDirectory=opendir("./".$language."/".$category."/");

    // Gets each entry
    while($entryName=readdir($myDirectory)) {
       $dirArray[]=$entryName;
    }

    // Closes directory
    closedir($myDirectory);

    // Counts elements in array
    $indexCount=count($dirArray);

    // Sorts files
    sort($dirArray);

    // Loops through the array of files
    for($index=0; $index < $indexCount; $index++) {

    // Decides if hidden files should be displayed, based on query above.
        if(substr("$dirArray[$index]", 0, 1)!=$hide) {

    // Gets File Names
        $name=$dirArray[$index];
        $temp = explode('.', $name);
        $ext  = array_pop($temp);
        $name = implode('.', $temp);

        
        
        $namehref=$dirArray[$index];

        echo"<tr>
            <td style=\"width:5%\"><a href=\"/appview.php?l=".$language."&c=".$category."&set=".$name."\"><img class='expand' src='/images/idmnd.png'></a></td>
            <td style=\"width:90%;line-height:16px;font-size:13px\"><a href=\"/appview.php?l=".$language."&c=".$category."&set=".$name."\">{$name}</a></td>
        </tr>";
       }
    }
?>

        </tbody>
    </table>

</div>
</body>
