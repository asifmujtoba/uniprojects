<?php
    include "header.php";
	$viewTask = $oms->view_task();
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>TaskBoard</strong></h1>

					<div class="row">
						<div class="col-12 col-lg-4">
							
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">New Task</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="layers"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
                                                    <?php
                                                        if(isset($pendingTask))
                                                        echo $pendingTask;
                                                    ?>
                                                </h1>
												
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Ongoing Tasks</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
                                                    <?php
                                                        if(isset($ongoingTask))
                                                        echo $ongoingTask;
                                                    ?>
                                                </h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">All Task</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="layers"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
                                                    <?php
                                                        if(isset($allTask))
                                                        echo $allTask;
                                                    ?>
                                                </h1>
											</div>
										</div>
						</div>
						<div class="col-12 col-lg-8  d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Latest Tasks</h5>
								</div>
								<div class="card-body">
										<table class="table table-hover my-0">
										<thead>
											<tr>
												<th>Title</th>
												<th class="d-none d-xl-table-cell">Start Date</th>
												<th class="d-none d-xl-table-cell">End Date</th>
												<th class="d-none d-md-table-cell">Assigned</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                                if($viewTask){
                                                    foreach ($viewTask as $viewValue) {
                                            ?>
											<tr>
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

					

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://my.uniprojects.team" target="_blank"><strong>UniProjects</strong></a> &copy 2021;
							</p>
						</div>
						<!-- <div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div> -->
					</div>
				</div>
			</footer>
		</div>
	</div>
<?php include "footer.php" ?>