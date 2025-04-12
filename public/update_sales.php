<?php require_once 'includes/header.php';?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Sales</li>
		</ol>

		<div class="panel panel-default col-md-8" style="margin-left: 200px">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Add Sales</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

			


<?php
if(isset($_GET['s_id'])){
	$the_sales_id=$_GET['s_id'];
}
$query="SELECT * FROM sales WHERE id= $the_sales_id ";
$select_sales=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_sales)){
	$sale_quantity=$row['quantity'];
	$sold_for=$row['selling_price'];
	$date=$row['date'];
}


if(isset($_GET['p_id'])){
	$the_product_id=$_GET['p_id'];
}

$query="SELECT * FROM products WHERE product_id = $the_product_id ";
$select_product=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_product)){
	
	
	$product_category_id=$row['product_category_id'];
	$product_brand=$row['brand_id'];
	$manufacturer_id=$row['manufacturer_id'];
	$product_image=$row['image'];
	$product_content=$row['product_content'];
	$product_stock=$row['product_stock'];
	$product_cost=$row['product_cost'];
	$product_price=$row['product_price'];
	$pack=$row['product_pack'];
	$unit=$row['units'];
	
	$expiry_date=$row['expiry_date'];
	$total_cost=$row['total_cost'];
	$total_price=$row['total_price'];
	$remaining_stock=$row['remaining_stock'];
	
}


if(isset($_POST['submit'])){

	
	
	$sales_date=$_POST['date'];


	$sale_quantity=$_POST['quantity'];

	
	$sold_for=$_POST['selling_price'];

	$total_sales_price=$sale_quantity * $sold_for;
	
	$expected_sales=$sale_quantity * $product_price;


	
	
	$sql="UPDATE products SET ";
	$sql.="remaining_stock = '{$remaining_stock}' ";
	$sql.="WHERE product_id = {$the_product_id} ";
	$update=mysqli_query($connection,$sql);


	$query="UPDATE sales SET ";
	$query.="quantity = '{$sale_quantity}', ";
	$query.="selling_price = '{$sold_for}', ";
	$query.="total_sales = '{$total_sales_price}',";
	$query.="expected_sales ='{$expected_sales}', ";
	$query.="date= '{$sales_date}' ";
	$query.="WHERE id = {$the_sales_id} ";


	$update=mysqli_query($connection,$query);
	if($update){
		echo "<p class='alert alert-success' style='margin-top:30px'>Sale successfully Updated<p>".""."<a href='total_sales.php'>View all Sales</a>";
	}
}







?>

<form class="form-horizontal " method="post"  enctype="multipart/form-data">
									
						
							<div class="clearfix space40"></div>
							<div class="clearfix space40"></div>

							<div class="row" style="margin-top: 10px;margin-left: 20px" >
								
									<div class="col-md-4">
										<label>Category</label>
										<?php
											$query="SELECT * FROM categories WHERE id= $product_category_id ";
											$select_cat=mysqli_query($connection,$query);
											while($row=mysqli_fetch_assoc($select_cat)){
												$cat_id=$row['id'];
												$cat_name=$row['name'];

											}


											?>
										<select name="category" class="form-control" disabled="true">
											<option value="<?php echo $product_category_id?>"><?php echo $cat_name?></option>
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

								<div class="col-md-4">
										<label>Brand</label>
										<?php
											$query="SELECT * FROM brands WHERE id = $product_brand ";
											$select_brand=mysqli_query($connection,$query);
											while($row=mysqli_fetch_assoc($select_brand)){
												$brand_id=$row['id'];
												$brand_name=$row['name'];

											}


											?>

										<select name="brand" class="form-control" disabled="true">
											<option value="<?php echo $product_brand?>"><?php echo $brand_name?></option>
											<?php
											$query="SELECT * FROM brands ";
											$select_brand=mysqli_query($connection,$query);
											while($row=mysqli_fetch_assoc($select_brand)){
												$brand_id=$row['brand_id'];
												$brand_name=$row['brand_name'];

												echo "<option value='{$brand_id}'>{$brand_name}</option>";
											}


											?>

										</select>
									
								</div>

									<div class="col-md-4">
										<label>Manufacturer</label>
											<?php
											$queryy="SELECT * FROM manufacturers WHERE man_id = $manufacturer_id ";
											$select_man=mysqli_query($connection,$queryy);
											while($row=mysqli_fetch_assoc($select_man)){
												$man_id=$row['man_id'];
												$man_name=$row['name'];

												
											}
											?>
										<select name="manufacturer" class="form-control" disabled="true">
											<option value="<?php echo $manufacturer_id?>"><?php echo $man_name?></option>
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
								
									<div class="col-md-4">
										<label>cost price</label>
										<input type="text" name="cost" value="<?php echo $product_cost?>" class="form-control" disabled="true">
								
									</div>

									<div class="col-md-4">
										<label>selling Price</label>
										<input type="text" name="price" value="<?php echo $product_price?>" class="form-control" disabled="true">
									
									</div>

									<div class="col-md-4">
										<label>Sold For</label>
										<input type="text" name="selling_price" value="<?php echo $sold_for ?>" class="form-control">
									
								</div>
							</div>
							
							<div class="row" style="margin-top: 10px">
								
									<div class="col-md-3">
										<label>Pack size</label>
										<input type="text" name="pack" value="<?php echo $pack;?>" placeholder="e.g: 250,500" class="form-control" required disabled="true">
									
									</div>

									<div class="col-md-3">
										<label>Units</label>
										<input type="text" name="unit" value="<?php echo $unit?>" placeholder="e.g: kg,g" class="form-control" disabled="true">
									
									</div>

									<div class="col-md-3">
										<label>Remaining stock</label>
										<input type="text" name="remaining_stock" value="<?php echo $remaining_stock;?>" class="form-control" disabled="true">
									</div>


									<div class="col-md-3">
										<label>Quantity</label>
										<input type="text" name="quantity" disabled="true" value="<?php echo $sale_quantity?>" class="form-control">
								
								</div>
							</div>

							

							<div class="row" style="margin-top: 10px;margin-left: 150px">
								
									<div class="col-md-4">
										<label>Sales date</label>
										<input type="date" name="date" value="<?php echo $date?>" class="form-control">
									
								</div>

								<div class="col-md-4">
										<label>Expiry</label>
										<input type="date" name="expiry" value="<?php echo $expiry_date?>" class="form-control" disabled="true">
									
								</div>
							</div>



							
							<div class="row" style="margin-top: 10px">
								<div class="col-md-12">
									<!-- <span class="remember-box checkbox">
									<label for="rememberme">
									<input type="checkbox" id="rememberme" name="rememberme">Remember Me
									</label>
									</span> -->
								</div>
								<div class="col-md-6">
									<button type="submit" class="button btn-success pull-right" name="submit">submit</button>
								</div>
							</div>
						</form>



				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> 

