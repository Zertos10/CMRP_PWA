<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="author" content="">
<title>Traitement des donnée</title>
</head>
<body id="validation">

<?php
session_start();
   // Vérifier si le formulaire est soumis 
   if ( isset( $_POST['submit'] ) ) {
      /*récupérer les données du formulaire en utilisant 
        la valeur des attributs name comme clé 
       */
     $nom = $_POST['name']; 
     $email = $_POST['email']; 
     $phone = $_POST['phone'];
     //$localisation = $_POST['localisation'];
     // afficher le résultat
     echo $nom;
       if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "L'adresse e-mail est valide";
    $email_valide = true;
  }else
  {
    echo "L'adresse e-mail n'est pas valide";
      $email_valide = false;
  }
 

if(!preg_match('`^(06[-. ]?(\d{2}[-. ]?){3}\d{2})$`',$phone))
{
echo 'C\'est pas un bon numéro!';
$valide_phone = false;
}
else
{
echo 'C\'est un bon numéro!';
$valide_phone = true;
}

  $_SESSION['phone_verif'] = $valide_phone;
  echo $_SESSION['phone_verif'];

if($valide_phone = true && $email_valide = true)
{
     $valideForm = true;
}
  }
  else {
	$valideForm =false;
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
                echo "Pas d'erreur";
                $validFile = true;
                }
                else 
                {
                echo "Pas la bonne extension";
                }

        }
}
else {
	$valideFile= false;
    
    echo "Il n'a pas d'image ";
}

if($valideForm = true AND $validFile = true)
{ 
$imagedata = file_get_contents("uploads/".basename($_FILES['image']['name']));
             // alternatively specify an URL, if PHP settings allow
$data_image = base64_encode($imagedata);
    $arr = array('Prenom' => $nom, 'Email' => $email, 'Phone' => $phone,'Image' => $data_image);
    $options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  => "Content-Type: application/json",
        'content' =>  json_encode($arr),
    ),

);

$context  = stream_context_create($options);
//$succes = file_get_contents('https://app.cmrp.net/cityc/thorailles/inser_user.php', false, $context);

}
if (!isset($_SESSION['email_verif'])) {
  $_SESSION['verif'] = $email_valide;
}





?>




</body>
</html>