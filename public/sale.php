<?php require_once 'includes/header.php'; ?>


	<div class="col-md-12">
		<div class="row" style="padding: 10px">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Sales</li>
		</ol>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>Sales Report
			</div>
			<!-- /panel-heading -->
		
				<form class="form-horizontal" action="" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    
				  </div>
				  <div class="row col-md-8">
				  <div class="form-group">
				  	
				  	<label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-3">
				      <input type="date" class="form-control" id="startDate" name="start_date" placeholder="Start Date" />
				    </div>
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-3">
				      <input type="date" class="form-control" id="endDate" name="end_date" placeholder="End Date" />
				    </div>
				    
				    <div class="col-md-2">
				    	<button type="submit" class="btn btn-success" id="generateReportBtn" name="filter"> <i class="glyphicon glyphicon-ok-sign"></i> Filter</button>
				    </div>
				  </div>
				</div>
				  
				</form>

			</div>

			<table class="table table-bordered table-hover table-responsive">
				<thead style="background-color: burlywood;">
					<tr>
						<th>ID</th>
						<th>Image</th>
						
						<th>Quantity</th>
						<th>Size</th>
						<th>Unit</th>
						<th>B.Price</th>
						<th>S.Price</th>
						<th>Sold For</th>
						<th>Sales</th>
						<th>Sold date</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<?php
if(isset($_GET['id'])){
	$p_id=$_GET['id'];
}

	if(isset($_POST['filter'])){
	$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];

	$sql="SELECT * FROM sales WHERE date >= '$start_date' AND date <= '$end_date' AND product_id='$p_id' ORDER BY id Desc ";
	$generate_query=mysqli_query($connection,$sql);

					


					
					while($row=mysqli_fetch_assoc($generate_query)){
						$product_id=$row['product_id'];
						

					
					?>
					<tr>
						<td>
							<?php echo $row['product_id'];?>

						</td>
 				<?php

                    $query="SELECT * FROM products WHERE product_id= $product_id";
                    $select_product=mysqli_query($connection,$query);
                  
                   	$product=mysqli_fetch_array($select_product);
                   	$total_cost=$product['total_cost'];
                   	$pack=$product['pack'];
                    		
                    ?>

						<td>
							<img width='100' height='100' src='images/<?php echo $product['product_image']; ?>' alt = 'image'>
									
						</td>

						

						<td>
							
                   <a href="sale.php?id=<?php echo $product_id?>"> <?php echo $product['product_name'];?> </a>

                		</td>

              

						
						<td>
							<?php echo $row['quantity'];?>			
						</td>
						<td>
							<?php echo $product['pack'];?>			
						</td>
						<td>
							<?php echo $product['unit'];?>			
						</td>
							
						<td>
							KES:<?php echo $row['cost'];?>			
						</td>
						<td>
							KES:<?php echo $row['price'];?>			
						</td>
						<td>
							KES:<?php echo $row['selling_price'];?>			
						</td>
						<td>
							KES:<?php echo $row['total_sales'];?>
						</td>
						<td>
							<?php echo $row['date']?>			
							
						</td>
						

						<td>
							<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Option <span class="caret"></span>
		</button>

		<ul class="dropdown-menu">
		<li><a href="update_sales.php?p_id=<?php echo $row['product_id'];?>&s_id=<?php echo $row['id']?>"> <i class="glyphicon glyphicon-edit"></i> Update</a></li>
		<li><a href="total_sales.php?delete=<?php echo $row['id'];?>"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
		</ul>
		</div>
						</td>

						
					</tr>
					


				<?php }}	

				else{

					$query="SELECT * FROM sales WHERE product_id='$p_id' ORDER BY id Desc ";
					$select=mysqli_query($connection,$query);
					while($row=mysqli_fetch_assoc($select)){
						$product_id=$row['product_id'];

					
					?>
					<tr>
						<td>
							<?php echo $row['product_id'];?>

						</td>
 				<?php

                    $query="SELECT * FROM products WHERE product_id= $product_id";
                    $select_product=mysqli_query($connection,$query);
                  
                   	$product=mysqli_fetch_array($select_product);
                    		
                    ?>
						<td>
							<img width='100' height='100' src='images/<?php echo $product['image']; ?>' alt = 'image'>
									
						</td>

						

	
						<td>
							<?php echo $row['quantity'];?>			
						</td>

						<td>
							<?php echo $product['product_pack'];?>			
						</td>

						<td>
							<?php echo $product['units'];?>			
						</td>

						<td>
							KES:<?php echo $row['cost'];?>			
						</td>
						
						<td>
							KES:<?php echo $row['price'];?>			
						</td>
						<td>
							KES:<?php echo $row['selling_price'];?>
						</td>	
						<td>
							KES:<?php echo $row['total_sales'];?>
						</td>
						<td>
							<?php echo $row['date']?>			
							
						</td>
						

						<td>
							<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Option <span class="caret"></span>
		</button>

		<ul class="dropdown-menu">
		<li><a href="update_sales.php?p_id=<?php echo $row['product_id'];?>&s_id=<?php echo $row['id']?>"><i class="glyphicon glyphicon-edit"></i> Update</a></li>
		<li><a href="total_sales.php?delete=<?php echo $row['id'];?>"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
		</ul>
		</div>
						</td>

						
					</tr>
				<?php }} ?>
			
				

					</tr>
					

				</tbody>
			</table>	

<?php
if(isset($_GET['delete'])){
	$the_sales_id=$_GET['delete'];

$query="DELETE FROM sales WHERE id = $the_sales_id ";
$del=mysqli_query($connection,$query);
header("location:total_sales.php");
}
?>

				

					<?php
					if(isset($_GET['id'])){
						$p_id=$_GET['id'];
					}
					if(isset($_POST['filter'])){
					$start_date=$_POST['start_date'];
					$end_date=$_POST['end_date'];

					$query="SELECT SUM(total_sales) AS total_sales,SUM(expected_sales) AS expected_sales,SUM(quantity) AS quantity,cost AS cost FROM sales WHERE date >= '$start_date' AND date <= '$end_date' AND product_id = '$p_id' ";
					$sum=mysqli_query($connection,$query);
					while($row=mysqli_fetch_assoc($sum)){
						$quantity=$row['quantity'];
						$cost=$row['cost'];
						$expected_sales=$row['expected_sales'];
						$total_sales=$row['total_sales'];
						$total_purchase=$quantity * $cost;
						$profit=$total_sales - $total_purchase;

					}
				
					echo "<h4><b>Total purchasing cost : </b></h4>". "KES:". $total_purchase ."". "<br>";
					echo "<h4><b>Grand total sales : </b></h4>" ."KES:". $total_sales.""."<br>";
					echo "<h4><b>Your profit is : </b></h4>"."KES:".$profit;

				}else{

					$query="SELECT SUM(total_sales) AS total_sales,SUM(expected_sales) AS expected_sales,cost AS cost ,SUM(quantity) AS quantity FROM sales WHERE product_id = $p_id ";
					$sum=mysqli_query($connection,$query);
					while($row=mysqli_fetch_assoc($sum)){
						$quantity=$row['quantity'];
						$cost=$row['cost'];
						$expected_sales=$row['expected_sales'];
						$total_sales=$row['total_sales'];
						$total_purchase=$quantity * $cost;
						$profit=$total_sales - $total_purchase;
					}

					echo "<h4><b>Total purchasing cost : </b></h4>". "KES:".  $total_purchase ."". "<br>";
					echo "<h4><b>Grand total sales : </b></h4>" ."KES:". $total_sales.""."<br>";
					echo "<h4><b>Your profit is : </b></h4>"."KES:".$profit;


					}

					?>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
</div>
<!-- /row -->

<?php include "includes/footer.php"?>