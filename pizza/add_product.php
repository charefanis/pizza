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
    <title>Document</title>
</head>

<body>
    <section class="mt-5">
        <h1 class="c-h1">Add product</h1>
        <div class="add-product-form-container">
            <form class="add-product-form" action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="menu" class="form-label">Choose a type</label>
                    <select class="form-select" id="menu" name="type_art" required>
                        <option value="Salade">Salad</option>
                        <option value="Burger">Burger</option>
                        <option value="Pizza">Pizza</option>
                        <option value="Drink">Drink</option>
                        <option value="Dessert">Dessert</option>
                        <option value="SeaFood">SeaFood</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product-name">Product Name</label>
                    <input type="text" class="form-control" name="product_name" id="product-name" required>
                </div>

                <div class="form-group">
                    <label for="product-price">Price ($)</label>
                    <input type="number" class="form-control" name="product_price" id="product-price" required>
                </div>

                <div class="form-group">
                    <label for="product-description">Description</label>
                    <textarea class="form-control" name="product_description" id="product-description"
                        required></textarea>
                </div>

                <div class="form-group">
                    <label for="product-image-file">Choose Image</label>
                    <input type="file" name="product_image" id="product-image-file" class="form-control" required>
                </div>

                <button type="submit" name="submit">Add Product</button>
            </form>

        </div>
    </section>

</body>

</html>