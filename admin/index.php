<?php 
include('../config.php');
include('../server.php');

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: ../index.php");
}

// update records deleted to yes instead of completely removing the records

// Updating Customer's record
if(isset($_GET['deluser']))
{
	$id=$_GET['deluser'];
	$sql = "update personal_driver.user set isdelete='yes' WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':id',$id, PDO::PARAM_STR);
	$query -> execute();

	echo "<script>
            alert(' $id Driver successfully Deleted.');
            window.location.href='index.php';
    	</script>";
}

// **************************************************88

// // Deleting from the driver table
// if(isset($_GET['deldriver']))
// {
// $id=$_GET['deldriver'];

// // delete record from driver table
// $sql = "delete from personal_driver.driver WHERE id=:id";
// $query = $dbh->prepare($sql);
// $query -> bindParam(':id',$id, PDO::PARAM_STR);
// $query -> execute();

// $sql = "delete from personal_driver.user WHERE id=:id";
// $query = $dbh->prepare($sql);
// $query -> bindParam(':id',$id, PDO::PARAM_STR);
// $query -> execute();

// echo "<script>
//             alert('Driver successfully Deleted.');
//             window.location.href='index.php';
//     	</script>";
// }

// // Deleting from the user table
// if(isset($_GET['deluser']))
// {
// $id=$_GET['deluser'];
// $sql = "delete from personal_driver.user WHERE id=:id";
// $query = $dbh->prepare($sql);
// $query -> bindParam(':id',$id, PDO::PARAM_STR);
// $query -> execute();
// // deleteRecord($sql,$id);

// echo "<script>
//             alert('User successfully Deleted.');
//             window.location.href='index.php';
//     	</script>";
// }

// // Updating Customer's record
//     if (isset($_POST['updateUser'])) {
//         $id=intval($_SESSION['userid']);
//         $name= mysqli_real_escape_string($db, $_POST['name']);
//         $phone= mysqli_real_escape_string($db, $_POST['phone']);
//         if (empty($name)) { array_push($errors, "Name is required"); 
//             echo "<script> alert('Name is required. ');
//             window.location.replace('userProfile.php') ; </script>";
//         }
        
//         if (empty($phone)) { array_push($errors, "Phone Number is required");
//             echo "<script> alert('Phone Number is required. ');
//             window.location.replace('userProfile.php') ; </script>";
//         }
//         else{
//             $sql="update  personal_driver.user a set name=:name,phone=:phone where a.id=$id";
//             $query = $dbh->prepare($sql);
//             $query->bindParam(':name',$name,PDO::PARAM_STR);
//             $query->bindParam(':phone',$phone,PDO::PARAM_STR);
//             $query->execute();


// Updating driver's record
if (isset($_POST['updateDriver'])) {
	$id=intval($_GET['id']);
	$driverName=$_POST['name'];
	$driverEmail=$_POST['email'];
	$driverPhone=$_POST['phone'];
	$driverCost=$_POST['cost'];
	$sql="update  personal_driver.user a, driver b set name=:name,email=:email,phone=:phone,cost=:cost where a.id=$id and b.id=$id";
	$query = $dbh->prepare($sql);
	$query->bindParam(':name',$driverName,PDO::PARAM_STR);
	$query->bindParam(':email',$driverEmail,PDO::PARAM_STR);
	$query->bindParam(':phone',$driverPhone,PDO::PARAM_STR);
	$query->bindParam(':cost',$driverCost,PDO::PARAM_STR);
	$query->execute();

	echo "<script>alert('Successfully updated Driver');
    window.location.replace('index.php') ;
    </script>";
}

// Updating Customer's record
if (isset($_POST['updateUser'])) {
	$id=intval($_GET['id']);
	$driverName=$_POST['name'];
	$driverEmail=$_POST['email'];
	$driverPhone=$_POST['phone'];
	$sql="update  personal_driver.user a set name=:name,email=:email,phone=:phone where a.id=$id";
	$query = $dbh->prepare($sql);
	$query->bindParam(':name',$driverName,PDO::PARAM_STR);
	$query->bindParam(':email',$driverEmail,PDO::PARAM_STR);
	$query->bindParam(':phone',$driverPhone,PDO::PARAM_STR);
	$query->execute();

	echo "<script>alert('Successfully updated Customer');
    window.location.replace('index.php') ;
    </script>";
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin Driver</title>
	<meta name="description" content="">
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- <link rel="shortcut icon" href="img/favicon.png"> -->

	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'>

	<!-- Syntax Highlighter -->
	<link rel="stylesheet" type="text/css" href="syntax-highlighter/styles/shCore.css" media="all">
	<link rel="stylesheet" type="text/css" href="syntax-highlighter/styles/shThemeDefault.css" media="all">

	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Normalize/Reset CSS-->
	<link rel="stylesheet" href="css/normalize.min.css">
	<!-- Main CSS-->
	<link rel="stylesheet" href="css/main.css">

</head>

<body id="welcome">

	<aside class="left-sidebar">
		<div class="logo">
			<a href="#welcome">
				<h1>ADMIN VIEW</h1>
			</a>
		</div>
		<nav class="left-nav">
			<ul id="nav">
				<li class="current"><a href="#welcome">Drivers</a></li>
				<li><a href="#system-users">Customers</a></li>
				
				<?php if(isset($_GET['updaterecord'])){?>
				<li><a href="#tmpl-structure">Update Driver Record</a></li>
				<?php } ?>

				<?php if(isset($_GET['updateuser'])){?>
					<li><a href="#tmpl-structure">Update User Record</a></li>
				<?php } ?>

				<li><a href="#booking-details">Booking Details</a></li>
				<li><a href="index.php?logout='1'">Log Out</a></li>

			</ul>
		</nav>
	</aside>


	<!-- System Driver Section -->
	<div id="main-wrapper">
			<div class="main-content">
			<section id="welcome">
				<div class="content-header">
					<h1>My Chauffeur System Driver</h1>
				</div>
				
			<div class="container">
        <div class="row">
            <div class="col-md-12">

			<div class="features">
					<h2 class="twenty">All Drivers</h2>
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Driver Name</th>
										<th>Gender</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Cost /Hr</th>
										<th>Delete Record</th>
										<th>Edit/Update</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php $sql = "SELECT user.name, user.email, user.gender, user.phone, driver.cost, driver.id from personal_driver.driver INNER JOIN personal_driver.user On driver.id = user.id where user.isdelete='no'";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>                                      
                                                                    <tr class="odd gradeX">
                                                                        <td class="center"><?php echo htmlentities($cnt);?></td>
																		<td class="center difsize"><?php echo htmlentities($result->name);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->gender);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->email);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->phone);?></td>
																		<td class="center"><?php echo htmlentities($result->cost);?></td>
                                                                        <td class="center cstsize"><a href="index.php?deluser=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete?');"><button class="remove" type="submit" name="deleteUser">Remove</button></td>
																		<td class="center cstsize"><a href="index.php?updaterecord=<?php echo htmlentities($result->id);?> #tmpl-structure"><button class="remove" type="submit" name="upt">Update</button></td>
                                                                        
                                                                    </tr>
                                    <?php $cnt=$cnt+1;}} else{
                        echo "ERROR: Failed to retreive data. Check Database connection or if database is empty";} ?>                                      
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
				</div>
				
				</div>
				</div>
			</div>
			</div>
		</section>

		<!-- End of System Driver Section -->

			<!-- System Customers Section -->
			<section id="system-users">
				<div class="content-header">
					<h1>My Chauffeur System Customers</h1>
				</div>
				<h2 class="title">All Users</h2>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
										<th>Gender</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Delete Record</th>
										<th>Edit/Update</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php $sql = "SELECT user.name, user.email, user.gender, user.phone, personal_driver.user.id from personal_driver.user Where personal_driver.user.id NOT IN (SELECT id FROM driver) and user.isdelete='no'";
									$query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>                                      
                                                                    <tr class="odd gradeX">
                                                                        <td class="center"><?php echo htmlentities($cnt);?></td>
																		<td class="center difsize"><?php echo htmlentities($result->name);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->gender);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->email);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->phone);?></td>
                                                                        <td class="center cstsize"><a href="index.php?deluser=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete?');"><button class="remove" type="submit" name="deleteUser">Remove</button></td>
																		<td class="center cstsize"><a href="index.php?updateuser=<?php echo htmlentities($result->id);?> #tmpl-structure"><button class="remove" type="submit" name="upt">Update</button></td>
                                                                        
                                                                    </tr>
                                    <?php $cnt=$cnt+1;}} else{
                        echo "ERROR: Failed to retreive data. Check if the database is not empty";} ?>                                      
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
			</section>
			<!-- End of System Customers Section -->

		<!-- Update driver record -->
		<?php if(isset($_GET['updaterecord'])){?>

			<section id="tmpl-structure">
			<div class="content-header">
					<h1>Update Driver Information</h1>
				</div>
				<h2 class="title">Update Record</h2>

				<p class="fifteen">Click and change the text in red.</p>

				<table>
					<thead>
						<tr>
							<th>Driver Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Cost</th>
						</tr>
					</thead>

			<?php 
			$uptDriver_id = $_GET['updaterecord'];
			$sql = "SELECT user.name, user.email, user.phone, driver.cost from driver, personal_driver.user where (driver.id = '$uptDriver_id') and (driver.id = user.id)";

			$query = mysqli_query($db, $sql);
			if (mysqli_num_rows($query) > 0) {
			$result=mysqli_fetch_assoc($query);
			$name = ($result['name']);
			$email = ($result['email']);
			$phone = ($result['phone']);
			$cost = ($result['cost']);
			//   echo "<script>alert('Driver is booked in the middle of your booking interval fromt the $booking_start to $booking_end');
			//   var data = $id; 
			//   window.location.replace('book_driver.php?id=' + data) ;
			//   </script>";
			} ?>
			<tbody>
				<form method="post" action="index.php?id=<?php echo $uptDriver_id;?>">
						<!-- <div class="serch_form"> -->
						<tr class="odd gradeX">			
							<td class="difsize"><input type="text" name="name" value="<?php echo $name; ?>" ></td>
							<td class="difsize"><input type="text" name="email" value="<?php echo $email; ?>" ></td>
							<td class="difsize"><input type="text" name="phone" value="<?php echo $phone; ?>" ></td>
							<td class="cstsize"><input type="text" name="cost" value="<?php echo $cost; ?>" ></td>
							<td class="cstsize"><button class="remove" type="submit" name="updateDriver">Update</button></td>
						</tr>
								<!-- </div> -->
					</form>
				</tbody>
			</table>

				<!-- <p class="fifteen">All information within the main content area is nested within a body tag. The general template structure is pretty the same throughout the template. Here is the general structure of main page (index.html).</p> -->
				<!-- <pre class="brush: html">
					<header class="header_area">

					</header>

					<main class="site-main">
						<section class="section">

						</section>
						<section class="section">

						</section>
						<section class="section">

						</section>
					</main>

					<footer class="footer">

					</footer>
				</pre> -->
			</section>

			<?php } ?>
			<!-- End of Update driver record -->


			<!-- user update record -->
			<?php if(isset($_GET['updateuser'])){?>

			<section id="tmpl-structure">
			<div class="content-header">
					<h1>Update Customer Information</h1>
				</div>
				<h2 class="title">Update Record</h2>

				<p class="fifteen">Click and change the text in red.</p>

				<table>
					<thead>
						<tr>
							<th>User Name</th>
							<th>Email</th>
							<th>Phone</th>
						</tr>
					</thead>
					
			<?php 
				
			$uptuser_id = $_GET['updateuser'];
			$sql = "SELECT user.name, user.email, user.phone from personal_driver.user where (user.id = '$uptuser_id')";

			$query = mysqli_query($db, $sql);
			if (mysqli_num_rows($query) > 0) {
			$result=mysqli_fetch_assoc($query);
			$name = ($result['name']);
			$email = ($result['email']);
			$phone = ($result['phone']);
			} ?>
				<tbody>
					<form method="post" action="index.php?id=<?php echo $uptuser_id;?>">
							<!-- <div class="serch_form"> -->
							<tr class="odd gradeX">			
								<td class="difsize"><input type="text" name="name" value="<?php echo $name; ?>" ></td>
								<td class="difsize"><input type="text" name="email" value="<?php echo $email; ?>" ></td>
								<td class="difsize"><input type="text" name="phone" value="<?php echo $phone; ?>" ></td>
								<td class="difsize"><button class="remove" type="submit" name="updateUser">Update</button></td>
							</tr>
									<!-- </div> -->
						</form>
					</tbody>
				</table>
				</section>

				<?php } ?>
				<!-- End of Update user record -->

			<!-- System Booking details section -->
			<section id="booking-details">
				<div id="printableArea">
				<div class="content-header" >
					<h1>All Booking Details</h1>
				</div>
				<h2 class="title">Bookings</h2>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
										<th>Driver Name</th>
										<th>Booking Start</th>
										<th>Booking End</th>
										<th>Cost/Hr</th>
										<th>Total Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php $sql = "SELECT bookdate, userid, driverid, duration, total_cost, user.name from personal_driver.transaction, user where userid=user.id";
									$query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {              
										$tempid = $result->driverid;
										$sql = "SELECT user.name, cost FROM driver, user WHERE driver.id='$tempid' and user.id='$tempid'";
										$res = mysqli_query($db, $sql);
										$row=mysqli_fetch_assoc($res);
										$drivername = $row['name'];
										$hourcost = $row['cost'];
										?>                                      
                                                                    <tr class="odd gradeX">
                                                                        <td class="center"><?php echo htmlentities($cnt);?></td>
																		<td class="center difsize"><?php echo htmlentities($result->name);?></td>
																		<td class="center difsize"><?php echo htmlentities($drivername);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->bookdate);?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->duration);?></td>
																		<td class="center cstsize"><?php echo $hourcost;?></td>
																		<td class="center cstsize"><?php echo htmlentities($result->total_cost);?></td>
                                                                        
                                                                    </tr>
                                    <?php $cnt=$cnt+1;}} else{
                        echo "ERROR: Failed to retreive data. Check Database connection or if database is empty";} ?>                                      
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
				</div>
				</div>
				<input id="print" type="button" onclick="printDiv('printableArea')" value="Print" />
				<script>
					function printDiv(divName) {
						var printContents = document.getElementById(divName).innerHTML;
						var originalContents = document.body.innerHTML;

						document.body.innerHTML = printContents;

						window.print();

						document.body.innerHTML = originalContents;
					}
				</script>
			</section>

		<!-- End of System Booking details section -->
		    <!-- footer start -->
		</body>
		</html>
