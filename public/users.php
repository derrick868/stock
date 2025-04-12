<?php require_once 'includes/header.php';?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Users</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>All users</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				 <!-- /div-action -->				
				
					<?php

						if(isset($_GET['source'])){
							$source=$_GET['source'];
						}else{
							$source="";
						}

						switch ($source) {
							case 'add_user':
								include "includes/add_user.php";
								break;
							
								case 'edit_user':
								include "includes/edit_user.php";
									break;

							default:
								include "includes/all_users.php";
								break;
						}

						?>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> 

<?php require_once 'includes/footer.php'?>