<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<h1>INFS7901 - Show a Patient Appointment Record</h1>
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
                <th scope="col">Appointment at</th>
                <th scope="col">Length (mins)</th>
                <th scope="col">Patient Name</th>
                <th scope="col">DOB</th>
                <th scope="col">Gender</th>
                <th scope="col">Clinician</th>
            </tr>
        </thead>
        <tbody id="showpatient">
            <?php
                // FILL TABLE WITH DATA ON CLICK
                if(isset($_POST["submit1"])) {
                    // get all our EC data
                    $varPID = ($_POST['formPID']);
                    $query = "SELECT  
                    Appointment.AppDateTime, 
                    Appointment.Length, 
                    CONCAT(Patient.FirstName, ' ',Patient.LastName) AS 'Patient', 
                    Patient.DOB, 
                    Patient.Gender, 
                    CONCAT(Clinician.FirstName,' ', Clinician.LastName) AS 'Clinician' 
                    FROM Appointment LEFT JOIN Patient ON Appointment.PatientID=Patient.PatientID 
                    LEFT JOIN Clinician ON Appointment.ClinicianID=Clinician.ClinicianID
                    WHERE Patient.PatientID=" . $varPID;
                    $result = mysqli_query($conn, $query);
                    // put all our results into a html table
                    while ($rows = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$rows["AppDateTime"]."</td>";
                        echo "<td>".$rows["Length"]."</td>";
                        echo "<td>".$rows["Patient"]."</td>";
                        echo "<td>".$rows["DOB"]."</td>";
                        echo "<td>".$rows["Gender"]."</td>";
                        echo "<td>".$rows["Clinician"]."</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <form action="" method="post">
    <p>
			What is the Patient ID of the record you want to show?<br>
			<input type="text" name="formPID" maxlength="2" value="<?=$varPID;?>" />
		</p>
        <input type="submit" name="submit1" class="btn btn-primary btn-lg" value="Get Data" style="text-align:centre;margin:10px" />
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>    