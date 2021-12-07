<!-- VALIDATIE CONTACTFORMULIER -->

<?php

$nameError = $emailError = "";
$name = $email = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameError = "Vul hier je naam in";
  } else {
    $name = test_input($_POST["name"]);

    // controleren of naam alleen letters en spaties bevat
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $nameError = "Alleen letters en spaties zijn toegestaan";
    }
  }

  if (empty($_POST["email"])) {
    $emailError = "Vul een geldig emailadres in";
  } else {
    $email = test_input($_POST["email"]);

    // opmaak emailadres controleren
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailError = "Geen geldig emailadres ingevuld";
    }
  }

  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = test_input($_POST["message"]);
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!-- EINDE VALIDATIE CONTACTFORMULIER -->

<!-- EMAIL VERSTUREN NA SUBMIT CONTACTFORMULIER -->

<?php
if (!empty($name) && !empty($email)) {
  $to = "you@me.com";
  $subject = "Nieuw bericht";
  $message = $name . " heeft dit bericht achtergelaten:" . "\n\n" . $_POST['message'];
  $headers = "From: me@you.com";
  mail($to, $subject, $message, $headers);
}
?>

<!-- EINDE EMAIL VERSTUREN NA SUBMIT CONTACTFORMULIER -->


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

    <title>BURO EETKUNDE</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png" />

    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Stylesheet Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300&display=swap"
        rel="stylesheet">

    <!-- Stylesheet icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <!-- HEADER -->

    <header class="header" id="header">
        <a href="index.php" class="logo">BURO EETKUNDE</a>
        <input class="menu-btn" type="checkbox" id="menu-btn">
        <label class="menu-icon" for="menu-btn">
            <span class="navicon"></span></label>
        <ul class="menu" id="menu">
            <li class="active"><a href="index.php">HOME</a></li>
            <li><a href="supplement.html">SUPPLEMENT</a></li>
            <li><a href="contact.php">CONTACT</a></li>
        </ul>
    </header>

    <!-- EINDE HEADER -->

    <!-- MAIN CONTENT -->

    <div class="maintext" id="maintext">
        <p><span class="hover">Buro Eetkunde</span> maakt, verbindt en vertelt verhalen uit de wereld van eten &
            drinken.</p>
        <p>Groot en klein, over én met ambacht.</p>
        <p>Van restaurants die het serveren, tot producenten die het maken.</p>
        <p>Vertellen doen we zelf, met onze maandelijkse mailing <a href="supplement.html" class="hover">Supplement</a>.
        </p>
    </div>

    <!-- EINDE MAIN CONTENT -->

    <!-- CONTACTFORMULIER -->

    <div class="container" id="contact">
        <div class="form-container">
            <div class="left-container">
                <div class="left-inner-container">
                    <p>Verbinden en maken<br> doen we ook in opdracht.</p>
                    <p class="cursor"><i class="fa fa-i-cursor"></i></p>
                </div>
            </div>
            <div class="right-container">

                <?php if (!empty($name) && !empty($email)) echo '<p class="bedankt"><span class="hello">Bedankt!</span><br><br>Je bericht is verstuurd.</p>'; ?>

                <div class="right-inner-container"
                    <?php if (!empty($name) && !empty($email)) echo 'style="display:none"'; ?>>
                    <p class="contact"><span class="hello">Say hello!</span> &#128075;&#127997;</p>

                    <form method="POST" action="#contact">

                        <span class="error"><?php echo $nameError; ?></span>
                        <input type="text" placeholder="Naam *" id="name" name="name" value="<?php echo $name; ?>" />
                        <span class="error"><?php echo $emailError; ?></span>
                        <input type="email" placeholder="Email *" id="email" name="email"
                            value="<?php echo $email; ?>" />

                        <textarea rows="4" placeholder="Typ hier je bericht" id="message" name="message"
                            value="<?php echo $message; ?>"></textarea>

                        <button type="submit" class="submit" id="submit" name="submit">Verstuur</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- EINDE CONTACTFORMULIER -->

    <!-- FOOTER -->

    <footer class="site-footer" id="footer">

        <!-- horizontale lijn -->
        <hr>

        <div class="social-icons">
            <a class="instagram" href="https://www.instagram.com/buro_eetkunde/"><i class="fa fa-instagram"></i></a>
        </div>

        <div class="toggle">
            <input type="checkbox" onclick="myFunction()" id="toggle" class="toggle--checkbox" />
            <label for="toggle" class="toggle--label">
                <span class="toggle--label-background"></span>
            </label>
        </div>

    </footer>

    <!-- EINDE FOOTER -->

    <!-- JAVASCRIPT VOOR TOGGLE -->

    <script>
    function myFunction() {
        var element = document.getElementById('contact');
        element.classList.toggle("dark-mode");
    }
    </script>

    <!-- EINDE JAVASCRIPT VOOR TOGGLE -->

</body>

</html>