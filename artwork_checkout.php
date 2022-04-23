<?php

@include 'config.php';
/**
|--------------------------------------------------------------------------
| Artwork Checkout
|--------------------------------------------------------------------------
|This is used for getting the values of name,email,address and other information of the customer
| in the checkout cart
|
*/

if(isset($_POST['order_btn'])){
	/**
	* @var string
	*/
   $name = $_POST['name'];
	/**
	* @var string
	*/
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $city = $_POST['city'];
   $area = $_POST['area'];
   $block = $_POST['block'];
   $road = $_POST['road'];
   $house = $_POST['house'];
   $flat = $_POST['flat'];
   $country = $_POST['country'];
   $password = $_POST['password'];
	/**
	* @var mysqli
	*/
	
	/**
|--------------------------------------------------------------------------
| Artwork Checkout
|--------------------------------------------------------------------------
|This is used for connecting cart from the database 
|It will fetch adding the string of product name with quantity

*/
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['art_name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['art_price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
	/**
	* @var mysqli
	*/
   $detail_query = mysqli_query($conn, "INSERT INTO `artwork_order`(name, number, email, payment_method, city, area, block, road, house, flat, country, password, total_artwork, total_price) VALUES('$name','$number','$email','$method','$city','$area','$block','$road','$house','$flat', '$country','$password', '$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : BDT: ".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$city.", ".$area.", ".$block.", ".$road.", ".$house.", ".$flat.", ".$country." - ".$password."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='products.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>













<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="Admin Dashboard/CSS/admin_artwork_style.css">

</head>
<body>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
			/**
			* @var Integer
			*/
            $total_price = number_format($fetch_cart['art_price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['art_name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on devlivery</option>
            </select>
         </div>
         <div class="inputBox">
            <span>City</span>
            <input type="text" placeholder="e.g. Dhaka" name="city" required>
         </div>
         <div class="inputBox">
            <span>Area</span>
            <input type="text" placeholder="Bashundhara" name="area" required>
         </div>
         <div class="inputBox">
            <span>Block</span>
            <input type="text" placeholder="e.g. Block No. B" name="block" required>
         </div>
         <div class="inputBox">
            <span>Road No.</span>
            <input type="text" placeholder="e.g. road no. 8" name="road" required>
         </div>
         <div class="inputBox">
            <span>House NO.</span>
            <input type="text" placeholder="e.g. House no. 18" name="house" required>
         </div>
         <div class="inputBox">
            <span>Flat No.</span>
            <input type="text" placeholder="e.g. floot no. C1" name="flat" required>
         </div>

         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. Bangladesh" name="country" required>
         </div>
         <div class="inputBox">
            <span>Password</span>
            <input type="text" placeholder="e.g. 123456" name="password" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>
 
</body>
</html>
