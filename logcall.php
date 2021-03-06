<?php
require_once 'db.php';
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
$sql = "SELECT * FROM incident_type";
$result = $conn ->query($sql);
$incidentTypes = [];

while ($row = $result->fetch_assoc()) {
	$id = $row['incident_type_id'];
	
	$type = $row['incident_type_desc'];
	
	$incidentType = ["id" => $id, "type" => $type];
	
	array_push($incidentTypes, $incidentType);
}
$conn->close();

 
?>

<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Log Call</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container" style="width: 80%">
			
			<?php require_once 'nav.php' ?>
			
			<section style="margin-top:20px">
			<form action="dispatch.php" method="post">
				<div class="form-group row">
					<label for="callerName" class="col-sm-4
				
					col-form-label">Caller's Name</label>
					<div class="col-lg-8">
						<input type="text" name="callerName" class="form-control" id="callerName" required pattern="[a-zA-Z]{1,20s}" title="please use alphabets only">
					</div>
				</div>
			
				<div class="form-group row">
					<label for="contactNo" class="col-lg-4 col-form-label">Contact Number (Required)</label>
					<div class="col-lg-8">
						<input type="text"  name="contactNo" class="form-control" id="contactNo" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="locationofIncident" class="col-lg-4 col-form-label">Location of Incident (Required)</label>
					<div class="col-lg-8">
						<input type="text" name="locationofIncident" class="form-control" id="locationofIncident" required>
					</div>
				</div>
				
				<div class="form-group row">                         <label for="typeofIncident" class="col-sm-4 col-form-label">Type of Incident (Required)</label>                         <div class="col-sm-8">                             <select id="typeofIncident" class="form-control"name="typeofIncident" required >                                 <option value="">Select</option>                                 <?php                                      for ($i=0; $i < count($incidentTypes); $i++) {                                          $incidentType = $incidentTypes[$i];                                         echo '<option value="' . $incidentType['id'] . '">' . $incidentType['type'] . '</option>';                                     }                                    ?>                             </select>                         </div>                     </div>

					<div class="form-group row">
					<label for="descriptionofIncident" class="col-lg-4 col-form-label">Description of Incident (Required)</label>
					<div class="col-lg-8">
					<textarea rows="5" name="descriptionofIncident" class="form-control" id="descriptionofIncident" required></textarea>
					</div>
			    </div>
					 <!--row for process call and reset button-->
			    <div class="form-group row">
			    	<div class="col-sm-4"></div>
			    	<div class="col-lg-8" style="text-align: center;">
			    		<input type="submit" name="btnProcessCall" class="btn btn-primary" value="Process Call">
			    		<input type="reset" name="btnReset" class="btn btn-primary" value="Reset">
			    	</div>
			    </div>
			</form>
			</section>
			<footer class="page-footer font-small blue pt-4 footer-copyright text-center py-3">&copy;2021 Copyright</footer>
	</div>
	<script type="text/javascript" src="js/jquery-3.5.0.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.js"></script>
	
	<script type="text/javascript" src="js/popper.min.js"></script>
	</body>
	</html>