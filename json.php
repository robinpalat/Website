<?php

$lang = htmlspecialchars($_GET["lang"]);
$uplang = ucfirst($lang);

 echo './share/'.$uplang.'/topics.json';

function dir2json($dir)
{
    $a = [];
    if($handler = opendir($dir))
    {
        while (($content = readdir($handler)) !== FALSE)
        {
            if ($content != "." && $content != ".." && $content != ".htaccess" && $content != "index.php" && $content != "app.php" && $content != "mobile.php" && $content != ".gitignore")
            {
                if(is_file($dir."/".$content)) $a[] = $content;
				else if(is_dir($dir."/".$content)) $a[$content] = dir2json($dir."/".$content);
            }
        }
        closedir($handler);
    }
    return $a;
}


$arr = dir2json('./'.$lang.'/');
$json = json_encode($arr, JSON_PRETTY_PRINT);
file_put_contents('./share/'.$uplang.'/topics.json', '{"Categories":'.$json.'}');

?>
