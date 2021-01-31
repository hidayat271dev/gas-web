<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<div class="card card-custom">
				<div class="card-body p-0">
					<!--begin::Invoice-->
					<div class="row justify-content-center pt-8 px-8 pt-md-27 px-md-0">
						<div class="col-md-9">
							<!-- begin: Invoice header-->
							<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
								<h1 class="display-4 font-weight-boldest mb-10">INVOICE</h1>
								<div class="d-flex flex-column align-items-md-end px-0">
									<!--begin::Logo-->
									<a href="#" class="mb-5 max-w-200px">
										<img src="<?php echo base_url('assets/media/logos/lpgo.png'); ?>" width="200px">
									</a>
									<!--end::Logo-->
									<span class="d-flex flex-column align-items-md-end font-size-h5 font-weight-bold text-muted">
										<span>Jln Sarimanis VII</span>
										<span>Bandung 40151</span>
									</span>
								</div>
							</div>
							<div class="rounded-xl overflow-hidden w-100 max-h-md-250px mb-30">
								<img src="assets/media/bg/bg-invoice-5.jpg" class="w-100" alt="" />
							</div>
							<!--end: Invoice header-->
							<!--begin: Invoice body-->
							<div class="row border-bottom pb-10">
								<div class="col-md-9 py-md-10 pr-md-10">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">Description</th>
													<th class="pt-1 pb-9 text-right font-weight-bolder text-muted font-size-lg text-uppercase">Hours</th>
													<th class="pt-1 pb-9 text-right font-weight-bolder text-muted font-size-lg text-uppercase">Rate</th>
													<th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase">Amount</th>
												</tr>
											</thead>
											<tbody>
												<?php $total_order = 0; ?>
												<?php foreach ($data_order_detail as $id => $value): ?>
													<?php $sub_total = $value->price * $value->qty; ?>
													<?php $total_order += $sub_total; ?>
													<tr class="font-weight-bolder font-size-lg">
														<td class="border-top-0 pl-0 pt-7 d-flex align-items-center">
														<span class="navi-icon mr-2">
															<i class="fa fa-genderless text-danger font-size-h2"></i>
														</span><?php echo $value->name; ?></td>
														<td class="text-right pt-7"><?php echo $value->qty; ?></td>
														<td class="text-right pt-7">Rp. <?php echo $value->price; ?></td>
														<td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">Rp. <?php echo $sub_total; ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
									<div class="border-bottom w-100 mt-7 mb-13"></div>
									<div class="d-flex flex-column flex-md-row">
										<div class="d-flex flex-column mb-10 mb-md-0">
											<div class="font-weight-bold font-size-h6 mb-3">BANK TRANSFER</div>
											<div class="d-flex justify-content-between font-size-lg mb-3">
												<span class="font-weight-bold mr-15">Account Name:</span>
												<span class="text-right">Admin</span>
											</div>
											<div class="d-flex justify-content-between font-size-lg mb-3">
												<span class="font-weight-bold mr-15">Account Number:</span>
												<span class="text-right">1234567890934</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 border-left-md pl-md-10 py-md-10 text-right">
									<!--begin::Total Amount-->
									<div class="font-size-h4 font-weight-bolder text-muted mb-3">TOTAL AMOUNT</div>
									<div class="font-size-h1 font-weight-boldest">Rp. <?php echo $total_order; ?></div>
									<div class="text-muted font-weight-bold mb-16">Taxes included</div>
									<!--end::Total Amount-->
									<div class="border-bottom w-100 mb-16"></div>
									<!--begin::Invoice To-->
									<div class="text-dark-50 font-size-lg font-weight-bold mb-3">INVOICE TO.</div>
									<div class="font-size-lg font-weight-bold mb-10"><?php echo $data_order->fullname ?></div>
									<!--end::Invoice To-->
									<!--begin::Invoice No-->
									<div class="text-dark-50 font-size-lg font-weight-bold mb-3">INVOICE NO.</div>
									<div class="font-size-lg font-weight-bold mb-10"><?php echo $data_order->order_number ?></div>
									<!--end::Invoice No-->
									<!--begin::Invoice Date-->
									<div class="text-dark-50 font-size-lg font-weight-bold mb-3">DATE</div>
									<div class="font-size-lg font-weight-bold"><?php echo $data_order->created_at ?></div>
									<!--end::Invoice Date-->
								</div>
							</div>
							<!--end: Invoice body-->
						</div>
					</div>
					<!-- begin: Invoice action-->
					<div class="row justify-content-center py-8 px-8 py-md-28 px-md-0">
						<div class="col-md-9">
							<?php //var_dump($data_order); ?>
							<div class="d-flex font-size-sm flex-wrap">
								<button type="button" class="btn btn-primary font-weight-bolder py-4 mr-3 mr-sm-14 my-1" onclick="window.print();">Print Invoice</button>
								<a href="<?php echo base_url('order/confirm/' . $data_order->uuid); ?>" class="btn btn-dark font-weight-bolder py-4 mr-3 mr-sm-14 my-1">Confirm Order</a>
							</div>
						</div>
					</div>
					<!-- end: Invoice action-->
					<!--end::Invoice-->
				</div>
			</div>
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
