<?php
include("db.php");

//pak de variables van de link (id en send)
$a = $_GET['id'];
$c = $_GET['send'];
//kijk of de back end je terug gestuurd hebt omdat het email adres al gebruikt is
switch ($c) {
  case 'link':
    echo "Deze link is al eerder gebruikt.";
  break;
  case 'failure':
    echo "Er is iets fout gegaan.";
  break;
  case 'ja':
    echo "Uw hebt zichzelf al geregistreerd.";
  break;
  case 'success':
      echo "Uw heeft zich geregistreerd.";
  break;
  case 'nee':
  break;
  default:
    echo "Er is iets fout gegaan.";
    break;
}


?>

<html>
<head>

    <title>Technolab Leiden | Registratie</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Toegevoegde links, hier beneden -->
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="SelectCheck.js"></script>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>



<!-- De achtergrond staat hier, hij werkt niet in het css bestand -->
<style>
    body {
        background-image: url("images/background.jpg");
        background-size: 100%;
        background-repeat: no-repeat;
    }
</style>

</head>
<body>



<!-- De header, staat hier onder -->
<header id="main">
            <div class="header-content-wrap">
                <div class="header-deco"></div>
                    <div class="header-content">
                        <div>
                            <nav class="navbar navbar-light shadow" style="background-color: white;">
                                <a class="navbar-brand" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstleyVEVO">
                                    <img src="images/logo-technolab.svg" width="200" height="40" alt="">
                                </a>
                                <a class="btn btn-outline-success my-2 my-sm-0" href="LoginFormulier.php">Aanmelden</a>
                            </nav>
                        </div>
                    </div>
            </div>
</header>

        <main>
        <!-- Dit is het formulier zelf, dus waar je alles invult in de browser -->
    <section>

<form method="POST" class="col-lg-9 mx-auto" id="MainForm" action="APStageBackend.php?id=<?= $a ?>&send=nee">
  <h1 class="mx-auto">Stage formulier</h1>

  <div class="form-row container-fluid justify-content-center">
      <div class="form-group col-md-3 ">
        <label for="inputvnaam">Voornaam</label>
        <input class="form-control" type="text" id="fname" name="fname"  placeholder="Dik" >
      </div>
      <div class="form-group col-md-3">
        <label for="inputanaam">Achternaam</label>
        <input class="form-control" type="text" id="anaam" name="anaam"  placeholder="Schaap" >
      </div>
      <div class="form-group col-md-2">
        <label for="inputgebdatum">Geboorte datum</label>
        <input class="form-control" type="date" id="gebdatum" name="gebdatum"  placeholder="06/06/1966" >
      </div>
      <div class="form-group col-md-5">
        <label for="inputPassword4">Email</label>
        <input class="form-control" type="email" id="email" name="email"  placeholder="dikschaap@emailadres.com" >
      </div>
      <div class="form-group col-md-5">
        <label for="inputPassword4">Telefoonnummer</label>
        <input class="form-control" type="tel" id="tel" name="tel"  placeholder="06 12345678" >
      </div>
    </div>
    <div class="form-row container-fluid justify-content-center">
      <div class="form-group col-md-5">
        <label for="stad">Stad</label>
        <input class="form-control" type="text" id="stad" name="stad" placeholder=" Hilversum 3" >
      </div>
      <div class="form-group col-md-5">
        <label for="straat">Straat</label>
        <input class="form-control" type="text" id="straat" name="straat" placeholder=" Herenweg">
      </div>
      <div class="form-group col-md-2">
        <label for="postcode">postcode</label>
          <input class="form-control" type="text" id="postcode" name="postcode" placeholder=" 2222AA" >
      </div>
    </div>

    <div class="form-row container-fluid justify-content-center">
      <div class="form-group col">
        <label for="straat">Opleiding</label>
        <input class="form-control" type="text" id="opleiding" name="opleiding"  placeholder=" Putjeschepper" >
      </div>
      <div class="form-group col">
        <label for="straat">Niveau</label>
        <input class="form-control" type="number" id="niveau" name="niveau"  placeholder=" 3">
      </div>
      <div class="form-group col">
        <label for="straat">leerjaar</label>
        <input class="form-control" type="number" id="leerjaar" name="leerjaar"  placeholder=" 1" >
      </div>
      <div class="form-group col">
        <label for="straat">School</label>
          <input class="form-control" type="text" id="school" name="school"  placeholder=" MBO Hilversum" >
      </div>
    </div>
    <div class="form-row container-fluid">
      <div class="form-group col">
        <label for="straat">Slb-er</label>
        <input class="form-control" type="text" id="Slber" name="Slber"  placeholder=" Gerard Joling" >
      </div>
      <div class="form-group col">
        <label for="straat">Slb-er Telefoonnummer</label>
        <input class="form-control" type="tel" id="SlberTel" name="SlberTel"  placeholder="06 12345678" >
      </div>
      <div class="form-group col">
        <label for="straat">Slb-ermail</label>
        <input class="form-control" type="email" id="SlberEmail" name="SlberEmail"  placeholder="Gerard@joling.nl" >
      </div>
    </div>
    <div class="d-flex justify-content-center">
        <button class="SubmitButtonForm" type="submit" name="registratieSubmit">submit</button>
    </div>
    </main>
        <footer>
        </footer>
    </section>
</body>
</html>
