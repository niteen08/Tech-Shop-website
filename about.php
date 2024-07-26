<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p> We are passionate about bringing you to the provide a best products at the best prices,Our mission is to make shopping easy and affordable for everyone,
Our goal is to provide you with a seamless shopping experience from start to finish,
We are committed to delivering exceptional customer service and quality products every time,</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>


<section class="review" id="review">

    <h1 class="heading">people's review</h1>

    <div class="box-container">

    <div class="box">
            <div class="info">
                <img src="images/tony.jpg" alt="">
                <div class="user">
                    <h3>Tony Stark</h3>
                    <span>   -Actor</span>
                    <div class="stars">
                          <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <p>these are best top processor,laptop i've ever had, best website for tech shopping, awsome customer support ,fast delivery thanks sunsetTech for making my shoping experience grateful</p>
        </div>

         <div class="box">
            <div class="info">
                <img src="images/rubby1.jpg" alt="">
                <div class="user">
                    <h3>mimi kaane</h3>
                    <span>- influencer</span>
                    <div class="stars">
                          <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <p>thanks sunsettech for providing such a great deal for buying laptop,awsome packing and 100% genuine product any mis-handling  and scratch</p>
        </div>

        <div class="box">
            <div class="info">
                <img src="images/pic-3.png" alt="">
                <div class="user">
                    <h3>john deo</h3>
                    <span>-web devloper</span>
                    <div class="stars">
                          <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <p>this website for online tech shopping is the best website in my whole life, provide a best  product and best service </p>
        </div>

        <div class="box">
            <div class="info">
                <img src="images/pic-2.png" alt="">
                <div class="user">
                    <h3>maria marry</h3>
                    <span>web designer</span>
                    <div class="stars">
                          <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <p>this website has got some huge list of best-selling and best rated product,all original and latest product ,its one of the best online store with great customer support </p>
        </div>

        <div class="box">
            <div class="info">
                <img src="images/pic-6.png" alt="">
                <div class="user">
                    <h3>jia  joy</h3>
                    <span> -user </span>
                    <div class="stars">
                          <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <p>i've order many product from this website ,its awsome original quality,no fraud and the delivery was also faster than estimated time 100% geninue company thanks sunsetTech </p>
        </div>

    </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>