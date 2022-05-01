<?php

include_once 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = '<div class="d-flex align-items-center justify-content-center">
      <h4 class="text-primary p-3">please fill out all</h4>
   </div>';
   }else{
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = '<div class="d-flex align-items-center justify-content-center">
         <h4 class="text-primary p-3">A New Product added successfully</h4>
      </div>';
      }else{
         $message[] = '<div class="d-flex align-items-center justify-content-center">
         <h4 class="text-primary p-3">could not add the product</h4>
      </div>';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   $sql = mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
};

?>

      <?php include_once "./header.php";?>



<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

<div class="container col-xs-12 col-sm-6 col-md-8 mt-5">
<div class="d-flex align-items-center justify-content-center">
   <h3 class="text-primary p-3">Add a New Product Page</h3>
</div>

   <div class="modal-body">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="bg-secondary p-5">
      <div class="d-flex align-items-center justify-content-center">
         <h3 class="text-white">Add a New Product</h3>
      </div>
         <input type="text" placeholder="Enter Product Name" name="product_name"  class="form-control my-3">
         <input type="number" placeholder="Enter Product Price" name="product_price"  class="form-control my-3">
         <div class="form-group">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="form-control my-3">
         </div>
         <div class="">
            <input type="submit" class="btn btn-primary form-control" name="add_product" value="add product">
         </div>
      </form>

   </div>

   
</div>
   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="container  mt-4">
      <table class="table">
         <thead>
         <tr>
            <th scope="col" class="text-center">Product Image</th>
            <th scope="col" class="text-center">Product Name</th>
            <th scope="col" class="text-center">Product Price</th>
            <th scope="col" class="text-center">Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
            <tbody>
         <tr>
            <td class="align-middle text-center"><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td class="align-middle text-center"><?php echo $row['name']; ?></td>
            <td class="align-middle text-center">$<?php echo $row['price']; ?>/-</td>
            <td class="align-middle text-center">
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> Edit </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger"> <i class="fas fa-trash"></i> Delete </a>
            </td>
         </tr>
         </tbody>
      <?php } ?>
      </table>
   </div>


<?php include_once "./footer.php";?>