<?php
if(isset($_GET['p_id'])){
	$the_product_id=$_GET['p_id'];
}
$sql="SELECT * FROM products where product_id = '{$the_product_id}' ";
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
						$units=$row['units'];
						$product_content=$row['product_content'];
						$product_pack=$row['product_pack'];
						$product_stock=$row['product_stock'];
						$purchase_date=$row['purchase_date'];
					}

if(isset($_POST['submit'])){
	$product_category_id=$_POST['product_category_id'];
	$brand_id=$_POST['brand_id'];
	$manufacturer_id=$_POST['manufacturer_id'];
	$product_cost=$_POST['product_cost'];
	$product_price=$_POST['product_price'];
	$product_stock=$_POST['product_stock'];
	$product_pack=$_POST['product_pack'];
	$product_content=$_POST['product_content'];
	$units=$_POST['units'];
	$expiry_date=$_POST['expiry_date'];
	
	$purchase_date=$_POST['purchase_date'];

 $image=$_FILES['image']['name'];
    $image_temp=$_FILES['image']['tmp_name'];
    

   move_uploaded_file($image_temp, "images/$image");

   if (empty($image)) {
    $query = "SELECT * FROM products WHERE product_id = $the_product_id";
    $select_image = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($select_image)){

        $image = $row['image'];
}
}
	$exp=strtotime($expiry_date);
	$td=strtotime($purchase_date);

    $diff=$td-$exp;
    $x=abs(floor($diff/(60 * 60 * 24)));

$total_cost=$product_stock * $product_cost;
						$total_price=$product_stock * $product_price;


$query="UPDATE products SET ";
	$query.="product_category_id = '{$product_category_id}', ";
	$query.="brand_id = '{$brand_id}', ";
	$query.="manufacturer_id = '{$manufacturer_id}', ";
	$query.="product_cost = '{$product_cost}', ";
	$query.="product_price = '{$product_price}', ";
	$query.="product_stock = '{$product_stock}', ";
	
	$query.="product_pack = '{$product_pack}', ";
	$query.="product_content = '{$product_content}', ";
	$query.="units = '{$units}', ";
	$query.="expiry_date = '{$expiry_date}', ";
	$query.="purchase_date = '{$purchase_date}', ";
	$query.="image= '{$image}' ";
	$query.="WHERE product_id = {$the_product_id} ";


	$update=mysqli_query($connection,$query);
	if($update){
		echo "<p class='alert alert-success' style='margin-top:30px'>Product successfully Updated<p>".""."<a href='products.php'>View all Products</a>";
	}


	

}





?>


<form class="form-horizontal " method="post"  enctype="multipart/form-data">
									
						
							<div class="clearfix space40"></div>
							<div class="clearfix space40"></div>

							<div class="row" style="margin-top: 10px;margin-left: 20px" >
									<div class="col-md-3">
										<label>product image</label>
										<input type="file" name="image" value="<?php echo $image?>" class="form-control" >
								
									</div>
									<div class="col-md-3">
										<label>Category</label>
									
					<select name="product_category_id" value="<?php echo $product_category_id ?>" class="form-control" >
											<option value="<?php echo $product_category_id?>">~~update category~~</option>
											<?php
											$query="SELECT * FROM categories ";
											$select_cat=mysqli_query($connection,$query);
											while($row=mysqli_fetch_assoc($select_cat)){
												$cat_id=$row['id'];
												$cat_name=$row['name'];

												echo "<option value='{$cat_id}'>{$cat_name}</option>";
											}


											?>

										</select>
									
								</div>

								<div class="col-md-3">
										<label>Brand</label>
									

										<select value="<?php echo $brand_id?>" name="brand_id" class="form-control" >
											<option value="<?php echo $brand_id ?>">~~update brand~~</option>
											<?php
											$query="SELECT * FROM brands ";
											$select_brand=mysqli_query($connection,$query);
											while($row=mysqli_fetch_assoc($select_brand)){
												$brand_id=$row['id'];
												$brand_name=$row['name'];

												echo "<option value='{$brand_id}'>{$brand_name}</option>";
											}


											?>

										</select>
									
								</div>

									<div class="col-md-3">
										<label>Manufacturer</label>
										<select value="<?php echo $manufacturer_id?>" name="manufacturer_id" class="form-control" >
											<option value="<?php echo $manufacturer_id?>">~~update manufacturer~~</option>
											<?php
											$query="SELECT * FROM manufacturers ";
											$select_man=mysqli_query($connection,$query);
											while($row=mysqli_fetch_assoc($select_man)){
												$man_id=$row['man_id'];
												$man_name=$row['name'];

												echo "<option value='{$man_id}'>{$man_name}</option>";
											}


											?>

										</select>
										
									
								</div>


							</div>

						
							
							<div class="row" style="margin-top: 10px;margin-left: 20px">
								<div class="col-md-3">
										<label>describe</label>
										<input type="text" name="product_content"  value="<?php echo $product_content?>"class="form-control" >
								
									</div>
									<div class="col-md-3">
										<label>cost price</label>
										<input type="text" value="<?php echo $cost?>" name="product_cost"  class="form-control" >
								
									</div>

									<div class="col-md-3">
										<label>selling Price</label>
										<input type="text" name="product_price" value="<?php echo $price?>" class="form-control">
									
									</div>

									<div class="col-md-3">
										<label>Stock</label>
										<input type="text" value="<?php echo $product_stock?>" name="product_stock" value="" class="form-control">
									
								</div>
							</div>
							
							<div class="row" style="margin-top: 10px">
								
									<div class="col-md-3">
										<label>Pack size</label>
										<input type="text" name="product_pack" value="<?php echo $product_pack?>" placeholder="e.g: 250,500" class="form-control" >
									
									</div>

									<div class="col-md-3">
										<label>Units</label>
										<input type="text" value="<?php echo $units?>" name="units"  placeholder="e.g: kg,g" class="form-control" >
									
									</div>

									<div class="col-md-3">
										<label>purchase date</label>
										<input type="date" name="purchase_date" value="<?php echo $purchase_date?>" class="form-control" >
									</div>


									<div class="col-md-3">
										<label>expiry date</label>
										<input type="date" value="<?php echo $expiry_date?>" name="expiry_date"  class="form-control" >
									</div>
																</div>

							

					



							
							<div class="clearfix space20"></div>
							
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-12">
									<!-- <span class="remember-box checkbox">
									<label for="rememberme">
									<input type="checkbox" id="rememberme" name="rememberme">Remember Me
									</label>
									</span> -->
								</div>
								<div class="col-md-6" style="padding: 10px">
									<button type="submit" class="button btn-default pull-right" name="submit">update</button>
								</div>
							</div>
						</form>
