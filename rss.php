<?php

class autorss
{
    public function show($document_type,$path,$xmlversion,$encoding,$rssversion,$atomversion,$title,$homelink,$description,$language,$lastupdate,$callfile,$generator,$permalink,$dir,$mode)
    {
        header($document_type);
     
echo "<?xml version='".$xmlversion."' encoding='".$encoding."'?>
<rss version='".$rssversion."' xmlns:atom='".$atomversion."'>
<channel>
<atom:link href='".$path."' rel='self' type='application/rss+xml'/>
<title>".$title."</title>
<link>".$homelink."</link>
<description>".$description."</description>
<language>".$language."</language>
<lastBuildDate>".$lastupdate."</lastBuildDate>
<generator>".$generator."</generator>";

        if ($mode == 1) {
                $viewtype = 'view.php';
        } else {
            $viewtype = 'mobileview.php';
        }
     
        $display = array('idmnd');
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        $data = array();
        foreach($files as $file) {
            $time = DateTime::createFromFormat('U', filemtime($file->getPathname()));
            // no need to explode the time, just make it a datetime object
            if(in_array($file->getExtension(), $display) && $time > new DateTime('2019-01-01')) { // is PHP and is greater than jan 15 2014
                $data[] = array('filename' => $file->getPathname(), 'time' => $time->getTimestamp()); // push inside
            }
        }
        usort($data, function($a, $b){ // sort by time latest
            return $b['time'] - $a['time'];
        });

        foreach ($data as $key => $value) {
           //$time = date('Y-m-d', $value['time']);

            $topic_path = $value[filename];
            clearstatcache() ;
                    $date_info = lstat($topic_path);
                    $pre_name = basename($topic_path);
                    $title = substr($pre_name, 0, strpos($pre_name, '.idmnd'));
                    $dir = basename($dir);
                    $name = $title;
                    $category = basename(dirname($topic_path));
                    $category_lbl = ucfirst($category);
                    $linkview = '/'.$viewtype.'?l='.$dir.'&amp;c='.$category.'&amp;set='.$name;
echo "
<item>
<title>".$name."</title>
<link>".$linkview."</link>
<pubDate>".date('r' ,$date_info[9])."</pubDate>
<description>in <font color=\"#626262\">".$category_lbl."</font></description>
</item>";
     
        }
        
        echo "</channel></rss>";
                return;
    }
}

$trgt = htmlspecialchars($_GET["trgt"]);
$mode = htmlspecialchars($_GET["viewp"]);

$newrss = new autorss();
$newrss->show("Content-type:text/xml","http://idiomind.sourceforge.io/".$trgt."/", "1.0","utf-8","2.0","http://www.w3.org/2005/Atom","Content shared by users - Idiomind ","http://idiomind.sourceforge.io/".$trgt."/","Latest Published","en-us","Sun, 31 May 2022 09:41:01 GMT","rss.php","Latest Published","false","./".$trgt."/",$mode);

?>
