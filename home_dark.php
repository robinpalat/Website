
<!DOCTYPE html>
<html lang="es" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#">
<head>
  <link rel="profile" href="http://www.w3.org/1999/xhtml/vocab" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Generator" content="Drupal 7 (http://drupal.org)" />
<meta about="/community/users/duende#me" typeof="foaf:Person" rel="foaf:account" resource="/community/users/duende" />
<meta about="/community/users/duende" property="foaf:name" content="Duende" />
  <title>Duende | idiomind.net</title>
  
   <link type="text/css" rel="stylesheet" href="/css/home_dark.css" media="all" />

<link type="text/css" rel="stylesheet" href="/css/bootstrap_slate.min.css" media="all" />

  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->



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
<body onload="setCookie()" class="html not-front logged-in no-sidebars page-user page-user- page-user-2 i18n-es">
	
	
	
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
	
	
	
	
	
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable">Pasar al contenido principal</a>
  </div>
    <header id="navbar" role="banner" class="navbar container navbar-default">
  <div class="container">
    <div class="navbar-header">
              <a class="logo navbar-btn pull-left" href="/community/" title="Inicio">
<!--
          <img src="http://idiomind.net/community/sites/default/files/library_icon.svg__1_3.png" alt="Inicio" />
-->
        </a>
      
              <a class="name navbar-brand" href="/community/" title="Inicio">idiomind.net</a>
      
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
          </div>

          <div class="navbar-collapse collapse" id="navbar-collapse">
        <nav role="navigation">
                                <ul class="menu nav navbar-nav secondary"><li class="first leaf"><a href="/community/user">Duende</a></li>
<li class="leaf"><a href="http://idiomind.net/library.php" title="">Topics Library</a></li>
<li class="last leaf"><a href="/community/user/logout">Cerrar sesión</a></li>
</ul>                            </nav>
      </div>
      </div>
</header>

<div class="main-container container">

  <header role="banner" id="page-header">
    
      </header> <!-- /#page-header -->

  <div class="row">

    
    <section class="col-sm-12">
                  <a id="main-content"></a>
                    <h1 class="page-header">Duende</h1>
                                <h2 class="element-invisible">Primary tabs</h2><ul class="tabs--primary nav nav-tabs"><li class="active"><a href="/community/users/duende" class="active">Ver<span class="element-invisible">(solapa activa)</span></a></li>
<li><a href="/community/user/2/courses">Cursos</a></li>
<li><a href="/community/user/2/edit">Editar</a></li>
<li><a href="/community/user/2/quiz-results">Mis resultados</a></li>
<li><a href="/community/user/2/track">Mis temas</a></li>
<li><a href="/community/user/2/orders">Pedidos</a></li>
<li><a href="/community/user/2/signups">Inscripciones</a></li>
</ul>                          <div class="region region-content">
    <section id="block-system-main" class="block block-system clearfix">

      
  <div class="profile" typeof="sioc:UserAccount" about="/community/users/duende">
  
<!--
<dl>
  <dt>Blog</dt>
<dd><a href="/community/blogs/duende" title="Read Duende&#039;s latest topics.">View recent entries</a></dd>
<dt>Pedidos</dt>
<dd><a href="/community/user/2/orders">Click here to view your order history.</a></dd>
<dt>Member for</dt>
<dd>3 meses 1 semana</dd>
</dl>
-->


    <div class="sentenceweek">
		<div class="sentencew-content"><h1 style="color:#6B6664;"><i class="fa fa-rss-square" aria-hidden="true"></i> Sentence of the week</h1> consectetur adipisicing elit, sed doeiusmod<br> tempor incididunt ut labore et dolore magna aliqua. Ut enimad<br> minim veniam, quis nostrud exercitation ullamco laboris nisi utaliquip ex ea commodo consequat.<br> Duis aute irure dolor inreprehenderit<br> in voluptate velit esse cillum dolore eu fugiat <br>nullapariatur. Excepteur sint occaecat cupidatat non proident, sunt inculpa qui officia deserunt mollit anim id est <br>laborum.Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit, se
	</div>
		
	</div>

	<br>

        <div class="feed-lists" class="box">
		   <h1>Latest Published Topics</h1>
		<?php
		output_rss_feed("http://idiomind.sourceforge.io/rss.php/?trgt=".$langdir, 8, true, true, 200);
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
					//title=\"".$catee."\" 
					echo "<a href=\"/box.php?lang=".$langdir."&category=".$cate." \"target=\"_new\" class=\"box\"><div class=\"floating-box\"><img class=\"expand\" src=\"/images/".$cate.".png\" /><span class=\"circle-count\">".$filecount." <font size=1>topics</font></span></div></a>";
				}
			}
		}
		?>
	</div>
    
    
    

  </div>
  <br>


</div>

</section>
  </div>
    </section>

    
  </div>
</div>

  <footer class="footer container">
      <div class="region region-footer">
    <section id="block-system-powered-by" class="block block-system clearfix">

      

        <br><div> &copy 2015-2017 <a href="http://idiomind.sourceforge.net">idiomind</a> Project | <a href="http://idiomind.sourceforge.net/contact">Contact</a> | <a href="../privacypolicy.htm">Privacy</a><br><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">All the content is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike</a>.
        </div><br>

</section>
  </div>
  </footer>
  <script src="http://idiomind.net/community/sites/default/files/js/js_OTdL_00eEtQq3wzsUAHLDYwgtcHpzbgUFYeJRcQf8f8.js"></script>
</body>
</html>
