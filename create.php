<?php



// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
{
    echo '<pre>';
    var_dump($_FILES);
    echo '</pre>';
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image']['size'] <= 1000000)
        {
                // Testons si l'extension est autorisée
                $fileInfo = pathinfo($_FILES['image']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($extension, $allowedExtensions))
                {
                    move_uploaded_file($_FILES['image']['tmp_name'], basename($_FILES['image']['name']));
                    echo 'you file is sended';
                
                }
        }
}


?>



<form action="create.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="image">Ajouter une phot</label>
        <input type="file" id="image" name="image">
    </div>
    <button type="submit">Envoyer</button>
</form>