<?php include "includes/header.php" ?>


 <div class="row" style="padding: 10px" >
                    <div class="container">
                        <div class="row" style="margin-top: 20px">
                        <h1 class="page-header col-md-3">
                             Welcome

            <small style="color: green"><?php echo $_SESSION['username'] ;?></small>
                        </h1>

                        <div class="col-md-6">
        <div class="card" style=" width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;">
          <div class="cardHeader" style="background-color: #4CAF50;
    color: white;
    padding: 10px;
    font-size: 40px;">
            <h1><?php echo date('d'); ?></h1>
          </div>

          <div class="cardContainer" style=" padding: 10px;">
            <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
          </div>
        </div> 
        <br/>

         </div>
</div>
                    </div>



          <div class="row" style="margin-top: 30px;padding: 10px">        
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-check" style="font-size: 50px;padding:10px"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php

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

                    $query = "SELECT *FROM products ";
                    $select_all_posts = mysqli_query($connection,$query);
                    $post_count = mysqli_num_rows($select_all_posts);

                    echo "<div class='huge'>{$post_count}</div>";

                    ?>
                 
                        <div>Products</div>
                    </div>
                </div>
            </div>
            <a href="products.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success" >
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-usd" style="font-size: 50px;padding: 10px"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                    $query = "SELECT * FROM sales";
                    $select_all_comments = mysqli_query($connection,$query);
                    $comments_count = mysqli_num_rows($select_all_comments);
                         echo "<div class='huge'>{$comments_count}</div>";
                    



                    ?>
                  <div>Sales</div>
                    </div>
                </div>
            </div>
            <a href="total_sales.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                    $query="SELECT* FROM users";
                    $select_all_users = mysqli_query($connection,$query);
                    $users_count = mysqli_num_rows($select_all_users);
                    echo "<div class='huge'>{$users_count}</div>";

                    ?>
                    
                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="user.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-warning-sign" style="font-size: 50px;padding: 10px;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       <?php
                    $query="SELECT* FROM products WHERE status = 'expired' ";
                    $select_all_categories = mysqli_query($connection,$query);
                    $categories_count = mysqli_num_rows($select_all_categories);
                    echo "<div class='huge'>{$categories_count}</div>";

                    ?>
                         <div>Expired Batch</div>
                    </div>
                </div>
            </div>
            <a href="expired.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

</div> 


<?php include "includes/footer.php"?>


