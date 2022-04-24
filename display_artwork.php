<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $art_name = $_POST['art_name'];
   $art_price = $_POST['art_price'];
   $art_image = $_POST['art_image'];
   $art_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE art_name = '$art_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Artwork already added to cart';
   }else{
      $insert_artwork = mysqli_query($conn, "INSERT INTO `cart`(art_name, art_price, art_image, quantity) VALUES('$art_name', '$art_price', '$art_image', '$art_quantity')");
      $message[] = 'Artwork added to cart succesfully';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ARTWORK DISPLAY</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Admin Dashboard/CSS/admin_artwork_style.css">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>


<div class="container">

<section class="products">

   <h1 class="heading">Latest World Artwork</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `view_art`");




      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="Admin Dashboard/Image/<?php echo $fetch_product['art_image']; ?>" height="200" alt="">
            <h3><?php echo $fetch_product['art_name']; ?></h3>
            <div class="price">BDT-<?php echo $fetch_product['art_price']; ?> TK/-</div>
            <input type="hidden" name="art_name" value="<?php echo $fetch_product['art_name']; ?>">
            <input type="hidden" name="art_price" value="<?php echo $fetch_product['art_price']; ?>">
            <input type="hidden" name="art_image" value="<?php echo $fetch_product['art_image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>


</body>
</html>