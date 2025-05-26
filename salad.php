<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
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

  <h1 class="c-h1">Our Salads</h1>
  <section class="section-salad">
    <div class="div-salad">
    </div>
  </section>

  <div class="add-salad-form-container">
    <form id="salad-form" class="add-salad-form">
      <div class="form-group">
        <label for="salad-name">Salad Name</label>
        <input type="text" id="salad-name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="salad-price">Price ($)</label>
        <input type="number" id="salad-price" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="salad-description">Description</label>
        <textarea id="salad-description" class="form-control" required></textarea>
      </div>

      <div class="form-group">
        <label>Image Upload</label>
        <div>
          <label><input type="radio" name="image-option" id="upload-image" value="upload" checked> Upload Image</label>
          <label><input type="radio" name="image-option" id="url-image" value="url"> Use Image URL</label>
        </div>
      </div>

      <div class="form-group" id="file-upload-group">
        <label for="salad-image-file">Choose Image</label>
        <input type="file" id="salad-image-file" class="form-control">
      </div>

      <div class="form-group" id="url-input-group" style="display:none;">
        <label for="salad-image-url">Image URL</label>
        <input type="url" id="salad-image-url" class="form-control">
      </div>

      <button type="submit">Add Salad</button>
    </form>

  </div>




















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
  <script src="main.js"></script>
</body>

</html>