<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "State Operating Funds"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
			 
            <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db="project_inv";
       
        // Create connection
       $conn = mysqli_connect($servername, $username, $password, $db);
       // Check connection
       if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
       }
       $total;
       $sql1 = "SELECT sum(net_total) as total from invoice;";
       $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while($row = mysqli_fetch_assoc($result1)) {
                           $total= $row["total"];
                        }
                    } else {
                        echo "0";
                    }
       $sql = "SELECT * FROM invoice;";
       $result = mysqli_query($conn, $sql);
       
       if (mysqli_num_rows($result) > 0) {
       $num = 1;
        while($row = mysqli_fetch_assoc($result)) {
            $perport=($row["net_total"]/$total)*100;
            echo "{ y:".$perport.", name: \"".$row["customer_name"]."\"},";
          
            
        }
       } else {
        echo "0 results";
       }
       
       mysqli_close($conn);
       
       ?>   
		]
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 500px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>