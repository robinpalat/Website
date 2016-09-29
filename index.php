<!DOCTYPE html>
<html>
  <head>
      
    <meta charset="utf-8">
    <title>Idiomind's library</title>
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="learn english free, learn english, learn english online, learn english grammar, learn english vocabulary, free English lessons, basic english, english vocabulary, english dictation, business english, english as a second language, english as a foreign language, english spelling, english grammar, english dictation, ESL, EFL, pronunciation, grammar, vocabulary, tests, lessons, quiz, quizzes, resources, lesson, vocabulary, questions, answers"/>
    <meta name="description" content="A little utility for taking notes aimed to help you learn foreign vocabulary"/>
    <!-- Bootstrap -->
    <link href="./style.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/bootstrap-responsive.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet"> 
    <link rel="shortcut icon" href="favicon.ico?v=2" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>
    <link href="./css/css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63037434-3', 'auto');
  ga('send', 'pageview');

</script>

<script>
function setCookie(lang,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie=lang + "=" + cvalue; + expires + "; path=/";
}
function getCookie(lang) {
    var lang = lang + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(lang) == 0) return c.substring(lang.length,c.length);
    }
    return "";
}
function checkCookie() {
    var lang=getCookie("language");
    if (lang != "") {
        window.location = window.location.toString()+lang;
        }
}
</script>

</head>
  <body onload="checkCookie()">
      
  <div id="header-row">
    <div class="container">
      <div class="row">
       <div align="right"></div>
      </div>
    </div>
  </div>
  
    <div class="container">
    <div class="row">
            <div class="span6">
                <h2>Welcome to Idiomind's library</h2>
                 <div class="plainInner">
                    <h3>Please select the language you are learning to get in and find topics:</h3>
                    <ul class="blank">
                        <li><a href="http://idiomind.net/english/" class="librarylink">English</a></li>
                        <li><a href="http://idiomind.net/spanish/" class="librarylink">Spanish</a></li>
                        <li><a href="http://idiomind.net/portuguese/" class="librarylink">Portuguese</a></li>
                        <li><a href="http://idiomind.net/italian/" class="librarylink">Italian</a></li>
                        <li><a href="http://idiomind.net/french/" class="librarylink">French</a></li>
                        <li><a href="http://idiomind.net/chinese/" class="librarylink">Chinese</a></li>
                        <li><a href="http://idiomind.net/russian/" class="librarylink">Russian</a></li>
                        <li><a href="http://idiomind.net/german/" class="librarylink">German</a></li>
                        <li><a href="http://idiomind.net/japonese/" class="librarylink">Japonese</a></li>
                        <li><a href="http://idiomind.net/vietnamese/" class="librarylink">Vietnamese</a></li>
                    </ul>
                </div>
          </div>
    </div>

    <footer>
        <div class="container">
          <div class="row">
            <div class="span6">Copyright &copy 2015-2016 <a href="http://sourceforge.net/projects/idiomind">idiomind</a> Project | <a href="http://idiomind.sourceforge.net/contact">Contact</a> | <a href="http://idiomind.sourceforge.net" target="_new">Website</a>
            </div>
          </div>
        </div>
    </footer>

    
  </div><!-- container --><script type="text/javascript">var base = "http://idiomind.net/";</script><script type="text/javascript" src="./js/jq210.js"></script>
  </body>
</html>
