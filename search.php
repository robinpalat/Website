<html/>
<head>
<script>
	function loadJSON(callback) {   
		var xobj = new XMLHttpRequest();
			xobj.overrideMimeType("application/json");
		xobj.open('GET', '/share/data/topics.json', true);
		xobj.onreadystatechange = function () {
			  if (xobj.readyState == 4 && xobj.status == "200") {
				callback(xobj.responseText);
			  }
		};
		xobj.send(null);  
	 }
    function GetCtgy() {
        var txt_val;
        txt_val = document.getElementById("GetCtgy").value;
         function init() {
			loadJSON(function(response) {
			// Parse JSON string into object
			var actual_JSON = JSON.parse(response);
			for (var ctgy in actual_JSON.Categories) { // itineracion por las categoctias
				if (actual_JSON.Categories.hasOwnProperty(ctgy)) { // algo propio del formato json
				var chck = actual_JSON.Categories[ctgy]; // assignamos la variable 'chck' a la categoria casual
				// itineracion por los topics de la categoria casual. tomo 'chck' de la categoria casual ('tpc' en un numero del loop) 
				for (var n in chck) {
					var topic // Creamos la variable topic que contendra el nombre del topic
					topic = chck[n] // el topic casual tomado de la itineracion
					topic = String(topic) // nos aseguramos que la variable 'topic 'sea un 'string'
					if(topic.includes(txt_val)) // si la variable topic contiene el texto introducido
						{
							console.log(ctgy);
							return ctgy;
						}
					}
				}
				}
			});
		}
	init()
    }
</script>

</head>

<body>

    <input type="text"id="GetCtgy">
	<input type="submit"value="get password"onclick="GetCtgy()">

</body>

<body>
</body>
</html>
