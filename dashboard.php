<?php
include_once "./database/constants.php";
if (!isset($_SESSION["userid"])) {
    header("location:" . DOMAIN . "/");
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
	 <script type="text/javascript" src="./js/main.js"></script>
	 <link rel="stylesheet" type="text/css" href="./includes/style.css">
	 <style>
		 .card{
			background-color:rgba(0,0,0,0.85);
		 }
		 .card-body{
			color:white;
		 }

	</style>
 </head>
<body style="background: url('./images/5-tools-for-inventory-management-blog.jpg') no-repeat center center;">
	<!-- Navbar -->
	<?php include_once "./templates/header.php";?>
	<br/><br/>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card mx-auto">
				  <img class="card-img-top mx-auto" style="width:60%;" src="./images/user.png" alt="Card image cap">
				  <div class="card-body">
				    <h4 class="card-title">
					<?php include_once "./database/constants.php";
echo $_SESSION["username"]?>
						</h4>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i>User id:
						<?php include_once "./database/constants.php";
echo $_SESSION["userid"]?>
					</p>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i>Admin</p>
				    <p class="card-text">Last Login :
					<?php include_once "./database/constants.php";
echo $_SESSION["last_login"]?>
					</p>
		 			<p>
						 <!-- This system manages the records of the inventory and also <strong>analyses the sales</strong> and <strong>predicts the future sales</strong>.
						 <br>It also performs <strong>market basket analysis</strong> on the data and finds which products are related.
						 <br>It also <strong>notifies of less qty products</strong><br>It also <strong>prints the invoice</strong> -->
						<!-- <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a> -->
						<table>
							<tr>
								<th>Product Name</th>
								<th>Product Price</th>
								<th>Procuct Qty</th>
								<th>Total Amount</th>
							</tr>

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
								$total = 0;
								$sql = 'SELECT product_name,product_price,product_stock from products ORDER BY product_stock DESC;';
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
												$total_inv = $row['product_stock'] * $row['product_price']  ;
												$total = $total_inv + $total;
												?>
												<tr>
												<td><?php echo $row['product_name'];?> </td>
												<td><?php echo $row['product_price'];?> </td>
												<td><?php echo $row['product_stock'];?> </td>
												<td><?php echo $total_inv;?> </td>
										</tr>
										<?php
										}
								} else {
										echo '0 results';
								}

								mysqli_close($conn);

								?>
						</table>
							<br>
								Total cost of inventory is <strong>INR <?php echo $total; ?></strong>.
				  </div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron" style="width:100%;height:100%;background-color:rgba(0,0,0,0.7);">
					<h1 style="color:white;">Welcome Admin,</h1>
					<div class="row">
						<div class="col-sm-6">
									<div class="card">
									<div class="card-body">
									<h4 class="card-title">Invoices</h4>
									<p class="card-text">Here you can view your Invoices</p><h6>&nbsp;</h6>
									<a href="view_invoice.php" class="btn btn-primary">View Invoice</a>
							</div>
							</div>
							</div>
						<div class="col-sm-6">
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">New Orders</h4>
						        <p class="card-text">Here you can make invoices and create new orders</p>
						        <a href="new_order.php" class="btn btn-primary">New Orders</a>
						      </div>
						    </div>
						</div>
					</div>
					<p></p>
					<div class="row">
						<div class="col-sm-12">
									<div class="card">
									<div class="card-body">
									<h4 class="card-title">Satistics</h4>
									<p class="card-text">Here you can view your Statistics</p><h6>&nbsp;</h6>
									<a href="view_data.php" class="btn btn-primary">View Stats</a>
							</div>
							</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p></p>
	<p></p>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title">Categories</h4>
						<p class="card-text">Here you can manage your categories and you add new parent and sub categories</p>
						<a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a>
						<a href="manage_categories.php" class="btn btn-primary">Manage</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title">Brands</h4>
						<p class="card-text">Here you can manage your brand and you add new brand</p>
						<a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-primary">Add</a>
						<a href="manage_brand.php" class="btn btn-primary">Manage</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" style="background-color:rgba(0,0,0,0.7);">
						<div class="card-body">
						<h4 class="card-title">Products</h4>
						<p class="card-text">Here you can manage your prpducts and you add new products</p>
						<a href="#" data-toggle="modal" data-target="#form_products" class="btn btn-primary">Add</a>
						<a href="manage_product.php" class="btn btn-primary">Manage</a>
					</div>
				</div>
			</div>
		</div>
		<p></p>
			<!-- <div class="container">
			<div class="row">
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title">Load Chart</h4>
						<p class="card-text">Here you your sales to customers</p>
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
						<h4 class="card-title">Sales</h4>
						<p class="card-text">Sales of each product in Inventory</p>
						<button onclick="loadchart1()" class="btn btn-primary">Load Chart</button>
						<p></p>
						<p></p>
			<div id="chartContainer1" style="height: 450px; width: 100%;display:none;"></div>
					</div>
				</div>
			</div>
			</div>
	</div>

	<div class="container">
			<div class="row">
			<div class="col-md-6">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title">Qty Based Chart</h4>
						<p class="card-text">Here qty sold of each product will be displayed</p>
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
						<h4 class="card-title">Price</h4>
						<p class="card-text">Price of each product in Inventory</p>
						<button onclick="loadchart3()" class="btn btn-primary">Load Chart</button>
						<p></p>
						<p></p>
			<div id="chartContainer3" style="height: 450px; width: 100%;display:none;"></div>
					</div>
				</div>
			</div>
			</div>
	</div> -->
<!-- // for loading chart no 1 -->
<script>
// function loadchart() {
// 	var x = document.getElementById("chartContainer");
// 	if(x.style.display === "none")
// 		{
// 			document.getElementById("chartContainer").style.display = "block";
// 		}
// 	else document.getElementById("chartContainer").style.display = "none";

// var chart = new CanvasJS.Chart("chartContainer", {
// 	exportEnabled: true,
// 	animationEnabled: true,
// 	title:{
// 		text: "State Operating Funds"
// 	},
// 	legend:{
// 		cursor: "pointer",
// 		itemclick: explodePie
// 	},
// 	data: [{
// 		type: "pie",
// 		showInLegend: true,
// 		toolTipContent: "{name}: <strong>{y}%</strong>",
// 		indexLabel: "{name} - {y}%",
// 		dataPoints: [

//             <?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "project_inv";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $db);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// $total;
// $sql1 = "SELECT sum(net_total) as total from invoice;";
// $result1 = mysqli_query($conn, $sql1);
// if (mysqli_num_rows($result1) > 0) {
//     while ($row = mysqli_fetch_assoc($result1)) {
//         $total = $row["total"];
//     }
// } else {
//     echo "0";
// }
// $sql = "SELECT * FROM invoice GROUP BY customer_name;";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//     $num = 1;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $perport = ($row["net_total"] / $total) * 100;
//         echo "{ y:" . $perport . ", name: \"" . $row["customer_name"] . "\"},";

//     }
// } else {
//     echo "0 results";
// }

// mysqli_close($conn);

// ?>
// 		]
// 	}]
// });
// chart.render();

// }

// function explodePie (e) {
// 	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
// 	} else {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
// 	}
// 	e.chart.render();

// }






// // for chart no 2

// function loadchart1() {
// 	var x = document.getElementById("chartContainer1");
// 	if(x.style.display === "block")
// 		{
// 			document.getElementById("chartContainer1").style.display = "none";
// 		}
// 	else document.getElementById("chartContainer1").style.display = "block";

// 	var chart = new CanvasJS.Chart("chartContainer1", {
// 	animationEnabled: true,
// 	theme: "light2", // "light1", "light2", "dark1", "dark2"
// 	title:{
// 		text: "Sales"
// 	},
// 	axisY: {
// 		title: "In INR"
// 	},
// 	data: [{
// 		type: "column",
// 		showInLegend: true,
// 		legendMarkerColor: "grey",
// 		legendText: "Total sales of each product",
// 		dataPoints: [

//             <?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "project_inv";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $db);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// //    $total;
// //    $sql1 = "SELECT sum(net_total) as total from invoice;";
// //    $result1 = mysqli_query($conn, $sql1);
// //                 if (mysqli_num_rows($result1) > 0) {
// //                     while($row = mysqli_fetch_assoc($result1)) {
// //                        $total= $row["total"];
// //                     }
// //                 } else {
// //                     echo "0";
// //                 }

// $sql = "SELECT product_name,SUM(qty) as sum_qty,price FROM invoice_details GROUP BY product_name;";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//     $num = 1;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $total1 = ($row["sum_qty"] * $row["price"]);
//         echo "{ y:" . $total1 . ", label: \"" . $row["product_name"] . "\"},";

//     }
// } else {
//     echo "0 results";
// }

// mysqli_close($conn);

// ?>
// 		]
// 	}]
// });
// chart.render();
// document.getElementById("chartContainer1").style.display = "block";
// }

// function explodePie (e) {
// 	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
// 	} else {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
// 	}
// 	e.chart.render();

// }







// // for chart no 3

// function loadchart2() {
// 	var x = document.getElementById("chartContainer2");
// 	if(x.style.display === "block")
// 		{
// 			document.getElementById("chartContainer2").style.display = "none";
// 		}
// 	else document.getElementById("chartContainer2").style.display = "block";

// 	var chart = new CanvasJS.Chart("chartContainer2", {
// 	animationEnabled: true,
// 	theme: "light2", // "light1", "light2", "dark1", "dark2"
// 	title:{
// 		text: "Quantity"
// 	},
// 	axisY: {
// 		title: "In Number of Units"
// 	},
// 	data: [{
// 		type: "column",
// 		showInLegend: true,
// 		legendMarkerColor: "grey",
// 		legendText: "Total sales of each product",
// 		dataPoints: [

//             <?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "project_inv";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $db);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// //    $total;
// //    $sql1 = "SELECT sum(net_total) as total from invoice;";
// //    $result1 = mysqli_query($conn, $sql1);
// //                 if (mysqli_num_rows($result1) > 0) {
// //                     while($row = mysqli_fetch_assoc($result1)) {
// //                        $total= $row["total"];
// //                     }
// //                 } else {
// //                     echo "0";
// //                 }

// $sql = "SELECT product_name,SUM(qty) as sum_qty,price FROM invoice_details GROUP BY product_name;";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//     $num = 1;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $total1 = ($row["sum_qty"] * $row["price"]);
//         echo "{ y:" . $row["sum_qty"] . ", label: \"" . $row["product_name"] . "\"},";

//     }
// } else {
//     echo "0 results";
// }

// mysqli_close($conn);

// ?>
// 		]
// 	}]
// });
// chart.render();
// document.getElementById("chartContainer2").style.display = "block";
// }

// // function explodePie (e) {
// // 	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
// // 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
// // 	} else {
// // 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
// // 	}
// // 	e.chart.render();

// // }





// // for chart no 4

// function loadchart3() {
// 	var x = document.getElementById("chartContainer3");
// 	if(x.style.display === "block")
// 		{
// 			document.getElementById("chartContainer3").style.display = "none";
// 		}
// 	else document.getElementById("chartContainer3").style.display = "block";

// 	var chart = new CanvasJS.Chart("chartContainer3", {
// 	animationEnabled: true,
// 	theme: "light2", // "light1", "light2", "dark1", "dark2"
// 	title:{
// 		text: "Price"
// 	},
// 	axisY: {
// 		title: "In INR"
// 	},
// 	data: [{
// 		type: "column",
// 		showInLegend: true,
// 		legendMarkerColor: "grey",
// 		legendText: "Price of each product",
// 		dataPoints: [

//             <?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "project_inv";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $db);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// $sql = "SELECT product_name,SUM(qty) as sum_qty,price FROM invoice_details GROUP BY product_name;";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//     $num = 1;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $total1 = ($row["sum_qty"] * $row["price"]);
//         echo "{ y:" . $row["price"] . ", label: \"" . $row["product_name"] . "\"},";

//     }
// } else {
//     echo "0 results";
// }

// mysqli_close($conn);

// ?>
// 		]
// 	}]
// });
// chart.render();
// document.getElementById("chartContainer3").style.display = "block";
// }

// function explodePie (e) {
// 	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
// 	} else {
// 		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
// 	}
// 	e.chart.render();

// }




</script>

	<?php
//Categpry Form
include_once "./templates/category.php";
?>
	 <?php
//Brand Form
include_once "./templates/brand.php";
?>
	 <?php
//Products Form
include_once "./templates/products.php";
?>


</body>
</html>