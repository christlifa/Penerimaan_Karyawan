var app = angular.module('app', ['ui.grid', 'ui.grid.pagination','angular-loading-bar']);
app.controller('AdminController', function($scope, $http, AdminFactory){
	console.log("this admin running well");
	$scope.mData = {};
	$scope.mainGrid = true;
	$scope.detailForm = false;
	$scope.skillData = [];

	$scope.getData = function(){

		AdminFactory.getDataAdmin().then(function(res) {
				console.log("Data admin",res.data);
				
				$scope.gridOptions1.data = res.data;
		    },
		    function(err) {
		        console.log("err=>", err);
		    }
		);
	}

	var actionButton = '<div class="ui-grid-cell-contents">\
	<a href="#"><i class="fa fa-pencil" title="Edit" ng-click="grid.appScope.editData(row.entity)"></i></a>\
	<a href="#"><i class="fa fa-close" title="Delete" style="margin-left:10px;" ng-click="grid.appScope.deleteData(row.entity)"></i></a>\
	</div>';

	$scope.gridOptions1 = {
	  paginationPageSizes: [25, 50, 75],
	  paginationPageSize: 25,
	  enableFiltering: true,
	  enableSorting: true,
	  columnDefs: [
	    { name: 'Username',field:'Username'},
	    // { name: 'Jabatan',cellTemplate: templateKaryawan, enableFiltering: false,field:'Jabatan'},
	    { name: 'Action', cellTemplate: actionButton,  enableFiltering: false, width:100}
	  ]
	};

	$scope.TambahButton = function(){
		$scope.mainGrid = false;
		$scope.detailForm = true;
	}

	$scope.KembaliButton = function(){
		$scope.mainGrid = true;
		$scope.detailForm = false;
		$scope.mData = {};
	}

	$scope.simpanButton = function(){
		if($scope.mData.LoginId == undefined || $scope.mData.LoginId == null || $scope.mData.LoginId == ''){

			AdminFactory.saveData($scope.mData).then(function(res) {
					swal({
						title: 'Simpan data berhasil',
						text: "",
						timer: 1000,
						type: 'success',
						showConfirmButton: false
					});
					$scope.mainGrid = true;
					$scope.detailForm = false;
					$scope.mData = {};
					$scope.getData();
			    },
			    function(err) {
			        console.log("err=>", err);
			    }
			);
		}else{

			AdminFactory.updateData($scope.mData).then(function(res) {
					swal({
						title: 'Ubah data berhasil',
						text: "",
						timer: 1000,
						type: 'success',
						showConfirmButton: false
					});
					$scope.mainGrid = true;
					$scope.detailForm = false;
					$scope.mData = {};
					$scope.getData();
			    },
			    function(err) {
			        console.log("err=>", err);
			    }
			);
		}
	}


	$scope.deleteData = function(Data){
		console.log("Data dihapus",Data);
		console.log("$scope.gridOptions1.data.length",$scope.gridOptions1.data.length);
		swal({
			title: "Apakah anda yakin untuk menghapus data?",
			text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes",
			closeOnConfirm: false,

		},
		function(){
			if($scope.gridOptions1.data.length > 1){
				AdminFactory.deleteData(Data.LoginId).then(function(res) {
						swal({
							title: 'Hapus data berhasil',
							text: "",
							timer: 1000,
							type: 'success',
							showConfirmButton: false
						});
						
						$scope.getData();
						
				    },
				    function(err) {
				        console.log("err=>", err);
				    }
				);

			}else{
				swal({
					title: 'Gagal hapus data',
					text: "Data Admin tidak boleh kosong",
					timer: 1500,
					type: 'error',
					showConfirmButton: false
				});
			}
			
		});
	}

	$scope.editData = function(Data){
		console.log("Data",Data);
		$scope.mainGrid = false;
		$scope.detailForm = true;
		// $scope.skillData = [];
		$scope.mData.LoginId = Data.LoginId;
		$scope.mData.Username = Data.Username;
		$scope.mData.Password = Data.Password;
		// $scope.TambahButton();
	}
});