var app = angular.module('app', []);
app.controller('loginController', function($scope, $http,login){
	console.log("LC here");
	$scope.formMaster = true;
	$scope.formLamaran = false;
	$scope.formListJob = false;
	$scope.formDetail = false;
	$scope.mData = {};

	// $scope.pekerjaan = [
	// 	{
	// 		Name : "Dev Jr",
	// 		Skills : [{Name : "Javascripsadfsdafsadft"},{Name : "Angular"},{Name : "Javascript"},{Name : "Angular"},{Name : "Javascript"},{Name : "Angular"},{Name : "Javascript"},{Name : "Angular"},{Name : "Javascript"},{Name : "Angular"}]
	// 	},
	// 	{
	// 		Name : "Admin",
	// 		Skills : [{Name : "Word"},{Name : "Excel"},{Name : "Power Point"}]
	// 	},
	// 	{
	// 		Name : "Cleaning Service",
	// 		Skills : []
	// 	},
	// ];

	$scope.skillData = [];

	$scope.btnLamar = function(){
		console.log("button lamar nih");
	
		login.getDataLowongan().then(function(res) {
				console.log("Data lowongan",res.data);
				for(var a in res.data){
					res.data[a].pengalamanTxt = res.data[a].pengalaman+" (Tahun)";
					res.data[a].usiaTxt = res.data[a].usia+" (Tahun)";
				}
				$scope.pekerjaan = res.data;
		    },
		    function(err) {
		        console.log("err=>", err);
		    }
		);

		login.getDataPendidikan().then(function(res) {
				console.log("Data pendidikan",res.data);
				
				$scope.dataPendidikan = res.data;
		    },
		    function(err) {
		        console.log("err=>", err);
		    }
		);

		$scope.formMaster = false;
		$scope.formLamaran = true;
		$scope.formListJob = true;
		$scope.formDetail = false;
	}

	$scope.clickLogo = function(){

		$scope.formMaster = true;
		$scope.formLamaran = false;
	}

	$scope.showDetiail = function(data){
		console.log("data",data);
		$scope.skillData = [];
		$scope.ChosedJob = data;
		$scope.formListJob = false;
		$scope.formDetail = true;
	}

	$scope.clickBack = function(){
		$scope.mData = {};
		
		$scope.formMaster = true;
		$scope.formLamaran = false;
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

	$scope.savePush = function(){
		console.log("$scope.mdata",$scope.mData);
		$scope.skillData.push({
			Id : $scope.skillData.length + 1, 
			Name : $scope.mData.Skills
		});
		$scope.mData.Skills = null;
		console.log("$scope.skillData",$scope.skillData);
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

	$scope.changeMount = function(data){
		console.log("data",data);
		if(data > 12){
			return $scope.mData.PengalamanBulan = 12;
		}
	}

	$scope.submitData = function(){
		console.log("$scope.mData",$scope.mData);
		console.log("$scope.ChosedJob",$scope.ChosedJob);
		console.log("$scope.mData.PengalamanTahun",$scope.mData.PengalamanTahun);
		if($scope.mData.PengalamanTahun == undefined){
			$scope.mData.PengalamanTahun = 0;
		}
		if($scope.mData.PengalamanBulan == undefined){
			$scope.mData.PengalamanBulan = 0;
		}
		var finalBulan = 0;
		finalBulan += $scope.mData.PengalamanBulan / 12;
		var lastBulan = parseFloat(finalBulan.toFixed(2));
		$scope.mData.Pengalaman = $scope.mData.PengalamanTahun + lastBulan;
		console.log("lastBulan",lastBulan);
		console.log(":$scope.mData.Pengalaman",$scope.mData.Pengalaman);
		if($scope.mData.Nama == null ||$scope.mData.Usia == null ||$scope.mData.Email == null ||$scope.mData.Phone == null ||$scope.mData.pendidikan == null||$scope.mData.Pengalaman == null||$scope.mData.gaji == null){
			swal({
				title: 'Data Belum Lengkap',
				text: "Mohon Untuk Melengkapi Data",
				timer: 1500,
				type: 'error',
				showConfirmButton: false
			});
		}else{
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
				$scope.mData.gaji = tmpKm;
				login.saveData($scope.mData,$scope.ChosedJob.lowonganID).then(function(res) {
						var DataSkill = []
						for(var a in $scope.skillData){
							DataSkill.push({
								kemampuan : $scope.skillData[a].Name,
								lamaranID : parseInt(res.data) //ini lamaranID dari yg baru disimpan
							})
						}
						console.log("DataSkill",DataSkill);
						login.saveDataKemampuan(DataSkill).then(function(res) {
							console.log("res",res);
								swal({
									title: 'Lamaran Telah Terkirim',
									text: "",
									timer: 1000,
									type: 'success',
									showConfirmButton: false
								});
								$scope.mData = {};
								$scope.skillData = [];
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

}); 