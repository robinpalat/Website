<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Study</title>
        <meta name="description" content="Flashcards">
        <link rel="stylesheet" href="/css/view.css">
        <link rel="stylesheet" href="/css/fa/css/font-awesome.css">
        <link rel="image_src" href="http://idiomind.net/images/zwlogo.png" / ><!--formatted-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/sweetalert.css">
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        <script>
        function toggleFullScreen() {
              if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
               (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                if (document.documentElement.requestFullScreen) {  
                  document.documentElement.requestFullScreen();  
                } else if (document.documentElement.mozRequestFullScreen) {  
                  document.documentElement.mozRequestFullScreen();  
                } else if (document.documentElement.webkitRequestFullScreen) {  
                  document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
                }  
              } else {  
                if (document.cancelFullScreen) {  
                  document.cancelFullScreen();  
                } else if (document.mozCancelFullScreen) {  
                  document.mozCancelFullScreen();  
                } else if (document.webkitCancelFullScreen) {  
                  document.webkitCancelFullScreen();  
                }  
              }  
            }
        </script>
        
        <script>
        document.addEventListener("DOMContentLoaded", function(event) {
		   document.querySelectorAll('img').forEach(function(img){
			img.onerror = function(){this.style.display='none';};
		   })
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
        
    </head>
    <body>
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

	<span id="headA">
		<table style="width:100%;margin:0;vertical-align:top;">
		<tr>
		<td>
			<table class="tainfo">
			<tr>
			   <td class="tdinfo">
				   
				   <span id="name">
						<h2 style="color:#4A4A4A"></h2>
					</span>
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
			<td class="floating-box-right"><div><a href="##" onClick="goBack(); return false; "><img src='/images/close.png'></a></div></td>
			</tr>
		</table>
	</span>
		
		
		
	<span id="headB" style="visibility:hidden;">
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
<!--
				<div class="help-tip">
					<p>This is the inline help tip! It can contain all kinds of HTML. Style it as you please.</p>
				</div>
-->
			</td>
			<td class="floating-box-right"><div><a href="##" id="ToHome"><img src='/images/close.png'></a></div></td>
			</tr>
		</table>
	</span>

	    <span id="TopicLanding">
			<table border=0 style="width:90%;padding:10px;vertical-align:top;">
				<tr><td>
					  <div class="note" id="info">
						<p style="color:#4A4A4A"></p>
					  </div>
					 </td>
				</tr>
				<hr>
				<input class="flashimg" id="flashimg" type="button" value="Flashcards with images" onclick="doFunction();" />
				<input class="flashdef" id="flashdef" type="button" value="Flashcards" onclick="doFunction();" />
			</table>
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
				</div>
				
				<div id="srce">
					<h2 style="color:#778773;"></h2>
				</div>
				<div id="dots">
					<h2 style="color:#5D725C"></h2>
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
		
    </body>
    <script src="/js/flashcard.js"></script>
    <script>
        var div = document.getElementById("dom-target");
        var myData = div.textContent;
        Topic.loadData(myData);
    </script>

</html>
