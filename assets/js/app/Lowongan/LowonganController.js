var app = angular.module('app', ['ui.grid', 'ui.grid.pagination','angular-loading-bar']);
app.controller('LowonganController', function($scope, $http, LowonganFactory){
	console.log("this karyawan running well");
	$scope.mData = {};
	$scope.mainGrid = true;
	$scope.detailForm = false;
	$scope.skillData = [];

	$scope.getData = function(){

		LowonganFactory.getDataLowongan().then(function(res) {
				console.log("Data lowongan",res.data);
				for(var a in res.data){
					res.data[a].pengalamanTxt = res.data[a].pengalaman+" (Tahun)";
					res.data[a].usiaTxt = res.data[a].usia+" (Tahun)";
				}
				$scope.gridOptions1.data = res.data;
		    },
		    function(err) {
		        console.log("err=>", err);
		    }
		);


		LowonganFactory.getDataPendidikan().then(function(res) {
				console.log("Data pendidikan",res.data);
				
				$scope.dataPendidikan = res.data;
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


	var currencyTemp = "currency:'Rp.'";

	$scope.gridOptions1 = {
	  paginationPageSizes: [25, 50, 75],
	  paginationPageSize: 25,
	  enableFiltering: true,
	  enableSorting: true,
	  columnDefs: [
	    { name: 'Lowongan',field:'lowonganNama'},
	    { name: 'Minimal Pengalaman (Tahun)',field:'pengalamanTxt', width:240},
	    { name: 'Pendidikan Minimal',field:'NamaPendidikan', width:200},
	    { name: 'Usia Maximal',field:'usiaTxt'},
	    { name: 'Gaji',field:'Sallary',cellFilter:currencyTemp},
	    // { name: 'Jabatan',cellTemplate: templateKaryawan, enableFiltering: false,field:'Jabatan'},
	    { name: 'Action', cellTemplate: actionButton,  enableFiltering: false, width:100}
	  ]
	};

	$scope.TambahButton = function(){
		$scope.mainGrid = false;
		$scope.detailForm = true;
		$scope.skillData = [];
	}

	$scope.KembaliButton = function(){
		$scope.mainGrid = true;
		$scope.detailForm = false;
		$scope.mData = {};
	}

	$scope.givePattern = function(item, event) {
	    console.log("item", item);
	    if (event.which > 37 && event.which < 40) {
	        event.preventDefault();
	        return false;
	    } else {
	        $scope.nilaiKM = item;
	        if ($scope.nilaiKM.includes(",")) {
	            $scope.nilaiKM = $scope.nilaiKM.split(',');
	            if ($scope.nilaiKM.length > 1) {
	                $scope.nilaiKM = $scope.nilaiKM.join('');
	            } else {
	                $scope.nilaiKM = $scope.nilaiKM[0];
	            }
	        }
	        $scope.nilaiKM = parseInt($scope.nilaiKM);
	        $scope.mData.gaji = $scope.mData.gaji.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	        return;
	    }
	};

	$scope.simpanButton = function(){
		 if ($scope.mData.gaji !== undefined && $scope.mData.gaji !== null) {
		     var tmpKm = angular.copy($scope.mData.gaji);
		     var backupKm = angular.copy($scope.mData.gaji);
		     if (tmpKm.toString().includes(",")) {
		         tmpKm = tmpKm.split(',');
		         if (tmpKm.length > 1) {
		             tmpKm = tmpKm.join('');
		         } else {
		             tmpKm = tmpKm[0];
		         };
		     };
		     tmpKm = parseInt(tmpKm);
		     $scope.mData.gajiNormal = tmpKm;
		 };
		$scope.mData.Pendidikan = parseInt($scope.mData.Pendidikan);
		console.log("$scope.mData",$scope.mData);
		if($scope.mData.lowonganID == undefined || $scope.mData.lowonganID == null || $scope.mData.lowonganID == ''){

			LowonganFactory.saveData($scope.mData).then(function(res) {
				console.log("res",res);
					var DataSkill = []
					for(var a in $scope.skillData){
						DataSkill.push({
							kemampuan : $scope.skillData[a].Name,
							lowonganID : parseInt(res.data) //ini lowonganId dari yg baru disimpan
						})
					}
					console.log("DataSkill",DataSkill);
					LowonganFactory.saveDataKemampuan(DataSkill).then(function(res) {
						console.log("res",res);
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
			    },
			    function(err) {
			        console.log("err=>", err);
			    }
			);
		}else{

			LowonganFactory.updateData($scope.mData).then(function(res) {

					LowonganFactory.deleteDataKemampuan($scope.mData.lowonganID).then(function(res) {
							var DataSkill = []
							for(var a in $scope.skillData){
								DataSkill.push({
									kemampuan : $scope.skillData[a].Name,
									lowonganID : parseInt($scope.mData.lowonganID) //ini lowonganId dari yg baru disimpan
								})
							}
							console.log("DataSkill",DataSkill);
							LowonganFactory.saveDataKemampuan(DataSkill).then(function(res) {
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
							
					    },
					    function(err) {
					        console.log("err=>", err);
					    }
					);
			    },
			    function(err) {
			        console.log("err=>", err);
			    }
			);
		}

	}

	$scope.editData = function(Data){
		console.log("Data",Data);
		$scope.mainGrid = false;
		$scope.detailForm = true;
		// $scope.skillData = [];
		$scope.mData.lowonganID = Data.lowonganID;
		$scope.mData.lowonganNama = Data.lowonganNama;
		$scope.mData.Pendidikan = Data.pendidikan;
		$scope.mData.Pengalaman = parseInt(Data.pengalaman);
		$scope.mData.usia = parseInt(Data.usia);
		$scope.mData.gaji = Data.Sallary.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		$scope.skillData = Data.Skills;
		// $scope.mData.gaji = Data.Sallary;
		// $scope.TambahButton();
	}

	$scope.deleteData = function(Data){
		console.log("Data dihapus",Data);

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

			LowonganFactory.deleteData(Data.lowonganID).then(function(res) {

					LowonganFactory.deleteDataKemampuan(Data.lowonganID).then(function(res) {
							
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
			    },
			    function(err) {
			        console.log("err=>", err);
			    }
			);

		});
	}

	$scope.savePush = function(){
		console.log("$scope.mdata",$scope.mData);
		$scope.skillData.push({
			Id : $scope.skillData.length + 1, 
			Name : $scope.mData.Skills
		});
		$scope.mData.Skills = null;
		console.log("$scope.skillData",$scope.skillData);
	}

	$scope.delete = function(data){
		console.log("data delete",data);
		// $scope.skillData.splice(data,1);
		var filtered = $scope.skillData.filter(function(item) { 
		   return item.Id != data.Id;  
		});
		$scope.skillData = filtered;
		console.log("$scope.skillData",$scope.skillData);
	}

	$scope.doneJOB = function(data){
		console.log("data",data);
	}

});