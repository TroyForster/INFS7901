<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<h1>INFS7901 - Delete a Patient Record</h1>
</body>
    <?php 
        // SETUP PHP CONNECTION
        $servername = "localhost";
        $username = "root";
        $password = "d14741f81f154b41";
        $dbname = "INFS7901";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("<h3>Connection failed: ".$conn->connect_error."</h3>");
        }
    ?>

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Patient Name</th>
                <th scope="col">DOB</th>
                <th scope="col">Gender</th>
                <th scope="col">PatientID</th>
            </tr>
        </thead>
        <tbody id="Patient List">
            <?php
                // FILL TABLE WITH DATA ON CLICK
                if(isset($_POST["submit1"])) {
                    // get all our EC data
                    $query = "SELECT  
                    CONCAT(Patient.FirstName, ' ',Patient.LastName) AS 'Patient', 
                    Patient.DOB, 
                    Patient.Gender, 
                    Patient.PatientID
                    FROM Patient
                    ORDER BY PatientID";
                    $result = mysqli_query($conn, $query);
                    // put all our results into a html table
                    while ($rows = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$rows["Patient"]."</td>";
                        echo "<td>".$rows["DOB"]."</td>";
                        echo "<td>".$rows["Gender"]."</td>";
                        echo "<td>".$rows["PatientID"]."</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <form action="" method="post">
        <input type="submit" name="submit1" class="btn btn-primary btn-lg" value="Get Data" style="text-align:centre;margin:10px" />
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
    if($_POST['formSubmit'] == "Submit")
    {
    	$errorMessage = "";
        
    	if(empty($_POST['formPID']))
    	{
	    	$errorMessage .= "<li>You forgot to enter a Patient Id!</li>";
	    }
	
    	$varPID = $_POST['formPID'];

	    if(empty($errorMessage)) 
    	{
            $query2 = "DELETE FROM Patient 
            WHERE PatientID = $varPID";
            $result2 = mysqli_query($conn, $query2);
		
	    	header("Location: delpatient.php");
	    	exit;
    	}
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<head>
	<title>Delete Patient Record</title>
</head>
<body>
	<?php
		if(!empty($errorMessage)) 
		{
			echo("<p>There was an error with your form:</p>\n");
			echo("<ul>" . $errorMessage . "</ul>\n");
		} 
	?>
	<form action="delpatient.php" method="post">
		<p>
			What is the Patient ID of the record you want to delete?<br>
			<input type="text" name="formPID" maxlength="2" value="<?=$varPID;?>" />
		</p>
		<input type="submit" name="formSubmit" value="Submit" />
	</form>
</body>