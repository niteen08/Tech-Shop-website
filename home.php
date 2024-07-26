<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/banner1.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>Our Latest Gaming Laptop</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/banner2.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>latest Gaming keyboard</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/banner3.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>latest CPU</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">shop by<span>category</span></h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=laptop" class="swiper-slide slide">
      <img src="images/laptop-icon.png" alt="">
      <h3>laptop</h3>
   </a>

   <a href="category.php?category=keyboard" class="swiper-slide slide">
      <img src="images/keyboard-icon.png" alt="">
      <h3>keyboard</h3>
   </a>

   <a href="category.php?category=processor" class="swiper-slide slide">
      <img src="images/processor-icon.png" alt="">
      <h3>processor</h3>
   </a>

   <a href="category.php?category=mouse" class="swiper-slide slide">
      <img src="images/mouse-icon.png" alt="">
      <h3>mouse</h3>
   </a>

   <a href="category.php?category=speaker" class="swiper-slide slide">
      <img src="images/speaker.png" alt="">
      <h3>speaker</h3>
   </a>

   <a href="category.php?category=pendrive" class="swiper-slide slide">
      <img src="images/pendrive.png" alt="">
      <h3>pendrive</h3>
   </a>

   <a href="category.php?category=cpu" class="swiper-slide slide">
      <img src="images/cpu-icon.png" alt="">
      <h3>CPU</h3>
   </a>

   <a href="category.php?category=monitor" class="swiper-slide slide">
      <img src="images/monitor-icon.png" alt="">
      <h3>monitor</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="products">

<h1 class="heading">latest <span>Product</span></h1>

<div class="box-container">

<?php
  $select_products = $conn->prepare("SELECT * FROM `products`"); 
  $select_products->execute();
  if($select_products->rowCount() > 0){
   while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
?>
<form action="" method="post" class="box">
   <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
   <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
   <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
   <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
   <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>"><img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt=""></a>
   <div class="name"><?= $fetch_product['name']; ?></div>
   <div class="flex">
      <div class="price"><span>₹</span><?= $fetch_product['price']; ?><span>/-</span></div>
      <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
   </div>
   <input type="submit" value="add to cart" class="btn" name="add_to_cart">
</form>
<?php
   }
}else{
   echo '<p class="empty">no products found!</p>';
}
?>

</div>

</section>








<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

</script>

</body>
</html>