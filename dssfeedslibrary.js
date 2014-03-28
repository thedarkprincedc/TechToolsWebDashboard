function onSetLocation(){
alert("mmkkmkmkmkmmkm");
}
function showNetworkGraph(location, elementID){

}
function parseWeatherFeed(feedlocation, elementID){
	$.getJSON( feedlocation, function( data ) {
		var weather_icon = data.current_observation.icon_url;
		var location = data.current_observation.display_location.city;
		var temperature = data.current_observation.temp_f;
		var conditions = data.current_observation.weather;
		var tdata = "<div id='weather_w'><div id='w_icon'><img src='" + weather_icon + "' style='float:left;margin-right:1em;' /></div> <div id='w_status'>" + conditions + "<br/>Location:" + location +"<br/>Temperature:" + temperature + "&deg;</div></div>";
		$(elementID).html(tdata);
	}).fail(function() {
			$(elementID).html("Error: Cannot Connect to Feed -> " + feedlocation);		
	});	
} 

function parseNewsfeed(feedLocation, elementID){
	var tdata=""
	var xml = new JKL.ParseXML( feedLocation );
	var data = xml.parse();
	$.each(data.rss.channel.item, function(i, item){
		tdata += "<li><a href='#'>" + item.title + "</a></li>";
	});
	var retVal = "<ul>" + tdata + "</ul>";
	$(elementID).html(retVal);
}
function parseNagiosJSON(feedlocation, elementID){
	
	$.getJSON( feedlocation, function( data ) {
		var temp = "";
		$.each(data, function(i, item){
			if(typeof item.hoststatus !== 'undefined'){
				//$(".networkSt").append("<tr><td>" + item.hoststatus.host_name + "</td><td></td><td></td><td></td></tr>"); 
			}
			if(typeof item.servicestatus !== 'undefined'){
				 if(item.servicestatus.current_notification_number > 0)
				 temp += "<tr><td>" + item.servicestatus.host_name + "</td><td>"+ item.servicestatus.plugin_output +"</td>";
			}
		});
		var networkTemp = "<table><tr><th>Hostname</th><th>Issue</th></tr>"+ temp +"</table>";
		$(elementID).html(networkTemp); 
	}).fail(function() {
			$(elementID).html("Error: Cannot Connect to Feed -> " + feedlocation);		
	});	
	
}
function parseRedmineFeedJSON(feedlocation, elementID){
	$.getJSON( feedlocation, function( data ) {
		if(data.issue !== undefined)
		{
			
			var name = data.issue.author.name;
			var id = data.issue.id;
			var subj = data.issue.subject;
			var date = data.issue.created_on;
			var desc = data.issue.description;
			var breadcrumb = "<a href='index_mobile.php#queue'>queue</a> >> " + subj + " (" + id + ")";
			$(elementID).html( breadcrumb + "<h2>" + id + " - " + subj + "<h2>" + "Contact Name: " + name + "<br/>" + "Date Submitted: " + date + "<br/>" + desc);
		}
		if(data.issues !== undefined){
			var temp = "";
			$.each(data.issues, function(i, item){
				var date = item.updated_on.split(" ");
				temp += "<tr data-ticknum='" + item.id +"'><td>" + item.id + "</td><td><a href='#"+ item.id +"'>" + item.subject + "</a></td><td>" + item.author.name + "</td><td>" + date[0] + "</td></tr>";
			})
			var retVal = "<table class='supportqueue'><thead><th>Ticket</th><th>Subject</th><th>Submitter</th><th>Date</th></thead>" + temp + "</table>"
			$(elementID).html(retVal)
		}
		}).fail(function() {
			$(elementID).html("Error: Cannot Connect to Feed -> " + feedlocation);		
	});	
}
function update_ui_element_realtime(){
	$("#today p").html(new Date().toString('dddd hh:mm:ss tt'));
}
function update_ui_element_short(){
	parseRedmineFeedJSON("dssfeedslibrary.php?query=redmine", "#queue p")
	parseNagiosJSON("dssfeedslibrary.php?query=nagios", "#server div")
	//showNetworkGraph()
}
function update_ui_element_long(){
	parseNewsfeed("dssfeedslibrary.php?query=news", "#news p")
	parseWeatherFeed("dssfeedslibrary.php?query=weather", "#weather_g")
	//$("#camera_feed").html(http://localhost/dssfeedsdev/dssfeedslibrary.php?query=weather_camera);		
}
$( document ).ready(function() {
	
	// update time ui elements 1 second
	var timeTimer = $.timer( update_ui_element_realtime ).set({ time : 1000, autostart : true });
	// Timer to Update 1 minute
 	var UITimer = $.timer( update_ui_element_short ).set({ time : 60000, autostart : true });
	//update weather ui element 30 minutes
	var updateWeatherUITimer = $.timer( update_ui_element_long ).set({ time : 1800000, autostart : true });
	update_ui_element_realtime();
	update_ui_element_short();
	update_ui_element_long();
	$(document).on("click", ".supportqueue tr", function(event){
		var ticknum = $(this).data("ticknum");
		var url = "dssfeedslibrary.php?query=redmine&ticknum=" + ticknum;
		parseRedmineFeedJSON(url, "#queue p")
	});
	$(window).bind( 'hashchange', function(e) { 
				var anchor = document.location.hash;
				var id = anchor.split("#");
				alert(id);
				//parseSingleTicket("feeds/redmine_feed.php?ticknum=" + id[1], "#dialog")
				
				
					/* if( anchor === '#one' ) {
						alert('url = #one');
					}else if ( anchor === '#two' ) {
						alert('url = #two');
					}else if ( anchor === '#three' ) {
						alert('url = #three');
					}
					console.log(anchor); */
	});
});