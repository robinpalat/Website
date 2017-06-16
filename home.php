<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"/>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="keywords" content="ESL, EFL, pronunciation, grammar, vocabulary, tests, lessons, quiz, quizzes, resources, lesson, vocabulary, questions, answers"/>
    <meta name="description" content="Learn foreign vocabulary"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon">
	<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="image_src" href="http://idiomind.net/images/logo.png" /><!--formatted-->
    <title>Idiomind's library</title>
    <link href="/css/home.css" rel="stylesheet" type="text/css" />
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
    <script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

    <script type="text/javascript">
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
                    'type'          : 'iframe',
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
		
	if(!isset($_COOKIE['Topics_fav'])) {
		$favs = "";
	} else {
		  $favs = $_COOKIE['Topics_fav'];
		  $favs =  ucfirst($favs);
		}

    ?>
    
    <main id="content" class="group" role="main">
    <div class="main">

    <table width="100%" height="60px" border="0" align="center" class="navbar-header" style="border-spacing: 4px 4px;">
        <td vertical-align="middle" align="left" class="langtitle">
            <a style="color:#FFFFFF" href="/<?=$langdir?>">My <?=$langdir?></a>
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


<!--
   <form action="/search.php" method="post">
    <input name="my_html_input_tag"  value=""/>

    <input type="submit" name="my_form_submit_button" 
           value="Click here for nothing"/>

    </form>
-->



	<div class="sentenceweek">
			<div class="sentencew-content"><h1 style="color:#6B6664;"><i class="fa fa-rss-square" aria-hidden="true"></i> -- Under construction --</h1>
			<div class="comment more"><br></div><table id="excelDataTable" border="0"></table>
		</div>
		
	</div>

	<br>
	

	
	<table width='100%'>
		<tr>
			<td valign="top">
			<div class="feed-lists" class="box">
				<h1>Latest Published Topics</h1>
			<?php
			echo" ";
			output_rss_feed("http://idiomind.net/rss.php/?trgt=".$langdir, 8, true, true, 200);
			?>
			</div>
			</td>
			

			
			<td valign="top">
				<div class="fav-lists" >
				<?php
					
					if(!isset($_COOKIE['Topics_fav'])) {
						$topics_favs = "";
						
					} else {
						  $topics_favs = $_COOKIE['Topics_fav'];
						  $topics_favs =  ucfirst($topics_favs);
					}
				
					if (!empty($topics_favs)){
						echo"<h1 style='text-align:right'>Favorites</h1>";
						$topics_favs = explode('|', $topics_favs);
						foreach($topics_favs as $fav) {
								
								if($fav!="|" AND $fav!=""){
									 echo"<a class=\"box\" href=\"/view.php?l=".$langdir."&c=fav&set=".$fav."\">{$fav}</a><br>";
							}
						}
					}
				?>
				</div>
			
			
			</td>
		</tr>
		
	</table>
		
		
		
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
					//title=\"".$catee."\" 
					echo "<a href=\"/box.php?lang=".$langdir."&category=".$cate." \"target=\"_new\" class=\"box\"><div class=\"floating-box\"><img class=\"expand\" src=\"/images/".$cate.".png\" /><span class=\"circle-count\">".$filecount." <font size=1>topics</font></span></div></a>";
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
 <script>
	$(document).ready(function() {
		
			function getCookie(cname) {
				var name = cname + "=";
				var decodedCookie = decodeURIComponent(document.cookie);
				var ca = decodedCookie.split(';');
				for(var i = 0; i <ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				return "";
			}
		
		var lessonChk = getCookie('topic_study');
		var myData = './at home/'+lessonChk+'.idmnd'
		
		var Topic = (function() {
			
			var render_page = function (data) {
					var first = Object.keys(data.items)[0]
					render_topic(first, data.items[first])
					
					
					//////////////////////////////////////////////////
					var myList = data.items
					var myList = Object.keys(data.items)
		

					// Builds the HTML Table out of myList.
					function buildHtmlTable(selector) {
					  var columns = addAllColumnHeaders(myList, selector);

					  for (var i = 0; i < myList.length; i++) {
						var row$ = $('<tr/>');
						for (var colIndex = 0; colIndex < columns.length; colIndex++) {
						  var cellValue = myList[i][columns[colIndex]];
						  if (cellValue == null) cellValue = "";
						  row$.append($('<td/>').html(cellValue));
						}
						$(selector).append(row$);
					  }
					}

					// Adds a header row to the table and returns the set of columns.
					// Need to do union of keys from all records as some records may not contain
					// all records.
					function addAllColumnHeaders(myList, selector) {
					  var columnSet = [];
					  var headerTr$ = $('<tr/>');

					  for (var i = 0; i < myList.length; i++) {
						var rowHash = myList[i];
						for (var key in rowHash) {
						  if ($.inArray(key, columnSet) == -1) {
							columnSet.push(key);
							headerTr$.append($('<th/>').html());
						  }
						}
					  }
					  $(selector).append(headerTr$);

					  return columnSet;
					}
			


				//buildHtmlTable('#excelDataTable')
					
					
				//////////////////////////////////////////////////
					
					

			}
			
			var render_topic = function (trgt, dat) {
			
				arr = []
				for(var event in dat){
					var dataCopy = dat[event]
					for(key in dataCopy){
						dataCopy[key] = new Date(dataCopy[key])
					}
					arr.push(dataCopy)
				}
				var srce = JSON.stringify(arr[0])
				srce = JSON.parse(srce)
				var exmp = JSON.stringify(arr[11])
				exmp = JSON.parse(exmp)
				var grmr = JSON.stringify(arr[15])
				grmr = JSON.parse(grmr)
				var imag = JSON.stringify(arr[19])
				imag = JSON.parse(imag)
				var type = JSON.stringify(arr[22])
				type = JSON.parse(type)
				var itle = trgt.toLowerCase();
				var exmp = exmp.replace(itle, "<b>"+itle+"</b>")
				exmp = exmp.replace(trgt, "<b>"+trgt+"</b>")
			}

			var load_data = function(file) {
				var xmlhttp = new XMLHttpRequest()
				xmlhttp.onreadystatechange = function () {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						data = JSON.parse(xmlhttp.responseText)
						Topic.renderPage(data)
					} else if (xmlhttp.readyState==4 && xmlhttp.status==404) {
						//document.write('<br><br><div align="center"><big>Exiting...</big></div>')
					}
				}
				xmlhttp.open("GET", file, true)
				xmlhttp.send()

			}
			return {
				renderTopic: render_topic,
				renderPage: render_page,
				loadData: load_data
			}
		})()
		
		Topic.loadData(myData)
		
		var showChar = 100;
		var ellipsestext = "...";
		var moretext = "more";
		var lesstext = "less";
		$('.more').each(function() {
			var content = lessonChk + "<div id=\"name\"></div>consectetur adipiscing elit. Vestibulum laoreet, nunc eget laoreet sagittis, quam ligula sodales orci, congue imperdiet eros tortor ac lectus. Duis eget nisl orci. Aliquam mattis purus non mauris blandit id luctus felis convallis. Integer varius egestas vestibulum. Nullam a dolor arcu, ac tempor elit. Donec. Duis nisl nibh, egestas at fermentum at, viverra et purus."
			
			if(content.length > showChar) {
				var c = content.substr(0, showChar);
				var h = content.substr(showChar-1, content.length - showChar);
				var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
				$(this).html(html);
			}
		});

		$(".morelink").click(function(){
			if($(this).hasClass("less")) {
				$(this).removeClass("less");
				$(this).html(moretext);
				
			} else {
				$(this).addClass("less");
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});
	});

 </script>

</html>

