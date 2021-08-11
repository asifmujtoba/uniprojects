<?php

include 'header.php';

if(isset($_POST['save-task'])){
    $saveTask = $oms->save_task($_POST);
}

$viewImp = $oms->view_employee();

?>
<main class="content">
    <div class="container-fluid p-0">
    
        <?php
            if(isset($saveTask['su'])){
                echo $saveTask['su'];
            }
        ?>
      

            
            <!-- /.row -->
        <div class="row">
            <div class="col-12 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header ">
                        <div class="row justify-content-around">
                            <div class="col-6">
                                <h5 class="card-title mb-0">Add Task</h5>
                            </div>
                            <div class="col-6 text-end">
                                <span class=""><a href="task-list.php" class="btn btn-primary">View Task List</a></span>
                            </div>
                        </div>
                        
                        
                        </div>
                    <div class="card-body">
                        <form role="form" method="post">
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <select id="employee_id" name="employee_id" class="form-control">
                                    <option value="">--- Select Name ---</option>
                                    <?php
                                        if(isset($viewImp)){
                                            foreach($viewImp as $value) {
                                    ?>
                                    <option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?> </option>
                                    <?php } } ?>
                                </select>
                                <?php
                                    if(isset($saveTask['employee_id'])){
                                        echo $saveTask['employee_id'];
                                    }
                                ?>
                            </div>
                            <div class="form-group mb-3">
                                <label>Task Name</label>
                                <input id="task_name" type="text" name="task_name" class="form-control" value="">
                                <?php
                                    if(isset($saveTask['task_name'])){
                                        echo $saveTask['task_name'];
                                    }
                                ?>
                            </div>
                            <div class="form-group mb-3">
                                <label>Task Details</label>
                                <textarea id="task_details" name="task_details" class="form-control" rows="3"></textarea>
                            </div>
                            <div class=" form-group mb-3" >
                                <label>Start Date</label>
                                <input id="start_date" name="start_date" class="datetimepicker form-control flatpickr flatpicker-human flatpickr-input" placeholder="Select date.." tabindex="0" type="text" readonly="readonly">
   
                            </div>
                            
                            <div class=" form-group mb-3" >
                                <label>End Date</label>
                                <input id="end_date" name="end_date" class="datetimepicker form-control flatpickr flatpicker-human flatpickr-input" placeholder="Select date.." tabindex="0" type="text" readonly="readonly">
											
                            </div>
                            
                        
                        <!-- Button trigger modal -->
                            <div class=" form-group mb-3" >
                                <button type="button" onclick="validate()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saveModal">
                                Submit
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="saveModalLabel">Do you want to add the task?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Task Assigned To: <span id="assigned_to"> </strong></p>
                                    <p><strong>Task Name: <span id="t_name"> </strong></p>
                                    <p><strong>Task Details: <span id="details"> </strong></p>
                                    <p><strong>Start Date: <span id="s_date"> </strong></p>
                                    <p><strong>End Date: <span id="e_date"> </strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Don't</button>
                                    <input type="submit" name="save-task" class="btn btn-primary" value="Save">
                                </div>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
      
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script>
        function validate(){
            var options = document.getElementById('employee_id');
            var id = document.getElementById('employee_id').value;
            var name = "";
            options.forEach(element => {
                id == element.value ? name = element.innerHTML : "";
            });
            $task_name = document.getElementById('task_name');
            $task_details = document.getElementById('task_details');
            var start_date = document.getElementById("start_date").value;
            var end_date = document.getElementById("end_date").value;

            document.getElementById("t_name").innerHTML = $task_name.value;
            document.getElementById("details").innerHTML = $task_details.value;
            document.getElementById("s_date").innerHTML = start_date;
            document.getElementById("e_date").innerHTML = end_date;

            document.getElementById("assigned_to").innerHTML = name ;


        }
    </script>
    <?php
        include "footer.php";
    ?>