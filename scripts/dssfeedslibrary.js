function updateNagiosFeed(feedLocation){

	//$.getJSON( "http://localhost/dssfeedsdev/feeds/nagios_feed.php", function( data ) {
	//alert("RRFRFR");
		/* var weather_icon = data.current_observation.icon_url;
		var location = data.current_observation.display_location.city;
		var temperature = data.current_observation.temp_f;
		var conditions = data.current_observation.weather;
		var tdata = "<div id='weather_w'> <div id='w_icon'><img src='" + weather_icon + "' /></div> <div id='w_status'>" + conditions + "<br/>Location:" + location +"<br/>Temperature:" + temperature + "&deg;</div></div><br/>";
		$(elementID).html(tdata); */
	//});
	var retVal = "<table class='supportqueue'><tr><th>Hostname</th><th>Issue</th><th>Time</th></tr><tr><td>Host</td><td>Disk</td><td>Time</td></tr></table>";
	return retVal;
}

function parseNewfeed(feedLocation){
	var tdata=""
	var xml = new JKL.ParseXML( feedLocation );
	var data = xml.parse();
	$.each(data.rss.channel.item, function(i, item){
	//	tdata += item.title
		tdata += "<li><a href='#'>" + item.title + "</a></li>";
	});
	var retVal = "<ul>" + tdata + "</ul>";
	return retVal;
}
function parseWeatherFeed(feedlocation, elementID)
{
	$.getJSON( feedlocation, function( data ) {
		var weather_icon = data.current_observation.icon_url;
		var location = data.current_observation.display_location.city;
		var temperature = data.current_observation.temp_f;
		var conditions = data.current_observation.weather;
		var tdata = "<div id='weather_w'> <div id='w_icon'><img src='" + weather_icon + "' /></div> <div id='w_status'>" + conditions + "<br/>Location:" + location +"<br/>Temperature:" + temperature + "&deg;</div></div><br/>";
		$(elementID).html(tdata);
	});
}
function parseSingleTicket(feedlocation, elementID){
	//$("#dialog").attr("title", "rcrfrcrr");
	//$("#dialog").html("<p>rgvrgfvrgvgvrgfvrgvrgvr</p>");
	$.getJSON( feedlocation, function( data ) {
		
		$("#dialog").attr("title",data.issue.id +": " + data.issue.subject);
		$("#dialog").html("<pre>" + data.issue.description + "</pre>");
		$( "#dialog" ).dialog({ width: 700 }, {position: "right top"});
	});
}
function parseRedmineFeedJSON(feedlocation, elementID){
	$.getJSON( feedlocation, function( data ) {
				var temp = "";
				var even = false;
				var state = "odd";
				$.each(data.issues, function(i, item){
				
					if(even == false){
						even = true;
						state = "even";
					}
					else{
						even = false;
						state = "odd";
					}
					var date = item.updated_on.split(" ");
					temp += "<tr class='" + state + "'><td>" + item.id + "</td><td><a href='#"+ item.id +"'>" + item.subject + "</a></td><td>" + item.author.name + "</td><td>" + date[0] + "</td></tr>";
					
				})
				var retVal = "<table class='supportqueue'><tr><th>Ticket</th><th>Subject</th><th>Submitter</th><th>Date</th></tr>" + temp + "</table>"
				$(elementID).html(retVal)
				/* 
				$( "tr" ).hover(
					function() {
						$( this ).css( "background-color", "white" );
					
					}, 
					function(){
						$( this ).css( "background-color", "black" );
					}
				); */
			}).fail(function() {
				$(elementID).html("Error: Cannot Connect to Feed -> " + feedlocation);
				
			});
			
}