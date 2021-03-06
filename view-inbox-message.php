
<?php

include 'header.php';

//Count Send Item  
$countSent = $oms->count_sent($id);

$viewId = $_GET['view-id'];
$viewInboxMessage = $oms->view_inbox_message_by_id($viewId);

?>
<main class="content">
        <div id="container-fluid p-0">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Message Inbox</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <a href="compose.php" class="btn btn-info">Compose</a>
                                    <a href="message.php" class="btn btn-primary" type="button">Inbox <span class="badge"><?php if(isset($countInbox)){ echo $countInbox; } ?></span></a>
                                    <a href="sent.php" class="btn btn-success" type="button">Sent <span class="badge"><?php if(isset($countSent)){ echo $countSent; } ?></span></a>
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        <?php
                                            if($viewInboxMessage){
                                                foreach ($viewInboxMessage as $value) {
                                        ?>
                                            <strong>From: <?php echo $value['name']; ?></strong> 
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <strong>Subject: </strong><em><?php echo $value['subject']; ?></em>
                                        </div>
                                        <!-- /.panel-body -->
                                        <div class="panel-footer">
                                            <p><?php echo $value['body']; ?></p>
                                            <p>Date: <?php echo $value['date_times']; ?></p>
                                            <p>Time: <?php echo $value['date_times']; ?></p>
                                        <?php
                                                }
                                            }
                                            else{
                                                echo "Data Not Found.";
                                            }
                                        ?>
                                        </div>
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row -->                
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <br/>
            <!-- /.row -->
           
        </div>
        <!-- /#page-wrapper -->
    </div>

    </div>
    <!-- /#wrapper -->
</main>
    <?php
        include "footer.php";
    ?>