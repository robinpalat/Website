<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Radio</title>
    </head>
    <body>
        <div class="content">
    
    <style type="text/css" rel="stylesheet">
    body {
      background: #332639;
      color: #BCBCBC;
    }
    .content{
        width: 60%;
        margin: 0 auto;
    }
    h2 a{
        font: 200 20px/1.5 Helvetica, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        text-decoration: none;
        color: #89BAE2;
    }
    h1 {
      font: 400 40px/1.5 Helvetica, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      border-bottom: 1px solid gray;
    }
    h2 {
      font: 200 20px/1.5 Helvetica, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      color: #D8E6F9;
    }
    .post{
        border: 0px solid gray;
        padding: 5px;
        border-radius: 3px;
        margin-top: 15px;
    }
    .post-head span{
        font-size: 14px;
        color: gray;
        letter-spacing: 1px;
    }
    .post-content{
        font-size: 18px;
        color: black;
    }
    /* media query */
    @media (max-width: 880px){
        .content{
            width: 99%;
        }
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
    li {
      font: 100 10px/1.5 Helvetica, Verdana, sans-serif;
      border-bottom: 1px solid #ccc;
    }
    li:last-child {
      border: none;
    }
    li a {
      text-decoration: none;
      color: #000;
      display: block;
      width: 200px;
      -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;
      -moz-transition: font-size 0.3s ease, background-color 0.3s ease;
      -o-transition: font-size 0.3s ease, background-color 0.3s ease;
      -ms-transition: font-size 0.3s ease, background-color 0.3s ease;
      transition: font-size 0.3s ease, background-color 0.3s ease;
    }
    li a:hover {
      font-size: 30px;
      background: #f6f6f6;
    }
    </style>
    <?php
        $lang = "msc";
        if($lang == "fe"):
            $url = "https://www.audio-lingua.eu/spip.php?page=backend&id_mot=17&id_rubrique=2&mot2=28&mot3=17&mot4=20&mot5=27&tri=date&lang=en";
        elseif($lang == "en"):
            $url = "https://www.audio-lingua.eu/spip.php?page=backend&id_rubrique=2";
        else:
            $url = "https://www.inoreader.com/stream/user/1006062930/tag/Music";
        endif;
        
        $invalidurl = false;
        if(@simplexml_load_file($url)){
            $feeds = simplexml_load_file($url);
        }else{
            $invalidurl = true;
            echo "<h2>Invalid RSS feed URL.</h2>";
        }
 
        $my_file = './listening/'.$lang.'.m3u';
        $handle = fopen($my_file, 'w') or die("Unable to open file!");
        fwrite($handle, "#EXTM3U\n");
        fclose($handle);

        $i=1;
        if(!empty($feeds)){

            $site = $feeds->channel->title;
            $sitelink = $feeds->channel->link;

            echo "<h1>".$site."</h1>";
            foreach ($feeds->channel->item as $item) {

                $title = $item->title;
                $link = $item->link;
                $enclosure = $item->enclosure['url'];
                //$description = $item->description['p'];
                $postDate = $item->pubDate;
                $pubDate = date('D, d M Y',strtotime($postDate));
                file_put_contents('./listening/'.$lang.'.m3u', "\n#EXTINF:".$i.",".$title."\n".$enclosure, FILE_APPEND);
                

                if($i>=20) break;
                
        ?>
                <div class="post">
                    <div class="post-head">
                        <h2><a class="feed_title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
                        
                        <audio controls><br>
                        <source src="<?php echo $enclosure; ?>" type="audio/mpeg">
                        </audio>

                        <span><?php echo $pubDate; ?></span>
                    </div>
                <br><br>
                </div>
                
                <?php
                $i++;
            }
        }else{
            if(!$invalidurl){
                echo "<h2>No item found</h2>";
            }
        }
    ?>
        </div>
    </body>
</html>

