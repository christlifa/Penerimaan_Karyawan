/**
 * Javascript Mesin
 * 
 * @author  Hikmahtiar <hikmahtiar.cool@gmail.com>
 */
window.MESIN = (function($) {

	var renderCheckbox = function(data, type, full, meta) {
        return '<input class="check-sub-machine" type="checkbox" value="'+full['machine_id']+'">';
    }

	var renderCheckboxType = function(data, type, full, meta) {
        return '<input class="check-sub-machine-type" type="checkbox" value="'+full['machine_type_id']+'">';
    }

    var renderCheckboxAssignMachine = function(data, type, full, meta) {
        return '<input class="check-sub-assign-machine" type="checkbox" value="'+full['assign_id']+'">';
    }

    var renderEdit = function(data, type, full, meta) {
    	var url = APP.siteUrl + 'adm/mesin/edit/' + data;
        return '<a class="machine-edit" href="'+url+'" data-toggle="tooltip" data-placement="top" title="Klik untuk Edit">'+data+'</a>';
    }

    var renderEditType = function(data, type, full, meta) {
    	var url = APP.siteUrl + 'adm/mesin/edit_tipe/' + data;
        return '<a class="machine-type-edit" href="'+url+'" data-toggle="tooltip" data-placement="top" title="Klik untuk Edit">'+data+'</a>';
    }

    var renderEditAssignMachine = function(data, type, full, meta) {
    	var url = APP.siteUrl + 'adm/mesin/edit_assign_machine/' + full['assign_id'];
        return '<a class="assign-machine-edit" href="'+url+'" data-toggle="tooltip" data-placement="top" title="Klik untuk Edit">'+data+'</a>';
    }


	return {
		// mesin
		elDatatable : null,
		elVue  : '#vue-machine',
		elForm : '.machine-form',
		elEdit : '.machine-edit',
		elTable : '#table-machine',
		elModal : '.machine-modal',
		elBtnDelete : '.machine-delete',
		elModalClose : '.machine-cancel',
		elSubCheckbox : '.check-sub-machine',
		elParentCheckbox : '.check-all-machine',
		elModalContent : '.machine-modal-content',
		urlDeleteData : window.APP.siteUrl + 'adm/mesin/delete',
		urlRequestData : window.APP.siteUrl + 'adm/mesin/get_data',

		// mesin type
		elDatatableType : null,
		elVueType : '#vue-machine-type',
		elFormType : '.machine-type-form',
		elEditType : '.machine-type-edit',
		elTableType : '#table-machine-type',
		elModalType : '.machine-type-modal',
		elBtnDeleteType : '.machine-type-delete',
		elModalCloseType : '.machine-type-cancel',
		elSubCheckboxType : '.check-sub-machine-type',
		elParentCheckboxType : '.check-all-machine-type',
		elModalContentType : '.machine-type-modal-content',
		urlDeleteDataType : window.APP.siteUrl + 'adm/mesin/delete_type',
		urlRequestDataType : window.APP.siteUrl + 'adm/mesin/get_data_type',

		// Assign Machine 
		elDatatableAssignMachine : null,
		elVueAssignMachine : '#vue-assign-machine',
		elFormAssignMachine : '.assign-machine-form',
		elEditAssignMachine : '.assign-machine-edit',
		elTableAssignMachine : '#table-assign-machine',
		elModalAssignMachine : '.assign-machine-modal',
		elBtnDeleteAssignMachine : '.assign-machine-delete',
		elModalCloseAssignMachine : '.assign-machine-cancel',
		elSubCheckboxAssignMachine : '.check-sub-assign-machine',
		elParentCheckboxAssignMachine : '.check-all-assign-machine',
		elModalContentAssignMachine : '.assign-machine-modal-content',
		urlDeleteDataAssignMachine : window.APP.siteUrl + 'adm/mesin/delete_assign_mesin',
		urlRequestDataAssignMachine : window.APP.siteUrl + 'adm/mesin/get_data_assign_mesin',

		init: function() {
			var parentThis = this;
		},

		handleDeleteAssignMachine : function() {
			var parentThis = this;

			$(parentThis.elBtnDeleteAssignMachine).click(function() {

				// item dari sub check box
				var items = $(parentThis.elTableAssignMachine).find('input[class="check-sub-assign-machine"]:checked');

	            var types = [];
	            for (var i=0; i<items.length;i++) {
	                types.push($(items[i]).val());
	            }

	            if(!types.length) {
	                // menampilkan sweet alert
					swal({
						title: 'Anda belum memilih yg akan dihapus',
						text: "",
						timer: 2000,
						type: 'error',
						showConfirmButton: false
					});
	                
	                return false;
	            } else {

	            	// alert
					swal({  
						title: "Apa Anda Yakin?",
						text: "Anda Akan Menghapus ini!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Ya, Hapus!",   
						closeOnConfirm: false 
					}, function(){   

						// jika yakin menghapus maka menjalankan ajax request hapus data
						$.ajax({
							type: "POST",
							dataType: 'json',
							url: parentThis.urlDeleteDataAssignMachine,
							data: {
							    id: types,
							},
							success: function(response) {

								window.FORM.showNotification(response.message, response.status);

								// reload datatable
								parentThis.elDatatableAssignMachine.ajax.reload();
							}
		           		});
					});
	            }

			});
		},

		handleDeleteType : function() {
			var parentThis = this;

			$(parentThis.elBtnDeleteType).click(function() {

				// item dari sub check box
				var items = $(parentThis.elTableType).find('input[class="check-sub-machine-type"]:checked');

	            var types = [];
	            for (var i=0; i<items.length;i++) {
	                types.push($(items[i]).val());
	            }

	            if(!types.length) {
	                // menampilkan sweet alert
					swal({
						title: 'Anda belum memilih yg akan dihapus',
						text: "",
						timer: 2000,
						type: 'error',
						showConfirmButton: false
					});
	                
	                return false;
	            } else {

	            	// alert
					swal({  
						title: "Apa Anda Yakin?",
						text: "Anda Akan Menghapus ini!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Ya, Hapus!",   
						closeOnConfirm: false 
					}, function(){   

						// jika yakin menghapus maka menjalankan ajax request hapus data
						$.ajax({
							type: "POST",
							dataType: 'json',
							url: parentThis.urlDeleteDataType,
							data: {
							    id: types,
							},
							success: function(response) {

								window.FORM.showNotification(response.message, response.status);

								// reload datatable
								parentThis.elDatatableType.ajax.reload();
							}
		           		});
					});
	            }

			});
		},

		handleDelete : function() {
			var parentThis = this;

			$(parentThis.elBtnDelete).click(function() {

				// item dari sub check box
				var items = $(parentThis.elTable).find('input[class="check-sub-machine"]:checked');

	            var types = [];
	            for (var i=0; i<items.length;i++) {
	                types.push($(items[i]).val());
	            }

	            if(!types.length) {
	                // menampilkan sweet alert
					swal({
						title: 'Anda belum memilih yg akan dihapus',
						text: "",
						timer: 2000,
						type: 'error',
						showConfirmButton: false
					});
	                
	                return false;
	            } else {

	            	// alert
					swal({  
						title: "Apa Anda Yakin?",
						text: "Anda Akan Menghapus ini!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Ya, Hapus!",   
						closeOnConfirm: false 
					}, function(){   

						// jika yakin menghapus maka menjalankan ajax request hapus data
						$.ajax({
							type: "POST",
							dataType: 'json',
							url: parentThis.urlDeleteData,
							data: {
							    id: types,
							},
							success: function(response) {

								window.FORM.showNotification(response.message, response.status);

								// reload datatable
								parentThis.elDatatable.ajax.reload();
							}
		           		});
					});
	            }

			});
		},

		handleVue: function() {
			var parentThis = this;
			
			// Vue Js
			new Vue({
				el : parentThis.elVue,
				delimiters: ['<%', '%>'],
				methods : {
				},
				mounted : function() {
					parentThis.handleDataTable();
				}
			});			

		},

		handleVueType: function() {
			var parentThis = this;
			
			// Vue Js
			new Vue({
				el : parentThis.elVueType,
				delimiters: ['<%', '%>'],
				methods : {
					addRowType : function() {
						var vue = this;
					}
				},
				mounted : function() {
					parentThis.handleDataTableType();
				}
			});			

		},

		handleVueAssignMachine : function() {
			var parentThis = this;
			
			// Vue Js
			new Vue({
				el : parentThis.elVueAssignMachine,
				delimiters: ['<%', '%>'],
				methods : {
					addRowType : function() {
						var vue = this;
					}
				},
				mounted : function() {
					parentThis.handleDataTableAssignMachine();
				}
			});			

		},

		handleDataTable: function() {
			var parentThis = this;

			// Datatable
			parentThis.elDatatable = $(parentThis.elTable).DataTable({
				ajax: {
					url : parentThis.urlRequestData
				},
				columns : [
					{
						data      : 'no',
						width     : '20',
						className : 'center',
						render: renderCheckbox
					},
					{
						data : 'machine_id',
						render : renderEdit
					},
					{
						data : 'machine_type_id',
					},
					{
						data : 'name',
					},
					{
						data : 'location',
					},
					{
						data     : 'max_billet',
						className: 'right'
					},
					{
						data     : 'min_billet',
						className: 'right'
					},
					{
						data     : 'end_butt',
						className: 'right'
					},
					{
						data : 'pulling_table',
					},
					{
						data : 'billet_type_id',
					},
				],
				order: false,
                deferRender: true,
                initComplete: function() {
					
					// handle form
					window.FORM.handleEditModal(
						parentThis.elForm, 
						parentThis.elEdit,
						parentThis.elModal,
						parentThis.elModalContent,
						parentThis.elModalClose,
						parentThis.elDatatable
					);
					parentThis.handleDelete();
                	window.INPUT.handleCheckboxAll(parentThis.elParentCheckbox, parentThis.elSubCheckbox);
                }
			});
		},

		handleDataTableType: function() {
			var parentThis = this;

			// Datatable
			parentThis.elDatatableType = $(parentThis.elTableType).DataTable({
				ajax: {
					url : parentThis.urlRequestDataType
				},
				columns : [
					{
						data      : 'no',
						width     : '20',
						className : 'center',
						render : renderCheckboxType
					},
					{
						data : 'machine_type_id',
						render : renderEditType
					},
					{
						data : 'name',
					},
					{
						data     : 'initial',
						className: 'right'
					},
					{
						data     : 'max_billet',
						className: 'right'
					},
					{
						data     : 'min_billet',
						className: 'right'
					},
					{
						data     : 'end_butt',
						className: 'right'
					}
				],
				order: false,
                deferRender: true,
                initComplete: function() {
					
					// handle form
					window.FORM.handleEditModal(
						parentThis.elFormType, 
						parentThis.elEditType,
						parentThis.elModalType,
						parentThis.elModalContentType,
						parentThis.elModalCloseType,
						parentThis.elDatatableType
					);
					parentThis.handleDeleteType();
                	window.INPUT.handleCheckboxAll(parentThis.elParentCheckboxType, parentThis.elSubCheckboxType);
                }
			});
		},

		handleDataTableAssignMachine: function() {
			var parentThis = this;

			// Datatable
			parentThis.elDatatableAssignMachine = $(parentThis.elTableAssignMachine).DataTable({
				ajax: {
					url : parentThis.urlRequestDataAssignMachine
				},
				columns : [
					{
						data      : 'no',
						width     : '20',
						className : 'center',
						render : renderCheckboxAssignMachine
					},
					{
						data : 'user_name',
						render : renderEditAssignMachine
					},
					{
						data : 'machine_id',
					},
					{
						data     : 'machine_name'
					},
					// {
					// 	data     : 'machine_location'
					// },
				],
				order: false,
                deferRender: true,
                initComplete: function() {
					
					// handle form
					window.FORM.handleEditModal(
						parentThis.elFormAssignMachine, 
						parentThis.elEditAssignMachine,
						parentThis.elModalAssignMachine,
						parentThis.elModalContentAssignMachine,
						parentThis.elModalCloseAssignMachine,
						parentThis.elDatatableAssignMachine
					);
					parentThis.handleDeleteAssignMachine();
                	window.INPUT.handleCheckboxAll(parentThis.elParentCheckboxAssignMachine, parentThis.elSubCheckboxAssignMachine);
                }
			});
		},

		// handleForm : function(elForm) {
		// 	var parentThis = this;

		// 	$(elForm).validate();

		// 	$(elForm).ajaxForm({
		// 		dataType : 'json',
		// 		beforeSend : function() {
		// 			$(elForm).block({
		// 				message: '<h4>Harap tunggu..</h4>'
		//             });
		// 		},
		// 		success : function(response) {
		// 			$(elForm).unblock();

		// 			// jika response success
		// 			if(response.status == 'success')
		// 			{
		// 				// reload datatable
		// 				parentThis.elDatatableType.ajax.reload();
		// 				window.FORM.showNotification(response.message, response.status);

		// 				// jika id == new, reset form
		// 				// id = close , close modal
		// 				// id = save , edit data 
		// 				if(response.id == 'new') {
		// 					$(elForm).clearForm();
		// 					$(elForm).find('input[name=id]').val('new');
		// 				}

		// 				if(response.id == 'close') {
		// 					$(parentThis.elModalCloseType).click();
		// 				}

		// 				if(response.id != 'close' && response.id != 'new') {
		// 					$(elForm).find('input[name=id]').val(response.id);
		// 				}
		// 			}
		// 		}
		// 	});
		// },
	}
})(jQuery);