<?php include 'includes/header.php'; ?>

<body>
	<?php include 'includes/topbar.php'; ?>
	<?php include 'includes/sidebar.php'; ?>
	<div class="main-container">

		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="pd-ltr-20">
				<!-- <div class="card-box pd-20 height-100-p mb-30">
					<div class="row align-items-center">
						<div class="col-md-4">
							<img src="vendors/images/banner-img.png" alt="" />
						</div>
						<div class="col-md-8">
							<h2 class="font-20 weight-500 mb-10 text-capitalize">
								Welcome back
								<div class="weight-600 font-30 text-blue"><?php // echo $_SESSION['username'] 
																			?></div>
							</h2>
                            <p class="font-16 max-width-600">
                            Welcome to the Medical Record Inventory System. This system is designed to efficiently manage medical records, ensuring accuracy, accessibility, and security. With our system, you can:
                        </p>
                   
                        <p class="font-16 max-width-600">
                            Our system helps healthcare facilities improve patient care, optimize inventory management, and maintain regulatory compliance.
                        </p>
						</div>
					</div>
				</div> -->
				<div class="row pb-10">
					<div class="col-xl-3 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data"><?php
															$TeacherClass = new TeacherClass($conn);
															$totalTeacher  = $TeacherClass->countTeacher(); ?>
									<a href="teacher.php">
										<div class="weight-700 font-24 text-dark"><?php echo $totalTeacher  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										Employees
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy dw dw-user"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data"><?php
															$StudentClass = new StudentClass($conn);
															$totalStudents  = $StudentClass->countStudents(); ?>
									<a href="student.php">
										<div class="weight-700 font-24 text-dark"><?php echo $totalStudents  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										Students
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy dw dw-user"></i>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col-xl-3 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<?php
									$EquipmentClass = new EquipmentClass($conn);
									$totalEquipment = $EquipmentClass->getTotalEquipment(); ?>
									<a href="equipments.php">
										<div class="weight-700 font-24 text-dark"><?php echo $totalEquipment  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										Equipments
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<span class="icon-copy fi-tablet-portrait"></span>
									</div>
								</div>
							</div>
						</div>
					</div>




					<div class="col-xl-3 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<?php
									$MedicineClass = new MedicineClass($conn);
									$totalQuantity = $MedicineClass->getTotalMedicineQuantity(); ?>
									<a href="medicines.php">
										<div class="weight-700 font-24 text-dark"><?php echo $totalQuantity  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										Medicines
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<span class="icon-copy ti-heart"></span>
									</div>
								</div>
							</div>
						</div>
					</div>




					<div class="col-xl-6 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data"><?php
															$expiredCount  = $MedicineClass->getExpiredMedicineCount(); ?>
									<a href="medicines.php">
										<div class="weight-700 font-24 text-dark"><?php echo $expiredCount  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										Medicines Expired
									</div>
								</div>
								<div class="widget-icon">

									<div class="icon" data-color="#ff5b5b">
										<i class="icon-copy fi-first-aid"></i>
									</div>
								</div>
							</div>
						</div>
					</div>




					<div class="col-xl-6 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data"><?php

															$isolationClass = new IsolationClass($conn);
															$totalEquipment = $isolationClass->countEquipmentIsolation(); ?>
									<a href="isolation_kit.php">
										<div class="weight-700 font-24 text-dark"><?php echo $totalEquipment  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										Isolation Kits
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy fi-shopping-bag"></i>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col-xl-6 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data"><?php

															$totalEquipment = $isolationClass->countExpiredEquipmentIsolation(); ?>
									<a href="isolation_kit.php">
										<div class="weight-700 font-24 text-dark"><?php echo $totalEquipment  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										Isolation Kits Expired
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<i class="icon-copy fi-first-aid"></i>
									</div>
								</div>
							</div>
						</div>
					</div>



					<div class="col-xl-6 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data"><?php

															$FirstAidKitClass = new FirstAidKitClass($conn);
															$EquipmentInFirstAidKit = $FirstAidKitClass->countEquipmentInFirstAidKit(); ?>
									<a href="first_aid_kit.php">
										<div class="weight-700 font-24 text-dark"><?php echo $EquipmentInFirstAidKit  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										First Aid Kits
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy fi-shopping-bag"></i>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col-xl-6 col-lg-5 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data"><?php

															$totalexpiredfirstaidkits = $FirstAidKitClass->countExpiredEquipmentInFirstAidKit(); ?>
									<a href="first_aid_kit.php">
										<div class="weight-700 font-24 text-dark"><?php echo $totalexpiredfirstaidkits  ?></div>
									</a>
									<div class="font-14 text-secondary weight-500">
										First Aid Kits Expired
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<i class="icon-copy fi-first-aid"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- js -->
		<?php include 'includes/footer.php'; ?>
</body>

</html>