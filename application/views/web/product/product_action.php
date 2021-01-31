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
					<h5 class="text-dark font-weight-bold my-1 mr-5">Product Action</h5>
					<!--end::Page Title-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Management</a>
						</li>
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Product</a>
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
			<form method="post" action="<?php echo base_url('product/save/' . $data_product->uuid); ?>" enctype="multipart/form-data">
				<div class="card card-custom gutter-b">
					<div class="card-header">
						<div class="card-title">
							<h3 class="card-label">
								Form Product
								<small>Information Product</small>
							</h3>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Product Name <span class="text-danger">*</span></label>
							<input name="name" type="text" class="form-control" placeholder="" value="<?php echo $data_product->name ?>"/>
							<input name="img_cover" type="hidden" class="form-control" placeholder="" value="<?php echo $data_product->img_cover ?>" id="img_cover"/>
						</div>
						<div class="form-group">
							<label>Cover Image <span class="text-danger">*</span></label>
							<div class="uppy" id="kt_uppy_5">
								<div class="uppy-wrapper"></div>
								<div class="uppy-list"></div>
								<div class="uppy-status"></div>
								<div class="uppy-informer uppy-informer-min"></div>
							</div>
							<span class="form-text text-muted">Max file size is 1MB and max number of files is 1.</span>
						</div>
						<div class="form-group">
							<label>Price <span class="text-danger">*</span></label>
							<input name="sale_price" type="text" class="form-control" placeholder="" value="<?php echo $data_product->sale_price ?>"/>
						</div>
						<div class="form-group">
							<label>Stock <span class="text-danger">*</span></label>
							<input name="qty" type="number" class="form-control" placeholder="" value="<?php echo $data_product->qty ?>"/>
						</div>
						<div class="form-group">
							<label>Status Product</label>
							<?php
								$active = ($data_product->status_product == 1) ? 'checked' : '';
								$notactive = ($data_product->status_product == 0) ? 'checked' : '';
							?>
							<div class="radio-inline">
								<label class="radio">
									<input type="radio" name="status_product" value="0" <?php echo $notactive ?>/>
									<span></span>
									Non Active
								</label>
								<label class="radio">
									<input type="radio" name="status_product" value="1" <?php echo $active ?>/>
									<span></span>
									Active
								</label>
							</div>
						</div>
						<div class="form-group">
							<label>Description <span class="text-danger">*</span></label>
							<textarea name="short_desc" class="form-control" id="exampleTextarea" rows="3"
									  placeholder=""><?php echo $data_product->short_desc ?></textarea>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<a href="<?php echo base_url('product'); ?>" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
