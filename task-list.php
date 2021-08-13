<?php

include 'header.php';

if(isset($_POST['delete-task'])){
    $deleteTask = $oms->delete_task($_POST['taskid']);
}
$viewTask = $oms->view_task();

?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Task List</h1>
                    <?php
                        if(isset($deleteTask['su'])){
                            echo $deleteTask['su'];
                        }
                    ?>

					<div class="row">
						<div class="col-12">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0"></h5>
								</div>
                               
                                    
                                <table width="100%" class="table table-hover my-0" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Assigned</th>
                                        <th class="d-none d-xl-table-cell">Start Date</th>
                                        <th class="d-none d-xl-table-cell">End Date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($viewTask){
                                            foreach ($viewTask as $viewValue) {
                                    ?>
                                        <tr class="odd gradeX">
                                            
                                            <td><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['task_name']; ?></a></td>
                                            <td><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['name']; ?></a></td>
                                            <td class="d-none d-xl-table-cell"><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['start_date']; ?></a></td>
                                            <td class="d-none d-xl-table-cell"><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['end_date']; ?></a></td>
                                            <?php
                                                if($viewValue['status'] == 0){
                                            ?>
                                            <td><span class="badge bg-danger">Not Started</span></td>
                                            <?php
                                                }
                                                if($viewValue['status'] == 1){
                                            ?>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <?php
                                                }
                                                if($viewValue['status'] == 2){
                                            ?>
                                            <td><span class="badge bg-primary">In Progress</span></td>
                                            <?php
                                                }
                                                if($viewValue['status'] == 3){
                                            ?>
                                            <td><p class="badge bg-success">Completed</p></td>
                                            <?php
                                                }
                                            ?>
                                            <td><a href="edit-task.php?view-id=<?php echo $viewValue['id']; ?>" class="btn btn-success btn-xs">Edit</a></td>
                                            <td>
                                                <a onclick="validate(<?php echo $viewValue['id']?>  , '<?php echo $viewValue['task_name'] ;?>')" title="<?php echo $viewValue['task_name']; ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                Delete
                                            </a>
                                            </td>                                        
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <!-- Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="saveModalLabel">Do you want to delete the task?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Task id: <span id="t_id"> </strong></p>
                                                <p><strong>Task Name: <span id="t_name"> </strong></p>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Don't</button>
                                                    <input id="taskid" type="hidden" name="taskid" value="">
                                                    <input type="submit" name="delete-task" class="btn btn-danger" value="Delete">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
							</div>
						</div>
					</div>

				</div>
			</main>
    <!-- /#main -->
       
<script type="text/javascript">  
    function validate(id, task_name){
            console.log(id);
        document.getElementById("taskid").value = id;
        console.log(task_name);
        document.getElementById("t_id").innerHTML = id;
        document.getElementById("t_name").innerHTML = task_name;
    }

</script>
 
    
    <?php
        include "footer.php";
    ?>