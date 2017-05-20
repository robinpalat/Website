
var scoreOk = 0
var scoreNo = 0
var imported = document.createElement('script');
imported.src = '/js/sweetalert.min.js';
document.head.appendChild(imported);

function percentage(num, per)
{
  return (num*100)/per;
}


var Cards = (function() {
    
    var render_page = function (data) {
        //var subjectElement = document.querySelector("#name").children[0]
        //subjectElement.innerHTML = data.name
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
        var itle = trgt.toLowerCase();
        var exmp = exmp.replace(itle, "<b>"+itle+"</b>")
        var exmp = exmp.replace(trgt, "<b>"+trgt+"</b>")
        
        var chars = trgt.length;
		if ((chars >= 1) && (chars < 20)) {
		  var fs = 30;
		} else if ((chars >= 20) && (chars < 40)) {
		  var fs = 26; 
		} else if ((chars >= 40) && (chars < 80)) {
		  var fs = 24;
		} else if ((chars >= 80) && (chars < 100)) {
		  var fs = 22;
		} else {
		  var fs = 20;
		}
		
		var chars = srce.length;
		if ((chars >= 1) && (chars < 20)) {
		  var sfs = 28;
		} else if ((chars >= 20) && (chars < 40)) {
		  var sfs = 22;
		} else if ((chars >= 40) && (chars < 80)) {
		  var sfs = 18;
		} else if ((chars >= 80) && (chars < 100)) {
		  var sfs = 16;
		} else {
		  var sfs = 16;
		}

		var lcss = 'h1 { font-size:'+fs+'} '+
		'h2 { font-size:'+sfs+'}'+
		'@media all and (max-device-width: 320px){'+
		'h1 { font-size:'+fs+';}'+
		'h2 { font-size:'+sfs+';}}',
		head = document.head || document.getElementsByTagName('head')[0],
		style = document.createElement('style');
		style.type = 'text/css';
		style.appendChild(document.createTextNode(lcss));
		head.appendChild(style);
		
        var trgtElement = document.querySelector("#trgt").children[0]
        var srceElement = document.querySelector("#srce").children[0]
        var dotsElement = document.querySelector("#dots").children[0]
        var exmpElement = document.querySelector("#exmp").children[0]
        var scoreOkElement = document.querySelector("#score_ok").children[0]
        var scoreNoElement = document.querySelector("#score_no").children[0]
        document.getElementById("Show").style = "DISPLAY: true;";
        document.getElementById('Right').style.right = "5%";
        document.getElementById('Wrong').style.left = "5%";
        
        srceElement.hidden = true
        dotsElement.hidden = false

        trgtElement.innerHTML = trgt
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
    }
    
    
    var load_data = function(file) {
        var xmlhttp = new XMLHttpRequest()
    
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                data = JSON.parse(xmlhttp.responseText)
                Cards.renderPage(data)
            } else if (xmlhttp.readyState==4 && xmlhttp.status==404) {
                alert('This file is not yet on Server, try again later.')
                document.write('<br><br><div align="center"><b>Exiting...</b></div>')
                goBack();
            }
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
	
	
	document.getElementById("Wrong").onclick = function () { Cards.nextCardNo(); };
	document.getElementById("Right").onclick = function () { Cards.nextCardOk(); };
	

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
