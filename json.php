<?php

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);


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


$arr = dir2json('./english/');
$json = json_encode($arr, JSON_PRETTY_PRINT);
file_put_contents('./share/data/topics.json', '{"Categories":'.$json.'}');
?>
