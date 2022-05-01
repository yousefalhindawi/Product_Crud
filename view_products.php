<?php
include_once 'config.php';

?>

<?php include_once "./header.php";?>

<?php

$select = mysqli_query($conn, "SELECT * FROM products");

?>


<div class="container mt-5">
   
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
        <div class="col">
        <div class="card">
        <img src="uploaded_img/<?php echo $row['image']; ?>" alt=""  class="card-img-top">
        <div class="card-body">
        <h5 class="card-title"><?php echo $row['name']; ?></h5>
        <p class="card-text">$<?php echo $row['price']; ?>/-</p>
        </div>
        </div>
        </div>
        
        <?php } ?>
    </div>
</div>

<?php include_once "./footer.php";?>