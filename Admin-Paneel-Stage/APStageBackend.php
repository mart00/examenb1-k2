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
    $naam = mysqli_real_escape_string($con,$_POST['fname']);
    $anaam = mysqli_real_escape_string($con,$_POST['anaam']);
    $gebdatum = mysqli_real_escape_string($con,$_POST['gebdatum']);
    $straat = mysqli_real_escape_string($con,$_POST['straat']);
    $stad = mysqli_real_escape_string($con,$_POST['stad']);
    $postcode = mysqli_real_escape_string($con,$_POST['postcode']);
    $tel = mysqli_real_escape_string($con,$_POST['tel']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $opleiding = mysqli_real_escape_string($con,$_POST['opleiding']);
    $niveau = mysqli_real_escape_string($con,$_POST['niveau']);
    $leerjaar = mysqli_real_escape_string($con,$_POST['leerjaar']);
    $school = mysqli_real_escape_string($con,$_POST['school']);
    $SLBer = mysqli_real_escape_string($con,$_POST['Slber']);
    $Stel = mysqli_real_escape_string($con,$_POST['SlberTel']);
    $Smail = mysqli_real_escape_string($con,$_POST['SlberEmail']);
    $sql = "UPDATE stagiaires set voornaam = '".$naam."', achternaam = '".$anaam."', geboortedatum = '".$gebdatum."', straat = '".$straat."', stad = '".$stad."',
    postcode = '".$postcode."', telefoonnummer = '".$tel."', email = '".$email."', opleiding = '".$opleiding."', niveau = '".$niveau."', leerjaar = '".$leerjaar."',
    school = '".$school."', SLBer = '".$SLBer."', SLBerTel = '".$Stel."', SLBerEmail = '".$Smail."' WHERE id = '".$id."' ";
    if (mysqli_query($con,$sql)) {
      echo "string";
    } else{
       echo "Error updating record: " . $con->error;
    }
}
?><?php
if(isset($_POST['Download'])){
require('../fpdf183/fpdf.php');

  class PDF extends FPDF{

    function getAllInputs(){
      include("db.php");
      $id = $_GET['id'];
      $query = mysqli_query($con,"SELECT * FROM stagiaires WHERE id = '".$id."'");
      $row = $query->fetch_assoc();
      $naam = mysqli_real_escape_string($con, $row['voornaam']);
      $anaam = mysqli_real_escape_string($con, $row['achternaam']);
      $gebdatum = mysqli_real_escape_string($con, $row['geboortedatum']);
      $straat = mysqli_real_escape_string($con, $row['straat']);
      $stad = mysqli_real_escape_string($con, $row['stad']);
      $postcode = mysqli_real_escape_string($con, $row['postcode']);
      $tel = mysqli_real_escape_string($con, $row['telefoonnummer']);
      $email = mysqli_real_escape_string($con, $row['email']);
      $opleiding = mysqli_real_escape_string($con, $row['opleiding']);
      $niveau = mysqli_real_escape_string($con, $row['niveau']);
      $leerjaar = mysqli_real_escape_string($con, $row['leerjaar']);
      $school = mysqli_real_escape_string($con, $row['school']);
      $SLBer = mysqli_real_escape_string($con, $row['SLBer']);
      $Stel = mysqli_real_escape_string($con, $row['SLBerTel']);
      $Smail = mysqli_real_escape_string($con, $row['SLBerEmail']);
      $inputs = array($naam, $anaam, $gebdatum, $straat, $stad, $postcode, $tel, $email, $opleiding, $niveau, $leerjaar, $school, $SLBer, $Stel, $Smail);
      return $inputs;
    }
    function Header(){
      include("db.php");
      $id = $_GET['id'];
      $query = mysqli_query($con,"SELECT voornaam, achternaam FROM stagiaires WHERE id = '".$id."'");
      $row = $query->fetch_assoc();
      $naam = mysqli_real_escape_string($con, $row['voornaam']);
      $anaam = mysqli_real_escape_string($con, $row['achternaam']);
      $this->Image('../images/logo.png',10,6,30);
      $this->SetFont('Arial','B',15);
      $this->Cell(80);
      $this->Cell(30,10,"Informatie voor ".$naam." ".$anaam,1,0,'C');
      $this->Ln(20);
    }
  }
  $pdf = new PDF();
  $width_cell=array(10,30,20,30,10,30,20,30,10,30,20,30,10,30,20);
  list($naam, $anaam, $gebdatum, $straat, $stad, $postcode, $tel, $email, $opleiding, $niveau, $leerjaar, $school, $SLBer, $Stel, $Smail) = $pdf->getAllInputs();
  $header = array("Naam", "Achternaam", "Geboortedatum", "Straat", "Stad", "Postcode", "Telefoonnummer"
  , "Email", "Opleiding", "Niveau", "Leerjaar", "School", "SLBer", "SLBer Telefoonnummer", "SlBer Email");
  $wowie = array($naam, $anaam, $gebdatum, $straat, $stad, $postcode, $tel, $email, $opleiding, $niveau, $leerjaar, $school, $SLBer, $Stel, $Smail);
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',10);
  // $pdf->Cell(80,15, "Informatie voor ".$naam." ".$anaam);
  // for ($i = 0; $i < count($header); $i++){
  //   $pdf->Cell($width_cell[$i],0,$header[$i],10,0,'C',true);
  // }
  $width_cell=array(3,15,42,54);
  $pdf->SetFillColor(193,229,252);
  $i=0;
  $pdf->Cell($width_cell[2],10,$header[$i],1,0,'C',true); //Naam header
  $pdf->Cell($width_cell[3],10,$wowie[$i]." ".$wowie[$i+1],1,0,'C',false); // De naam van de database
  for ($i = 2; $i < count($wowie); $i++) {
    $pdf->Cell($width_cell[2],10,$header[$i],1,0,'C',true);
    $pdf->Cell($width_cell[3],10,$wowie[$i],1,1,'C',false);
  }

  $pdf->Output();
}
?>
