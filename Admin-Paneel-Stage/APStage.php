<?php
include("db.php");
include("APStageBackend.php");

?>

<html>
<head>
  <style>
  table, th, td {
      border: 1px solid black;
  }
  </style>
    <title>Technolab Leiden | Registratie</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Toegevoegde links, hier beneden -->
    <link rel="stylesheet" href="../css/adminStyle.css">
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
                                    <img src="../images/logo-technolab.svg" width="200" height="40" alt="">
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

<form method="POST" class="col-lg-9 mx-auto" id="MainForm" action="BackEnd-Stage.php?id=<?= $a ?>&send=nee">
  <h1 class="mx-auto">Admin paneel stagiaires login</h1>

<?php
    $query = mysqli_query($con,"SELECT * FROM formdata2");
    $check = mysqli_num_rows($query);

    // if($check > 0 ){
    //   while ($row = mysqli_fetch_assoc($query)) {
    //     echo $row['voornaam']. "<br>";
    //     echo $row['geboorteDatum']. "<br>";
    //     echo $row['straat'] . "<br>";
    //     echo $row['stad']. "<br>";
    //     echo $row['postcode']. "<br>";
    //     echo $row['telefoon']. "<br>";
    //     echo $row['email']. "<br>";
    //     echo $row['school']. "<br>";
    //     echo $row['opleiding']. "<br>";
    //     echo $row['niveau']. "<br>";
    //     echo $row['stagejaar']. "<br>";
    //     echo $row['slber']. "<br>";
    //     echo $row['slbTelefoon']. "<br>";
    //     echo $row['slbMail']. "<br>";
    //   }
    // }
    if ($query->num_rows > 0) {
    echo "<table><tr><th>Voornaam</th><th>geboorte Datum</th><th>Straat</th><th>Stad</th><th>Postcode</th><th>Telefoon</th></tr>";
    // output data of each row
    while($row = $query->fetch_assoc()) {

        echo "<tr><td>" . $row["voornaam"]. "</td><td>" . $row["geboorteDatum"]. " </td><td>" . $row["straat"]. "</td></tr>";
    }
    echo "</table>";
    } else {
    echo "0 results";
    }

    // if ($query->num_rows > 0) {
    // echo "<table><tr><th>Voornaam</th><th>geboorte Datum</th><th>Straat</th><th>Stad</th><th>Postcode</th><th>Telefoon</th></tr>";
    // // output data of each row
    // while($row = $query->fetch_assoc()) {
    //
    //     echo "<tr><td>" . $row["voornaam"]. "</td><td>" . $row["geboorteDatum"]. " </td><td>" . $row["straat"]. "</td></tr>";
    // }
    // echo "</table>";
    // } else {
    // echo "0 results";
    // }
$con->close();
  ?>
    </main>
        <footer>
        </footer>
    </section>
</body>
</html>
