<?php
//Dit is het bestand om met de database een connectie te maken
include("db.php");

//Dit is een functie om cross-site scripting te voorkomen
function secure($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
if(isset($_POST['submit'])){
    //alle files worden opgehaald van het form en cross site scripting veilig gemaakt via de secure functie
    $password= mysqli_real_escape_string($con,$_POST['password']);
    $username = mysqli_real_escape_string($con,$_POST['username']);

    $query = mysqli_query($con,"SELECT * FROM admin WHERE Gebruikersnaam = '".$username."' AND Wachtwoord = '".$password."' ");
    //makes sure that mysqli reports the errors in full detail
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    if(!mysqli_num_rows($query)) {
        mysqli_error($con);
    } else {
      session_start();
      $_SESSION["loggedin"] = TRUE;
      header("Location: APstage.php");
    }
}
if(isset($_POST['aanpassen'])){
    $id = $_GET['id'];
    $tel = mysqli_real_escape_string($con,$_POST['tel']);
    $sql = "UPDATE stagiaires set telefoonnummer = '".$tel."' WHERE id = '".$id."' ";
  if (mysqli_query($con,$sql)) {
      echo "string";
    } else{
       echo "Error updating record: " . $con->error;
    }
}
