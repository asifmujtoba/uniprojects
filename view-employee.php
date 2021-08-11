<?php

include 'header.php';

$viewImp = $oms->view_employee();

?>
<main class="content">
        <div id="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <?php
                        if(isset($saveImp['su'])){
                            echo $saveImp['su'];
                        }
                    ?>
                    <h1 class="card-title mb-0">View Employee</h1>
                </div>
                <!-- /.col-lg-12 -->
       
           
                        <!-- /.panel-heading -->
                        <div class="card-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                            		if($viewImp){
                            			foreach ($viewImp as $EmpValue) {
                            	?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $EmpValue['name']; ?></td>
                                        <td><?php echo $EmpValue['designation']; ?></td>
                                        <td><?php echo $EmpValue['address']; ?></td>
                                        <td><?php echo $EmpValue['email']; ?></td>
                                        <td><a href="edit-employee.php?edit_id=<?php echo $EmpValue['id']; ?>" class="btn btn-success btn-xs">Edit</a> <a href="edit-employee.php?delete_id=<?php echo $EmpValue['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
                                    </tr>
                                    <?php
                                    	}
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
        </div>
</main>
    <!-- /#wrapper -->
    <?php
        include "footer.php";
    ?>