<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Study</title>
        <meta name="description" content="Flashcards">
        <link rel="stylesheet" href="/css/view.css">
        <link rel="stylesheet" href="/css/fa/css/font-awesome.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/sweetalert.css">

        <script>
			function onReady(callback) {
				var intervalID = window.setInterval(checkReady, 1000);

				function checkReady() {
					if (document.getElementsByTagName('body')[0] !== undefined) {
						window.clearInterval(intervalID);
						callback.call(this);
					}
				}
			}

			function show(id, value) {
				document.getElementById(id).style.display = value ? 'block' : 'none';
			}

			onReady(function () {
				show('page', true);
				show('loading', false);
			});
        </script>
        
         <script>
			function imgError(image) {
				image.onerror = "";
				image.style="display: none;";
				var s = document.getElementById("imgs");
				s.value = "<br>";
				return true;
			}
         </script>
         
         <script>
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
         </script>
         
        <script>
		function setBtnFav() {
			var el = document.getElementById("FavBtn")
			var faves = getCookie('Topics_fav');
			var bol = faves.includes(data.name);
			if(bol==false)
			{
				el.src='/images/fav.png';
				el.className="fav";
			}
			if(bol==true)
			{
				el.src='/images/unfav.png';
				el.className="unfav";
			}
		}
         </script>
         
         <script>
			function Favesjs(el) {

				var faves = getCookie('Topics_fav');
				var bol = faves.includes(data.name);
		
				if(bol==true)
				{
					var SetFavs_value = faves.replace(data.name+'|','');
					var expiration_date = new Date();
					expiration_date.setFullYear(expiration_date.getFullYear() + 1);
					var expires = "expires=" + expiration_date.toGMTString();
					document.cookie="Topics_fav="+SetFavs_value+"; expires=" + expires + "; path=/";
					el.src='/images/fav.png';
					el.className="fav";
				}
				
				if(bol==false)
				{
					SetFavs_value = data.name+'|'+faves
					var expiration_date = new Date();
					expiration_date.setFullYear(expiration_date.getFullYear() + 1);
					var expires = "expires=" + expiration_date.toGMTString();
					document.cookie="Topics_fav="+SetFavs_value+"; expires=" + expires + "; path=/";
					el.src='/images/unfav.png';
					el.className="unfav";
				}
			}
         </script>
         
    </head>
    <body onload="setBtnFav()">
        <?php
        include_once("analyticstracking.php");
        $lang = htmlspecialchars($_GET["l"]);
        $catg = htmlspecialchars($_GET["c"]);
        $set = htmlspecialchars($_GET["set"]);
        ?>
        <div id="dom-target" style="display: none;">
            <?php
            $set = "/".$lang."/".$catg."/".$set.".idmnd";
            print $set
            ?>
        </div>
        
 <div id="page">
 
	<span id="headA">
		<table style="width:100%;margin:0;vertical-align:top;">
		<tr>
		<td>
			<table class="tainfo">
			<tr>
			   <td class="tdinfo">
				   
				   <div id="name" class="topicName">
						<p style="font-weight:bold;font-family:bookman;"></p>
					</div>
					  <span id="nwrd"><font></font></span>
					  <span id="nsnt"><font></font></span>
					  <span id="naud"><font></font></span>
					  <span id="nimg"><font></font></span>
				  </td>
				</tr>
				<tr>
				  <td>
					  <span style="text-align:left;"id="autr"><font></font></span>
				  </td>
				</tr>

			</table>
			<td class="floating-box-right"><div><a href="box.php?lang=<?=$lang?>&category=<?=$catg?>" return false;><img src='/images/close.png'></a></div></td>
			</tr>
		</table>
	</span>

	<span id="headB" style="visibility:hidden">
		<table style="width:100%;margin:0;vertical-align:top;">
		<tr>
		<td>
			<table class="tainfo">
			<tr>
			   <td class="tdinfo">
					  <span id="nwrdB"><font></font></span>
					  <span id="nsntB"><font></font></span> | 
					  <span id="score_no"> I did not know it <font color="#C01B4C"></font></span> /
					  <span id="score_ok">I knew it <font color="green"></font></span>
				  </td>
				</tr>
				<tr>
				  <td>
					  <span style="text-align:left;"id="autrB"><font></font></span>
				  </td>
				</tr>

			</table>
			<td>
			</td>
			<td class="floating-box-right"><div><a href="##" id="ToHome"><img src='/images/close.png'></a></div></td>
			</tr>
		</table>
	</span>
<br>
	<span id="TopicLanding">
			<div class="TestStartBtn">
				<input type="image" src="/images/fav.png" class="fav" id="FavBtn" onclick="Favesjs(this);" />
				<input title="Flascards" type="image" src="/images/flashc1.png" class="flashimg" id="flashimg" onclick="doFunction();" />
				<input title="Flascards" type="image" src="/images/flashc1.png" class="flashdef" id="flashdef" onclick="doFunction();" />
			</div>
			<br><br><br><br>
				<hr>
			<div class="note" id="info">
				<p style="color:#4A4A4A"></p>
			</div>
	</span>

	<div id="fscreen">
			
			<div id="imgs">
				<p></p>
			</div>
			
			<a href="##" id="tts" style="text-decoration:none;" onclick="doFunction();">
				<div class="trgt pronounce" id="trgt">
					<h1 style="color:#4A4A4A"></h1>
				</div>
			</a>
			
			<div id="srce">
				<h2 style="color:#7C8C77;"></h2>
			</div>
			<div id="dots">
				<h2 style="color:#7C8C77"></h2>
			</div>
			
			
			<div class="exmp" id="exmp">
				<font></font>
			</div>
			
		</div>
		
        <div id="FlashcardButtoms" class="FlashcardButtoms" style="visibility:hidden;">
				<input class="btnNo" id="Wrong" type="button" value="Wrong" onclick="doFunction();" />
				<input style="display: inline-block;" class="btnShow" id="Show" type="button" value="Show Translation" onclick="doFunction();" />
				<input class="btnOk" id="Right" type="button" value="Right" onclick="doFunction();" />
		</div>
		
</div>

<div id="loading"></div>
	
</body>
    
<script src="/js/flashcard.js"></script>
<script>
	var div = document.getElementById("dom-target");
	var myData = div.textContent;
	Topic.loadData(myData);
</script>

</html>
