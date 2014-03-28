<?php
	require_once("dssfeedslibrary.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title><?php echo $ini_array[general_settings][title]; ?></title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.css" /> 
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog2.min.js"></script>
		<script type="text/javascript" src="scripts/jkl-parsexml.js"></script>
		<script type="text/javascript" src="scripts/jquery.timer.js"></script>
		<script type="text/javascript" src="scripts/date.js"></script>
		<script type="text/javascript" src="dssfeedslibrary.js"></script>
		<style>
			body{font-size:.8em;
			}
			table { 
				width: 100%; 
				border-collapse: collapse; 
				
			}
			/* Zebra striping */
			tr:nth-of-type(odd) { 
				background: #eee; 
			}
			th { 
				background: #333; 
				color: white; 
				font-weight: bold; 
			}
			td, th { 
				padding: 6px; 
				border: 1px solid #ccc; 
				text-align: left; 
			}
		
		
			@media all and (max-width: 35em) {
				.my-breakpoint .ui-block-a, 
				.my-breakpoint .ui-block-b, 
				.my-breakpoint .ui-block-c,
				.my-breakpoint .ui-block-d,
				.my-breakpoint .ui-block-e { 
					width: 100%; 
					float:none; 
				}
			
				/* Force table to not be like tables anymore */
				table, thead, tbody, th, td, tr { 
					display: block; 
				}
				
				/* Hide table headers (but not display: none;, for accessibility) */
				table tr th,thead tr { 
					position: absolute;
					top: -9999px;
					left: -9999px;
				}
	
				tr { 
					border: 1px solid #ccc; 
				}
				
				td { 
					/* Behave  like a "row" */
					border: none;
					border-bottom: 1px solid #eee; 
					position: relative;
					padding-left: 50%; 
				}
			
				td:before { 
					/* Now like a table header */
					position: absolute;
					/* Top/left values mimic padding */
					top: 6px;
					left: 6px;
					width: 45%; 
					padding-right: 10px; 
					white-space: nowrap;
				}
		
				/*
				Label the data
				*/
					#server tr td:nth-of-type(1):before { content: "Hostname"; }
					#server tr td:nth-of-type(2):before { content: "Issue"; }
					
					#employee tr td:nth-of-type(1):before { content: "Username"; }
					#employee tr td:nth-of-type(2):before { content: "Location"; }
						
					#queue tr td:nth-of-type(1):before { content: "Ticket #"; }
					#queue tr td:nth-of-type(2):before { content: "Subject"; }
					#queue tr td:nth-of-type(3):before { content: "Submitter"; }
					#queue tr td:nth-of-type(4):before { content: "Date"; }
					
					td:nth-of-type(1):before { content: "First Name"; }
					td:nth-of-type(2):before { content: "Last Name"; }
					td:nth-of-type(3):before { content: "Job Title"; }
					td:nth-of-type(4):before { content: "Favorite Color"; }
					td:nth-of-type(5):before { content: "Wars of Trek?"; }
					td:nth-of-type(6):before { content: "Porn Name"; }
					td:nth-of-type(7):before { content: "Date of Birth"; }
					td:nth-of-type(8):before { content: "Dream Vacation City"; }
					td:nth-of-type(9):before { content: "GPA"; }
					td:nth-of-type(10):before { content: "Arbitrary Data"; }
			}
		 
			@media all and (min-width: 45em) {
				.my-breakpoint.ui-grid-b .ui-block-a { 
					width: 20%; 
				
				}
				
				.my-breakpoint.ui-grid-b .ui-block-b{
					width: 50%;
				}
				.my-breakpoint.ui-grid-b .ui-block-c { 
					width: 20%; 
				}
				.my-breakpoint.ui-grid-b .ui-block-a, 
				.my-breakpoint.ui-grid-b .ui-block-b, 
				.my-breakpoint.ui-grid-b .ui-block-c {
					margin-left:1.5%;
					margin-right:1.5%;
				}
			}
		  
		</style>
	</head>
	<body>
		<div data-role="page"> 
			<div data-role="header">
				<h1><?php echo $ini_array[general_settings][title]; ?></h1>
				<a href="index.html" data-role="button">Options</a>
			</div> 
			<div data-role="content">			
				<div class="ui-grid-b my-breakpoint">
					<div class="ui-block-a">
						<div id="network">
							<h2>Network</h2>
							<hr/>
							<p></p>
						</div>
						<div id="server">
							<h2>Server Monitoring</h2>
							<hr/>
							<div></div>
						</div>
					</div>
					<div id="queue"  class="ui-block-b">
						<h2>Queue</h2>
						<hr/>
						<p></p>
					</div>
					<div class="ui-block-c">
						<div id="today">
							<h2>Today</h2>
							<hr/>
							<p></p>
							<div id="weather_g"></div>
							<div id="camera_feed"></div>
						</div>
						<div id="employee">
							<h2>Employee Locations</h2>
							<hr/>
						</div>
						<div id="news">
							<h2>News</h2>
							<hr/>
							<p></p>
						</div>
					</div>
				</div>
			</div> 
		</div><!-- page one -->
	</body>
</head>
	