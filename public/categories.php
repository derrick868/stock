<?php include "includes/header.php" ?>

<section id="course_home">
<div class="container">
   <div class="row">
    <div class="col-md-8" style="margin-left: 250px">

        <ol class="breadcrumb">
          <li><a href="dashboard.php">Home</a></li>       
          <li class="active">Categories</li>
        </ol>

    <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Category</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">


        <!-- Navigation -->
     

        <div id="page-wrapper "style="margin-left: 50px;" >

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <div class = "col-xs-4">

                        <?php

                        if(isset($_POST['submit'])){
                            $name=$_POST['name'];
                            if($name== "" || empty($name)){
                                echo "this field should not be empty";
                            }else{
                                 $query="INSERT INTO categories(name) ";
                                 $query.="VALUE('{$name}')";
                                 $insert_man=mysqli_query($connection,$query);
                                 if(!$insert_man){
                                    die("query failed".mysqli_error($connection));
                                 }

                            }
                           
                        }
                        ?>


                    <form action = "" method="post">
                        <div class = "form-group">
                            <label for="cat-title"> Add category</label>
                            <input type="text" class="form-control" name= "name">
                            </div>
                        <div class =" form-group">
                            <button class="btn btn-default button1" type="submit" name="submit"> <i class="glyphicon glyphicon-plus-sign"></i> Add</button>
                        </div>

                        </form>
                    
                    <?php

                    if(isset($_GET['edit'])){
                        $edit_man=$_GET['edit'];

                        include "includes/update_categories.php";

                    }

                    ?>
                    </div><!--add category form-->


                     <div class = "col-xs-8">

                        <table class="cart-table account-table table table-bordered">
                <thead style="background-color: burlywood;">
                    <tr>
                        <th>id</th>
                        <th>category name</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query="SELECT * FROM categories";
                    $select_man=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_man)){

                    ?>
                    <tr>
                        <td>
                            <?php echo $row['id'];?>
                        </td>
                        <td>
                            <?php echo $row['name'];?>
                        </td>
                      
                        <td>
                            <a href="categories.php?edit=<?php echo $row['id']?>"><i class="glyphicon glyphicon-edit"></i> Update</a>/ <a href="categories.php?delete=<?php echo $row['id']?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                        </td>
                        
                    </tr>
                <?php } ?>
                </tbody>
            </table>        

                    <?php

                    if(isset($_GET['delete'])){
                        $del=$_GET['delete'];


                        $query="DELETE FROM categories WHERE id =$del ";
                        $del_query=mysqli_query($connection,$query);
                        if(!$del_query){
                            die("query failed".mysqli_error($connection));
                        }
                        header("location:categories.php");
                    }
                    ?>
                    </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
</div>
</div>
</div>
</div>
</div>
    <!-- /row -->
  </div>
</section>


<?php include "includes/footer.php"?>













</body>
 
</html>
