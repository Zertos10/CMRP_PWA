<html>
<head>
    <meta charset="utf-8">
<title>Traitement des donn�e</title>
</head>
<body>
<?php
   // V�rifier si le formulaire est soumis 
   if ( isset( $_POST['submit'] ) ) {
     /* r�cup�rer les donn�es du formulaire en utilisant 
        la valeur des attributs name comme cl� 
       */
     $nom = $_POST['name']; 
     $email = $_POST['email']; 
     $phone = $_POST['phone'];
     // afficher le r�sultat
     echo $nom;
       if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "L'adresse e-mail est valide";
  }else{
    echo "L'adresse e-mail n'est pas valide";
  }
     $valideForm = true;
  }

// Testons si le fichier a bien �t� envoy� et s'il n'y a pas d'erreur
if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image']['size'] <= 1000000)
        {
                // Testons si l'extension est autoris�e
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
file_get_contents('https://app.cmrp.net/cityc/thorailles/inser_user.php', false, $context);
}
?>



</body>
</html>