<html>
<head>
<meta http-equiv= »Content-Type » content= »text/html; charset=utf-8″ />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="author" content="">
    <title>Formulaire</title>
</head>
<body id="corp">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <h4 class="navbar-brand" href="#">Site essai PWA</h4>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="javascript:void(0)" >Formulaire</a>
            </li>
           
        </ul>
    </nav>
    
    <br><br><br>
    <article class="container pt-19" id="formulaire">
            <h1 id="titre_form">Formulaire d'inscription</h1>

    <form  class="form-group" enctype="multipart/form-data" method="POST" action="traitement.php">
          
    <input type="hidden" name="localisation" id="localisation">
    <label>Nom:</label>
    <input type="text" class="form-control" name="name" id="name_form">
        
     <label>Email:</label>
    <input type="email" class="form-control" name="email" id="email_form">
        <br/>
    <label>Numéro de télephone :</label>
    <input type="tel" class="form-control" name="phone" id="phone_form">
        <br/>
     <label>Image :</label>
        <input type="file" class="form-control-file border" name="image" id="image_form">
        <br/>
    
    <input type="submit" class="form-control" name="submit">
    
    </form>
    <?php

    session_start();
 
   if(empty( $_SESSION['phone_valid']) && empty( $_SESSION['email_valid']) && empty( $_SESSION['nom_valid']) && empty( $_SESSION['succes_envoie'])) 
   {
  session_write_close();
   }
   else {
	$phone_valid = $_SESSION['phone_valid'];
    $email_valid = $_SESSION['email_valid'];
    $name_valid = $_SESSION['nom_valid'];
    $send_succes = $_SESSION['succes_envoie'];

    //echo  $_SESSION['phone_valid'];
    // echo  $_SESSION['email_valid'];
       ?>
       <input type='hidden' id='phone_valid' value='<?php echo $phone_valid; ?>'/>
       <input type='hidden' id='email_valid' value='<?php echo $email_valid; ?>'/>
       <input type='hidden' id='name_valid' value='<?php echo $name_valid; ?>'/>
       <input type='hidden' id='send_succes' value='<?php echo $send_succes; ?>'/>


       <?php
       
} session_destroy();


?>

    </article>
    
    <script src="../javascript/formulaire.js"></script>
</body>
</html> 