<?php
@include 'config.php';

// Initialiser le message
$message = array();

// Fonction pour ajouter le produit à la liste dans first.php
function addProductToList($name, $price)
{
    // Chemin du fichier first.php
    $filename = 'first.php';

    // Contenu à ajouter
    $newProduct = '<li class="scrollbar-item"><span>' . $name . ' - $' . $price . '</span></li>';
    
    // Ajouter le nouveau produit à la fin du fichier
    file_put_contents($filename, $newProduct, FILE_APPEND);
}

if (isset($_POST['add_product'])) {
    // Récupérer les données du formulaire
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . $product_image;

    // Vérifier si tous les champs sont remplis
    if (empty($product_name) || empty($product_price) || empty($product_image)) {
        $message[] = 'Please fill out all fields';
    } else {
        // Insérer le nouveau produit dans la base de données
        $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
        $upload = mysqli_query($conn, $insert);
        if ($upload) {
            // Déplacer l'image téléchargée vers le dossier approprié
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'New product added successfully';
            
            // Ajouter le nouveau produit à la liste dans first.php
            addProductToList($product_name, $product_price);
        } else {
            $message[] = 'Could not add the product';
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:admin_page.php');
    exit; // Arrêter l'exécution du reste du code
}

// Sélectionner tous les produits de la base de données
$select = mysqli_query($conn, "SELECT * FROM products");
$products = [];
while ($row = mysqli_fetch_assoc($select)) {
    $products[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               
               <a href="first.php" class="btn" onclick="uploadProduct(<?php echo $row['id']; ?>)"> <i class="fas fa-upload"></i> Upload </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</body>
</html>
