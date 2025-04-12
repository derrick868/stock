<?php include "includes/db.php"; 

ob_start();
session_start();

                        $sql="SELECT * FROM products  ";
                        $generate=mysqli_query($connection,$sql);

                        while($row=mysqli_fetch_assoc($generate)){
                        $current_date=date('y-m-d');
                        $product_id=$row['product_id'];
                        $product_image=$row['image'];
                        $product_category_id=$row['product_category_id'];
                        $manufacturer_id=$row['manufacturer_id'];
                        $brand_id=$row['brand_id'];
                        $expiry_days=$row['expiry_days'];
                        $expiry_date=$row['expiry_date'];
                        $stock=$row['product_stock'];
                        $remaining_stock=$row['remaining_stock'];
                        $cost=$row['product_cost'];
                        $price=$row['product_price'];

                    


                        $exp=strtotime($expiry_date);
                        $td=strtotime($current_date);


                        if($td>$exp){
                            $diff=$td-$exp;
                            $x=abs(floor($diff/(60 * 60 * 24)));
                            $query5="UPDATE products set status = 'expired' where product_id = '{$product_id}' ";
                            $up_ex=mysqli_query($connection,$query5);
                            if(!$up_ex){
                                die("fail".mysqli_error($connection));
                            }
                            
                        }else{
                            $diff=$td-$exp;
                            $x=abs(floor($diff/(60 * 60 * 24)));
                            $query5="UPDATE products set status = 'not expired' where product_id = '{$product_id}' ";
                            $up_ex=mysqli_query($connection,$query5);
                            if(!$up_ex){
                                die("fail".mysqli_error($connection));
                            }
                            
                        }
                    

}

                   
          
                 


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product expiry management system</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/global.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  
<body>


<section  style="padding-bottom: 60px;">
	<nav class="navbar navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php"><i class="fa fa-book"></i> PRODUCT</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="tag_m" href="dashboard.php">Home</a>
                    </li>
                     
                    <li>
                        <a class="tag_m" href="categories.php">Categories</a>
                    </li>
					
					<li>
                        <a class="tag_m" href="brands.php">Brands</a>
                    </li>
					
                    
					<li>
                        <a class="tag_m" href="manufacturers.php">Manufacturers</a>
                    </li>
					
					<li>
                        <a class="tag_m" href="products.php">Products</a>
                    </li>
					
					<li>
                        <a class="tag_m" href="total_sales.php">Sales</a>
                    </li>
					
					<li>
                        <a class="tag_m" href="report.php">Report</a>
                    </li>
	  <li>
                        <a class="tag_m" href="users.php">Users</a>
                    </li>
                               <li>
                        <a class="tag_m" href="logout.php">logout</a>
                    </li>

                        <li class="dropdown">
       <a href="#" id="notification" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
       <ul id="not1" class="dropdown-menu"></ul>

     </li>
				 
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</section>