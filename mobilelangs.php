<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="ESL, EFL, pronunciation, grammar, vocabulary, tests, lessons, quiz, quizzes, resources, lesson, vocabulary, questions, answers"/>
<meta name="description" content="Learn foreign vocabulary"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="image_src" href="http://idiomind.net/images/logo.png" / ><!--formatted-->
<title>Idiomind's library</title>
<link href="/css/lgmobi.css" rel="stylesheet" type="text/css" />
<link href="/css/fa/css/font-awesome.css" rel="stylesheet" type="text/css" />
<?php include 'fetchfeed.php';?>

<script>
function setCookie() {
    var d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie="language=<?=$langdir?>; expires=" + expires + "; path=/";
}
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript">
        $(document).ready(function() {
            $(".box").fancybox({
                "width"         : "100%",
                "height"        : "100%",
                "margin"        : 15,
                "padding"        : 10,
                'autoScale'     : false,
                'transitionIn'      : 'none',
                'transitionOut'     : 'none',
                'overlayColor'      : '#ECEEF1',
                'overlayOpacity'    : 0,
                'scrolling'     : 'yes',
                'type'          : 'iframe',
                'titlePosition': 'over'
            });
        });
</script>

</head>
<body onload="setCookie()">
    
    <?php
    
    include_once("analyticstracking.php");
    
	if(!isset($_COOKIE['iuser'])) {
		$use = "My account";
		$class_btn_user = "userbutton";

	} else {
		  $use = $_COOKIE['iuser'];
		  $use =  ucfirst($use);
		  $class_btn_user = "userbutton";
		}
    ?>
    
    <main id="content" class="group" role="main">
    <div class="main">

    <table width="100%" height="30px" border="0" align="center" class="top">
        <td align="left" class="langtitle">
            <a style="color:#FFFFFF" href="/<?=$langdir?>"><?=$uplangdir?><br></a>
        </td>
        <td align="right">
            <a class=<?=$class_btn_user?> style="text-decoration: none; color: #FFFFFF" href="../community/"><small><?= $use ?></small></a>
        </td>
    </table>

    <table style="width:100%;padding:3px;font-size:14px;">
	<tr style="color:#FEFFFF"><td style="background:#9BACDE;">Plus</td><td style="background:#A89CC8;"><a href="#folders" style="color: #FFFFFF">Topics by category</a></td><td style="background:#9BB2E1;">Downloads</td><td style="background:#8CC9F0;">Donate</td></tr>
	</table>
	<div class="sentenceweek">
		<div class="sentencew-content"> <h1 style="background-color:#D9E0EA;"> Sentence of week <i align="right" class="fa fa-rss-square" aria-hidden="true"></i></h1> consectetur adipisicing elit, sed doeiusmod<br> tempor incididunt ut labore et dolore magna aliqua. Ut enimad<br> minim veniam, quis nostrud exercitation ullamco laboris nisi utaliquip ex ea commodo consequat.<br> Duis aute irure dolor inreprehenderit<br> in voluptate velit esse cillum dolore eu fugiat <br>nullapariatur. Excepteur sint occaecat cupidatat non proident, sunt inculpa qui officia deserunt mollit anim id est <br>laborum.Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit, se
		</div>
    </div>
    
    <table width="94%" border="0" align="center" class="rss">
        <tr>
        <td align="left" valign="top">
			
        <div class="feed-lists">
			<h1><a href="http://feeds.feedburner.com/p/<?=$langdir?>"></a>latest shared and published topics</h1>
				<?php
				output_rss_feed("http://idiomind.net/rss.php/?trgt=".$langdir, 5, true, true, 200);
				?>
        </div>
        
        </td>
        </tr>
    </table>
	<div id="folders">
    <?php
    
	$files = scandir('./');
	foreach($files as $cate) {
		if($cate!=".htaccess" AND $cate!="." AND $cate!=".." AND $cate!="index.php" AND $cate!="box.php" AND $cate!="mobile.php"){
			$catedir = "./".$cate."/";
			$filecount = 0;
			$files = glob($catedir . "*.idmnd");
			if ($files){
				$filecount = count($files);
			}
			if ($filecount>0){
				$upcate = ucfirst($cate);
				echo "<div class=\"floating-box\"><a href=\"/box.php?lang=".$langdir."&category=".$cate." \"target=\"_new\" class=\"box\"><img class=\"expand\" src=\"/images/".$cate.".png\" /></a><span class=\"circle-count\">".$filecount." <font size=1>items</font></span></div>";
			}
		}
	}
	?>
	</div>
  <br>
  </div>
  </main>
      <footer class="footer">
        <br><div>&copy 2015-2017 <a href="http://sourceforge.net/projects/idiomind">idiomind</a> Project | <a href="http://idiomind.sourceforge.net/contact">Contact</a> | <a href="../privacypolicy.htm">Privacy</a><br><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">All the content is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike</a>.
        </div><br>
    </footer>
</body>
</html>
