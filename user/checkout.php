
<?php

require 'server.php';

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(p_name, '(',qty,')') AS ItemQty, total_price FROM tbl_cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  $grand_total += $row['total_price'];
  $items[] = $row['ItemQty'];
}
$allItems = implode('<br />* ', $items);
   
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Checkout</title>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>


<body>
<?php    include ('header.php');
include('server.php');
     
    $user = $_SESSION['username'];
    $query = "SELECT * FROM tbl_user WHERE username ='$user' " or die("Error:" . mysqli_error());
    $result = mysqli_query($conn, $query);
    $row_am = mysqli_fetch_array($result);
    $roeconvers = implode($row_am);
?>

<div class="container">
<div class="row justify-content-center">
  <div class="col-lg-6 px-4 pb-4" id="order">
    <h4 class="text-center text-info p-2">Complete your order!</h4>
    <div class="jumbotron p-3 mb-2 text-center">
      <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
      <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
      <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
    </div>
    <form action="" method="post" id="placeOrder" enctype="multipart/form-data" class="form-horizontal">
      <input type="hidden" name="products" value="<?= $allItems; ?>">
      <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
      <input type="hidden" name="username" class="form-control" value="<?php echo $row_am['username']; ?>">
      <div class="form-group">
          <input type="text" name="firstname" class="form-control"value="<?php echo $row_am['firstname']; ?>">
      </div>
      <div class="form-group">
        <input type="last_name" name="lastname" class="form-control"value="<?php echo $row_am['lastname']; ?>">
      </div>
      <div class="form-group">
        <input type="tel" name="phone" class="form-control"value="<?php echo $row_am['tel']; ?>">
      </div>
      <div class="form-group">
          <input name="address" class="form-control" rows="3" cols="10"value="<?php echo $row_am['adress']; ?>">
      </div>
          
      <br>
      <div class="form-group">
        <input type="submit" name="submit" value="ยืนยันการสั่งซื้อ" class="btn btn-danger btn-block">
      </div>
    </form>
  </div>
</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>


<script type="text/javascript">
$(document).ready(function() {

// Sending Form data to the server
$("#placeOrder").submit(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'action.php',
    method: 'post',
    data: $('form').serialize() + "&action=order",
    success: function(response) {
      $("#order").html(response);
    }
  });
});

// Load total no.of items added in the cart and display in the navbar
load_cart_item_number();

function load_cart_item_number() {
  $.ajax({
    url: 'action.php',
    method: 'get',
    data: {
      cartItem: "cart_item"
    },
    success: function(response) {
      $("#cart-item").html(response);
    }
  });
}
});
</script>
</body>

</html>