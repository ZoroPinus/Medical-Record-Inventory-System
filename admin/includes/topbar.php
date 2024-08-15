<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Your Page Title</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	
	
</head>

<body>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon bi bi-list"></div>
			<h3 class="text-dark custom-font-size">Medical Record Inventory System</h3>
			<!-- <div class="header-search">sds
					<form>
						<div class="form-group mb-0">
							<i class="dw dw-search2 search-icon"></i>
							<input
								type="text"
								class="form-control search-input"
								placeholder="Search Here"
							/>
							<div class="dropdown">
								<a
									class="dropdown-toggle no-arrow"
									href="#"
									role="button"
									data-toggle="dropdown"
								>
									<i class="ion-arrow-down-c"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>From</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>Subject</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div> -->
		</div>
		<div class="header-right">

			<!-- <div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li>
										<a href="#">
											<img src="vendors/images/img.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo1.jpg" alt="" />
											<h3>Lea R. Frith</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo2.jpg" alt="" />
											<h3>Erik L. Richards</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo3.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo4.jpg" alt="" />
											<h3>Renee I. Hansen</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/img.jpg" alt="" />
											<h3>Vicki M. Coleman</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div> -->
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="model/uploads/<?php echo $_SESSION['profile_picture'] ?>" alt="" />

					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="#" id="editProfileBtn"><i class="dw dw-user1"></i> Profile</a>


						<a class="dropdown-item" href="includes/logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="" />
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2" />
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3" />
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="" />
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2" />
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3" />
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="" />
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5" />
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6" />
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">
						Reset Settings
					</button>
				</div>
			</div>
		</div>
	</div>

	<style>
		.profile-picture-container {
			display: flex;
			align-items: center;
		}

		.profile-picture-preview {
			width: 110px;
			height: 100px;
			border-radius: 50%;
			overflow: hidden;
			margin-right: 1rem;
		}

		@media (max-width: 1024px) {
			.header-left {
				width: 75%;
				/* Adjust the font size as needed */
			}

			.header-right {
				width: 25%;
				/* Adjust the font size as needed */
			}

			h3 {
				font-size: 1.25rem;
			}
		}

		.brand-logo {
			width: 280px;
			height: 120px;
			border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		}

		.brand-logo a {
			display: flex;
			align-items: center;
			/* Center vertically */
			justify-content: center;
			position: relative;
			height: 100%;
			font-size: 22px;
			color: #ffffff;
			letter-spacing: 0.050em;
			font-weight: 500;
			line-height: 45px;
			font-family: 'Inter', sans-serif;
			padding: 0px 20px 0px;
		}

		.brand-logo a img {
			max-width: 100px;
			display: block;
			height: 100px;
		}


		.profile-picture-preview img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
	</style>
	<!-- HTML -->
	<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header text-white">
					<h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editProfileForm" enctype="multipart/form-data">
						<div class="form-group">
							<label for="editFirstName">First Name</label>
							<input type="text" class="form-control" id="editFirstName" name="editFirstName" required>
						</div>
						<div class="form-group">
							<label for="editLastName">Last Name</label>
							<input type="text" class="form-control" id="editLastName" name="editLastName" required>
						</div>
						<div class="form-group">
							<label for="editEmail">Email</label>
							<input type="email" class="form-control" id="editEmail" name="editEmail" required>
						</div>
						<div class="form-group">
							<label for="editOldPassword">Old Password</label>
							<div class="input-group">
								<input type="password" class="form-control" id="editOldPassword" name="editOldPassword" required>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
										<i class="icon-copy ion-eye"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="editNewPassword">New Password</label>
							<div class="input-group">
								<input type="password" class="form-control" id="editNewPassword" name="editNewPassword" required>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
										<i class="icon-copy ion-eye"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="editProfilePicture">Profile Picture</label>
							<div class="profile-picture-container">
								<div class="profile-picture-preview">
									<img id="editProfilePicturePreview" src="../assets/img/avatars/2.png">
								</div>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="editProfilePicture" name="editProfilePicture" accept="image/*" required>
									<label class="custom-file-label" for="editProfilePicture">Choose file</label>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>

</html>


<script>
	const editProfilePicture = document.getElementById('editProfilePicture');
	const editProfilePicturePreview = document.getElementById('editProfilePicturePreview');

	editProfilePicture.addEventListener('change', function() {
		const file = this.files[0];
		if (file) {
			const reader = new FileReader();
			reader.onload = function() {
				editProfilePicturePreview.src = reader.result;
			}
			reader.readAsDataURL(file);
		} else {
			editProfilePicturePreview.src = '#';
		}
	});
</script>