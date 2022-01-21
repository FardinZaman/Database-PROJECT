	var editor = [];
	var editorf = [];

	function splitQuery(queryText){
		
		var indexS = queryText.indexOf("<head>");
		var indexE = queryText.indexOf("</head>");
		var substr;
		
		var queryDet = {heading:"", title:"", query:""};
		
		if(indexS != -1 && indexE != -1){
			substr = queryText.substring(indexS, indexE).replace("<head>", "");
			queryDet.heading = substr;
		}

		var indexS = queryText.indexOf("<title>");
		var indexE = queryText.indexOf("</title>");
		
		if(indexS != -1 && indexE != -1){
			substr = queryText.substring(indexS, indexE).replace("<title>", "");
			queryDet.title = substr;
		}
		
		var indexS = queryText.indexOf("<code>");
		var indexE = queryText.indexOf("</code>");
		
		if(indexS != -1 && indexE != -1){
			substr = queryText.substring(indexS, indexE).replace("<code>", "");
			queryDet.query = substr;
		}
		
		queryDet.query = queryDet.query.trim() + "\n\n\n";
		
		return queryDet;
	}
	
	
	function getData(filename, htmlTag1, htmlTag2){
		$.get(filename, function(data) {
			var str = data.split("<query>");
			var j = 1;
			for(var i = 0; i < str.length; i++){
				if(str[i].indexOf("<code>") == -1){
					continue;
				}
				var queryD = splitQuery(str[i]);
				var appendStr = "<div class = 'query'>" + "<h2>" + j + ". "+ queryD.heading +"</h2>" + "<h4>" + queryD.title + "</h4>" + "<div class = 'editor'>" + 
				"<textarea class='queryText'>" + queryD.query + "</textarea>" +"</div>" + "<a class = 'run' href = '#'>Run Query</a>" + "<h4>Output : </h4>" + 
				"<div class = 'divider'></div>" + "<div class = 'output'></div></div>";
				$(htmlTag1).append(appendStr);
				j++;
			}

			var selector = $(htmlTag2);
			for(var i = 0; i < selector.length; i++){
				editor.push(CodeMirror.fromTextArea(selector[i], {
				  lineNumbers: true,
				  mode: 'text/x-mariadb',
				  matchBrackets: true,
				  theme : 'dracula',
					viewportMargin: Infinity
				}));
				
			}	

		}, 'text');

	}



$(document).ready(function(){
	

	getData("queries.xml",  "#queries .queries","#queries .queryText");
	getData("functions.xml",  "#functions .queries","#functions .queryText");
	
	
	$(".navigation a").click(function(e) {
		e.preventDefault();
	
		var position = $($(this).attr("href")).offset().top;

		$("body, html").animate({
			scrollTop: position
		} /* speed */ );
	});
			
	$(".queries").on("click", ".run", function(e){
		var queryResult;
		var output = $(this).closest(".query").find(".output");

		e.preventDefault();		
		$.ajax({
				url: "queryget.php",
				data : { query : editor[$(".query .run").index(this)].getValue() },
				success: function(result){
					queryResult = result;
					createResult(queryResult, output);
				}
		});

		
	})
	
	function createResult(queryResult, output){
		if(queryResult.indexOf("valid") == 0){
			queryResult = queryResult.replace("valid", "");
			var table = [];
			var temp = queryResult.split("||r||");
			for(var i = 0; i < temp.length-1; i++){
					table[i] = [];
					var temp2 = temp[i].split("||c||");
					for(var j = 0; j < temp2.length-1; j++){
						table[i].push(temp2[j]);
					}
			}
			
			var mystr = "<table class = 'result'>";
			for(var i = 0; i < table.length; i++){
				mystr += "<tr>";
				for(var j = 0; j < table[i].length; j++){
					mystr += "<td>" + table[i][j] + "</td>"
				}				
				mystr += "</tr>";
			}
			mystr += "</table>";
			output.html(mystr);
		}else{
			output.html(queryResult)			
		}
	}

	
});			
