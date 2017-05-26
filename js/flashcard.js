
var scoreOk = 0
var scoreNo = 0
var imported = document.createElement('script');
imported.src = '/js/sweetalert.min.js';
document.head.appendChild(imported);
var imported = document.createElement('script');
imported.src = '/js/voicerss-tts.min.js';
document.head.appendChild(imported);

var speechtrgt = function (trgt) {
		VoiceRSS.speech({
		key: 'b7a621583d034658bf22c3d829de5fcf',
		src: trgt,
		hl: 'en-us',
		r: 0, 
		c: 'ogg',
		f: '44khz_16bit_stereo',
		ssml: false
	});
}

function percentage(num, per)
{
  return (num*100)/per;
}

var Topic = (function() {
    
    var render_page = function (data) {
        var subjectElement = document.querySelector("#name").children[0]
        subjectElement.innerHTML = data.name
        var subjectElement = document.querySelector("#info").children[0]
        subjectElement.innerHTML = data.info
        var subjectElement = document.querySelector("#autr").children[0]
        subjectElement.innerHTML = 'Create by ' + data.autr
        var subjectElement = document.querySelector("#nwrd").children[0]
        subjectElement.innerHTML = 'Words ' + data.nwrd
        var subjectElement = document.querySelector("#nsnt").children[0]
        subjectElement.innerHTML = 'Sentences ' + data.nsnt
        var subjectElement = document.querySelector("#nimg").children[0]
        subjectElement.innerHTML = 'Images ' + data.nimg
        var subjectElement = document.querySelector("#naud").children[0]
        subjectElement.innerHTML = 'Audio ' + data.naud
        
        var first = Object.keys(data.items)[0]
        render_topic(first, data.items[first])
    }
    
    var render_topic = function (trgt, dat) {
        document.body.style.backgroundColor = "#cdeeb1";
        document.getElementById("headA").style = "DISPLAY: true;";
        document.getElementById("headB").style = "DISPLAY: none;";
        document.getElementById("TopicLanding").style = "DISPLAY: true;";
        document.getElementById("fscreen").style = "DISPLAY: none;";
        document.getElementById("FlashcardButtoms").style = "DISPLAY: none;";
    }

    var load_data = function(file) {
        var xmlhttp = new XMLHttpRequest()
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                data = JSON.parse(xmlhttp.responseText)
                Topic.renderPage(data)
            } else if (xmlhttp.readyState==4 && xmlhttp.status==404) {
                swal("This file is not yet on Server, try again later.", ' ', "error");
                document.write('<br><br><div align="center"><big>Exiting...</big></div>')
                goBack();
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


var Notes = (function() {
    
    var render_page = function (data) {
        var subjectElement = document.querySelector("#autrB").children[0]
        subjectElement.innerHTML = 'Create by ' + data.autr
        var subjectElement = document.querySelector("#nwrdB").children[0]
        subjectElement.innerHTML = 'Words ' + data.nwrd
        var subjectElement = document.querySelector("#nsntB").children[0]
        subjectElement.innerHTML = 'Sentences ' + data.nsnt
        
        var first = Object.keys(data.items)[0]
        render_card(first, data.items[first], scoreOk, scoreNo)

    }
    
    var render_card = function (trgt, dat, scoreOk, scoreNo) {
        
        arr = []
        for(var event in dat){
            var dataCopy = dat[event]
            for(key in dataCopy){
                dataCopy[key] = new Date(dataCopy[key])
            }
            arr.push(dataCopy)
        }
        var srce = JSON.stringify(arr[0])
        var srce = JSON.parse(srce)
        
        var exmp = JSON.stringify(arr[11])
        var exmp = JSON.parse(exmp)
        
        var grmr = JSON.stringify(arr[15])
        var grmr = JSON.parse(grmr)
        
        var imag = JSON.stringify(arr[19])
        var imag = JSON.parse(imag)
        
        var type = JSON.stringify(arr[22])
        var type = JSON.parse(type)

        var itle = trgt.toLowerCase();
        var exmp = exmp.replace(itle, "<b>"+itle+"</b>")
        var exmp = exmp.replace(trgt, "<b>"+trgt+"</b>")
        
        var chars = trgt.length;
		if ((chars >= 1) && (chars < 20)) {
		  var fs = 68; var vw = 4.75
		} else if ((chars >= 20) && (chars < 40)) {
		  var fs = 50; var vw = 4.55
		} else if ((chars >= 40) && (chars < 80)) {
		  var fs = 55; var vw = 4.25
		} else if ((chars >= 80) && (chars < 100)) {
		  var fs = 45; var vw = 3.75
		} else {
		  var fs = 35; var vw = 3.55
		}
		
		var chars = srce.length;
		if ((chars >= 1) && (chars < 20)) {
		  var sfs = 35; var svw = 3.25
		} else if ((chars >= 20) && (chars < 40)) {
		  var sfs = 32; var svw = 3.00
		} else if ((chars >= 40) && (chars < 80)) {
		  var sfs = 28; var svw = 2.75
		} else if ((chars >= 80) && (chars < 100)) {
		  var sfs = 25; var svw = 2.55
		} else {
		  var sfs = 25; var svw = 2.25
		}
		var mvw = 6; var msvw = 5
		var lcss = 'h1 { font-size:'+fs+';font-size:'+vw+'vw;} '+
		'h2 { font-size:'+sfs+';font-size:'+svw+'vw;}'+
		'.pronounce {width:90%}'+
		'@media all and (max-device-width: 320px){'+
		'h1 { font-size:'+fs+';font-size:'+mvw+'vw;}'+
		'h2 { font-size:'+sfs+';font-size:'+msvw+'vw;}'+
		'.pronounce {width:95%}}',
		head = document.head || document.getElementsByTagName('head')[0],
		style = document.createElement('style');
		style.type = 'text/css';
		style.appendChild(document.createTextNode(lcss));
		head.appendChild(style);
		
		window.pronounce = function () {
			speechtrgt(trgt);
		}

        var trgtElement = document.querySelector("#trgt").children[0]
        var srceElement = document.querySelector("#srce").children[0]
        var dotsElement = document.querySelector("#dots").children[0]
        var imgsElement = document.querySelector("#imgs").children[0]
        var exmpElement = document.querySelector("#exmp").children[0]
        var scoreOkElement = document.querySelector("#score_ok").children[0]
        var scoreNoElement = document.querySelector("#score_no").children[0]
        document.getElementById("Show").style = "DISPLAY: true;";
        document.getElementById('Right').style.right = "5%";
        document.getElementById('Wrong').style.left = "5%";
        
        srceElement.hidden = true
        dotsElement.hidden = false
        
        document.body.style.backgroundColor = "#cdeeb1";
        document.getElementById("headA").style = "DISPLAY: none;";
        document.getElementById("headB").style = "DISPLAY: true;";
        document.getElementById("TopicLanding").style = "DISPLAY: none;";
        document.getElementById("fscreen").style = "DISPLAY: true;";
        document.getElementById("FlashcardButtoms").style = "DISPLAY: true;";

        trgtElement.innerHTML = trgt
        if ((type == '1') && (imag != '0')) {
			trgtximg = trgt.toLowerCase()
			imgsElement.innerHTML = '<img class="WordImage" src="/share/images/'+trgtximg+'-'+imag+'.jpg" onerror="imgError(this);"</img>'
		} else {
			imgsElement.innerHTML = '<br>'
        }
        srceElement.innerHTML = srce
        dotsElement.innerHTML = '<img src="/images/eyelash.svg"</img>'
        exmpElement.innerHTML = exmp
        scoreNoElement.innerHTML = scoreNo
        scoreOkElement.innerHTML = scoreOk
    }
    
	var next_card_ok = function () {
        var trgt = document.querySelector("#trgt").children[0].innerHTML
        var scoreOk = document.querySelector("#score_ok").children[0].innerHTML
        var scoreOk = Number(scoreOk)
        var scoreNo = document.querySelector("#score_no").children[0].innerHTML
        var scoreNo = Number(scoreNo)

        var keys = Object.keys(data.items)
        var current = keys.indexOf(trgt)
        var nextIndex = current+1
        var scoreOk = scoreOk+1

        if (nextIndex == keys.length) {
			
			var por = percentage(scoreOk, keys.length);
			var por = por.toFixed();
			
			if (scoreOk == keys.length) {
			  swal("Congratulations, you made a passing score!", 'Your score is: '+por+'%', "success");
			} else if (scoreOk > scoreNo) {
			  swal("Good job!", 'Your score is: '+por+'%', "success");
			} else if (scoreOk < scoreNo) {
			  swal("You've not passed", 'Your score is: '+por+'%', "error");
			} else if (scoreOk == scoreNo) {
			  swal("Good job!", 'Your score is: '+por+'%', "warning");
			}
			
            var scoreOk = 0;
            var scoreNo = 0;
            var nextIndex = 0;
        }

        var next = keys[nextIndex]
        render_card(next, data.items[next], scoreOk, scoreNo)
        
        var imge = document.querySelector("#imgs").children[0].innerHTML
		imge.error = function () { 
			document.getElementById("imgs").style.display = "none";
		}
		
    }
    
    
	var next_card_no = function () {
        var trgt = document.querySelector("#trgt").children[0].innerHTML
        var trgt = document.querySelector("#trgt").children[0].innerHTML
        var scoreOk = document.querySelector("#score_ok").children[0].innerHTML
        var scoreOk = Number(scoreOk)
        var scoreNo = document.querySelector("#score_no").children[0].innerHTML
        var scoreNo = Number(scoreNo)

        var keys = Object.keys(data.items)
        var current = keys.indexOf(trgt)
        var nextIndex = current+1
        var scoreNo = scoreNo+1
        
        if (nextIndex == keys.length) {
            
            Topic.loadData(myData);
            
			var por = percentage(scoreOk, keys.length);
			var por = por.toFixed();
			
			if (scoreOk == keys.length) {
			  swal("Congratulations, you made a passing score!", 'Your score is: '+por+'%', "success");
			} else if (scoreOk > scoreNo) {
			  swal("Good job!", 'Your score is: '+por+'%', "success");
			} else if (scoreOk < scoreNo) {
			  swal("You've not passed", 'Your score is: '+por+'%', "error");
			} else if (scoreOk == scoreNo) {
			  swal("Good job!", 'Your score is: '+por+'%', "warning");
			}
			
            var scoreOk = 0; var scoreNo = 0; var nextIndex = 0;
        }

        var next = keys[nextIndex]
        render_card(next, data.items[next], scoreOk, scoreNo)
    }
    
    
    var load_data = function(file) {
        var xmlhttp = new XMLHttpRequest()

        xmlhttp.onreadystatechange = function () {
           data = JSON.parse(xmlhttp.responseText)
           Notes.renderPage(data)
        }

        xmlhttp.open("GET", file, true)
        xmlhttp.send()
    }

    return {
        renderCard: render_card,
        renderPage: render_page,
        nextCardOk: next_card_ok,
        nextCardNo: next_card_no,
        loadData: load_data
    }
})()



window.addEventListener('load', function () {
	document.getElementById("Wrong").onclick = function () { Notes.nextCardNo(); };
	document.getElementById("Right").onclick = function () { Notes.nextCardOk(); };
	document.getElementById("tts").onclick = function () { window.pronounce(); };
	
	var div = document.getElementById("dom-target");
    var myData = div.textContent;
    document.getElementById("ToHome").onclick = function () { Topic.loadData(myData); };
	document.getElementById("flashimg").onclick = function () { Notes.loadData(myData); };
	document.getElementById("flashdef").onclick = function () { Notes.loadData(myData); };

	document.getElementById("Show").onclick = function () {  
        var srceElement = document.querySelector("#srce").children[0]
        var dotsElement = document.querySelector("#dots").children[0]
        srceElement.hidden = false
        dotsElement.hidden = true
        document.getElementById("Show").style = "DISPLAY: none;";
        document.getElementById('Right').style.right = "21%";
        document.getElementById('Wrong').style.left = "21%";
    }
})
