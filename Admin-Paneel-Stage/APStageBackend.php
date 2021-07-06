<?php
//Dit is het bestand om met de database een connectie te maken
include("db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(E_ALL);
ini_set("display_errors", 1);
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
      session_start();
      $_SESSION["loggedin"] = TRUE;
      header("Location: APstage.php?info=nee");
    } else {
      mysqli_error($con);
      header("Location: APStageLogin.php?info=wachtwoord");
    }
    $query = mysqli_query($con,"SELECT * FROM admin WHERE Gebruikersnaam = '".$username."' AND Wachtwoord = '".$password."' ");
    //makes sure that mysqli reports the errors in full detail
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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
      header("Location: APStage.php?info=aanpassen");
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
    header("Location: APstage.php?info=delete");
  } else {
      echo "Error deleting record: " . $con->error;
      header("Location: APstage.php?failure");
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


//code voor het versturen van mails naar stagiaires via een gegeven excel sheet waarbij PhpSpreadsheet en PhpMailer gebruikt word.
if(isset($_POST['registratie']) ){ //als een from met de naam registratie verstuurd word
//code voor het opzetten van de mail
ob_start();
    $id = uniqid(); //maak een unieke id
    require 'vendor/autoload.php'; //gebruik (pak) vendor/autoload.php voor mail
    $mail = new PHPMailer(true); //Maak een nieuwe classe mail aan
    $mail->IsSMTP(); // zet smtp aan nodig voor het verzenden van mails op localhost
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com"; //gebruik een google account voor de mails
    $mail->Port = 465; // or 587
    $mail->IsHTML(true); //laat je html gebruiken in de mail
    $mail->Username = 'testformail946@gmail.com';
    $mail->Password = 'Testformail946!';
    $mail->SetFrom('testformail946@gmail.com'); //verzend van
    $mail->Subject = "Registratie link Technolab"; //onderwerp van de mail

//code voor het uploaden van een excel bestand en het lezen daarvan
    $target_dir = "uploads/"; //selecteer waar het bestand komt te staan
    $target_file = $target_dir . basename($_FILES["uploadedsheet"]["name"]); //de locatie van de file + de naam van de file
    $file = pathinfo($_FILES["uploadedsheet"]["name"]); //de locatie "pad" van de file bv: c/xampp/htdocs/werkplaats/uploads/excel.xlsx
    $check = $file["extension"]; //sla de extensie (file type) van de file op
    if($check == "xlsx") {  //kijk of de file extensie gelijk staat aan xlsx (weet niet zeker of andere bestands types zouden werken)
        move_uploaded_file($_FILES["uploadedsheet"]["tmp_name"], $target_file); //verplaats de file naar $target_file
    } else {
        header("Location: APstage.php?excelError");
    }
//code voor het verzenden van de mail naar verschillende adressen
    //implodeer twee keer eerst alle items in de array waarna die weer worden geimplodeerd naar een enkele string
    function convert_multi_array($array) { //functie voor het verwerken van array(s) in een array naar een enkele array
        $out = implode(",",array_map( //imploderen maakt de array een string met de gewenste teken er tussen
          //array map doet alles in de functie hieronder met de geselecteerde array
            function($a) {
                return implode("~",$a); // splits de array naar een string met ~ ertussen
            },$array)); //gebruik deze array
        print_r($out); // print de ouput de functie.
    }
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); // maak een classe gebaseerd op de xlsx() classe
    $spreadsheet = $reader->load($target_file); //laat de opgeslagen file
    $mails = $spreadsheet->getActiveSheet()->toArray(); //verwerk de opgelaade file tot een array
    $mails = array_column($mails,0); //pak de eerste(0) value van elke array in de array
    foreach ($mails as $recipients) {
        $mail->addBcc($recipients);//voeg recipients toe als annoniemen ontvanger
        try {
          $mail->Body = "Hallo toekomstige stagiair. Hierbij de link voor het registreren bij Technolab.<br>
            https://localhost//examenb1-k2/Admin-Paneel-Stage/RegistratieFormulier.php?id=".uniqid()."&send=nee";  //tekst van de mail
          $mail->Send(); //verstuur de mail
          $mail->ClearBCCs(); //verwijder ontvanger
        } catch (phpmailerException $e) {//let op error van phpmailer
            echo $e->errorMessages();
            header("Location: APStage.php?info=");
        }
        $mail->clearAddresses();
    }

    header("Location: APStage.php?info=mail");
}

// Dit is een functie om cross-site scripting te voorkomen
function secure($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

//Hier worden de gegevens opgehaald zodra er op verzenden word gedrukt
if(isset($_POST['registratieSubmit'])){
  //alle files worden opgehaald van het form en cross site scripting veilig gemaakt via de secure functie
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

  //makes sure that mysqli reports the errors in full detail
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  //get the values from the browser
  $a = $_GET['id'];
  $c = $_GET['send'];

  //the database you connect and what you want to get from it.
  $query = mysqli_query($con, "SELECT * FROM onetimelink WHERE id= '".$a."' ");
  $sql = mysqli_query($con, "SELECT * FROM stagiaires WHERE email = '$email'");

  //checks if eather query went through
  if(!$sql && !$query) {
      mysqli_error($con);
  }
  //get submitted email
  while($row = mysqli_fetch_array($sql)) {
      $emaill = $row['email'];
  }
  //check if link has been used before.
  if ($c == "link"){
    header("Location: APStage.php?id=".$a."&send=link");
  }
  //check if email has been used before
  if(!isset($emaill)){
    //check if the link has been used and send back if it has
    if( mysqli_num_rows($query) > 0){
      header("Location: APstage.php?id=".$a."&info=link");
    } else{
      //prepare insert of one time link into database
      $stmt = $con->prepare( "INSERT INTO OneTimeLink VALUES (?)");
      //bind (confirm) the insert into the database
      $stmt->bind_param('s', $a);
      //insert into the database
      $result = $stmt->execute();
      //prepare insert of one alle stagiair data into database
      $stmt2 = $con->prepare("INSERT INTO stagiaires (voornaam, achternaam, geboortedatum, straat, stad, postcode,
      telefoonnummer, email, opleiding, niveau, leerjaar, school, SLBer, SLBerTel, SLBerEmail)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      //bind (confirm) the insert into the database
      $stmt2->bind_param('sssssissiisssis', $naam, $anaam, $gebdatum, $straat, $stad, $postcode, $tel, $email, $opleiding, $niveau, $leerjaar, $school, $SLBer, $Stel, $Smail);
      //insert into the database
      $result2 = $stmt2->execute();
      //if the insertions succeed send back with keyword succes otherwise failure.
      if($result && $result2){
        header("Location: APStage.php?id=".$a."&info=success");
      } else {
        header("Location: APStage.php?id=".$a."&info=failure");
      }

    }
  } else{
    header("Location: APStage.php?id=".$a."&info=failure");
  }

}
?>
