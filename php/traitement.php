<html>
<head>
<meta http-equiv= »Content-Type » content= »text/html; charset=utf-8″ />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="author" content="">
<title>Traitement des donnée</title>
</head>
<body id="validation">

<?php
   // Vérifier si le formulaire est soumis 
   if ( isset( $_POST['submit'] ) ) 
   {
      /*récupérer les données du formulaire en utilisant 
        la valeur des attributs name comme clé 
       */
     $nom = htmlspecialchars($_POST['name']); 
     $email =htmlspecialchars($_POST['email']); 
     $phone = htmlspecialchars($_POST['phone']);
     $localisation = htmlspecialchars($_POST['localisation']);

     
     // afficher le résultat
     //echo $nom;
     if(empty($nom))
     {
        $nom_valide = 1;
     }
     if(empty($email))
     {
          $email_valide = 1;
     }
     if(empty($phone))
     {
          $phone_valid = 1;
     }
     else {
	$nom_valide = 2;


       if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    //echo "L'adresse e-mail est valide";
    $email_valide = 2;
  }else
  {
    //echo "L'adresse e-mail n'est pas valide";
      $email_valide = 1;
  }
 

if(preg_match('`^(06[-. ]?(\d{2}[-. ]?){3}\d{2})$`',$phone))
{

	$valide_phone = 2;
   // echo 'Numéro correct !';
}
else {
   // echo 'Numéro incorrect !';
    $valide_phone = 1;
}
}
if($valide_phone == 2 && $email_valide == 2 && $nom_valide == 2)
{
     $valideForm = true;
}
  else {
	$valideForm = false;
}
}

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image']['size'] <= 1000000)
        {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                  move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . basename($_FILES['image']['name']));
              //  echo "Pas d'erreur";
                $validFile = true;
                }
                else 
                {
               // echo "Pas la bonne extension";
                }

        }
}
else {
	$valideFile = false;
    
   // echo "Il n'a pas d'image ";
}

if($valideForm == true AND $validFile == true)
{ 
$imagedata = file_get_contents("uploads/".basename($_FILES['image']['name']));
             // alternatively specify an URL, if PHP settings allow
$data_image = base64_encode($imagedata);
    $arr = array('Prenom' => $nom, 'Email' => $email, 'Phone' => $phone,"localisation" => $localisation,'Image' => $data_image);
    $options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  => "Content-Type: application/json",
        'content' =>  json_encode($arr),
    ),

);

$context  = stream_context_create($options);
$succes = file_get_contents('https://app.cmrp.net/cityc/thorailles/inser_user.php', false, $context);
}
else {
	echo "Plusieur erreur";
}

//echo $phone;
session_start();

if (!isset($_SESSION['phone_valid']) && !isset($_SESSION['email_valid']) && !isset($_SESSION['succes_envoie']) && !isset($_SESSION['nom_valid'])) 
{
//echo "\nL'état de la variable est $valide_phone ";
  $_SESSION['phone_valid'] = $valide_phone;
    $_SESSION['email_valid'] = $email_valide;
    $_SESSION['succes_envoie']= $succes;
    $_SESSION['nom_valid']= $nom_valide;
    // echo  $_SESSION['email_valid'];
}
else 
{
	//echo "\nL'état de la variable est $valide_phone ";
  $_SESSION['phone_valid'] = $valide_phone;
    $_SESSION['email_valid'] = $email_valide;
     $_SESSION['succes_envoie']= $succes;
    $_SESSION['nom_valid']= $nom_valide;
   // echo  $_SESSION['email_valid'];
}

?><meta http-equiv="refresh" content="1; url=formulaire.php" />






</body>
</html>