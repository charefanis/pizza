<?php
session_start();
if (!isset($_SESSION['user_id']))
    header("Location: login.php"); // adjust file as needed
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Pizza House</title>
</head>

<body>
    <?php
    include_once("nav.php");
    ?>
    <section class="mt-5">
        <div class="add-salad-form-container">
            <form class="add-salad-form" action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="menu" class="form-label">Choose a type</label>
                    <select class="form-select" id="menu" name="type_art" required>
                        <option value="Salade">Salade</option>
                        <option value="Burger">Burger</option>
                        <option value="Pizza">Pizza</option>
                        <option value="Drink">Drink</option>
                        <option value="Dessert">Dessert</option>
                        <option value="SeaFood">SeaFood</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="salad-name">Product Name</label>
                    <input type="text" class="form-control" name="salad_name" id="salad-name" required>
                </div>

                <div class="form-group">
                    <label for="salad-price">Price ($)</label>
                    <input type="number" class="form-control" name="salad_price" id="salad-price" required>
                </div>

                <div class="form-group">
                    <label for="salad-description">Description</label>
                    <textarea class="form-control" name="salad_description" id="salad-description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="salad-image-file">Choose Image</label>
                    <input type="file" name="salad_image" id="salad-image-file" class="form-control" required>
                </div>

                <button type="submit" name="submit">Add Salad</button>
            </form>

        </div>
    </section>
    <button id="scrollToTopBtn" class="scrollToTopBtn"><i class="fa-solid fa-up-long"></i></button>
    <button class="toggleDarkMode" id="darkModeButton" onclick="toggleDarkMode()">Dark mode<i
            class="fa-solid fa-moon"></i></button>
    <button class="toggleLightMode" id="lightModeButton" onclick="toggleDarkMode()"><i class="fa-solid fa-sun"></i>Light
        mode</button>


    <?php
    include_once("footer1.php");
    include_once("footer2.php");
    ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 500
        });
    </script>
    <script src="main.js?v=<?php echo time(); ?>"></script>
</body>

</html>
<?php
// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $type_art = $_POST['type_art'];
    $saladName = $_POST['salad_name'];
    $saladPrice = $_POST['salad_price'];
    $saladDescription = $_POST['salad_description'];

    // Traitement de l'image uploadée
    if (isset($_FILES['salad_image']) && $_FILES['salad_image']['error'] == 0) {
        $file = $_FILES['salad_image'];

        // Informations sur le fichier
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Extension autorisée
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        // Vérifie si l'extension est autorisée
        if (in_array($fileExt, $allowedExts)) {
            // Vérifie si la taille du fichier est inférieure à 5 Mo
            if ($fileSize <= 5 * 1024 * 1024) {
                // Générer un nom unique pour le fichier
                $newFileName = uniqid('salad_', true) . '.' . $fileExt;
                $uploadDirectory = 'assets/img/' . $type_art; // Dossier de destination
                $newFileName=$uploadDirectory . $newFileName;
                // Déplace le fichier vers le dossier 'uploads'
                if (move_uploaded_file($fileTmpName, $newFileName)) {
                    echo "Fichier téléchargé avec succès : " . $newFileName;
                } else {
                    echo "Erreur : Le fichier n'a pas pu être téléchargé.";
                }
            } else {
                echo "Erreur : Le fichier est trop volumineux. La taille maximale est 5 Mo.";
            }
        } else {
            echo "Erreur : Extension de fichier non autorisée.";
        }
    }
    echo "hello";

    // Maintenant, tu peux insérer les données dans la base de données si nécessaire
    // Exemple avec MySQLi (à adapter à ton propre système de base de données)
    // Assure-toi que ta base de données est prête à accepter ces informations
    
    $conn = new mysqli('localhost', 'root', '', 'pizzahouse');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO article (nom_art,prix_art,dsc_art,type_art,url_art) 
            VALUES ('$saladName', '$saladPrice', '$saladDescription', '$type_art','$newFileName')";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle salade ajoutée avec succès!";
    } else {
        echo "Erreur: " . $conn->error;
    }

    $conn->close();
    }
?>