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
    <link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time(); ?>">
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
    <style>
        body {
            display: grid !important;
            grid-template-columns: 300px 1fr !important;
            grid-template-rows: auto 1fr auto !important;
            grid-template-areas:
                "navbar navbar"
                "sidebar main"
                "footer footer" !important;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        nav {
            grid-area: navbar !important;
        }

        aside {
            grid-area: sidebar !important;
        }

        footer {
            grid-area: footer !important;
        }

        aside button {
            background: none;
            border: none;
            font-weight: 600;
            color: white;
            margin: 10px 0;
        }

        .btns-container {
            width: 100%;
            height: 500px;
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }

        .logout-btn form {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .div-container{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
    </style>
    </style>
</head>

<body>
    <?php
    include_once("nav.php");
    ?>

    <aside style="background-color: rgb(32, 30, 30);">
        <div class="div-container">
            <div class="btns-container">
                <button onclick="toggleIframe1()">Dashboard</button>
                <button onclick="toggleIframe2()">Add product</button>
                <button onclick="toggleIframe3()">Manage Menu</button>
                <button onclick="toggleIframe4()">Orders</button>
                <button onclick="toggleIframe5()">Customers</button>
            </div>
            <div class="logout-btn">
                <form action="logout.php">
                    <button style="color:red;">Logout</button>
                </form>
            </div>
        </div>
    </aside>
    <main>
        <iframe id="iframe1" src="dashboard_overview.php" style="width: 100%; height:100%; display:none;"></iframe>
        <iframe id="iframe2" src="add_product.php" style="width: 100%; height:100%; display:none;"></iframe>
        <iframe id="iframe3" src="manage_product.php" style="width: 100%; height:100%; display:none;"></iframe>
        <iframe id="iframe4" src="orders.php" style="width: 100%; height:100%; display:none;"></iframe>
        <iframe id="iframe5" src="manage_customers.php" style="width: 100%; height:100%; display:none;"></iframe>
    </main>

    <?php
    include_once("footer2.php");
    ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 500
        });
    </script>
    <script>
        let iframe1 = document.getElementById('iframe1');
        let iframe2 = document.getElementById('iframe2');
        let iframe3 = document.getElementById('iframe3');
        let iframe4 = document.getElementById('iframe4');
        let iframe5 = document.getElementById('iframe5');

        function toggleIframe1() {
            iframe1.style.display = "flex";
            iframe2.style.display = "none";
            iframe3.style.display = "none";
            iframe4.style.display = "none";
            iframe5.style.display = "none";
        }
        function toggleIframe2() {
            iframe1.style.display = "none";
            iframe2.style.display = "flex";
            iframe3.style.display = "none";
            iframe4.style.display = "none";
            iframe5.style.display = "none";
        }
        function toggleIframe3() {
            iframe1.style.display = "none";
            iframe2.style.display = "none";
            iframe3.style.display = "flex";
            iframe4.style.display = "none";
            iframe5.style.display = "none";
        }
        function toggleIframe4() {
            iframe1.style.display = "none";
            iframe2.style.display = "none";
            iframe3.style.display = "none";
            iframe4.style.display = "flex";
            iframe5.style.display = "none";
        }
        function toggleIframe5() {
            iframe1.style.display = "none";
            iframe2.style.display = "none";
            iframe3.style.display = "none";
            iframe4.style.display = "none";
            iframe5.style.display = "flex";
        }
    </script>
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>

</html>
<?php
// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $type_art = $_POST['type_art'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productDescription = $_POST['product_description'];

    // Traitement de l'image uploadée
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $file = $_FILES['product_image'];

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
                $newFileName = uniqid('product_', true) . '.' . $fileExt;
                $uploadDirectory = 'assets/img/' . $type_art; // Dossier de destination
                $newFileName = $uploadDirectory . $newFileName;
                // Déplace le fichier vers le dossier 'uploads'
                if (move_uploaded_file($fileTmpName, $newFileName)) {
                    echo "Fichier téléchargé avec succès";
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
            VALUES ('$productName', '$productPrice', '$productDescription', '$type_art','$newFileName')";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>