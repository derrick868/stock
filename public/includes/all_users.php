 <table id="zero_config" class="table table-striped table-bordered">
                                         <thead style="background-color: burlywood;">
                                            <tr>
                                                <th>Id</th>
                                                
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                               
                                               <th>Registered on </th>
                                                <th>options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                           
                                            	<?php
                                             

                        $query = "SELECT * FROM users" ;
                        $select_tenant = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($select_tenant)) {
                            $t_id = $row['id'];
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $mobile = $row['phone'];
                            
                            $date_admitted = $row['date'];
                         
                          $username= $row['username'];
                            $email = $row['email'];
                            $password = $row['password'];
                          
                          $status=$row['status'];   
           

                                            	?>

                                            	 <tr>
                                           

                                            <td><?php echo "$t_id"; ?></td>
                                         
                                            <td><?php echo "$firstname"; ?></td>
                                            <td><?php echo "$lastname"; ?></td>
                                              <td><?php echo "$username"; ?></td>
                                            <td><?php echo "$email"?></td>
                                            <td><?php echo "$mobile"; ?></td>
              
                                          <td><?php echo "$status"?></td>
                                            <td><?php echo "$date_admitted"; ?></td>
                                           
                                            <td>

                                                <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Option <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
            
        <li><a href="users.php?approve=<?php echo $t_id?>"><i class="glyphicon glyphicon-edit"></i> Approve</a></li>
         <li><a href="users.php?unapprove=<?php echo $t_id?>"><i class="glyphicon glyphicon-edit"></i>Unapprove</a></li>
        <li><a href="users.php?delete=<?php echo $t_id?>"><i class="glyphicon glyphicon-trash"></i>Delete</a></li>
        </ul>
        </div>
         
                        </td>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                       
                                    </table>


<?php

if(isset($_GET['approve'])){
    $approve=$_GET['approve'];

    $query="UPDATE users set status = 'approved' where id= $approve ";
    $up_u=mysqli_query($connection,$query);
    if(!$up_u){
        die("failed".mysqli_error($connection));
    }
    header("location:users.php");
} 
 ?>
<?php

if(isset($_GET['unapprove'])){
    $unapprove=$_GET['unapprove'];

    $query="UPDATE users set status = 'unapproved' where id= $unapprove ";
    $up_u=mysqli_query($connection,$query);
    if(!$up_u){
        die("failed".mysqli_error($connection));
    }
    header("location:users.php");
} 
 ?>

                                    <?php
if(isset($_GET['delete'])){
$delete=$_GET['delete'];

$query ="DELETE FROM users WHERE id = '{$delete}' ";
$del=mysqli_query($connection,$query);
if(!$del){
	die("fail".mysqli_error($connection));
}
header("location:users.php");
}


                                ?>