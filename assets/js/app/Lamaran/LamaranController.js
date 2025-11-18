var app = angular.module('app', ['ui.grid', 'ui.grid.pagination','angular-loading-bar']);
app.controller('LamaranController', function($scope, $http, LamaranFactory){
	console.log("this Lamaran running well");
	$scope.mData = {};
	$scope.mainGrid = true;
	$scope.detailForm = false;
	var actionButton = '<div class="ui-grid-cell-contents">\
	<a href="#"><i class="fa fa-book" title="Detail" ng-click="grid.appScope.onshowDetail(row.entity)"></i></a>\
	</div>';


	var currencyTemp = "currency:'Rp.'";

	$scope.gridOptions1 = {
	  paginationPageSizes: [25, 50, 75],
	  paginationPageSize: 25,
	  enableFiltering: true,
	  enableSorting: true,
	  columnDefs: [
	    { name: 'Nama',field:'nama'},
	    { name: 'Status',field:'status', width:240},
	    { name: 'Action', cellTemplate: actionButton,  enableFiltering: false, width:100}
	  ]
	};
	
	LamaranFactory.getDataLowongan().then(function(res) {
			console.log("Data lowongan",res.data);
			
			$scope.dataLowongan = res.data;
	    },
	    function(err) {
	        console.log("err=>", err);
	    }
	);

	$scope.getdata = function(){
		console.log("$scope.mData.lowongan",$scope.mData.lowongan);
		if($scope.mData.lowongan == undefined){
			swal({
				title: 'Pilih Filter Untuk Menampilkan Data',
				text: "",
				timer: 1500,
				type: 'error',
				showConfirmButton: false
			});
			$scope.gridOptions1.data = [];
		}else{

			LamaranFactory.getDataPelamar(parseInt($scope.mData.lowongan)).then(function(res) {
					console.log("Data pelamar",res.data);
					for(var a in res.data){
						if(res.data[a].isAcc == "1"){
							if(res.data[a].isEmailSend == "1"){
								res.data[a].status = "Undangan Interview";
							}else{
								res.data[a].status = "Terpilih Proses Seleksi";
							}
						}else if(res.data[a].isAcc == "0"){
							res.data[a].status = "Belum Terpilih Proses Seleksi";
						}
					}
					$scope.gridOptions1.data = res.data;
					// $scope.dataLowongan = res.data;
			    },
			    function(err) {
			        console.log("err=>", err);
			    }
			);
		}
	}

	$scope.onshowDetail = function(data){
		console.log("data detail",data);
		console.log("$scope.mData.lowongan",$scope.mData.lowongan);
		$scope.mainGrid = false;
		$scope.detailForm = true;

		var filtered = $scope.dataLowongan.filter(function(item) { 
		   return item.lowonganID == $scope.mData.lowongan;  
		});
		$scope.lowonganChoosed = filtered[0];
		console.log("$scope.lowonganChoosed",$scope.lowonganChoosed);
		for(var a = 0; a < data.Skills.length; a ++){
			data.Skills[a].No = a + 1; 
		}
		var test = data.pengalaman;
		var test2 = test.split(/[,.]/);
		console.log("hahaha",test2);
		console.log("test2[1]",test2[1]);
		var bulanTmp = '0.'; 
		var finalbulan;
		if(test2[1] != undefined){
			 finalbulan = bulanTmp.concat(test2[1]);
		}else{
			finalbulan = 0;
		}
		
		console.log("finalbulan",parseFloat(finalbulan));
		data.tahun = test2[0];
		// if(finalbulan > 0){

			data.bulan = Math.round((finalbulan) * 12);
		// }else{
		// 	data.bulan = finalbulan;
		// }
		// console.log("data",Math.round((finalbulan) * 12));
		$scope.dataDetail = data;
		console.log("$scope.dataDetail ",$scope.dataDetail );
	}

	$scope.KembaliButton = function(){
		$scope.mainGrid = true;
		$scope.detailForm = false;
	}
});