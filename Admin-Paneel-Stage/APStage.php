<?php
//get database
include("db.php");

?>

<html>
<head>

    <title>Technolab Leiden | Registratie</title>
    <meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/adminStyle.css">

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>



<style>
      body {
          background-image: url("images/background.jpg");
          background-size: 100%;
          background-repeat: no-repeat;
      }
  </style>

  </head>
  <body>

  <header id="main" class="w-100">
              <div class="header-content-wrap">
                  <div class="header-deco"></div>
                      <div class="header-content">
                          <div>
                              <nav class="navbar navbar-light shadow w-100" style="background-color: white;">
                                  <a class="navbar-brand" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstleyVEVO">
                                      <img src="../images/logo-technolab.svg" width="200" height="40" alt="">
                                  </a>
                                  <a class="btn btn-outline-success my-2 my-sm-0" href="LoginFormulier.php">Aanmelden</a>
                              </nav>
                          </div>
                      </div>
              </div>
  </header>

      <main>
      <section>

    <h1 class="mx-center text-center">Admin paneel stagiaires</h1>
  <!-- php code voor het maken en het invullen van de tabel -->
  <?php
  //start een buffer waardoor de header(); functie stopt met de "cannont modify header information" error weer te geven
      ob_start();
      //selecteer alle data van stagiaires
      $query = mysqli_query($con,"SELECT * FROM stagiaires");
      //kijk of er data bestaat
      if ($query->num_rows > 0) {
      //maak de tabel en headers
      echo '<table class="table table-sm table-dark table-bordered" w-75> <thead>
      <tr>
        <th scope="col">Voornaam</th>
        <th scope="col">Achternaam</th>
        <th scope="col">Geboorte Datum</th>
        <th scope="col">Straat</th>
        <th scope="col">Stad</th>
        <th scope="col">Postcode</th>
        <th scope="col">Telefoon</th>
        <th scope="col">Email</th>
        <th scope="col">Opleiding</th>
        <th scope="col">Niveau</th>
        <th scope="col">Leerjaar</th>
        <th scope="col">School</th>
        <th scope="col">Slb-er</th>
        <th scope="col">Slb Email</th>
        <th scope="col">Slb Telefoon</th>
        <th scope="col">DELETE DATA</th>
        <th scope="col">CHANGE DATA</th>
        <th scope="col">Download PDF</th>
      </tr>
    </thead> <tbody>';

      // while their still is data from the query
      while($row = $query->fetch_assoc()) {
        //fill the table with the data from the query and add buttons for deleting, changing and downloading a pdf.
          echo '<tr>
              <th scope="row"> '.$row["voornaam"].' </th><td>' .$row["achternaam"]. '</td> <td>'.$row["geboortedatum"].'</td> <td>'.$row["straat"].'</td>
              <td>'.$row["stad"].'</td> <td>'.$row["postcode"].'</td> <td>'.$row["telefoonnummer"].'</td> <td>'.$row["email"].'</td> <td>'.$row["opleiding"].'</td>
              <td>'.$row["niveau"].'</td> <td>'.$row["leerjaar"].'</td> <td>'.$row["school"].'</td> <td>'.$row["SLBer"].'</td> <td>'.$row["SLBerTel"].'</td> <td>'.$row["SLBerEmail"].'</td>
              <form action="APStageBackend.php?id='.$row["ID"].'" method="post">
                <td><input type="submit" name="Delete" value="Danger" class="btn btn-danger" /></td>
              </form>
              <form action="APStageChange.php?id='.$row["ID"].'" method="post">
                <td><input type="submit" name="Change" value="Change"class="btn btn-info" /></td>
              </form>
              <form action="APStageBackend.php?id='.$row["ID"].'" method="post">
                <td><input type="submit" name="Download" value="Download"class="btn btn-info" /></td>
              </form>
            </tr>';
              }

      echo "</table>";
    } else {
    echo "0 results";
    }
$con->close();
ob_end_flush();
?>
    </main>
        <footer>
        </footer>
    </section>
</body>
</html>
