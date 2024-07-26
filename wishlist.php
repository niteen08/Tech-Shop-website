<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

include 'components/wishlist_cart.php';

if(isset($_POST['delete'])){
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if(isset($_GET['delete_all'])){
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>wishlist</title>
   
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

<section id="wishlist" class="section-p1">
<h3 class="heading">Your <span>wishlist</span></h3>
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Cart</td>
                    <td>Remove</td>
                </tr>
            </thead>

   <?php
      $grand_total = 0;
      $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
      $select_wishlist->execute([$user_id]);
      if($select_wishlist->rowCount() > 0){
         while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
            $grand_total += $fetch_wishlist['price'];  
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
      <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">


      <tbody>
                  <tr>
                            
                                <td><a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>"> <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt=""></a></td>
                                <td><?= $fetch_wishlist['name']; ?></td>
                                <td>₹<?= $fetch_wishlist['price']; ?>/-</td>
                                <td><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"></td>
                                <td><input type="submit" value="add to cart" class="btn" name="add_to_cart"></td>
                                
                                 
                                <td><input type="submit" value="delete item" onclick="return confirm('are you sure delete this from cart?');" class="option-btn" name="delete"></td>
                            
                    </tr>

       </tbody>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">your wishlist is empty...!</p>';
   }
   ?>
    
</section>








 
<script src="js/script.js"></script>

</body>
</html>
 