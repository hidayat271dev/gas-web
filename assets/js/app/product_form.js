"use strict";

// Class definition
var KTUppy = function () {
	const Tus = Uppy.Tus;
	const StatusBar = Uppy.StatusBar;
	const FileInput = Uppy.FileInput;
	const XHRUpload = Uppy.XHRUpload;
	const Informer = Uppy.Informer;

	var initUppy5 = function(){
		console.log(XHRUpload);
		// Uppy variables
		// For more info refer: https://uppy.io/
		var elemId = 'kt_uppy_5';
		var id = '#' + elemId;
		var $statusBar = $(id + ' .uppy-status');
		var $uploadedList = $(id + ' .uppy-list');
		var timeout;

		var uppyMin = Uppy.Core({
			debug: true,
			autoProceed: true,
			showProgressDetails: true,
			restrictions: {
				maxFileSize: 1000000000000, // 1mb
				maxNumberOfFiles: 1,
				minNumberOfFiles: 1
			}
		});

		uppyMin.use(FileInput, { target: id + ' .uppy-wrapper', pretty: false });
		// uppyMin.use(FileInput, { target: id + ' .uppy-wrapper', pretty: false, fieldName: 'files' });
		uppyMin.use(Informer, { target: id + ' .uppy-informer'  });

		// demo file upload server
		uppyMin.use(XHRUpload, { endpoint: HOST_URL + 'api/v2/upload_cover', method:'post', fieldName: 'files' });
		uppyMin.use(StatusBar, {
			target: id + ' .uppy-status',
			hideUploadButton: true,
			hideAfterFinish: false
		});

		$(id + ' .uppy-FileInput-input').addClass('uppy-input-control').attr('id', elemId + '_input_control');
		$(id + ' .uppy-FileInput-container').append('<label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="' + (elemId + '_input_control') + '">Attach files</label>');

		var $fileLabel = $(id + ' .uppy-input-label');

		uppyMin.on('upload', function(data) {
			$fileLabel.text("Uploading...");
			$statusBar.addClass('uppy-status-ongoing');
			$statusBar.removeClass('uppy-status-hidden');
			clearTimeout( timeout );
		});

		uppyMin.on('upload-success', (file, response) => {
			var status = response.status; // HTTP status code
			var body = response.body;   // extracted response data

			// do something with file and response
			$('#img_cover').val(HOST_URL + 'assets/uploads/products/' + body.file_name);
		})

		uppyMin.on('complete', function(file) {
			console.log(file);
			$.each(file.successful, function(index, value){
				var sizeLabel = "bytes";
				var filesize = value.size;
				if (filesize > 1024){
					filesize = filesize / 1024;
					sizeLabel = "kb";

					if(filesize > 1024){
						filesize = filesize / 1024;
						sizeLabel = "MB";
					}
				}
				var uploadListHtml = '<div class="uppy-list-item" data-id="'+value.id+'"><div class="uppy-list-label">'+value.name+' ('+ Math.round(filesize, 2) +' '+sizeLabel+')</div><span class="uppy-list-remove" data-id="'+value.id+'"><i class="flaticon2-cancel-music"></i></span></div>';
				$uploadedList.append(uploadListHtml);
			});

			$fileLabel.text("Attach files");

			$statusBar.addClass('uppy-status-hidden');
			$statusBar.removeClass('uppy-status-ongoing');
		});

		$(document).on('click', id + ' .uppy-list .uppy-list-remove', function(){
			var itemId = $(this).attr('data-id');
			uppyMin.removeFile(itemId);
			$(id + ' .uppy-list-item[data-id="'+itemId+'"').remove();
		});
	}

	return {
		// public functions
		init: function() {
			initUppy5();

			// setTimeout(function() {
			// 	swal.fire({
			// 		"title": "Notice",
			// 		"html": "Uppy demos uses <b>https://master.tus.io/files/</b> URL for resumable upload examples and your uploaded files will be temporarely stored in <b>tus.io</b> servers.",
			// 		"type": "info",
			// 		"buttonsStyling": false,
			// 		"confirmButtonClass": "btn btn-primary",
			// 		"confirmButtonText": "Ok, I understand",
			// 		"onClose": function(e) {
			// 			console.log('on close event fired!');
			// 		}
			// 	});
			// }, 2000);
		}
	};
}();

KTUtil.ready(function() {
	KTUppy.init();
});
