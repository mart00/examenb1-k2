<?php
//Dit is het bestand om met de database een connectie te maken
include("db.php");

//code voor het inloggen op het admin paneel
if(isset($_POST['login'])){
    //get de ingevulde values van het formulier en maak ze mysqli veilig
    $password= mysqli_real_escape_string($con,$_POST['password']);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    $username = mysqli_real_escape_string($con,$_POST['username']);

    $wowAnotherQuery = mysqli_query($con,"SELECT Wachtwoord FROM admin WHERE Gebruikersnaam = '".$username."'");
    $data = $wowAnotherQuery->fetch_assoc();

    var_dump($passwordHashed);

    //pak alle data van de admin paneel die de juiste gebruikersnaam en wachtwoord hebben
    if (password_verify($password,$data["Wachtwoord"])) {
      header("Location: www.hahah.php");
      echo "string";
    }
    echo $data["Wachtwoord"];
    echo "<br>". $passwordHashed;
    $query = mysqli_query($con,"SELECT * FROM admin WHERE Gebruikersnaam = '".$username."' AND Wachtwoord = '".$password."' ");
    //makes sure that mysqli reports the errors in full detail
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    //als er geen rije zijn van de query geef error weer anders ga naar de apstage pagina.
    // if(!mysqli_num_rows($query)) {
    //     mysqli_error($con);
    //     header("Location: APStageLogin.php");
    // } else {
    //   session_start();
    //   $_SESSION["loggedin"] = TRUE;
    //   header("Location: APstage.php");
    // }
}
//code voor het aanpassen van de gegevens in de database
if(isset($_POST['aanpassen'])){
  echo "string";
    //get de ingevulde values van het formulier en maak ze mysqli veilig
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

    //lange sql query die alle gegevens met de ingevulde gegevens aanpast
    $sql = "UPDATE stagiaires set voornaam = '".$naam."', achternaam = '".$anaam."', geboortedatum = '".$gebdatum."', straat = '".$straat."', stad = '".$stad."',
    postcode = '".$postcode."', telefoonnummer = '".$tel."', email = '".$email."', opleiding = '".$opleiding."', niveau = '".$niveau."', leerjaar = '".$leerjaar."',
    school = '".$school."', SLBer = '".$SLBer."', SLBerTel = '".$Stel."', SLBerEmail = '".$Smail."' WHERE id = '".$_GET['id']."' ";
    //pas de gegevens aan als de query werkt en ga dan terug naar APStage.php anders geef error weer
    if (mysqli_query($con,$sql) === TRUE) {
      header("Location: APStage.php");
    } else {
       echo "Error updating record: " . $con->error;
    }
}
//code voor het verwijderen van data
if(isset($_POST['Delete'])){
  //verwijder data waar de id de id in de header is
  $sql = "DELETE FROM stagiaires WHERE id='".$_GET['id']."' ";
  //kijk of de query door gaat ga dan weer terug naar stage of geef error weer en dan weer terug naar stage.
  if (mysqli_query($con, $sql) === TRUE) {
    header("Location: APstage.php");
  } else {
      echo "Error deleting record: " . $con->error;
      header("Location: APstage.php");
  }
}
?>
<?php
//code voor het downloaden van een pdf van de data van een specifieke stagiere
if(isset($_POST['Download'])){
//get de code van het fpdf file
require('../fpdf183/fpdf.php');
  // de classe pdf is een extentie (copie) van de FPDF classe.
  class PDF extends FPDF{
    //functie voor het pakken van alle data voor het specifieke id.
    function getAllInputs(){
      include("db.php");
      //selecteer alles waar van stagiaires de id de id in de header is
      $sql = "SELECT * FROM stagiaires WHERE id = '".$_GET['id']."'";
      //als de de query door gaat zet alle data in $row waarna je ze in verschillende variables zet en dat in een array zet waarna je die returned.
      if(mysqli_query($con,$sql) == TRUE){
          //zet query gelijk aan de query
          $query = mysqli_query($con,$sql);
          //zet alle data in $row
          $row = $query->fetch_assoc();
          //get de ingevulde values van het formulier en maak ze mysqli veilig
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
          //zet alle variables in een array
          $inputs = array($naam, $anaam, $gebdatum, $straat, $stad, $postcode, $tel, $email, $opleiding, $niveau, $leerjaar, $school, $SLBer, $Stel, $Smail);
          return $inputs;
      } else {
        header("Location: APstage.php");
      }
    }
    //code voor de header van de pdf die automatisch word aangeroepen
    function Header(){
      include("db.php");
      //selecteer alles waar van stagiaires de id de id in de header is
      $query = mysqli_query($con,"SELECT voornaam, achternaam FROM stagiaires WHERE id = '".$_GET['id']."'");
      //zet alle data in $row
      $row = $query->fetch_assoc();
      //get de ingevulde values van het formulier en maak ze mysqli veilig
      $naam = mysqli_real_escape_string($con, $row['voornaam']);
      $anaam = mysqli_real_escape_string($con, $row['achternaam']);
      //zet header image, hoe ver hij naar links gaat,naar beneden en grote
      $this->Image('../images/logo.png',10,10,60);
      // zet de font, dat hij bold is, en grote
      $this->SetFont('Arial','B',15);
      //zet de grote van de cell
      $this->Cell(80);
      // zet de grote van de cell, hoe ver naar link, tekst,of er een border is, of er iets naast gaat, en tekst opties (zoals bold)
      $this->Cell(100,10,"Informatie voor ".$naam." ".$anaam,1,0,'C');
      //wit ruimte tussen regels enters...
      $this->Ln(20);
    }
  }
  //maak nieuwe pdf via classe pdf
  $pdf = new PDF();
  //maak een array met all namen voor de headers
  $header = array("Naam", "Achternaam", "Geboortedatum", "Straat", "Stad", "Postcode", "Telefoonnummer"
  , "Email", "Opleiding", "Niveau", "Leerjaar", "School", "SLBer", "SLBer Telefoonnummer", "SlBer Email");
  //array $wowie is gelijk aan alle de return array van getAllInputs()
  $wowie = $pdf->getAllInputs();
  //$pdf voeg de eerste pagina toe aan de pdf
  $pdf->AddPage();
  // zet de font, dat hij bold is, en grote
  $pdf->SetFont('Arial','B',10);
  //variable met een array met values voor breedte van cellen
  $width_cell=array(3,15,42,54);
  //zet de kleuren die gebruikte worden bij cellen
  $pdf->SetFillColor(193,229,252);
  //zet $i
  $i=0;
  //zet een cell van de tabel met de breedte,hoogte, value, wel of geen border,of er iest naast komt, centered in de cel, of het een kleur heeft
  $pdf->Cell($width_cell[2],10,$header[$i],1,0,'C',true);
  //zet een cell van de tabel met de breedte,hoogte, value, wel of geen border,of er iest naast komt, centered in de cel, of het een kleur heeft
  $pdf->Cell($width_cell[3],10,$wowie[$i]." ".$wowie[$i+1],1,0,'C',false); // De naam van de database
  //als $i=2; kleiner is dan de hoeveelheid variables die in de array $wowie zitten maak automatisch nieuwe cellen aan en vul die in en voeg een toe aan i
  for ($i = 2; $i < count($wowie); $i++) {
    $pdf->Cell($width_cell[2],10,$header[$i],1,0,'C',true);
    $pdf->Cell($width_cell[3],10,$wowie[$i],1,1,'C',false);
  }
  // geef de pdf weer.
  $pdf->Output();
}
?>
