<?php include "includes/header.php" ?>

<section id="course_home">
<div class="container">
   <div class="row">
    <div class="col-md-8" style="margin-left: 250px">

        <ol class="breadcrumb">
          <li><a href="dashboard.php">Home</a></li>       
          <li class="active">Manufacturers</li>
        </ol>

    <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Brand</div>
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
                                 $query="INSERT INTO manufacturers(name) ";
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
                            <label for="cat-title"> Add Manufacturer</label>
                            <input type="text" class="form-control" name= "name">
                            </div>
                        <div class =" form-group">
                            <button class="btn btn-default button1" type="submit" name="submit"> <i class="glyphicon glyphicon-plus-sign"></i> Add</button>
                        </div>

                        </form>
                    
                    <?php

                    if(isset($_GET['edit'])){
                        $edit_man=$_GET['edit'];

                        include "includes/update_manufacturer.php";

                    }

                    ?>
                    </div><!--add category form-->


                     <div class = "col-xs-8">

                        <table class="cart-table account-table table table-bordered">
                <thead style="background-color: burlywood;">
                    <tr>
                        <th>id</th>
                        <th>Manufacturer name</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query="SELECT * FROM manufacturers";
                    $select_man=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_man)){

                    ?>
                    <tr>
                        <td>
                            <?php echo $row['man_id'];?>
                        </td>
                        <td>
                            <?php echo $row['name'];?>
                        </td>
                      
                        <td>
                            <a href="manufacturers.php?edit=<?php echo $row['man_id']?>"><i class="glyphicon glyphicon-edit"></i> Update</a>/ <a href="manufacturers.php?delete=<?php echo $row['man_id']?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                        </td>
                        
                    </tr>
                <?php } ?>
                </tbody>
            </table>        

                    <?php

                    if(isset($_GET['delete'])){
                        $del=$_GET['delete'];


                        $query="DELETE FROM manufacturers WHERE man_id =$del ";
                        $del_query=mysqli_query($connection,$query);
                        if(!$del_query){
                            die("query failed".mysqli_error($connection));
                        }
                        header("location:manufacturers.php");
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
