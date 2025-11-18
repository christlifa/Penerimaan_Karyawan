/**
 * Javascript Form
 *
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 */

window.FORM = (function($) {
	return {
		// menampilkan notifikasi/alert dengan plugin sweetalert
		showNotification: function(message, status) {
			// menampilkan sweet alert
			swal({
				title: message,
				text: "",
				timer: 1000,
				type: status,
				showConfirmButton: false
			});
		},

		handleEditModal : function(elForm, elEdit, elModal, elModalContent, elBtnModalClose, elDatatable) {
			var parentThis = this;
			// edit data
			$(document).on('click', elEdit, function(e) {
				e.preventDefault();

				// show modal and request url (in href link edit)
				$(elModal).modal('show');
				$(elModalContent).load($(this).attr('href'), function() {
					parentThis.handleForm(elForm, elBtnModalClose, elDatatable);
					$('.select2').select2();
				});
			});
		},

		handleForm : function(elForm, elBtnModalClose, elDatatable) {
			var parentThis = this;

			$(elForm).validate({
				errorElement : 'div'
			});

			$(elForm).ajaxForm({
				dataType : 'json',
				beforeSend : function() {
					$(elForm).block({
						message: '<h4>Harap tunggu..</h4>'
		            });
				},
				success : function(response) {

					var elSelect2 = '.select2';
					var elReadOnly = '.readonly-edit';

					$(elForm).unblock();

					// jika response success
					if(response.status == 'success')
					{
						// reload datatable and notification
						elDatatable.ajax.reload();
						parentThis.showNotification(response.message, response.status);

						// jika id == new, reset form
						// id = close , close modal
						// id = save , edit data 
						if(response.id == 'new') {
							$(elForm).clearForm();
							$(elSelect2).val('').trigger('change');
							$(elForm).find('input[name=id]').val('new');
							$(elForm).find(elReadOnly).removeAttr('readonly');
						}

						if(response.id == 'close') {
							$(elBtnModalClose).click();
						}

						if(response.id != 'close' && response.id != 'new') {
							$(elForm).find('input[name=id]').val(response.id);
							$(elForm).find(elReadOnly).attr('readonly', 'readonly');
						}
					}
				}
			});
		},

		handleCheckField: function(elDivID, elResult, elUrl, elBtn)
		{
			var typingTimer;
			var doneTypingInterval = 1000;
			var inputKeyup = $(elDivID);
			$(inputKeyup).keyup(function() {
				var Ide = this.value;
				clearTimeout(typingTimer);
			    if (Ide != "") {
			        typingTimer = setTimeout(doneTyping, doneTypingInterval);
			    }else{
			    	$(elResult).html('');
			    }

				function doneTyping () {
					check_id(Ide);
				}
			});
			
			function check_id(Ide)
			{			
				$.ajax({
					type : "POST",
					data : {
						'id' : Ide
					},
					url : elUrl,
					dataType : "JSON",
					beforeSend : function(result)
					{
						$(elResult).html('<i class="glyphicon fa fa-spinner fa-spin"> </i>');
					},
					success : function(result)
					{
						if (result.status === false) {
							$(elResult).html('<i class="glyphicon glyphicon-ok text-green"> ID Tersedia</i>');
							$(elBtn).attr('disabled', false);
						}else if (result.status === true) {
							$(elBtn).attr('disabled', true);
							$(elResult).html('<i class="glyphicon glyphicon-remove text-red"> ID Tidak Tersedia</i>');
						}
					}
				});
			}
		},

		handleCheckField2 : function(elDivID, elResult, elUrl, elBtn, stringSuccess, stringFailure)
		{
			var typingTimer;
			var doneTypingInterval = 1000;
			var inputKeyup = $(elDivID);
			$(inputKeyup).keyup(function() {
				var Ide = this.value;
				clearTimeout(typingTimer);
			    if (Ide != "") {
			        typingTimer = setTimeout(doneTyping, doneTypingInterval);
			    }else{
			    	$(elResult).html('');
			    }

				function doneTyping () {
					check_id(Ide);
				}
			});
			
			function check_id(Ide)
			{			
				$.ajax({
					type : "POST",
					data : {
						'id' : Ide
					},
					url : elUrl,
					dataType : "JSON",
					beforeSend : function(result)
					{
						$(elResult).html('<i class="glyphicon fa fa-spinner fa-spin"> </i>');
					},
					success : function(result)
					{
						if (result.status === false) {
							$(elResult).html('<i class="glyphicon glyphicon-ok text-green"> '+stringSuccess+'</i>');
							$(elBtn).attr('disabled', false);
						}else if (result.status === true) {
							$(elBtn).attr('disabled', true);
							$(elResult).html('<i class="glyphicon glyphicon-remove text-red"> '+stringFailure+'</i>');
						}
					}
				});
			}
		},

	}
})(jQuery);