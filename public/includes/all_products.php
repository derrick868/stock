<table class="table table-bordered table-hover table-responsive">
				<thead style="background-color: burlywood;">
					<tr>
						
						<th>Image</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Manufacturer</th>
						<th>Description</th>
						<th>Stock</th>
						<th>Store</th>
						<th>B.Price</th>
						<th>S.Price</th>
						<th>size</th>
						<th>Unit</th>
						
						<th>To expire</th>
						<th>Date</th>
						<th>Expiry date</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
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

						$total_cost=$remaining_stock * $cost;
						$total_price=$remaining_stock * $price;
						if($total_cost){
							$query9="UPDATE products set total_cost = '{$total_cost}' WHERE status = 'expired' ";
						$up_total=mysqli_query($connection,$query9);
						if(!$up_total){
							die('failed'.mysqli_error($connection));
						}	
						}else{
							die(mysqli_error($connection));
						}
						if($total_price){
							$query9="UPDATE products set total_price = '{$total_price}' WHERE status = 'expired' ";
						$up_total=mysqli_query($connection,$query9);
						if(!$up_total){
							die('failed'.mysqli_error($connection));
						}	
						}else{
							die(mysqli_error($connection));
						}

						


						$exp=strtotime($expiry_date);
						$td=strtotime($current_date);

					
					?>


<tr>
						

						<td><a href="single_product.php?p_id=<?php echo $product_id;?>">
							<img width='50'src='images/<?php echo $row['image']; ?>' alt = 'image'>
								</a>	
						</td>

						

						<td>
							 <?php

                    $query="SELECT * FROM categories WHERE id= $product_category_id";
                    $select_cat=mysqli_query($connection,$query);
                  
                   	$category=mysqli_fetch_array($select_cat);
                    		
                    ?>
                    <?php echo $category['name'];?>

                </td>

                <td>

                     <?php

                    $query="SELECT * FROM brands WHERE id= $brand_id";
                    $select_brand=mysqli_query($connection,$query);
                   if(!$select_brand){
                   	die("query failed".mysqli_error($connection));
                   }
                   	$brand=mysqli_fetch_array($select_brand);
                    		
                    ?>
                    <?php echo $brand['name'];?>

						</td>

						<td>
							<?php
							$query="SELECT * FROM manufacturers WHERE man_id =$manufacturer_id ";
							$select_man=mysqli_query($connection,$query);
							$man=mysqli_fetch_assoc($select_man);

							?>
							<?php echo $man['name'];?>			
						</td>
				
						<td>
							<?php echo $row['product_content'];?>			
						</td>
						<td>
							<?php echo $row['product_stock'];?>			
						</td>
						<td>
							<?php echo $row['remaining_stock'];?>
						</td>

						<td>
							KES:<?php echo $row['product_cost'];?>			
						</td>
						<td>
							KES:<?php echo $row['product_price'];?>			
						</td>
						<td>
							<?php echo $row['product_pack'];?>			
						</td>
						<td>
							<?php echo $row['units'];?>			
						</td>
					
						<td>
							<?php

							if($td>$exp){
							$diff=$td-$exp;
							$x=abs(floor($diff/(60 * 60 * 24)));
							$query5="UPDATE products set status = 'expired' where product_id = '{$product_id}' ";
							$up_ex=mysqli_query($connection,$query5);
							if(!$up_ex){
								die("fail".mysqli_error($connection));
							}
							echo "<label class='label label-danger'>expired:";
							echo ":days".$x;
						}else{
							$diff=$td-$exp;
							$x=abs(floor($diff/(60 * 60 * 24)));
							$query5="UPDATE products set status = 'not expired' where product_id = '{$product_id}' ";
							$up_ex=mysqli_query($connection,$query5);
							if(!$up_ex){
								die("fail".mysqli_error($connection));
							}
							echo "<label class='label label-success'>not expired:";
							echo ":days".$x;
						}
					
							 ?>					
						</td> 
						<td>
							<?php echo $row['purchase_date']?>			
							
						</td>
						<td>
							<?php echo $row['expiry_date'];?>
						</td>

						<td>
							<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Option <span class="caret"></span>
		</button>

		<ul class="dropdown-menu">
			<li><a href="sales.php?s_id=<?php echo $row['product_id'];?>"><i class="glyphicon glyphicon-plus"></i>Add Sales</a></li>
		<li><a href="products.php?source=edit_product&p_id=<?php echo $row['product_id'];?>"><i class="glyphicon glyphicon-edit"></i> Update</a></li>
		<li><a href="products.php?delete=<?php echo $row['product_id'];?>"><i class="glyphicon glyphicon-trash"></i>Delete</a></li>
		</ul>
		</div>
						</td>

						
					</tr>
				<?php } ?>
				</tbody>
				             <?php
if(isset($_GET['delete'])){
  $delete=$_GET['delete'];

  $query2="DELETE FROM products WHERE product_id = '{$delete}' ";
  $delete_query=mysqli_query($connection,$query2);
  if(!$delete_query){
    die("fail".mysqli_error($connection));
  }
  header("location:products.php");
}
?>

			</table>
