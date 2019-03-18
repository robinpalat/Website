<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Study</title>
        <meta name="description" content="Flashcards">
        <link rel="stylesheet" href="/css/mobileview.css">
        <link rel="stylesheet" href="/css/fa/css/font-awesome.css">
        <link rel="image_src" href="http://idiomind.net/images/zwlogo.png" / ><!--formatted-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/sweetalert.css">
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
        $uplang = ucfirst($lang);
        $precatg = htmlspecialchars($_GET["c"]);
        $set = htmlspecialchars($_GET["set"]);
        //Get category of topic from remote json file (if came empty from favorites)
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
            <table border="0" class="topic_info">
            <tr>
               <td>
                   <div id="name" class="topicName">
                        <font style="font-weight:bold;font-family:Verdana;"></font><br>
                    </div>
                    <br>
                        </span>
                        <span id="levl">This material is aimed for <b><font></font></b> students.</span><br>
                        <div style="text-align:left;padding-top:4"><b>Contains:</b></div>
                        <span style="text-align:left" id="nwrd"><font></font></span> and 
                        <span style="text-align:left" id="nsnt"><font></font></span><br>
                        <div style="text-align:left" id="naud"><font></font></div>
                        <div style="text-align:left" id="nimg"><font></font></div>
                        <div style="text-align:left;padding-top:4"><b>Translations:</b></div>
                        <div style="text-align:left" id="slng"><font></font></div>
                 
                        <div style="text-align:left;padding-top:4;">It was uploaded on <span style="text-align:left;"id="dteu"><font></font><span style="text-align:left;"id="autr"> by <font ></font></span></div>

                    </td>
                </tr>
                
                <tr>
                <td>
                  <br>
                </td>
            </tr>

            </table>
            <td class="floating-box-right"><div><a href="mobilebox.php?lang=<?=$lang?>&category=<?=$backcatg?>" return false;><img title='Go back to "<?=$backcatg?>"' src='/images/backgrey.png'></a></div></td>
            </tr>
        </table>
    </span>

    <span id="headB" style="visibility:hidden">
        <table border="0" style="width:100%;margin:0;vertical-align:top;">
        <tr>
        <td>
            <table class="flascards_info">
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

            </table>
            <td>
            </td>
            <td class="floating-box-right"><div><a href="##" id="ToHomeB"><img src='/images/back.png'></a></div></td>
            </tr>
        </table>
    </span>
    <span id="TopicLanding">
        <div class="TestStartBtn" >
                
<!--
                <input title="Pin" src="/images/dl.png" type="image" class="flashdef" style="outline:none;" id="studySet" onclick="StudySet(this);" />
-->
                                
                <input type="image" src="/images/fav.png" class="fav" style="outline:none;" id="FavBtn" onclick="Favesjs(this);" />

                <input title="Studys" type="image" src="/images/lesson.png" class="flashimg" style="outline:none;" id="flashimg" onclick="doFunction();" />
                <input title="Flascards" type="image" src="/images/flashc1.png" class="flashdef" style="outline:none;" id="flashdef" onclick="doFunction();" />
        </div>
        
            <div id="div_to_info">
                <p></p>
            </div>
        
            <div class="note" id="info_note">
                <p style="color:#4A4A4A;font-size:10px;font-size:1.00vw;"></p>
            </div>
        
        
        
    
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
                
                <tr>
                    <td style="visibility:hidden">
                      <span id="total"> total <font color="#1B5EC0"></font></span> /
                      <span id="item"><font color="#464B5F">1</font></span> 
                       
                    </td>
                </tr>
            </td>
            </table>
            <td>
            </td>
            <td class="floating-box-right"><div><a href="##" id="ToHomeC"><img src='/images/back.png'></a></div></td>
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

        <div id="vscreen" >
            
            <div id="v_imgs" background="green">
                <p></p>
            </div>
            
            <a href="##" id="vtts" title="Click to listen" style="text-decoration:none;" onclick="doFunction();">

                <div class="grmr pronounce" id="grmr" style="font-weight: bold;">
                    <h1 style="color:#4A4A4A"></h1>
                </div>
                
            </a>
            
            <div id="v_srce" style="font-weight:normal;">
                <h2 style="color:#79848F;"></h2>
            </div>

            <div class="exmp" id="v_exmp">
                <p></p>
            </div>
            
            <div id="trgt">
                    <p style="color:#4A4A4A"></p>
            </div>
            
        </div>
        
        <div id="QuizButtons" class="QuizButtons" style="visibility:hidden;">
                <input class="btnNo" id="Wrong" type="button" value="0" onclick="doFunction();" />
                <input style="display: inline-block;" class="btnShow" id="Show" type="button" value="Show Translation" onclick="doFunction();" />
                <input class="btnOk" id="Right" type="button" value="0" onclick="doFunction();" />
        </div>
        
        <div class="center">
            <table border="0" id="ViewerButtons" class="ViewerButtons" style="visibility:hidden;">
                <tr>
                    <td><input class="btnBack" style="background:url(/images/back1.png);background-repeat:no-repeat;background-position:center;outline:none;" id="Back" type="button" onclick="doFunction();" /></td> 
                    <td><input type="image" src="/images/play.png" class="btnPlay" style="background-position:center;outline:none;" id="Play" onclick="doFunction();" /></td>
                    <td><input class="btnNext" style="background:url(/images/next1.png);background-repeat:no-repeat;background-position:center;outline:none;" id="Next" type="button" onclick="doFunction();" /></td>
                </tr>
            </table>
        </div>
        
</div>

<div id="loading"></div>
    
</body>
    
<script type="text/javascript" src="/js/view_mob.js"></script>
<script>
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
    Topic.loadData(myData);
</script>

</html>
