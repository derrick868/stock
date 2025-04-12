<?php require_once 'includes/header.php';?>
<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
          <li><a href="dashboard.php">Home</a></li>       
          <li class="active">products</li>
        </ol>
<button class="btn btn-default"><a href="products.php?source=add_product"><i class="glyphicon glyphicon-plus-sign"></i>Add Product</a></button>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>All products</div>
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
                            case 'add_product':
                                include "includes/add_product.php";
                                break;
                            
                                case 'edit_product':
                                include "includes/edit_product.php";
                                    break;

                            default:
                                include "includes/all_products.php";
                                break;
                        }

                        ?>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->      
    </div> <!-- /col-md-12 -->
</div> 

<?php require_once 'includes/footer.php'?>