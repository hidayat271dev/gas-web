<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-dark font-weight-bold my-1 mr-5">User Action</h5>
					<!--end::Page Title-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Management</a>
						</li>
						<li class="breadcrumb-item">
							<a href="" class="text-muted">User</a>
						</li>
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Action</a>
						</li>
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<form method="post" action="<?php echo base_url('user/save/' . $data_user->uuid); ?>">
				<div class="card card-custom gutter-b">
					<div class="card-header">
						<div class="card-title">
							<h3 class="card-label">
								User Form
								<small>Information User</small>
							</h3>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Fullname <span class="text-danger">*</span></label>
							<input name="fullname" type="text" class="form-control" placeholder="" value="<?php echo $data_user->fullname ?>"/>
						</div>
						<div class="form-group">
							<label>Email <span class="text-danger">*</span></label>
							<input name="email" type="text" class="form-control" placeholder="" value="<?php echo $data_user->email ?>"/>
						</div>
						<div class="form-group">
							<label>Password <span class="text-danger">*</span></label>
							<input name="password" type="password" class="form-control" placeholder="" value="<?php echo $data_user->password ?>"/>
						</div>
						<div class="form-group">
							<label>Phone <span class="text-danger">*</span></label>
							<input name="phone" type="number" class="form-control" placeholder="" value="<?php echo $data_user->phone ?>"/>
						</div>
						<div class="form-group">
							<label>Account Status</label>
							<?php
							$active = ($data_user->account_status == 1) ? 'checked' : '';
							$notactive = ($data_user->account_status == 0) ? 'checked' : '';
							?>
							<div class="radio-inline">
								<label class="radio">
									<input type="radio" name="account_status" value="0" <?php echo $notactive ?>/>
									<span></span>
									Non Active
								</label>
								<label class="radio">
									<input type="radio" name="account_status" value="1" <?php echo $active ?>/>
									<span></span>
									Active
								</label>
							</div>
						</div>
						<div class="form-group">
							<label>User Access</label>
							<?php
							$publicuser = ($data_user->access == 1) ? 'checked' : '';
							$administrator = ($data_user->access == 0) ? 'checked' : '';
							?>
							<div class="radio-inline">
								<label class="radio">
									<input type="radio" name="access" value="0" <?php echo $administrator ?>/>
									<span></span>
									Administrator
								</label>
								<label class="radio">
									<input type="radio" name="access" value="1" <?php echo $publicuser ?>/>
									<span></span>
									Pubic User
								</label>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<a href="<?php echo base_url('user'); ?>" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
