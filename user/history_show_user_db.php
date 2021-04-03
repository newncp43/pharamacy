<?php
include('server.php');
$user = $_SESSION['username'];
$query = "SELECT * FROM tbl_history  WHERE username = '$user' " or die("Error:" . mysqli_error());
$result = mysqli_query($conn, $query);
$row_am = mysqli_fetch_assoc($result);

?>

  <?php if (isset($row_am['id'])) {?>
    <table class="table table-bordered">
    <thead class="thead-dark ">
        <tr >    
            <th>ID</th>
            <th>__ที่อยู่__</th>
            <th>ธนาคาร</th>
            
            <th>__________Products___________</th>
            <th>Amount_total</th>
            <th >_____Status______</th>
            <th>___สถานะ___</th>
            
        </tr>
    </thead>
    <?php do { ?>

        <tr>
            <td><?php echo $row_am['id']; ?></td>
            <td><?php echo $row_am['or_firstname']," ",$row_am['or_lastname'];?>
              <br><?php echo $row_am['or_tel']; ?><br><?php echo $row_am['or_address']; ?></td>
            <td ><?php echo $row_am['or_bank']; ?></td>
            <td ><?php echo $row_am['or_product']; ?></td>
            <td >฿<?php echo $row_am['or_total']; ?></td>
            <td>  
            <?php if ($row_am['or_img']!='') {?>
                <font color='green'>ชำระเงินแล้ว</font><br>
              
            <?php } else { ?>
                <font color='red' >ยังไม่ชำระเงิน</font><br><br>
                <a href="payment.php?act=edit&ID=<?php echo $row_am['id']; ?>" class="btn btn-success" >ชำระเงิน</a><br><br>
                <a href="cancle_order.php?act=edit&ID=<?php echo $row_am['id']; ?>" class="btn btn-danger" >ยกเลิกคำสั่งซื้อ</a>
              <?php } ?>
            </td> 
               
            <td>
            
            <font color='green'>สำเร็จ</font><br>
        
            </td> 
        </tr>     

    <?php } while ($row_am = mysqli_fetch_assoc($result)); ?>

</table>
    
            <?php } else { ?>
                <br>
                <h4><center>ไม่พบประวัติการสั่งซื้อของคุณ</center></h4>
              
              <?php } ?>

