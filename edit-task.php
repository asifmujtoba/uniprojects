<?php
include 'header.php';

$getID = $_GET['view-id'];

$viewTask = $oms->view_task_by_id($getID);

if(isset($_POST['edit-task'])){
    $editTask = $oms->edit_task($_POST);
}

$viewImp = $oms->view_employee();

?>
<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-12 col-lg-6 mx-auto">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Edit Task</h5>
								</div>
								<div class="card-body">
                                <?php if(!empty($viewTask)){ ?>
                                    <form role="form" method="post">
                                        <div class="form-group mb-3">
                                            <input type="hidden" name="id" value="<?php echo $viewTask->id; ?>">
                                            <label>Name</label>
                                            <select name="employee_id" class="form-control">
                                                <option value="">--- Select Name ---</option>
                                                <?php
                                                    if(isset($viewImp)){
                                                        foreach($viewImp as $value) {
                                                ?>
                                                <option value="<?php echo $value['id']; ?>" <?php if($value['id'] == $viewTask->employee_id) echo 'selected'; ?>> <?php echo $value['name']; ?> </option>
                                                <?php } } ?>
                                            </select>
                                            <?php
                                                if(isset($editTask['employee_id'])){
                                                    echo $editTask['employee_id'];
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Task Name</label>
                                            <input type="text" name="task_name" class="form-control" value="<?php echo $viewTask->task_name; ?>">
                                            <?php
                                                if(isset($editTask['task_name'])){
                                                    echo $editTask['task_name'];
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Task Details</label>
                                            <textarea name="task_details" class="form-control" rows="3"><?php echo $viewTask->task_details; ?></textarea>
                                        </div>
                                        <label>Start Date</label>
                                        <div class=" form-group mb-3" >
                                             <input name="start_date" class="datetimepicker form-control flatpickr flatpicker-human flatpickr-input" placeholder="Select date.." tabindex="0" type="text" value="<?php echo $viewTask->start_date; ?>" readonly="readonly">
											 
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">End Date</label>
                                            <input name="end_date" class="datetimepicker form-control flatpickr flatpicker-human flatpickr-input" placeholder="Select date.." tabindex="0" type="text" value="<?php echo $viewTask->end_date; ?>" readonly="readonly">
											
                                        </div>
                                     
                                        <div class="form-group mb-3">
                                            <label>Completion</label>
                                            <input type="text" name="completion" class="form-control"  value="<?php echo $viewTask->completion; ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <?php $status = ['Not Started', 'Pending', 'In Progress', 'Completed'];?>
                                            <select name="status" class="form-control">
                                                <option value="">-- Select Status --</option>
                                                <?php foreach($status as $key => $value){?>
                                                <option value="<?= $key; ?>" <?php if($viewTask->status == $key) echo 'selected';?>><?= $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                                if(isset($editTask['status'])){
                                                    echo $editTask['status'];
                                                }
                                            ?>
                                        </div>
                                        <input type="submit" name="edit-task" class="btn btn-primary" value="Save">
                                        <?php
                                            }
                                            else{
                                                echo '<h2 class="text-danger text-center">No data found!</h2>';
                                            }
                                        ?>
                                    </form>
								</div>
							</div>
						</div>
					</div>


    
			</main>
    </div>
    <!-- /#wrapper -->
    <?php
        include "footer.php";
    ?>