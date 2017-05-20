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
    <link href="/css/lg.css" rel="stylesheet" type="text/css" />
    <link href="/css/fa/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <?php include 'fetchfeed.php';?>

    <?php
    function mobileDevice()
    {
    $type = $_SERVER['HTTP_USER_AGENT'];
    if(strpos((string)$type, "Windows Phone") != false || strpos((string)$type, "iPhone") != false || strpos((string)$type, "Android") != false)
    return true;
    else
    return false;
    }
    if(mobileDevice() == true)
    header('Location: mobile.php');
    ?>
	
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
			$('.titleHidden').removeAttr('title');
            $(document).ready(function() {
                $(".box").fancybox({
                    'width'         : '75%',
                    'height'        : '85%',
                    'autoScale'     : false,
                    'transitionIn'      : 'none',
                    'transitionOut'     : 'none',
                    'overlayColor'      : '#000',
                    'overlayOpacity'    : 0,
                    'scrolling'     : 'yes',
                    'type'          : 'iframe'
                });
            });
    </script>
    
    <script>
		
	function underc(){
		alert('This website is under construction');
	}
	
	function hideshow(which){
		if (!document.getElementById)
		return
		if (which.style.display=="block")
		which.style.display="none"
		else
		which.style.display="block"
	}
	var info = `
	<div class="plus">
		<table width="90%" height="auto" border="0" align="center">
			<tr><td align="right"><a href="javascript:hideshow(document.getElementById('plus'))">X</a></td></tr>
			<tr><td align="left"><h1>ho Lorem ipsum dolor sit amet, consectetur adipisicing elit</h1> sed doeiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi utaliquip ex ea commodo consequat. Duis aute irure dolor inreprehenderit in voluptate velit esse cillum dLorem ipsum dolor sit amet, consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi utaliquip ex ea commodo consequat. Duis aute irure dolo</td></tr>
			<tr>
			</tr>
		</table>
		<table width="90%" height="auto" border="0" align="center">
			<td align="left"> <h2>level 1</h2><small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi utali</small></td>
			<td> </td>
			<td align="right"><img src="/images/l3.png"></td>
		</table>	
		<table width="90%" height="auto" border="0" align="center">
			<td align="left"><h2>level 2</h2><small>Lorem ipsu dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi utali</small> </td>
			<td align="center"><img src="/images/l2.png"></td>
			<td align="left"> <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed exercitation ullamco laboris nisi utali</small></td>
		</table>
		<table width="90%" height="auto" border="0" align="center">
			<td align="left"><img src="/images/l1.png"></td>
			<td align="left"><h2>level 3</h2><small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi utali</small></td>
			<td> </td>
		</table>
	</div>
	<br>
	`;
	$(document).ready(function(){
		$("#show").click(function(){
			document.getElementById('plus').innerHTML = info;
			document.getElementById('plus').style.display="block"
		});
	});
	</script>
	
</head>
	
<body onload="setCookie()">
    
    <?php
    
    include_once("analyticstracking.php");
    
	if(!isset($_COOKIE['iuser'])) {
		$use = "Login";
		$class_btn_user = "userbutton";

	} else {
		  $use = $_COOKIE['iuser'];
		  $use =  ucfirst($use);
		  $class_btn_user = "userbutton";
		}
    ?>
    
    <main id="content" class="group" role="main">
    <div class="main">

    <table width="100%" height="55px" border="0" align="center" class="top" style="border-spacing: 4px 4px;">
        <td align="left" class="langtitle">
            <a style="color:#FFFFFF" href="/<?=$langdir?>"><?=$uplangdir?></a><br>
        </td>
 
         <td style="border-radius:5px;background:#EBDA86;color:#FF0000;cursor:pointer" id="topLinks"><a id="show" href="#" style="color:#978786">Plus</a></td>
         <td style="border-radius:5px;background:#EB9486;color:#FFFFFF;cursor:pointer;font-weight:normal" id="topLinks" onclick="location.href='#categories'">Topics by Category</td>
         <td style="border-radius:5px;background:#6981A1;color:#FFFFFF;cursor:pointer;font-weight:normal" id="topLinks" onclick="underc();">Downloads</td>
         <td style="border-radius:5px;background:#7E7F9A;color:#FFFFFF;cursor:pointer;font-weight:normal" id="topLinks" onclick="underc();">Under Construction</td>

        <td align="right">
            <a class=<?=$class_btn_user?> style="text-decoration: none;color:#FFFFFF;" href="../community/"><small><?= $use ?></small></a>
        </td>
    </table>

	<br>
	
	<div id="plus"></div>

    <div class="sentenceweek">
		<div class="sentencew-content"><h1 style="color:#6B6664;"><i class="fa fa-rss-square" aria-hidden="true"></i> Sentence of the week</h1> consectetur adipisicing elit, sed doeiusmod<br> tempor incididunt ut labore et dolore magna aliqua. Ut enimad<br> minim veniam, quis nostrud exercitation ullamco laboris nisi utaliquip ex ea commodo consequat.<br> Duis aute irure dolor inreprehenderit<br> in voluptate velit esse cillum dolore eu fugiat <br>nullapariatur. Excepteur sint occaecat cupidatat non proident, sunt inculpa qui officia deserunt mollit anim id est <br>laborum.Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit, se
	</div>
		
	</div>

	<br>
        <div class="feed-lists" class="box">
		   <h1>Latest Published Topics</h1>
		<?php
		output_rss_feed("http://idiomind.net/rss.php/?trgt=".$langdir, 8, true, true, 200);
		//output_rss_feed("http://tmp.site50.net/rss/", 5, false, false, 200);
		?>
		</div>
        
    <br>
    
		<div id="categories">
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
					$catee = strtoupper($cate);
					echo "<div class=\"floating-box\"><a title=\"".$catee."\" href=\"/box.php?lang=".$langdir."&category=".$cate." \"target=\"_new\" class=\"box\" class=\"titleHidden\"><img class=\"expand\" src=\"/images/".$cate.".png\" /></a><span class=\"circle-count\">".$filecount." <font size=1>topics</font></span></div>";
					
				}
			}
		}
		?>
	</div>

  </div>
  <br>
  </main>
      <footer class="footer">
        <br><div> &copy 2015-2017 <a href="http://idiomind.sourceforge.net">idiomind</a> Project | <a href="http://idiomind.sourceforge.net/contact">Contact</a> | <a href="../privacypolicy.htm">Privacy</a><br><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">All the content is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike</a>.
        </div><br>
    </footer>
  
</body>
</html>
