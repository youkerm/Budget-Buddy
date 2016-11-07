<?php
session_start();
if ($_SESSION["userID"] <= 0) {
	header('Location: '. 'https://ub-hacking-youkerm.c9users.io/login.php');
}
?>

<!DOCTYPE html>
	<head>
		<title>Budget Buddy</title>
		<link rel="stylesheet" href="css/reset.css" type="text/css" />
		<link rel="stylesheet" href="css/main.css" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://d3js.org/d3.v2.js"></script>
	</head>
	<body style="overflow:hidden;">
    <div style="overflow:auto; position:absolute; top: 0px; left:0px; right:0px; bottom:0px">
		<div id="header">
			<div id="header_title">
				<h2>Budget Buddy</h2>
				<p>Hello <font color="#fe921f">
					<?php 
					include('php/database.php');
					session_start();
					$userID = $_SESSION["userID"];
					$db = new Database;
					$conn = $db->getConn();
					
					
					$userSql = 'SELECT FirstN, LastN  FROM User WHERE ID = ?';

					$query = $conn->prepare($userSql);
					$query->execute(array($userID));
					$name = $query->fetch();
					
					echo $name['FirstN'] . " " . $name['LastN'];
					
					?>
				</font></p>
			</div>
			
			<form action="php/logout.php">
				<input class="signout" type="submit" value="Sign Out">
			</form>
		</div>
		
		<div id="container">
			<nav id="primary_nav_wrap">
				<ul>
				  <li class="current-menu-item"><a href="index.php">Dashboard</a></li>
				  <li><a href="accounts.php">Accounts</a>
				    <!--<ul>-->
				    <!--  <li><a href="account_check.php">Checkings Account</a></li>-->
				    <!--  <li><a href="account_save.php">Savings Account</a></li>-->
				    <!--  <li><a href="account_cash.php">Cash Flow</a></li>-->
				    <!--</ul>-->
				  </li>
				  <!--<li><a href="#">Activities</a>-->
				  <!--  <ul>-->
				  <!--    <li><a href="#">Recent Activities</a></li>-->
				  <!--    <li><a href="#">Monthly Overview</a></li>-->
				  <!--    <li><a href="#">Yearly Overview</a></li>-->
				  <!--  </ul>-->
				  <!--</li>-->
				  <li><a href="about.php ">About</a></li>
			</nav>
			
			<div id="graph">
			<div id="container1">
				<div id="col1">
					<!-- Column one start -->
					<div id="pieChart"></div
					<!-- Column one end -->
				</div>
				<div id="col2">
					<!-- Column two start -->
					<div id="barChart"></div>
					<!-- Column two end -->
				</div>
				
				<ol style="margin-top: 10px;margin-right:50px;">
					<li style="font-weight:900"><b>Expenses</b></li>
					<li>1.Rent</li>
					<li>2.Food</li>
					<li>3.Gas</li>
					<li>4.Utilities</li>
					<li>5.Misc</li>
				</ol>
				
				<ol style="margin-top: 10px;margin-right:50px">
					<li style="font-weight:900"><b>Revanue</b></li>
					<li>1.Cash</li>
					<li>2.Intrest</li>
					<li>3.Findings</li>
					<li>4.Earnings</li>
					<li>5.Misc</li>
				</ol>
				
			</div>
			</div>
			
			<p>hi</p>

	   	</div>
	   		<br><br><br><br><br>
	   	
	<script type="text/javascript">
		/*
################ FORMATS ##################
-------------------------------------------
*/


var 	formatAsPercentage = d3.format("%"),
		formatAsPercentage1Dec = d3.format(".1%"),
		formatAsInteger = d3.format(","),
		fsec = d3.time.format("%S s"),
		fmin = d3.time.format("%M m"),
		fhou = d3.time.format("%H h"),
		fwee = d3.time.format("%a"),
		fdat = d3.time.format("%d d"),
		fmon = d3.time.format("%b")
		;

/*
############# PIE CHART ###################
-------------------------------------------
*/



function dsPieChart(){
	
	var dataset = [];
	
	$.getJSON('https://ub-hacking-youkerm.c9users.io/php/getChart.php?accountID=' + 1, function (data) {
      dataset = data;

    
    console.log(dataset);

	var 	width = 400,
		   height = 400,
		   outerRadius = Math.min(width, height) / 2,
		   innerRadius = outerRadius * .999,   
		   // for animation
		   innerRadiusFinal = outerRadius * .5,
		   innerRadiusFinal3 = outerRadius* .45,
		   //color = d3.scale.category20c()    //builtin range of colors
		   color = d3.scale.ordinal().domain(["Income","Expenses"])
			.range(["black","#fe921f"]);
			;
	    
	var vis = d3.select("#pieChart")
	     .append("svg:svg")              //create the SVG element inside the <body>
	     .data([dataset])                   //associate our data with the document
	         .attr("width", width)           //set the width and height of our visualization (these will be attributes of the <svg> tag
	         .attr("height", height)
	     		.append("svg:g")                //make a group to hold our pie chart
	         .attr("transform", "translate(" + outerRadius + "," + outerRadius + ")")    //move the center of the pie chart from 0, 0 to radius, radius
				;
				
   var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
        	.outerRadius(outerRadius).innerRadius(innerRadius);
   
   // for animation
   var arcFinal = d3.svg.arc().innerRadius(innerRadiusFinal).outerRadius(outerRadius);
	var arcFinal3 = d3.svg.arc().innerRadius(innerRadiusFinal3).outerRadius(outerRadius);

   var pie = d3.layout.pie()           //this will create arc data for us given a list of values
        .value(function(d) { return d.measure; });    //we must tell it out to access the value of each element in our data array

   var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
        .data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties) 
        .enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
            .append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
               .attr("class", "slice")    //allow us to style things in the slices (like text)
               .on("mouseover", mouseover)
    				.on("mouseout", mouseout)
    				.on("click", up)
    				;
    				
        arcs.append("svg:path")
               .attr("fill", function(d, i) { return color(i); } ) //set the color for each slice to be chosen from the color function defined above
               .attr("d", arc)     //this creates the actual SVG path using the associated data (pie) with the arc drawing function
					.append("svg:title") //mouseover title showing the figures
				   .text(function(d) { return d.data.category + ": " + formatAsPercentage(d.data.measure); });			

        d3.selectAll("g.slice").selectAll("path").transition()
			    .duration(750)
			    .delay(10)
			    .attr("d", arcFinal )
			    ;
	
	  // Add a label to the larger arcs, translated to the arc centroid and rotated.
	  // source: https://bl.ocks.org/1305337#index.html
	  arcs.filter(function(d) { return d.endAngle - d.startAngle > .2; })
	  		.append("svg:text")
	      .attr("dy", ".35em")
	      .attr("text-anchor", "middle")
	      .attr("transform", function(d) { return "translate(" + arcFinal.centroid(d) + ")rotate(" + angle(d) + ")"; })
	      //.text(function(d) { return formatAsPercentage(d.value); })
	      .text(function(d) { return d.data.category; })
	      ;
	   
	   // Computes the label angle of an arc, converting from radians to degrees.
		function angle(d) {
		    var a = (d.startAngle + d.endAngle) * 90 / Math.PI - 90;
		    return a > 90 ? a - 180 : a;
		}
		    
		
		// Pie chart title			
		vis.append("svg:text")
	     	.attr("dy", ".35em")
	      .attr("text-anchor", "middle")
	      .text("Budget Buddy")
	      .attr("class","title")
	      ;		    


		
	function mouseover() {
	  d3.select(this).select("path").transition()
	      .duration(750)
	        		//.attr("stroke","red")
	        		//.attr("stroke-width", 1.5)
	        		.attr("d", arcFinal3)
	        		;
	}
	
	function mouseout() {
	  d3.select(this).select("path").transition()
	      .duration(750)
	        		//.attr("stroke","blue")
	        		//.attr("stroke-width", 1.5)
	        		.attr("d", arcFinal)
	        		;
	}
	
	function up(d, i) {
	
				/* update bar chart when user selects piece of the pie chart */
				//updateBarChart(dataset[i].category);
				updateBarChart(d.data.category, color(i));
				//updateLineChart(d.data.category, color(i));
			 
	}
	
	});
}

dsPieChart();

/*
############# BAR CHART ###################
-------------------------------------------
*/



var datasetBarChart = [
{ group: "All", category: "1", measure: 7850.4963 }, 
{ group: "All", category: "2", measure: 78258.0845 }, 
{ group: "All", category: "3", measure: 60610.2355 }, 
{ group: "All", category: "4", measure: 30493.1686 }, 
{ group: "All", category: "5", measure: 30493.1686 }, 
{ group: "Expenses", category: "1", measure: 3182.399 }, 
{ group: "Expenses", category: "2", measure: 867.927 }, 
{ group: "Expenses", category: "3", measure: 1808.18125 }, 
{ group: "Expenses", category: "4", measure: 795.59975 }, 
{ group: "Expenses", category: "5", measure: 578.618 }, 
{ group: "Income", category: "1", measure: 2227.6793 }, 
{ group: "Income", category: "2", measure: 3442.7771 }, 
{ group: "Income", category: "3", measure: 303.77445 }, 
{ group: "Income", category: "4", measure: 2328.93745 }, 
{ group: "Income", category: "5", measure: 1822.6467 }, 
]
;

// set initial group value
var group = "All";

function datasetBarChosen(group) {
	var ds = [];
	for (x in datasetBarChart) {
		 if(datasetBarChart[x].group==group){
		 	ds.push(datasetBarChart[x]);
		 } 
		}
	return ds;
}


function dsBarChartBasics() {

		var margin = {top: 30, right: 0, bottom: 20, left: 0},
		width = 400 - margin.left - margin.right,
	   height = 250 - margin.top - margin.bottom,
		colorBar = d3.scale.category20(),
		barPadding = 1
		;
		
		return {
			margin : margin, 
			width : width, 
			height : height, 
			colorBar : colorBar, 
			barPadding : barPadding
		}			
		;
}

function dsBarChart() {

	var firstDatasetBarChart = datasetBarChosen(group);         	
	
	var basics = dsBarChartBasics();
	
	var margin = basics.margin,
		width = basics.width,
	   height = basics.height,
		colorBar = basics.colorBar,
		barPadding = basics.barPadding
		;
					
	var 	xScale = d3.scale.linear()
						.domain([0, firstDatasetBarChart.length])
						.range([0, width])
						;
						
	// Create linear y scale 
	// Purpose: No matter what the data is, the bar should fit into the svg area; bars should not
	// get higher than the svg height. Hence incoming data needs to be scaled to fit into the svg area.  
	var yScale = d3.scale.linear()
			// use the max funtion to derive end point of the domain (max value of the dataset)
			// do not use the min value of the dataset as min of the domain as otherwise you will not see the first bar
		   .domain([0, d3.max(firstDatasetBarChart, function(d) { return d.measure; })])
		   // As coordinates are always defined from the top left corner, the y position of the bar
		   // is the svg height minus the data value. So you basically draw the bar starting from the top. 
		   // To have the y position calculated by the range function
		   .range([height, 0])
		   ;
	
	//Create SVG element
	
	var svg = d3.select("#barChart")
			.append("svg")
		    .attr("width", width + margin.left + margin.right)
		    .attr("height", height + margin.top + margin.bottom)
		    .attr("id","barChartPlot")
		    ;
	
	var plot = svg
		    .append("g")
		    .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
		    ;
	            
	plot.selectAll("rect")
		   .data(firstDatasetBarChart)
		   .enter()
		   .append("rect")
			.attr("x", function(d, i) {
			    return xScale(i);
			})
		   .attr("width", width / firstDatasetBarChart.length - barPadding)   
			.attr("y", function(d) {
			    return yScale(d.measure);
			})  
			.attr("height", function(d) {
			    return height-yScale(d.measure);
			})
			.attr("fill", "lightgrey")
			;
	
		
	// Add y labels to plot	
	
	plot.selectAll("text")
	.data(firstDatasetBarChart)
	.enter()
	.append("text")
	.text(function(d) {
			return formatAsInteger(d3.round(d.measure));
	})
	.attr("text-anchor", "middle")
	// Set x position to the left edge of each bar plus half the bar width
	.attr("x", function(d, i) {
			return (i * (width / firstDatasetBarChart.length)) + ((width / firstDatasetBarChart.length - barPadding) / 2);
	})
	.attr("y", function(d) {
			return yScale(d.measure) + 14;
	})
	.attr("class", "yAxis")
	/* moved to CSS			   
	.attr("font-family", "sans-serif")
	.attr("font-size", "11px")
	.attr("fill", "white")
	*/
	;
	
	// Add x labels to chart	
	
	var xLabels = svg
		    .append("g")
		    .attr("transform", "translate(" + margin.left + "," + (margin.top + height)  + ")")
		    ;
	
	xLabels.selectAll("text.xAxis")
		  .data(firstDatasetBarChart)
		  .enter()
		  .append("text")
		  .text(function(d) { return d.category;})
		  .attr("text-anchor", "middle")
			// Set x position to the left edge of each bar plus half the bar width
						   .attr("x", function(d, i) {
						   		return (i * (width / firstDatasetBarChart.length)) + ((width / firstDatasetBarChart.length - barPadding) / 2);
						   })
		  .attr("y", 15)
		  .attr("class", "xAxis")
		  //.attr("style", "font-size: 12; font-family: Helvetica, sans-serif")
		  ;			
	 
	// Title
	
	svg.append("text")
		.attr("x", (width + margin.left + margin.right)/2)
		.attr("y", 15)
		.attr("class","title")				
		.attr("text-anchor", "middle")
		.text("Budget Buddy's Revenue Breakdown")
		;
}

dsBarChart();

 /* ** UPDATE CHART ** */
 
/* updates bar chart on request */

function updateBarChart(group, colorChosen) {
	
		var currentDatasetBarChart = datasetBarChosen(group);
		
		var basics = dsBarChartBasics();
	
		var margin = basics.margin,
			width = basics.width,
		   height = basics.height,
			colorBar = basics.colorBar,
			barPadding = basics.barPadding
			;
		
		var 	xScale = d3.scale.linear()
			.domain([0, currentDatasetBarChart.length])
			.range([0, width])
			;
		
			
		var yScale = d3.scale.linear()
	      .domain([0, d3.max(currentDatasetBarChart, function(d) { return d.measure; })])
	      .range([height,0])
	      ;
	      
	   var svg = d3.select("#barChart svg");
	      
	   var plot = d3.select("#barChartPlot")
	   	.datum(currentDatasetBarChart)
		   ;
	
	  		/* Note that here we only have to select the elements - no more appending! */
	  	plot.selectAll("rect")
	      .data(currentDatasetBarChart)
	      .transition()
			.duration(750)
			.attr("x", function(d, i) {
			    return xScale(i);
			})
		   .attr("width", width / currentDatasetBarChart.length - barPadding)   
			.attr("y", function(d) {
			    return yScale(d.measure);
			})  
			.attr("height", function(d) {
			    return height-yScale(d.measure);
			})
			.attr("fill", colorChosen)
			;
		
		plot.selectAll("text.yAxis") // target the text element(s) which has a yAxis class defined
			.data(currentDatasetBarChart)
			.transition()
			.duration(750)
		   .attr("text-anchor", "middle")
		   .attr("x", function(d, i) {
		   		return (i * (width / currentDatasetBarChart.length)) + ((width / currentDatasetBarChart.length - barPadding) / 2);
		   })
		   .attr("y", function(d) {
		   		return yScale(d.measure) + 14;
		   })
		   .text(function(d) {
				return formatAsInteger(d3.round(d.measure));
		   })
		   .attr("class", "yAxis")					 
		;
		

		svg.selectAll("text.title") // target the text element(s) which has a title class defined
			.attr("x", (width + margin.left + margin.right)/2)
			.attr("y", 15)
			.attr("class","title")				
			.attr("text-anchor", "middle")
			.text("Buddy Budget's " + group + "'s Breakdown")
		;
}
	</script>
	</body>
</html>

