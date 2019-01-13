<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Idiomind</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="learn english free, learn english, learn english online, learn english grammar, learn english vocabulary, free English lessons, basic english, english vocabulary, english dictation, business english, english as a second language, english as a foreign language, english spelling, english grammar, english dictation, ESL, EFL, pronunciation, grammar, vocabulary, tests, lessons, quiz, quizzes, resources, lesson, vocabulary, questions, answers"/>
    <meta name="description" content="A little utility for taking notes aimed to help you learn foreign vocabulary"/>
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/bootstrap-responsive.css" rel="stylesheet">
<!--
	// integrates very well into your GTK-based desktop
-->
    <link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon">
	<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16"/>
    <link rel="image_src" href="http://idiomind.net/images/logo.png"/><!--formatted-->
    
    
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>
    <link href="./css/css" rel="stylesheet" type="text/css">
    
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

  <div class="container">

    <div class="row">
        <div class="span6">
            <h2>Idiomind</h2>
             <p>Idiomind is a small but handy program based on shell scripts to learn foreign vocabulary</p>

			<h2>About</h2>
			<p>Language learners are constantly finding new words, ideas, expressions, ect.
		Idiomind can help you learn by save and practice words and phrases you discover every day</p>

		<h2>Some features</h2>
			<ul>
			<li>Take notes on the go!</li>
			<li>Pronunciation of words and phrases</li>
			<li>Automatic Translation via Google Translate</li>
			<li>5 types of workouts</li>
			<li>Tracking reviews in order to assimilate what you learned</li>
			<li>Setting up to 10 languages to learn</li>
			<li>Uses Zenity's fork Yad for graphical interface</li>
			<li>Language support: English, Spanish, Portuguese, French, Italian</li>
			</ul>
		<br>
			<p>Taking note of words and sentences from a PDF document:</p>
			<iframe width="285" height="160" src="https://www.youtube.com/embed/HFvcQjlVHcA?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>

			<h2>Idiomind PPA / Download</h2>
			<p>It can be installed through the terminal (recommended method) using the commands:<br>
			<code>add-apt-repository ppa:robinpalat/idiomind<br>
			apt-get update<br>
			apt-get install idiomind</code>
			<br>
			<p>It is also possible to download and install the latest version.</p>
			<div>
				<?php
				output_rss_feed("https://sourceforge.net/projects/idiomind/rss", 3, false, false, 200);
				?>
		    </div>

	<h2>Support or contact</h2>
    <p><a href="http://idiomind.sourceforge.net/contact">Send a message</a> and we’ll help you sort it out.</p>

	<footer>
			Copyright &copy; 2015-2019 <a href="http://sourceforge.net/projects/idiomind">Idiomind Project </a>
			<small>All the code under license GPL 3.</small>
	</footer>

		</div>
	  </div>
	</div>
	<br>
	
  </body>
</html>
