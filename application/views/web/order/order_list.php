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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Order List</h5>
					<!--end::Page Title-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Management</a>
						</li>
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Order</a>
						</li>
						<li class="breadcrumb-item">
							<a href="" class="text-muted">List</a>
						</li>
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Actions-->
				<!--end::Actions-->
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">Order List
							<span class="text-muted pt-2 font-size-sm d-block">Info list about user order item</span>
						</h3>
					</div>
					<div class="card-toolbar">

					</div>
				</div>
				<div class="card-body">
					<!--begin: Search Form-->
					<!--begin::Search Form-->
					<div class="mb-7">
						<div class="row align-items-center">
							<div class="col-lg-9 col-xl-8">
								<div class="row align-items-center">
									<div class="col-md-8 my-2 my-md-0">
										<div class="input-icon">
											<input type="text" class="form-control" placeholder="Search..."
												   id="kt_datatable_search_query"/>
											<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
										</div>
									</div>
									<div class="col-md-4 my-2 my-md-0">
										<div class="d-flex align-items-center">
											<label class="mr-3 mb-0 d-none d-md-block">Type:</label>
											<select class="form-control" id="kt_datatable_search_type">
												<option value="0">Pending</option>
												<option value="1">Approve</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
								<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
							</div>
						</div>
					</div>
					<!--end::Search Form-->
					<!--end: Search Form-->
					<!--begin: Datatable-->
					<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
					<!--end: Datatable-->
				</div>
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
