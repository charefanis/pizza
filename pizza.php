<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css?v=<?php echo time();?>">
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

  <h1 class="c-h1">Our Pizzas</h1>
  <section class="section-salad">
    <div class="div-salad">
        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=pizzahouse","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from article where type_art='Pizza'";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
           echo ' <div class="salad">
                <img class="d-item" src="'.$row["url_art"].'" alt="${product.name}">
                <button class="add-cart">Add to Cart</button>
                <div class="text">
                    <div class="price-name">
                        <b><p>'.$row['nom_art'].'</p></b>
                        <b><p>'.$row['prix_art'].'</p></b>
                    </div>
                    <b><p>'.$row['dsc_art'].'</p></b>
                </div>
            </div>';
        }
        
        ?>
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
    <script src="main.js?v=<?php echo time();?>"></script>
</body>

</html>