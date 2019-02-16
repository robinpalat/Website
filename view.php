<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Study</title>
        <meta name="description" content="Flashcards"/>
        <link rel="stylesheet" href="/css/view.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="/css/sweetalert.css"/>
<!--
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
-->

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
            var div = document.getElementById("data-name");
            var tpc = div.textContent;
            tpc = tpc.replace(/(^[ \t]*\n)/gm, '').replace(/^\s\s*/, '').replace(/\s\s*$/, '');
            /* Favorite */
            var el = document.getElementById("FavBtn")
            var faves = getCookie('Topics_fav');
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

                var faves = getCookie('Topics_fav');
                var bol = faves.includes(data.name);
        
                if(bol == true)
                {
                    var SetFavs_value = faves.replace(data.name+'|','');
                    var expiration_date = new Date();
                    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
                    var expires = "expires=" + expiration_date.toGMTString();
                    document.cookie="Topics_fav="+SetFavs_value+"; expires=" + expires + "; path=/";
                    el.src='/images/fav.png';
                }
                else
                {
                    SetFavs_value = data.name+'|'+faves
                    var expiration_date = new Date();
                    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
                    var expires = "expires=" + expiration_date.toGMTString();
                    document.cookie="Topics_fav="+SetFavs_value+"; expires=" + expires + "; path=/";
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

    </head>
    <body onload="setBtnFav()">
        <div id="audio"></div>
        <?php
        include_once("analyticstracking.php");
        $lang = htmlspecialchars($_GET["l"]);
        $precatg = htmlspecialchars($_GET["c"]);
        $set = htmlspecialchars($_GET["set"]);
        //Get category of topic from remote json file (if came empty from favorites)
        if ($precatg == 'fav') {
            $data = file_get_contents ('./share/data/topics.json');
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
        <table style="width:100%;margin:0;vertical-align:top;">
        <tr>
        <td>
            <table class="topic_info">
            <tr>
               <td>
                   <div id="name" class="topicName">
                        <p style="font-weight:bold;font-family:Verdana;"></p>
                    </div>
                      <span id="levl">This topic is intended for <b><font></font></b> students.</span><br>
                      <span>Contains: </span>
                      <span id="nwrd"><font></font></span>
                      <span id="nsnt"><font></font></span>
                      <span id="naud"><font></font></span>
                      <span id="nimg"><font></font></span>
                  </td>
                </tr>
                
                <tr>
                  <td>Translations: <span style="text-align:left;"id="slng"><font ></font></span>. <a href="box.php?">Translate it into your language</a><br>
                      It was updated on <span style="text-align:left;"id="dteu"><font></font>. </span> 
                      <span style="text-align:left;"id="autr">Uploaded by <font ></font></span>
                  </td>
                </tr>

            </table>
            <td class="floating-box-right"><div><a href="box.php?lang=<?=$lang?>&category=<?=$backcatg?>" return false;><img title='Go back to "<?=$backcatg?>"' src='/images/back_grey.png'></a></div></td>
            </tr>
        </table>
    </span>

    <span id="headB" style="visibility:hidden">
        <table style="width:100%;margin:0;vertical-align:top;">
        <tr>
        <td>
            <table class="flascards_info">
            <tr>
               <td>
                      <span id="nwrdB"> <font></font></span>
                      <span id="nsntB"> <font></font></span> | 
                      <span id="score_no"> I did not know it  <font color="#C01B4C"></font></span> /
                      <span id="score_ok">I knew it  <font color="green"></font></span>
                  </td>
                </tr>
                <tr>
                  <td>
                      <span style="text-align:left;"><font></font></span>
                  </td>
                </tr>

            </table>
            <td>
            </td>
            <td class="floating-box-right"><div><a href="##" id="ToHomeB"><img src='/images/back_green.png'></a></div></td>
            </tr>
        </table>
    </span>
    
    <span id="headC" style="visibility:hidden">
        <table border="0" style="width:100%;margin:0;vertical-align:top;">
        <tr>
        <td>
            <table border="0" class="viewer_info">
                <tr>
                    <td>
                      <span style="text-align:left;"><font></font></span>
                      <span class="slidecontainer" id="slidecontainer" style="visibility:hidden;">
                        <input type="range" min="1" max="200" value="1" class="slider" id="item_slider">
                        </span>
                    </td>
                </tr>
                
                <tr style="visibility:hidden;">
                    <td>
                      <span id="nwrdC"> <font></font></span>
                      <span id="nsntC"> <font></font></span> | 
                      <span id="total"> total <font color="#1B5EC0"></font></span> /
                      <span id="item"><font color="#464B5F">1</font></span> 
                       
                    </td>
                </tr>
</td>
            </table>
            <td>
            </td>
            <td class="floating-box-right"><div><a href="##" id="ToHomeC"><img src='/images/back_blue.png'></a></div></td>
            </tr>
        </table>
    </span>

<br>
    <span id="TopicLanding">
            <div class="TestStartBtn">
                
                <input title="Pin" src="/images/dl.png" type="image" class="flashdef" id="studySet" onclick="StudySet(this);" />
                                
                <input type="image" src="/images/fav.png" class="fav" id="FavBtn" onclick="Favesjs(this);" />

                <input title="Studys" type="image" src="/images/lesson.png" class="flashimg" id="flashimg" onclick="doFunction();" />
                <input title="Flascards" type="image" src="/images/flashc1.png" class="flashdef" id="flashdef" onclick="doFunction();" />
            </div>
            <br><br><br><br>
                
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
                <h2 style="color:#677862;"></h2>
            </div>
            <div id="dots">
                <h2 style="color:#677862"></h2>
            </div>
            
            <div class="exmp" id="exmp">
                <font></font>
            </div>
            
        </div>

        <div id="vscreen">
            
            <div id="v_imgs">
                <p></p>
            </div>
            
            <a href="##" id="tts" style="text-decoration:none;" onclick="doFunction();">

                <div class="grmr pronounce" id="grmr">
                    <h1 style="color:#4A4A4A"></h1>
                </div>
                
            </a>
            
            <div id="v_srce">
                <h2 style="color:#677862;"></h2>
            </div>

            <div class="exmp" id="v_exmp">
                <font></font>
            </div>
            
            <div id="trgt">
                    <p style="color:#4A4A4A"></p>
            </div>
            
        </div>
        
       

        <div id="QuizButtons" class="QuizButtons" style="visibility:hidden;">
                <input class="btnNo" id="Wrong" type="button" value="Wrong" onclick="doFunction();" />
                <input style="display: inline-block;" class="btnShow" id="Show" type="button" value="Show Translation" onclick="doFunction();" />
                <input class="btnOk" id="Right" type="button" value="Right" onclick="doFunction();" />
        </div>
        
        <div class="center">
            <table border="0" id="ViewerButtons" style="text-align:center;" class="ViewerButtons" style="visibility:hidden;">
                <tr>
                    <td><input class="btnBack" id="Back" type="button" value="<" onclick="doFunction();" /></td> 
                    <td><input type="image" src="/images/play.png" class="btnPlay" id="Play" onclick="doFunction();" /></td>
                    <td><input class="btnNext" id="Next" type="button" value=">" onclick="doFunction();" /></td>
                </tr>
            </table>
        </div>
        
</div>

<div id="loading"></div>
    
</body>
    
<script type="text/javascript" src="/js/flashcard.js"></script>
<script>
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
    Topic.loadData(myData);
</script>

</html>
