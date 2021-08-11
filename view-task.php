<?php

include 'header.php';

//Count Send Item  
$countSent = $oms->count_sent($id);

$getID = $_GET['view-id'];

$viewTask = $oms->view_task_by_id($getID);

?>
<main class="content">
        <div id="container-fluid p-0">
            <div class="row">
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-header mx-auto">
                            <h5 class="card-title mb-0">View Task</h5>
                            <a href="edit-task.php?view-id=<?php echo $getID; ?>" class="btn btn-success btn-xs">Edit</a>
                        </div>
                        <div class="card-body">
                        <?php if(!empty($viewTask)) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <p class="card-text"><strong>Assigned To: </strong> <?php echo $viewTask->name; ?></p> 
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <strong>Task Name: </strong><em><?php echo $viewTask->task_name; ?></em>
                                </div>
                                <!-- /.panel-body -->
                                <div class="panel-footer">
                                    <p><strong> Start Date:</strong> <?php echo $viewTask->start_date; ?></p>
                                    <p><strong> End Date:</strong> <?php echo $viewTask->end_date; ?></p>
                                    <?php
                                    $status = ['Not Started', 'Pending', 'In Progress', 'Completed'];
                                        foreach($status as $key => $value){
                                            if($viewTask->status == $key){
                                    ?>
                                        <p><strong> Status: </strong><em class="badge bg-primary"><?php echo $value; ?></em></p>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <p> <strong> Task Details: </strong><?php echo $viewTask->task_details; ?></p>
                                </div>
                            </div>
                            <a href="edit-task.php?view-id=<?php echo $getID; ?>" class="btn btn-success btn-xs">Edit</a>
                            <!-- /.panel -->
                            <?php
                                }
                                else{
                                    echo '<h2 class="text-danger text-center">No data found!</h2>';
                                }
                            ?>
                        </div>
                <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

</main>
    <!-- /.main -->
    <?php
        include "footer.php";
    ?>