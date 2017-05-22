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
<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
<link rel="image_src" href="http://idiomind.net/images/logo.png" / ><!--formatted-->
<title>Idiomind's library</title>
<link href="/css/apphome.css" rel="stylesheet" type="text/css" />
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

    <table width="100%" height="40px" border="0" align="center" class="top">
        <td style="width:55%;" align="left" >
            <a class="langtitle" style="vertical-align:top;font-size:17px;color:#FFFFFF" href="/<?=$langdir?>/app.php">My <?=$uplangdir?></a>
        </td>
        <td style="width:40%;" align="right">
			<a style="text-align:middle;font-size:12px;text-decoration:none;color:#B1B1B1" href="../community/"><?= $use ?></a>
        </td>
           <td style="width:2%;" align="right">
            <img height="32" width="32" src="/images/logo.svg">
        </td>
    </table>
<br>
	<div class="folders">
    <?php
	$files = scandir('./');
	foreach($files as $cate) {
		if($cate!=".htaccess" AND $cate!="." AND $cate!=".."){
			$catedir = "./".$cate."/";
			$filecount = 0;
			$files = glob($catedir . "*.idmnd");
			if ($files){
				$filecount = count($files);
			}
			if ($filecount>0){
				$upcate = ucfirst($cate);
				echo "<a title=\"".$catee."\" href=\"/appbox.php?lang=".$langdir."&category=".$cate." \"target=\"_new\" class=\"box\"><div class=\"floating-box\"><img class=\"expand\" src=\"/images/".$cate.".png\" /><span class=\"circle-count\">".$filecount." <font size=1>topics</font></span></div></a>";
			}
		}
	}
	?>
	</div>
  </div>
  </main>
</body>
</html>
