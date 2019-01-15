<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- saved from url=(0062)http://idiomind.sourceforge.net/index.php?category=impressum -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta charset="utf-8">
    <title>Idiomind</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="learn english free, learn english, learn english online, learn english grammar, learn english vocabulary, free English lessons, basic english, english vocabulary, english dictation, business english, english as a second language, english as a foreign language, english spelling, english grammar, english dictation, ESL, EFL, pronunciation, grammar, vocabulary, tests, lessons, quiz, quizzes, resources, lesson, vocabulary, questions, answers"/>
    <meta name="description" content="A little utility for taking notes aimed to help you learn foreign vocabulary"/>
    
    <link rel="stylesheet" type="text/css" href="/css/classic.css">
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">
    
    <link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16"/>
    <link rel="image_src" href="/images/logo.png"/><!--formatted-->
    
    <style type="text/css">:root topadblock, :root td[valign="top"] > .mainmenu[style="padding:10px 0 0 0 !important;"], { display: none !important; }
    </style>

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
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-63037434-3', 'auto');
      ga('send', 'pageview');
    </script>
    
    <?php include 'rss_releases.php';?>
    
</head>

<body>
    <div class="wrapper">
        <div class="logo_bar">
            <img class="wrapped_logo" src="/images/logo.png" height="58px" align="left">
            <h1>Idiomind</h1>
            <p>
            Idiomind is a small program to learn a foreign language
            </p>
        </div>
        
        <div class="header_bar">
            <div class="navigation_bar" align="left">
                <a class="current_category" href="index.php" onfocus="this.blur();">Introduction</a>
                <a class="category" href="help.html" onfocus="this.blur();">Getting started</a>
                <a class="category" href="contact.html" onfocus="this.blur();">Contact</a>
                <a class="category" href="library.html" onfocus="this.blur();">Library</a>
                <a class="category" href="donate.html" onfocus="this.blur();">Donate</a>
            </div>
        </div>
        
        <div class="content_wrapper">
            
            <div class="content">

                <p>
                    Language learners are constantly finding new words, phrases, Idiomind can help you learn by save and practice words and phrases you discover every day
                </p>
                
                <h3>
                    Here are some features it has:
                </h3>
                
                <p>
                    <ul>
                    <li>Take notes on the go</li>
                    <li>Pronunciation of words and phrases</li>
                    <li>Automatic Translation via Google Translate</li>
                    <li>Practices</li>
                    <li>Tracking reviews in order to assimilate what you learned</li>
                    <li>Setting up to 10 languages to learn</li>
                    <li>Interface languages: English, Spanish, Portuguese, French, Italian</li>
                    </ul>
                </p>

                <h3>
                    Taking note of words and sentences from a PDF document:
                </h3>
                
                <p>
                    <iframe width="285" height="160" src="https://www.youtube.com/embed/HFvcQjlVHcA?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
                </p>
                <br>
                
                <h2>
                    Install / Download
                </h2>
                
                <p>It can be installed through the terminal using the commands:<br></p>
                    <p>
                <code>add-apt-repository ppa:robinpalat/idiomind<br>
                apt-get update<br>
                apt-get install idiomind</code>
                <br><br>
                </p>
                <p>
                    It is also possible to download and install the latest version.
                </p>
                
                [![Download Idiomind](https://a.fsdn.com/con/app/sf-download-button)](https://sourceforge.net/projects/idiomind/files/0.2.9/idiomind_0.2.9_all.deb/download)
                
                <div>
                    <p>
                        <?php
                        output_rss_feed("https://sourceforge.net/projects/idiomind/rss", 3, false, false, 200);
                        ?>
                    </p>
                </div>
                
                
                <br>
                <h2>
                    About / History
                </h2>
                <p><img src="/images/me.png" alt="Robin Palatnik" height="92" width="92" align="left" hspace="10" vspace="0"></img>
                    I'm Robin Palatnik from Argentina. Back in 2012 I used Ubuntu Lucid on my PC, I needed to memorize words and I was looking for some program for that, I wanted something simple, that went straight to the point. Then I decided to write a Bash script that did the job of showing dialog boxes with Zenity. To more possibilities that the programming offered, more details and features was implemented, thus the number of scripts, functions, ect. was growing.<br>Then I stumbled upon YAD, a very enhanced zenity fork, so I began to organize the code and write it more readable way; Since then, Idiomind had raised its level ;)
                </p>
                <p>
                <small>
                       <a href="https://www.ubuntu.com">https://www.ubuntu.com</a><br>
                       <a href="https://en.wikipedia.org/wiki/Bash_(Unix_shell)">https://en.wikipedia.org/wiki/Bash_(Unix_shell)</a><br>
                       <a href="https://help.gnome.org/users/zenity/3.24/">https://help.gnome.org/users/zenity/3.24/</a><br>
                       <a href="https://github.com/robinpalat/idiomind">https://github.com/robinpalat/idiomind</a><br>
                       <a href="https://sourceforge.net/projects/yad-dialog">https://sourceforge.net/projects/yad-dialog</a><br>
                 </small>
                    
                    
                </p>
                
            </div>
            <br>
            
        </div>

    </div>
            
    <div class="footer">
        <p><small>Copyright &copy; 2015-2019 <a href="http://sourceforge.net/projects/idiomind">Idiomind Project </a>
        All the code under license GPL 3.</small><p>
    </div>

</body>

</html>

