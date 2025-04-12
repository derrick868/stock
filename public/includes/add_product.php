<?php
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

	$exp=strtotime($expiry_date);
	$td=strtotime($purchase_date);

    $diff=$td-$exp;
    $x=abs(floor($diff/(60 * 60 * 24)));

$total_cost=$product_stock * $product_cost;
						$total_price=$product_stock * $product_price;




	$query="INSERT INTO products (image, product_category_id, manufacturer_id, brand_id, expiry_days, expiry_date, product_stock, remaining_stock, product_cost, product_price, product_pack, units, purchase_date,product_content,total_cost,total_price,status)";
	$query.="VALUES('{$image}','{$product_category_id}','{$manufacturer_id}','{$brand_id}','{$x}','{$expiry_date}','{$product_stock}','{$product_stock}','{$product_cost}','{$product_price}','{$product_pack}','{$units}','{$purchase_date}' ,'{$product_content}','{$total_cost}','{$total_price}','')";
	$insert=mysqli_query($connection,$query);
	if(!$insert){
		die("query failed".mysqli_error($connection));
	}else{

	echo "<p class='alert alert-success' style='margin-top:30px'>product successfully added<p>".""."<a href='products.php'>View all products</a>";
}

}





?>


<form class="form-horizontal " method="post"  enctype="multipart/form-data">
									
						
							<div class="clearfix space40"></div>
							<div class="clearfix space40"></div>

							<div class="row" style="margin-top: 10px;margin-left: 20px" >
									<div class="col-md-3">
										<label>product image</label>
										<input type="file" name="image"  class="form-control" >
								
									</div>
									<div class="col-md-3">
										<label>Category</label>
									
										<select name="product_category_id" class="form-control" >
											<option>~~select category~~</option>
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
									

										<select name="brand_id" class="form-control" >
											<option>~~select brand~~</option>
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
										<select name="manufacturer_id" class="form-control" >
											<option>~~select manufacturer~~</option>
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
										<input type="text" name="product_content"  class="form-control" >
								
									</div>
									<div class="col-md-3">
										<label>cost price</label>
										<input type="text" name="product_cost"  class="form-control" >
								
									</div>

									<div class="col-md-3">
										<label>selling Price</label>
										<input type="text" name="product_price"  class="form-control">
									
									</div>

									<div class="col-md-3">
										<label>Stock</label>
										<input type="text" name="product_stock" value="" class="form-control">
									
								</div>
							</div>
							
							<div class="row" style="margin-top: 10px">
								
									<div class="col-md-3">
										<label>Pack size</label>
										<input type="text" name="product_pack"  placeholder="e.g: 250,500" class="form-control" >
									
									</div>

									<div class="col-md-3">
										<label>Units</label>
										<input type="text" name="units"  placeholder="e.g: kg,g" class="form-control" >
									
									</div>

									<div class="col-md-3">
										<label>purchase date</label>
										<input type="date" name="purchase_date"  class="form-control" >
									</div>


									<div class="col-md-3">
										<label>expiry date</label>
										<input type="date" name="expiry_date"  class="form-control" >
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
									<button type="submit" class="button btn-default pull-right" name="submit">submit</button>
								</div>
							</div>
						</form>
