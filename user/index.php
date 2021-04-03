<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pharmacy</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<?php include('header.php'); ?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/IMG_1185.JPG" alt="First slide">
    </div>
    <div class="carousel-item">
      <a href="img/pexels-photo-576831.webp"></a>
      <img class="d-block w-100" src="img/IMG_1176.JPG" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/IMG_1191.JPG" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
<div class="container">
  <div id="message"></div>
  <div class="row mt-2 pb-3">
    <?php
    include 'server.php';
    $stmt = $conn->prepare('SELECT * FROM tbl_product');
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) :

    ?>
      <div class="col-md-3">
        <br />
        <div class="card mb-4 shadow-sm ">
          <form action="" class="form-submit"></form>
          <img src="p_img/<?= $row['p_img'] ?>" class="card-img-top" height="250">
          <div class="card-body ">
            <p class="card-text"><?= $row['p_name'] ?></p>
            <h5 class="SpePrice">฿&nbsp;<?= number_format($row['p_price']) ?></h5>

            <form action="" class="form-submit">
              <div class="row p-1">

                <div class="d-flex justify-content-between align-items-center btnbuy">
                  <div class="btn-group">
                  </div>
                </div>

                <input type="hidden" class="pid" value="<?= $row['p_id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['p_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['p_price'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['p_img'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['p_code'] ?>">
                <button class="btn btn  addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;สั่งซื้อ</button>
                <a href="product_detail.php?id=<?php echo $row['p_id'] ?>" class="Pdetail">รายละเอียด</a>

              </div>

          </div>
        </div>
      </div>

    <?php endwhile; ?>
  </div>
</div>
<!-- Displaying Products End -->

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>



<script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
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