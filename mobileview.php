<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Study</title>
        <meta name="description" content="Flashcards">
        <link rel="stylesheet" href="/css/mobileview.css">
        <link rel="stylesheet" href="/css/fa/css/font-awesome.css">
        <link rel="image_src" href="/images/logo.png" / ><!--formatted-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/sweetalert.css">
        <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css" media="screen" />
        
        <?php $lang = htmlspecialchars($_GET["l"]); ?>
        
        <script type="text/javascript"> //  Loading gif
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
        
         <script type="text/javascript"> // Image fix 
            function imgError(image) {
                image.onerror = "";
                image.style="display: none;";
                var s = document.getElementById("imgs");
                s.value = "<br>";
                return true;
            }
        </script>
         
        <script type="text/javascript"> // Get X cookie value 
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
         
        <script type="text/javascript"> //  Buttons fav & lesson at loading
            function setBtnFav() {
                var lang = "<?php echo $lang ?>";
                var cookie_name = lang.charAt(0)+'PINS';
                var div = document.getElementById("data-name");
                var tpc = div.textContent;
                tpc = tpc.replace(/(^[ \t]*\n)/gm, '').replace(/^\s\s*/, '').replace(/\s\s*$/, '');
                /* Favorite */
                var el = document.getElementById("FavBtn")
                var faves = getCookie(cookie_name);
                var bol = faves.includes(tpc);
                if(bol == false) { el.src='/images/fav.png'; }
                else { el.src='/images/unfav.png'; }
                /* Lesson */
                //var el = document.getElementById("studySet")
                //var lessonChk = getCookie('topic_study');
                //if(lessonChk !== tpc) { el.src='/images/pin.png'; }
                //else { el.src='/images/unpin.png'; }
                
                
            }
        </script>
         
        <script type="text/javascript"> //  Toggle Button fav
            function Favesjs(el) {
                var lang = "<?php echo $lang ?>";
                var cookie_name = lang.charAt(0)+'PINS';
                var faves = getCookie(cookie_name);
                var bol = faves.includes(data.name);
        
                if(bol == true)
                {
                    var SetFavs_value = faves.replace(data.name+'|','');
                    var expiration_date = new Date();
                    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
                    var expires = "expires=" + expiration_date.toGMTString();
                    document.cookie=cookie_name+"="+SetFavs_value+"; expires=" + expires + "; path=/";
                    el.src='/images/fav.png';
                }
                else
                {
                    SetFavs_value = data.name+'|'+faves
                    var expiration_date = new Date();
                    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
                    var expires = "expires=" + expiration_date.toGMTString();
                    document.cookie=cookie_name+"="+SetFavs_value+"; expires=" + expires + "; path=/";
                    el.src='/images/unfav.png';
                }
            }
        </script>

        <script type="text/javascript"> //  Toggle Button study 
            function StudySet(el) {
                var lessonChk = getCookie('topic_study');
        
                if(data.name == lessonChk)
                {
                    var expiration_date = new Date();
                    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
                    var expires = "expires=" + expiration_date.toGMTString();
                    document.cookie="topic_study="+SetFavs_value+"; expires=" + expires + "; path=/";
                    el.src='/images/pin.png';
                }
                else
                {
                    SetFavs_value = data.name
                    var expiration_date = new Date();
                    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
                    var expires = "expires=" + expiration_date.toGMTString();
                    document.cookie="topic_study="+SetFavs_value+"; expires=" + expires + "; path=/";
                    el.src='/images/unpin.png';
                }
            }
         </script>
         
        <script>
            function ListFavs() {
                
            }
        </script>
         
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/fancybox/jquery.fancybox.js"></script>

    </head>
    <body onload="setBtnFav()">
        <div id="audio"></div>
        <?php
        include_once("analyticstracking.php");
        $lang = htmlspecialchars($_GET["l"]);
        $uplang = ucfirst($lang);
        $precatg = htmlspecialchars($_GET["c"]);
        $set = htmlspecialchars($_GET["set"]);
        //Get topic's category from remote json file (favorites)
        if ($precatg == 'fav') {
            $data = file_get_contents ('./share/'.$uplang.'/topics.json');
            $json = json_decode($data, true);
            foreach ($json['Categories'] as $field => $value) {
                foreach ($value as $key => $val) {
                        if( strpos( $val, $set ) !== false ) {
                            $catg = $field;
                            $backcatg = 'fav';
                        }
                    }
            }
               
        } else {
            $catg = $precatg;
            $backcatg = $precatg;
        }
        
        $ViewThisTopic = "/".$lang."/".$catg."/".$set.".idmnd";
        ?>
         <div id="data-name" style="display:none;">
            <?php print $set ?>
        </div>
        <div id="dom-target" style="display:none;">
            <?php print $ViewThisTopic ?>
        </div>
        
 <div id="page">
 
    <span id="headA">
        <table border="0" style="width:100%;margin:0;vertical-align:top;">
            <tr>
            <td>
                <table class="TopicInfo">
                    <tr>
                        <td>
                           <div id="name" class="TopicName">
                                <font style="font-weight:bold;font-family:Verdana;"></font>
                            </div>
                            <br> 
                            <span id="levl">This topic is aimed for <b><font></font></b> students.</span><br>
                            <span>Contains: </span>
                            <span id="nwrd"><font></font></span>
                            <span id="nsnt"><font></font></span>
                            <span id="naud"><font></font></span>
                            <span id="nimg"><font></font></span>
                        </td>
                    </tr>
                    <tr>
                      <td>Translations: <span style="text-align:left;"id="slng"><font ></font></span> <br>
                          It was uploaded on <span style="text-align:left;"id="dteu"><font></font></span> 
                          <span style="text-align:left;"id="autr"> by <font ></font>.
                          </span>
                      </td>
                    </tr>
                </table>
                
                <td class="td_GoBackBtn"><div><a href="mobilebox.php?lang=<?=$lang?>&category=<?=$backcatg?>" return false;><img title='Go back to "<?=$backcatg?>"' src='/images/backgrey.png'></a></div></td>
                </tr>
        </table>
    </span>

    <span id="TopicLanding">
        <div class="TestStartBtn" >
            <br>
            <input type="image" src="/images/fav.png" class="fav" style="outline:none;" id="FavBtn" onclick="Favesjs(this);" />
            <input title="Study" type="image" src="/images/lesson.png" style="outline:none;" onclick="displaya();"/>
            <input title="Flascards" type="image" src="/images/flashc1.png" class="flashdef" style="outline:none;" onclick="displayb();"/>
        </div>
        <div id="div_to_info">
            <p></p>
        </div>
        <div class="note" id="info_note">
            <p style="color:#4A4A4A;"></p>
        </div>
    </span>
    <br>
    
    
    <div id="Studyscrn" >
        <div id="vscreen" >

            <div id="v_imgs">
                <p></p>
            </div>
            
            <a href="##" id="vtts" title="Click to listen" style="text-decoration:none;" onclick="doFunction();">
                
            <div class="grmr pronounce" id="grmr" style="font-weight: bold;">
                <h1 style="color:#4A4A4A;text-align:center;"></h1>
            </div>
                    
            </a>
                
            <div id="v_srce" style="font-weight:normal;">
                <h2 style="color:#79848F;"></h2>
            </div>

            <div class="exmp" id="v_exmp">
                <p></p>
            </div>
                
            <div id="v_trgt" style="visibility:hidden">
                <p style="color:#4A4A4A"></p>
            </div>

            <div class="center">

                <div id="headC" class="ViewerInfo">
                    <div style="visibility:hidden" id="total"> total <font color="#1B5EC0"></font></div>
                    <div style="visibility:hidden" id="item"><font color="#464B5F">1</font></div> 
                    <div class="slidecontainer" id="slidecontainer" >
                    <input type="range" min="1" max="200" value="1" class="slider" id="item_slider">
                    </div>
                </div> 
                
                <table border="0" id="ViewerButtons" class="ViewerButtons">
                    <tr>
                        <td><input class="btnBack" style="background:url(/images/back1.png);background-repeat:no-repeat;background-position:center;outline:none;" id="Back" type="button" onclick="doFunction();" /></td> 
                        <td><input type="image" src="/images/play.png" class="btnPlay" style="background-position:center;outline:none;" id="Play" onclick="doFunction();" /></td>
                        <td><input class="btnNext" style="background:url(/images/next1.png);background-repeat:no-repeat;background-position:center;outline:none;" id="Next" type="button" onclick="doFunction();" /></td>
                    </tr>
                </table>
                
            </div>

        </div>
    </div>
    
     <div id="Flashscrn" >
        <span id="headB">
            <table border="0" style="width:100%;margin:0;vertical-align:top;" class="FlascardsInfo">
                <tr>
                    <tr>
                       <td>
                            <span style="background-color:#DE939A;border-radius:6px;padding:5px;box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);" id="score_no"> I did not know it:  <font></font></span>  &nbsp;&nbsp;
                            <span style="background-color:#A2D07D;border-radius:6px;padding:5px;box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);" id="score_ok">I knew it:  <font></font></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="text-align:left;"><font></font></span>
                        </td>
                    </tr>

                </tr>
            </table>
        </span>
        <br>
        <div id="fscreen" >
            
            <div id="imgs">
                <p></p>
            </div>
            
            <a href="##" id="tts"  title="Click to listen" style="text-decoration:none;" onclick="doFunction();">
                <div class="trgt pronounce" id="trgt" style="font-weight: bold;">
                    <h1 style="color:#4A4A4A"></h1>
                </div>
            </a>
       
            <div id="srce" style="font-weight:normal;">
                <h2 style="color:#758571;"></h2>
            </div>
            <div id="dots">
                <h2 style="color:#677862"></h2>
            </div>
            
            <div class="exmp" id="exmp">
                <p></p>
            </div>
        </div>
        
        <div id="QuizButtons" class="QuizButtons">
            <input class="btnNo" id="Wrong" type="button" value="0" onclick="doFunction();" />
            <input style="display: inline-block;" class="btnShow" id="Show" type="button" value="Show Translation" onclick="doFunction();" />
            <input class="btnOk" id="Right" type="button" value="0" onclick="doFunction();" />
        </div>
        
    </div>

</div>

<div id="loading"></div>

<script type="text/javascript" src="/js/view_mob.js"></script>
    
<script>
    function displaya() {
        $.fancybox.open({
        src  : '#Studyscrn',
        type : 'inline',
        height : "1000",
        opts : {
          scaleToFit: false,
          beforeShow : function( ) {
            this.height = "1000";
            var div = document.getElementById("dom-target");
            var myData = div.textContent;
            Viewer.loadData(myData);
          }
        }
      });
    }
</script>

<script>
    function displayb() {
        $.fancybox.open({
        src  : '#Flashscrn',
        type : 'inline',
        height : "1000",
        fullscreen: true,
        opts : {
          scaleToFit: false,
          beforeShow : function( ) {
            this.height = "1000";
            var div = document.getElementById("dom-target");
            var myData = div.textContent;
            Quiz.loadData(myData);
          }
        }
      });
    }
</script>

</body>
    
<script>
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
    Topic.loadData(myData);
    
</script>

</html>
