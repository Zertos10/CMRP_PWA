<html>
<head>
    <meta charset="utf-8">
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
        <a class="navbar-brand" href="#">Logo</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="javascript:void(0)" >Formulaire</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Map</a>
            </li>
        </ul>
    </nav>
    
    <br/><br/><br/>
    <article class="container pt-19" id="formulaire">
            <h1 id="titre_form">Formulaire d'inscription</h1>

    <form  class="form-group" enctype="multipart/form-data" method="POST" action="traitement.php">
      
    <label>Nom:</label>
    <input type="text" class="form-control" name="name">
        
     <label>Email:</label>
    <input type="email" class="form-control" name="email">
        <br/>
    <label>Numéro de télephone :</label>
    <input type="tel" class="form-control" name="phone">
        <br/>
     <label>Image :</label>
        <input type="file" class="form-control-file border" name="image">
        <br/>
    <input type="submit" class="form-control" name="submit">
    
    </form>
    <?php
    session_start();
 
   if(empty( $_SESSION['phone_verif'])) 
   {
  session_write_close();
   }
   else {
   echo session_name();
	$phone_verif = $_SESSION['phone_verif'];
    echo  $_SESSION['phone_verif'];
       ?>"<input type='hidden' id='phone_verif' value='<?php echo $phone_verif; ?>'/>"
       <?php
   

}
   




    ?>

    </article>
    
    <script src="../javascript/formulaire.js"></script>
</body>
</html> 