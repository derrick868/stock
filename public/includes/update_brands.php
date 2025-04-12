<?php
if(isset($_GET['edit'])){
	$brand_id=$_GET['edit'];

	$query ="SELECT * FROM brands WHERE id = '{$brand_id}'";
                  	$select_cat =mysqli_query($connection,$query);
                  	while($row=mysqli_fetch_assoc($select_cat)){
                  		$brand_id =$row['id'];
                  		$brand_name =$row['name'];
                  	}
}

if(isset($_POST['edit'])){
	$brand_name=$_POST['name'];

	$query1="UPDATE brands SET name = '{$brand_name}' WHERE id = '{$brand_id}'";
	$update=mysqli_query($connection,$query1);
	if(!$update){
		die("fail".mysqli_error($connection));
	}
}

?>
                    <form action = "" method="post">
                        <div class = "form-group">
                            <label for="cat-title"> Update category</label>
                            <input type="text" class="form-control" value="<?php echo $brand_name ?>" name= "name">
                            </div>
                        <div class =" form-group">
                            <button class="btn btn-default button1" type="submit" name="edit"> <i class="glyphicon glyphicon-plus-sign"></i> Update</button>
                        </div>

                        </form>