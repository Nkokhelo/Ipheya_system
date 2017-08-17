var manageitemTable;

$(document).ready(function() {
	// top nav bar
	$('#navitem').addClass('active');
	// manage item data table
	manageitemTable = $('#manageitemTable').DataTable({
		'ajax': 'php_action/fetchitem.php',
		'order': []
	});

	// add item modal btn clicked
	$("#additemModalBtn").unbind('click').bind('click', function() {
		// // item form reset
		$("#submititemForm")[0].reset();

		// remove text-error
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#item_img_name").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});

		// submit item form
		$("#submititemForm").unbind('submit').bind('submit', function() {

			// form validation
			var item_img_name = $("#item_img_name").val();
			var item_name = $("#item_name").val();
			var item_code = $("#item_code").val();
			var quantity = $("#quantity").val();
			var unit_price = $("#unit_price").val();
			var description = $("#description").val();			
			var status = $("#status").val();

			if(item_img_name == "") {
				$("#item_img_name").closest('.center-block').after('<p class="text-danger">item Image field is required</p>');
				$('#item_img_name').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#item_img_name").find('.text-danger').remove();
				// success out for form
				$("#item_img_name").closest('.form-group').addClass('has-success');
			}	// /else

			if(item_name == "") {
				$("#item_name").after('<p class="text-danger">Item Name field is required</p>');
				$('#item_name').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#item_name").find('.text-danger').remove();
				// success out for form
				$("#item_name").closest('.form-group').addClass('has-success');
			}	// /else

			if(item_code == "") {
				$("#item_code").after('<p class="text-danger">Item Code field is required</p>');
				$('#item_code').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#item_code").find('.text-danger').remove();
				// success out for form
				$("#item_code").closest('.form-group').addClass('has-success');
			}	// /else

			if(quantity == "") {
				$("#quantity").after('<p class="text-danger">Quantity field is required</p>');
				$('#quantity').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#quantity").find('.text-danger').remove();
				// success out for form
				$("#quantity").closest('.form-group').addClass('has-success');
			}	// /else

			if(unit_price == "") {
				$("#unit_price").after('<p class="text-danger">Unit Price field is required</p>');
				$('#unit_price').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#unit_price").find('.text-danger').remove();
				// success out for form
				$("#unit_price").closest('.form-group').addClass('has-success');
			}	// /else

			if(description == "") {
				$("#description").after('<p class="text-danger">description field is required</p>');
				$('#description').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#description").find('.text-danger').remove();
				// success out for form
				$("#description").closest('.form-group').addClass('has-success');
			}	// /else
			

			if(status == "") {
				$("#status").after('<p class="text-danger">Status field is required</p>');
				$('#status').closest('.form-group').addClass('has-error');
			}	else {
				// remove error text field
				$("#status").find('.text-danger').remove();
				// success out for form
				$("#status").closest('.form-group').addClass('has-success');
			}	// /else

			if(item_img_name && item_name && item_code && quantity && unit_price && description && status) {
				// submit loading button
				$("#createitemBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						if(response.success == true) {
							// submit loading button
							$("#createitemBtn").button('reset');

							$("#submititemForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

							// shows a successful message after operation
							$('#add-item-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							// remove the mesages
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          // reload the manage student table
							manageitemTable.ajax.reload(null, true);

							// remove text-error
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success

					} // /success function
				}); // /ajax function
			}	 // /if validation is ok

			return false;
		}); // /submit item form

	}); // /add item modal btn clicked


	// remove item

}); // document.ready fucntion

//Edit, update
function edititem(item_id = null) {

	if(item_id) {
		$("#item_id").remove();
		// remove text-error
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelecteditem.php',
			type: 'post',
			data: {item_id: item_id},
			dataType: 'json',
			success:function(response) {
			// alert(response.item_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');

				$("#getitem_img_name").attr('src', 'cart3/'+response.item_img_name);

				$("#edititem_img_name").fileinput({
				});

				// $("#edititem_img_name").fileinput({
		  //     overwriteInitial: true,
			 //    maxFileSize: 2500,
			 //    showClose: false,
			 //    showCaption: false,
			 //    browseLabel: '',
			 //    removeLabel: '',
			 //    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
			 //    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
			 //    removeTitle: 'Cancel or reset changes',
			 //    elErrorContainer: '#kv-avatar-errors-1',
			 //    msgErrorClass: 'alert alert-block alert-danger',
			 //    defaultPreviewContent: '<img src="stock/'+response.item_image+'" alt="Profile Image" style="width:100%;">',
			 //    layoutTemplates: {main2: '{preview} {remove} {browse}'},
		  // 		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
				// });

				// item id
				$(".edititemFooter").append('<input type="hidden" name="item_id" id="item_id" value="'+response.item_id+'" />');
				$(".edititemPhotoFooter").append('<input type="hidden" name="item_id" id="item_id" value="'+response.item_id+'" />');

				// item name
				$("#edititem_name").val(response.item_name);
				// item code
				$("#edititem_code").val(response.item_code);
				// quantity
				$("#editQuantity").val(response.quantity);
				// unit_price
				$("#editunit_price").val(response.unit_price);
			    // description
				$("#editdescription").val(response.description);						
				// status
				$("#editstatus").val(response.active);

				// update the item data function
				$("#edititemForm").unbind('submit').bind('submit', function() {

					// form validation
					var item_img_name = $("#edititem_img_name").val();
					var item_name = $("#edititem_name").val();
					var item_code = $("#edititem_code").val();
					var quantity = $("#editQuantity").val();
					var description = $("#editdescription").val();
					var unit_price = $("#editunit_price").val();					
					var status = $("#editstatus").val();


					if(item_name == "") {
						$("#edititem_name").after('<p class="text-danger">Item Name field is required</p>');
						$('#edititem_name').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edititem_name").find('.text-danger').remove();
						// success out for form
						$("#edititem_name").closest('.form-group').addClass('has-success');
					}	// /else

					if(item_code == "") {
						$("#edititem_code").after('<p class="text-danger">Item Code field is required</p>');
						$('#edititem_code').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edititem_code").find('.text-danger').remove();
						// success out for form
						$("#edititem_code").closest('.form-group').addClass('has-success');
					}	// /else

					if(quantity == "") {
						$("#editQuantity").after('<p class="text-danger">Quantity field is required</p>');
						$('#editQuantity').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editQuantity").find('.text-danger').remove();
						// success out for form
						$("#editQuantity").closest('.form-group').addClass('has-success');
					}	// /else

					if(description == "") {
						$("#editdescription").after('<p class="text-danger">Description field is required</p>');
						$('#editdescription').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editQuantity").find('.text-danger').remove();
						// success out for form
						$("#editQuantity").closest('.form-group').addClass('has-success');
					}	// /else

					if(unit_price == "") {
						$("#editunit_price").after('<p class="text-danger">Unit Price field is required</p>');
						$('#editunit_price').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editunit_price").find('.text-danger').remove();
						// success out for form
						$("#editunit_price").closest('.form-group').addClass('has-success');
					}	// /else					

					if(status == "") {
						$("#editstatus").after('<p class="text-danger">Status field is required</p>');
						$('#editstatus').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editstatus").find('.text-danger').remove();
						// success out for form
						$("#editstatus").closest('.form-group').addClass('has-success');
					}	// /else

					if(item_name && item_code && quantity && description && unit_price && status) {
						// submit loading button
						$("#edititemBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#edititemBtn").button('reset');

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

									// shows a successful message after operation
									$('#edit-item-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageitemTable.ajax.reload(null, true);

									// remove text-error
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success

							} // /success function
						}); // /ajax function
					}	 // /if validation is ok

					return false;
				}); // update the item data function

				// update the item image
				$("#updateitem_img_nameForm").unbind('submit').bind('submit', function() {
					// form validation
					var item_img_name = $("#edititem_img_name").val();

					if(item_img_name == "") {
						$("#edititem_img_name").closest('.center-block').after('<p class="text-danger">tem Image field is required</p>');
						$('#edititem_img_name').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edititem_img_name").find('.text-danger').remove();
						// success out for form
						$("#edititem_img_name").closest('.form-group').addClass('has-success');
					}	// /else

					if(item_img_name) {
						// submit loading button
						$("#edititem_img_nameBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {

								if(response.success == true) {
									// submit loading button
									$("#edititem_img_nameBtn").button('reset');

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

									// shows a successful message after operation
									$('#edit-itemPhoto-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageitemTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchitem_img_nameUrl.php?i='+item_id,
										type: 'post',
										success:function(response) {
										$("#getitem_img_name").attr('src', response);
										}
									});

									// remove text-error
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success

							} // /success function
						}); // /ajax function
					}	 // /if validation is ok

					return false;
				}); // /update the item image

			} // /success function
		}); // /ajax to fetch item image


	} else {
		alert('error please refresh the page');
	}
} // /edit item function

// remove item
function removeitem(item_id = null) {
	if(item_id) {
		// remove item button clicked
		$("#removeitemBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeitemBtn").button('loading');
			$.ajax({
				url: 'php_action/removeitem.php',
				type: 'post',
				data: {item_id: item_id},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeitemBtn").button('reset');
					if(response.success == true) {
						// remove item modal
						$("#removeitemModal").modal('hide');

						// update the item table
						manageitemTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeitemMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the item
			return false;
		}); // /remove item btn clicked
	} // /if item_id
} // /remove item function

function clearForm(oForm) {
	// var frm_elements = oForm.elements;
	// console.log(frm_elements);
	// 	for(i=0;i<frm_elements.length;i++) {
	// 		field_type = frm_elements[i].type.toLowerCase();
	// 		switch (field_type) {
	// 	    case "text":
	// 	    case "password":
	// 	    case "textarea":
	// 	    case "hidden":
	// 	    case "select-one":
	// 	      frm_elements[i].value = "";
	// 	      break;
	// 	    case "radio":
	// 	    case "checkbox":
	// 	      if (frm_elements[i].checked)
	// 	      {
	// 	          frm_elements[i].checked = false;
	// 	      }
	// 	      break;
	// 	    case "file":
	// 	    	if(frm_elements[i].options) {
	// 	    		frm_elements[i].options= false;
	// 	    	}
	// 	    default:
	// 	        break;
	//     } // /switch
	// 	} // for
}
