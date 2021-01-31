"use strict";
// Class definition

var KTDatatableProductList = function () {
	// Private functions

	// basic demo
	var getData = function () {

		var datatable = $('#kt_datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: HOST_URL + 'api/v2/products',
						method: 'GET',
						map: function (raw) {
							var dataSet = raw;
							if (typeof raw.data !== 'undefined') {
								dataSet = raw.data;
							}
							return dataSet;
						},
					},
				},
				pageSize: 10,
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false,
				footer: false,
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},

			// columns definition
			columns: [{
				field: 'null',
				sortable: false,
				title: '#',
				width: 30,
				textAlign: 'center',
				template: function (row, data, index) {
					return data + 1;
				}
			}, {
				field: 'img_cover',
				title: 'Cover Image',
				template: function (data) {
					return 	'<div class="symbol symbol-40 symbol-sm flex-shrink-0">' +
								'<img class="" src="' +data.img_cover+ '" alt="photo">' +
							'</div>';
				},
			}, {
				field: 'name',
				title: 'Product Name',
			}, {
				field: 'qty',
				title: 'QTY',
			}, {
				field: 'sale_price',
				title: 'Sale Price',
			}, {
				field: 'short_desc',
				title: 'Desc',
			}, {
				field: 'uuid',
				title: 'Actions',
				sortable: false,
				width: 125,
				overflow: 'visible',
				autoHide: false,
				template: function (data) {
					return '\
							<a href="' + HOST_URL + 'product/action/' + data.uuid + '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
	                            <span class="svg-icon svg-icon-md">\
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
											<rect x="0" y="0" width="24" height="24"/>\
											<path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>\
										</g>\
									</svg>\
								</span>\
							</a>\
							<a href="' + HOST_URL + 'product/delete/' + data.uuid + '" class="btn btn-sm btn-clean btn-icon" title="Delete">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                        <rect x="0" y="0" width="24" height="24"/>\
	                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
	                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
	                                    </g>\
	                                </svg>\
	                            </span>\
							</a>\
						';
				},
			}],

		});

		$('#kt_datatable_search_status').on('change', function () {
			datatable.search($(this).val().toLowerCase(), 'status_product');
		});

		$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

		$('#kt_datatable_button_search').on('click', function () {
			datatable.reload();
		});
	};

	return {
		// public functions
		init: function () {
			getData();
		},
	};
}();

jQuery(document).ready(function () {
	KTDatatableProductList.init();
});
