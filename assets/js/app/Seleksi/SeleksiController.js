var app = angular.module('app', ['ui.grid', 'ui.grid.pagination','angular-loading-bar']);
app.controller('SeleksiController', function($scope, $http, SeleksiFactory){
	console.log("this Selection running well");
	$scope.mData = {};
	$scope.mainGrid = true;
	$scope.detailForm = false;
	
	$scope.getdata = function(){
		SeleksiFactory.getDataLoker().then(function(res) {
				console.log("getDataLoker",res.data)
				var dataLoker = [];
				for(var a = 0; a < res.data.length; a++){
					
					if(res.data[a].isDone == "0"){
						var Count = 0;
						for(var b in res.data[a].Lamaran){
							if(res.data[a].Lamaran[b].isAcc == "0"){
								Count++
								res.data[a].Count = Count;
							}
						}
						dataLoker.push(res.data[a]);
					}
				}
				$scope.dataLowongan = dataLoker;
		    },
		    function(err) {
		        console.log("err=>", err);
		    }
		);
	}

	

	

	$scope.showDetiail = function(data){
		console.log("data dipilih", data);
		if(data.Count == 0){
			swal({
				title: 'Belum ada pelamar di lowongan '+data.lowonganNama,
				text: "",
				timer: 1500,
				type: 'error',
				showConfirmButton: false
			});
		}else{
			swal({
				title: "Apakah anda yakin untuk melakukan seleksi "+data.lowonganNama+ " ?",
				text: "",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes",
				closeOnConfirm: false,

			},
			function(){

				
				SeleksiFactory.getDataLowonganTr(data.lowonganID).then(function(res) {
						
						$scope.dataLokerTr = res.data[0];
						console.log("getDataLowonganTr",$scope.dataLokerTr);
						SeleksiFactory.getDataPelamarTr(data.lowonganID).then(function(res) {
								console.log("getDataPelamarTr",res.data)
								$scope.dataPelamarTr = res.data;
						    	$scope.findingBiggerResult();
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
		
	}

	// Pendidikan, Pengalaman kerja , Gaji, usia 
	//buat nnti nentuin data yang paling cocok
	// var points = [40, 100, 1, 5, 25, 10];
	// document.getElementById("demo").innerHTML = points;

	// function myFunction() {
	//   points.sort(function(a, b){return b-a});
	//   document.getElementById("demo").innerHTML = points;
	// }
	$scope.findingBiggerResult = function(){
		console.log("ini finding bigger result");
		for(var a in $scope.dataPelamarTr){
			$scope.dataPelamarTr[a].Point = 0;
			if(parseInt($scope.dataPelamarTr[a].pendidikan) == parseInt($scope.dataLokerTr.pendidikan)){
				$scope.dataPelamarTr[a].Point += 10;
			}else if(parseInt($scope.dataPelamarTr[a].pendidikan) > parseInt($scope.dataLokerTr.pendidikan)){
				$scope.dataPelamarTr[a].Point += 5;
			}else if(parseInt($scope.dataPelamarTr[a].pendidikan) < parseInt($scope.dataLokerTr.pendidikan)){
				$scope.dataPelamarTr[a].Point += 0;
			}

			if(parseInt($scope.dataPelamarTr[a].pengalaman) == parseInt($scope.dataLokerTr.pengalaman)){
				$scope.dataPelamarTr[a].Point += 10;
			}else if(parseInt($scope.dataPelamarTr[a].pengalaman) > parseInt($scope.dataLokerTr.pengalaman)){
				$scope.dataPelamarTr[a].Point += 5;
			}else if(parseInt($scope.dataPelamarTr[a].pengalaman) < parseInt($scope.dataLokerTr.pengalaman)){
				$scope.dataPelamarTr[a].Point += 0;
			}

			var GajiTMP = parseInt($scope.dataPelamarTr[a].gaji);
			console.log("GajiTMP",GajiTMP);
			var FinalResultGaji = parseInt($scope.dataLokerTr.Sallary) - GajiTMP;
			console.log("gaji dibandingkan",FinalResultGaji);
			if(FinalResultGaji == 0){
				$scope.dataPelamarTr[a].Point += 10;
			}else if(FinalResultGaji > 0){
				$scope.dataPelamarTr[a].Point += 5;
			}else if(FinalResultGaji < 0){
				$scope.dataPelamarTr[a].Point += 0;
			}

			var UsiaTMP = parseInt($scope.dataPelamarTr[a].usia);
			var FinalResultusia = parseInt($scope.dataLokerTr.usia) - UsiaTMP;
			console.log("FinalResultusia",FinalResultusia);
			if(FinalResultusia == 0){
				$scope.dataPelamarTr[a].Point += 10;
			}else if(FinalResultusia > 0){
				$scope.dataPelamarTr[a].Point += 5;
			}else if(FinalResultusia < 0  && FinalResultusia <= -2){
				$scope.dataPelamarTr[a].Point += 3;
			}else if(FinalResultusia < 0 && FinalResultusia < -2){
				$scope.dataPelamarTr[a].Point += 0;
			}


			for(var b in $scope.dataPelamarTr[a].Skills){
				for(var c in $scope.dataLokerTr.Skills){
					$scope.dataPelamarTr[a].Skills[b].Name = $scope.dataPelamarTr[a].Skills[b].kemampuan.toUpperCase();
					$scope.dataLokerTr.Skills[c].Name = $scope.dataLokerTr.Skills[c].kemampuan.toUpperCase();
					if($scope.dataPelamarTr[a].Skills[b].Name == $scope.dataLokerTr.Skills[c].Name){
						console.log($scope.dataPelamarTr[a].nama,"dia dapet point di",$scope.dataPelamarTr[a].Skills[b].Name);
						$scope.dataPelamarTr[a].Point += 10;
					}
				}

			}

			
			
		}

		console.log("$scope.dataPelamarTr",$scope.dataPelamarTr);
		$scope.maxData = getMax($scope.dataPelamarTr, "Point");
		console.log("max data", $scope.maxData ,typeof $scope.maxData);
		if(typeof $scope.maxData == 'object'){
			SeleksiFactory.accLamaran($scope.maxData.lamaranID).then(function(res) {
					swal({
						title: 'Seleksi Pelamar Berhasil',
						text: "",
						timer: 1000,
						type: 'success',
						showConfirmButton: false
					});
					$scope.detailForm = true;
					$scope.mainGrid = false;
					$scope.mData.nama = $scope.maxData.nama;
					$scope.mData.email = $scope.maxData.email;
			    },	
			    function(err) {
			        console.log("err=>", err);
			    }
			);
			
		}

	}



	function getMax(arr, prop) {
	    var max;
	    for (var i=0 ; i<arr.length ; i++) {
	        if (max == null || parseInt(arr[i][prop]) > parseInt(max[prop]))
	            max = arr[i];
	    }
	    return max;
	}

	$scope.test = function(){
		$scope.test = ["lifachristian2@gmail.com","lalalalalla"];
		SeleksiFactory.sendEmail($scope.test).then(function(res) {
				console.log("Data",res.data);
				// swal({
				// 	title: 'Undangan Interview Berhasil Dikirim',
				// 	text: "",
				// 	timer: 1000,
				// 	type: 'success',
				// 	showConfirmButton: false
				// });
				// $scope.getdata();
				// $scope.detailForm = false;
				// $scope.mainGrid = true;
				// $scope.mData = {};
		    },
		    function(err) {
		        console.log("err=>", err);
		    }
		);	
	}

	$scope.sendEmail = function(){
		console.log("$scope.mData.dateInterview",$scope.mData.dateInterview);

		
		var today = new Date();
		console.log("today",today);
		console.log("message",$scope.mData);
		if($scope.mData.dateInterview.getTime() < today.getTime()){
			swal({
							title: 'Undangan Interview Gagal',
							text: "Tanggal Interview Minimal H + 1",
							timer: 2000,
							type: 'error',
							showConfirmButton: false
			});
		}else{
			SeleksiFactory.accEmail($scope.maxData.lamaranID,$scope.mData).then(function(res) {
					SeleksiFactory.sendEmail($scope.mData).then(function(res) {
							console.log("Data",res.data);
							swal({
								title: 'Undangan Interview Berhasil Dikirim',
								text: "",
								timer: 1000,
								type: 'success',
								showConfirmButton: false
							});
							$scope.getdata();
							$scope.detailForm = false;
							$scope.mainGrid = true;
							$scope.mData = {};
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

	$scope.setDate = function(data){
		console.log("data",data);

		var tmpDate = data;
		tmpDate = new Date(tmpDate);
		var finalDate
		var yyyy = tmpDate.getFullYear().toString();
		var mm = (tmpDate.getMonth() + 1).toString(); // getMonth() is zero-based         
		var dd = tmpDate.getDate().toString();
		finalDate = (dd[1] ? dd : "0" + dd[0])+ '/' + (mm[1] ? mm : "0" + mm[0]) + '/' + yyyy;
		console.log("changeFormatDate finalDate", finalDate);


		var d = data;
		var n = d.getDay();
		console.log("n",n);
		var hari = "";
		if(n == 1){
			hari = "Senin";
		}else if(n == 2){
			hari = "Selasa";
		}else if(n == 3){
			hari = "Rabu";
		}else if(n == 4){
			hari = "Kamis";
		}else if(n == 5){
			hari = "Jumat";
		}else if(n == 6){
			hari = "Sabtu";
		}else if(n == 7){
			hari = "Minggu";
		}
		$scope.mData.message = 'Kepada Yth '+$scope.maxData.nama+' ,\n\
Kami perusahaan IT yang menerima lamaran Anda, memilih dan mengundang\n\
Anda untuk mengikuti interview, pada :\n\
Hari dan Tanggal : '+hari+', '+finalDate+'\n\
Waktu : 09.00 WIB\n\
Tempat : PT. Clientsolve Mitra Solusi\n\
Office Building\n\
Sunter Park View Tower A\n\
2nd Floor\n\
JL. Yos Sudarso Kav 30 A, Sunter Jaya Jakarta Utara 14350\n\
(021) 294-610-14\n\
*Mohon membawa alat tulis lengkap dan CV lengkap (Pas Foto,KTP,Lamaran\n \
Kerja,CV,Transkip Nilai,Veklaring dan diwajibkan memperlihatkan Ijazah asli).\n\
**Mohon segera konfirmasi kehadiran nya\n\
Terimakasih\n\
Salam\n\
HR Dept\n\
\n\
PT. Clientsolve Mitra Solusi';
	}
});