<?php

include 'header.php';

$viewTask = $oms->view_my_task($id);

?>
<main class="content">
				<div class="container-fluid p-0">


					<div class="row">
						<div class="col-12 ">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">My Task</h5>
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
                                        <tr class="table-striped">
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
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
							</div>
						</div>
					</div>

				</div>
			</main>
        
    <!-- /#main -->
    <?php
        include "footer.php";
    ?>