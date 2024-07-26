<?php

include 'components/connect.php';
 
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
   
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



<section id="cart" class="section-p1">
<h3 class="heading">shopping<span>Cart</span></h3>
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                </tr>
            </thead>
            <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="POST" class="box">
                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                        <tbody>
                            <tr>
                            
                                <td><a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>"> <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt=""></a></td>
                                <td><?= $fetch_cart['name']; ?></td>
                                <td>₹<?= $fetch_cart['price']; ?>/-</td>
                                <td><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                                <button type="submit" class="fas fa-edit" name="update_qty"></button></td>
                                <td>₹<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
                                <td><input type="submit" value="delete item" onclick="return confirm('are you sure delete this from cart?');" class="option-btn" name="delete"></td>
                            
                              </tr>

                        </tbody>
                    </form>
            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">your cart is empty...!</p>';
            }
            ?>
        </table>
    </section>
    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>

        <div id="subtotal" class="section-p1">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>₹<?= $grand_total; ?>/-</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>₹<?= $grand_total; ?>/-</strong></td>
                </tr>
            </table>
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
        </div>
    </section>




 









<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>