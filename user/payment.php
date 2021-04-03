<?php  
include('server.php');

$ID = $_GET['ID'];

$sql = "SELECT * FROM tbl_order WHERE id='$ID' ";
$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
$row_am = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html>
<head>
    <title>แจ้งชำระเงิน</title>
    <meta charset="UTF-8">
</head>
<body>
<?php include('header.php'); ?>
<div class="container">

<form class="imgForm" action="payment_db.php" method="post" enctype="multipart/form-data">
<div class="container" style="margin-left: 130px;">
<input type="hidden" name="id" value="<?php echo $row_am['id']; ?>" />
<table class="table table-bordered">
    <thead class="thead-dark ">
        <tr >    
            <th>ID</th>
            <th>__ที่อยู่__</th>
            <th>__________Products___________</th>
            <th>Amount_total</th>
            
        </tr>
    </thead>

        <tr>
            <td><?php echo $row_am['id']; ?></td>
            <td><?php echo $row_am['or_firstname']," ",$row_am['or_lastname'];?>
              <br><?php echo $row_am['or_tel']; ?><br><?php echo $row_am['or_address']; ?></td>
            <td ><?php echo $row_am['or_product']; ?></td>
            <td >฿<?php echo $row_am['or_total']; ?></td> 
        </tr>     
</table>
</div>
  <h6 class="text-center lead">ชำระผ่านธนาคาร</h6>
      <div class="form-group">
        <select name="pmode" class="form-control">
          <option value="" selected disabled>เลือกธนาคาร</option>
          <option value="ธนาคารไทยพานิชย์ 0115633738 (นายมดเขียว เรืองแสง)">ธนาคารไทยพานิชย์ 0115633738 (นายมดเขียว เรืองแสง)</option>
          <option value="ธนาคารกรุงไทย 0154785425 (นายมดเขียว เรืองแสง)">ธนาคารกรุงไทย 0154785425 (นายมดเขียว เรืองแสง)</option>
          <option value="ธนาคารกสิกรไทย 0321551421 (นายมดเขียว เรืองแสง)">ธนาคารกสิกรไทย 0321551421 (นายมดเขียว เรืองแสง)</option>
        </select> <br>
    <input type="file" name="p_img" id="p_img" class="form-control" /> <br> <br>
    <button type="submit" class="btn btn-success" > บันทึก </button>

</form>
</div>
</body>
</html>
