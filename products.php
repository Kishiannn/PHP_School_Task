<?php 
        require 'conn.php';

        session_start();

        function getAllProducts(){
            $conn = connection();
            $sql = "SELECT products.ID AS id,
                            products.NAME AS name,
                            products.DESRIPTION AS description,
                            products.PRICE AS price,
                            sections.SECTION_ID AS section_id
                            FROM products
                            INNER JOIN sections
                            ON products.section_id = section_id
                            ORDER BY product.id DESC";

            if($result = $conn ->query($sql)){
                return $result;
            }else{
                die("Error retriving products: " .$conn -> error);
            }

        }

    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sections</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <?php include 'navbar.php'; ?>
    <main class="container">
        <div class="row mb-4">
            <div class="col"><h2 class="fw-light">Products</h2></div>
            <div class="col text-end">
                <a href="add-product.php" class="btn btn-success"><i class="fa-solid fa-plus-circle"></i>New Product</a>
            </div>
        </div>
        <table class="table table-hover align-middle border">
            <thead class="small table-success">
                <tr>
                <th>ID</th>
                <th style="width: 250px;">NAME</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>SECTION</th>
                <th style="width: 95px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $all_products = getAllProducts();
                while($product = $all_products -> fetch_assoc()){
                ?>
                <tr>
                    <td><?= $product['ID'] ?></td>
                    <td><?= $product['NAME'] ?></td>
                    <td><?= $product['DESCRIPTION'] ?></td>
                    <td>$<?= $product['PRICE'] ?></td>
                    <td><?= $product['SECTIONS'] ?></td>
                    <td>
                        <a href="edit-product.php?id=<?= $product['ID'] ?>" class="btn btn_outline-secondary btn-sm">
                            <i class="fas fa-pensil-alt"></i>
                        </a>
                        <a href="delete-product.php?id=<?= $product['ID'] ?>" class="btn btn_outline-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
