<?php
if(isset($_GET['edit'])){
	$cat_id=$_GET['edit'];

	$query ="SELECT * FROM categories WHERE id = '{$cat_id}'";
                  	$select_cat =mysqli_query($connection,$query);
                  	while($row=mysqli_fetch_assoc($select_cat)){
                  		$cat_id =$row['id'];
                  		$cat_name =$row['name'];
                  	}
}

if(isset($_POST['edit'])){
	$cat_name=$_POST['name'];

	$query1="UPDATE categories SET name = '{$cat_name}' WHERE id = '{$cat_id}'";
	$update=mysqli_query($connection,$query1);
	if(!$update){
		die("fail".mysqli_error($connection));
	}
}

?>
                    <form action = "" method="post">
                        <div class = "form-group">
                            <label for="cat-title"> Update category</label>
                            <input type="text" class="form-control" value="<?php echo $cat_name ?>" name= "name">
                            </div>
                        <div class =" form-group">
                            <button class="btn btn-default button1" type="submit" name="edit"> <i class="glyphicon glyphicon-plus-sign"></i> Update</button>
                        </div>

                        </form>