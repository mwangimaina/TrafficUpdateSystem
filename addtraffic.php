
<!DOCTYPE html>
<html>
<head>
	<title>Add Patient</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>

    <h1 class="jumbotron">Traffic Update</h1> 
   <fieldset>
   <legend>Details</legend>
    <form action="" method="POST">
    	<input type="text" name="road" 
    	placeholder = "Enter Road">
    	<br><br>

    	<input type="text" name="info" 
    	placeholder = "Whats going on?">
    	<br><br>

    	<input type="submit" value="Update" class="btn btn-info">
    </form>
</fieldset>
</body>
</html>


<?php
    $conn = mysqli_connect("localhost","root","","clinic_db");  
    $response1 = mysqli_query($conn, "SELECT * FROM table_traffic ORDER BY date DESC");

         while($row = mysqli_fetch_array($response1)){
            echo "<i class='text-muted'> $row[0]</i>";
            echo "<p class = 'alert alert-warning'> $row[1]</p>";
            echo "<b class='badge badge-secondary'> $row[2]</b>";
            echo "<hr>";
         }//end while

     //This is the Logic: provide the constructor with form values
  if (empty($_POST)) {
    exit(); //quit executing PHP code until, Form Button 
    //is clicked
  }//end

    $object = new Patient($_POST['road'],
    	                  $_POST['info']);
    $object->save(); # trigger save function


 class Patient{
      function __construct($road,$info){
 
         $this->road = $road;
         $this->info = $info;
       
      }//end
     
      function save(){
      	  //connect to your database
          $conn = mysqli_connect("localhost","root","","clinic_db");  
          //save to table
          $response = mysqli_query($conn, "INSERT INTO `table_traffic`
          	(`road`, `info`) 
          VALUES ('$this->road','$this->info')");    

           //testing the response
           if ($response==true) {
             echo "Sucessfully Saved Record <br/>";
             header("location:addtraffic.php");
           }

           else {
            echo "Record Failed. Check Your Details ";
           }
      }//end
 }

?>






