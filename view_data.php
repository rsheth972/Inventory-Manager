<?php
include_once './database/constants.php';
if (!isset($_SESSION['userid'])) {
    header('location:' . DOMAIN . '/');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inventory Management System</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <script type="text/javascript" src="./js/manage.js"></script>
   <link rel="stylesheet" type="text/css" href="./includes/style.css">
 </head>
<body>
	<!-- Navbar -->
	<?php include_once './templates/header.php';?>
    <br/><br/>
    <div class="container">
			<div class="row">
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title" style="color:black;">Customer Data</h4>
						<p class="card-text" style="color:black;">How much sales is contributed by a single customer</p>
						<button onclick="loadchart()" class="btn btn-primary">Load Chart</button>
						<p></p>
						<p></p>
			<div id="chartContainer" style="height: 450px; width: 100%;display:none;"></div>
			<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title" style="color:black;">Sales</h4>
						<p class="card-text" style="color:black;">Sales of each product in Inventory</p>
						<button onclick="loadchart1()" class="btn btn-primary">Load Chart</button>
						<p></p>
						<p></p>
			<div id="chartContainer1" style="height: 450px; width: 100%;display:none;"></div>
					</div>
				</div>
			</div>
			</div>
    </div>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
<br>
	<div class="container">
			<div class="row">
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title" style="color:black;">Quantity Based Chart</h4>
						<p class="card-text" style="color:black;">Here qty sold of each product will be displayed</p>
						<button onclick="loadchart2()" class="btn btn-primary">Load Chart</button>
						<p></p>
						<p></p>
			<div id="chartContainer2" style="height: 450px; width: 100%;display:none;"></div>
			<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title" style="color:black;">Price</h4>
						<p class="card-text" style="color:black;">Price of each product in Inventory</p>
						<button onclick="loadchart3()" class="btn btn-primary">Load Chart</button>
						<p></p>
						<p></p>
			<div id="chartContainer3" style="height: 450px; width: 100%;display:none;"></div>
					</div>
				</div>
			</div>
			</div>
	</div>
<br>
<p></p>


    <div class="container">
			<div class="row">
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title" style="color:black;">Product Grouping Analysis</h4>
                        <p class="card-text" style="color:black;">
                        <?php
							$myfile = fopen('Basketanalysis.txt', 'r') or die('Unable to open file!');
							echo fread($myfile, filesize('Basketanalysis.txt'));
							fclose($myfile);
							?>
                    </p>
						<!-- <button onclick="loadcontent()" class="btn btn-primary">Load Content</button> -->
						<p id = "contentContainer"></p>
						<p></p>
			<!-- <div id="contentContainer" style="height: 450px; width: 100%;display:none;"></div> -->
			<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title" style="color:black;">Sales vs Date</h4>
						<p class="card-text" style="color:black;">Sales on each date is shown below</p>
						<button onclick="loadchart4()" class="btn btn-primary">Load Chart</button>
						<p></p>
						<p></p>
			<div id="chartContainer4" style="height: 450px; width: 100%;display:none;"></div>
					</div>
				</div>
			</div>
			</div>
	</div>


<script>
    function loadchart() {
	var x = document.getElementById("chartContainer");
	if(x.style.display === "none")
		{
			document.getElementById("chartContainer").style.display = "block";
		}
	else document.getElementById("chartContainer").style.display = "none";

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
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'project_inv';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
$total;
$sql1 = 'SELECT sum(net_total) as total from invoice;';
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $total = $row['total'];
    }
} else {
    echo '0';
}
$sql = 'SELECT * FROM invoice GROUP BY customer_name;';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $perport = ($row['net_total'] / $total) * 100;
        echo '{ y:' . $perport . ', name: "' . $row['customer_name'] . '"},';
    }
} else {
    echo '0 results';
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






// for chart no 2

function loadchart1() {
	var x = document.getElementById("chartContainer1");
	if(x.style.display === "block")
		{
			document.getElementById("chartContainer1").style.display = "none";
		}
	else document.getElementById("chartContainer1").style.display = "block";

	var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Sales"
	},
	axisY: {
		title: "In INR"
	},
	data: [{
		type: "column",
		showInLegend: true,
		legendMarkerColor: "grey",
		legendText: "Total sales of each product",
		dataPoints: [

            <?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'project_inv';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
//    $total;
//    $sql1 = "SELECT sum(net_total) as total from invoice;";
//    $result1 = mysqli_query($conn, $sql1);
//                 if (mysqli_num_rows($result1) > 0) {
//                     while($row = mysqli_fetch_assoc($result1)) {
//                        $total= $row["total"];
//                     }
//                 } else {
//                     echo "0";
//                 }

$sql = 'SELECT product_name,SUM(qty) as sum_qty,price FROM invoice_details GROUP BY product_name;';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $total1 = ($row['sum_qty'] * $row['price']);
        echo '{ y:' . $total1 . ', label: "' . $row['product_name'] . '"},';
    }
} else {
    echo '0 results';
}

mysqli_close($conn);

?>
		]
	}]
});
chart.render();
document.getElementById("chartContainer1").style.display = "block";
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}




function loadchart2() {
	var x = document.getElementById("chartContainer2");
	if(x.style.display === "block")
		{
			document.getElementById("chartContainer2").style.display = "none";
		}
	else document.getElementById("chartContainer2").style.display = "block";

	var chart = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Quantity"
	},
	axisY: {
		title: "In Number of Units"
	},
	data: [{
		type: "column",
		showInLegend: true,
		legendMarkerColor: "grey",
		legendText: "Total sales of each product",
		dataPoints: [

            <?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'project_inv';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
//    $total;
//    $sql1 = "SELECT sum(net_total) as total from invoice;";
//    $result1 = mysqli_query($conn, $sql1);
//                 if (mysqli_num_rows($result1) > 0) {
//                     while($row = mysqli_fetch_assoc($result1)) {
//                        $total= $row["total"];
//                     }
//                 } else {
//                     echo "0";
//                 }

$sql = 'SELECT product_name,SUM(qty) as sum_qty,price FROM invoice_details GROUP BY product_name;';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $total1 = ($row['sum_qty'] * $row['price']);
        echo '{ y:' . $row['sum_qty'] . ', label: "' . $row['product_name'] . '"},';
    }
} else {
    echo '0 results';
}

mysqli_close($conn);

?>
		]
	}]
});
chart.render();
document.getElementById("chartContainer2").style.display = "block";
}

// function explodePie (e) {
// 	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
// 	} else {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
// 	}
// 	e.chart.render();

// }





// for chart no 4

function loadchart3() {
	var x = document.getElementById("chartContainer3");
	if(x.style.display === "block")
		{
			document.getElementById("chartContainer3").style.display = "none";
		}
	else document.getElementById("chartContainer3").style.display = "block";

	var chart = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Price"
	},
	axisY: {
		title: "In INR"
	},
	data: [{
		type: "column",
		showInLegend: true,
		legendMarkerColor: "grey",
		legendText: "Price of each product",
		dataPoints: [

            <?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'project_inv';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
//    $total;
//    $sql1 = "SELECT sum(net_total) as total from invoice;";
//    $result1 = mysqli_query($conn, $sql1);
//                 if (mysqli_num_rows($result1) > 0) {
//                     while($row = mysqli_fetch_assoc($result1)) {
//                        $total= $row["total"];
//                     }
//                 } else {
//                     echo "0";
//                 }

$sql = 'SELECT product_name,SUM(qty) as sum_qty,price FROM invoice_details GROUP BY product_name;';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $total1 = ($row['sum_qty'] * $row['price']);
        echo '{ y:' . $row['price'] . ', label: "' . $row['product_name'] . '"},';
    }
} else {
    echo '0 results';
}

mysqli_close($conn);

?>
		]
	}]
});
chart.render();
document.getElementById("chartContainer3").style.display = "block";
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}


// for chart 4
function loadchart4() {
	var x = document.getElementById("chartContainer4");
	if(x.style.display === "block")
		{
			document.getElementById("chartContainer4").style.display = "none";
		}
	else document.getElementById("chartContainer4").style.display = "block";


    var chart = new CanvasJS.Chart("chartContainer4",
    {
      title:{
        text: "Sales vs Date chart"
    },
    axisX:{
        title: "timeline",
        gridThickness: 2
    },
    axisY: {
        title: "Sales"
    },
    data: [
    {
        type: "area",
        dataPoints: [

<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'project_inv';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
//    $total;
//    $sql1 = "SELECT sum(net_total) as total from invoice;";
//    $result1 = mysqli_query($conn, $sql1);
//                 if (mysqli_num_rows($result1) > 0) {
//                     while($row = mysqli_fetch_assoc($result1)) {
//                        $total= $row["total"];
//                     }
//                 } else {
//                     echo "0";
//                 }

$sql = 'SELECT SUM(net_total) as total,order_date FROM invoice GROUP BY order_date;';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo '{ x:' . $row['order_date'] . ', y: ' . $row['total'] . '},';
    }
} else {
    echo '0 results';
}

mysqli_close($conn);

?>
]
        // [//array
        // { x: new Date(2012, 01, 1), y: 26},
        // { x: new Date(2012, 01, 3), y: 38},
        // { x: new Date(2012, 01, 5), y: 43},
        // { x: new Date(2012, 01, 7), y: 29},
        // { x: new Date(2012, 01, 11), y: 41},
        // { x: new Date(2012, 01, 13), y: 54},
        // { x: new Date(2012, 01, 20), y: 66},
        // { x: new Date(2012, 01, 21), y: 60},
        // { x: new Date(2012, 01, 25), y: 53},
        // { x: new Date(2012, 01, 27), y: 60}

        // ]
    }
    ]
});

    chart.render();

document.getElementById("chartContainer4").style.display = "block";
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}

// function loadcontent() {
// 	document.getElementById("contentContainer").innerHTML = "It works";
// 	// var x = document.getElementById("contentContainer");
// 	// if(x.style.display === "none")
// 	// 	{
// 	// 		document.getElementById("contentContainer").style.display = "block";
// 	// 	}
// 	// else document.getElementById("contentContainer").style.display = "none";

// }


</script>

</body>
</html>


