var app = angular.module('app', ['angular-loading-bar','chart.js']);
app.controller('dashboardController', function($scope, $http, dashboardFactory){
	console.log("this dashboard running well");
	

	  $scope.labels2 = ['Januari', 'Februari', 'Maret', 'April', 'May', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'November', 'Desember'];
	  $scope.data2 = [0,0,0,0,0,0,0,0,0,0,0,0];
	  $scope.datasetOverride = [
	    {
	      label: "Jumlah Interview",
	      borderWidth: 1,
	      type: 'bar'
	    }
	  ];
	  $scope.colors = ['#45b7cd', '#ff6384', '#ff8e72'];

	  $scope.labels = [];
	  $scope.data = [];
	  var data0 = 0;
	  var data1 = 0;
	  var data2 = 0;
	  var data3 = 0;
	  var data4 = 0;
	  var data5 = 0;
	  var data6 = 0;
	  var data7 = 0;
	  var data8 = 0;
	  var data9 = 0;
	  var data10 = 0;
	  var data11 = 0;
	
	  dashboardFactory.getDataLoker().then(function(res) {
	  		console.log("getDataLoker",res.data);
	  		for(var a in res.data){
	  			res.data[a].Count = res.data[a].Lamaran.length;
	  			$scope.labels.push(res.data[a].lowonganNama);

	  			$scope.data.push(res.data[a].Count);
	  			for(var b in res.data[a].Lamaran){
	  				if(res.data[a].Lamaran[b].tanggalUndangan != null){

	  					var d = new Date(res.data[a].Lamaran[b].tanggalUndangan);
	  					var n = d.getMonth();
	  					console.log("n",n);
	  					if(n == 0){
	  						data0++
	  						$scope.data2[0] = data0;
	  					}else if(n == 1){
	  						data1++
	  						$scope.data2[1] = data1;
	  					}else if(n == 2){
	  						data2++
	  						$scope.data2[2] = data2;
	  					}else if(n == 3){
	  						data3++
	  						$scope.data2[3] = data3;
	  					}else if(n == 4){
	  						data4++
	  						$scope.data2[4] = data4;
	  					}else if(n == 5){
	  						data5++
	  						$scope.data2[5] = data5;
	  					}else if(n == 6){
	  						data6++
	  						$scope.data2[6] = data6;
	  					}else if(n == 7){
	  						data7++
	  						$scope.data2[7] = data7;
	  					}else if(n == 8){
	  						data8++
	  						$scope.data2[8] = data8;
	  					}else if(n == 9){
	  						data9++
	  						$scope.data2[9] = data9;
	  					}else if(n == 10){
	  						data10++
	  						$scope.data2[10] = data10;
	  					}else if(n == 11){
	  						data11++
	  						$scope.data2[11] = data11;
	  					}
	
	
	  				}
	  			}
	  		}

	  		  console.log("$scope.data2",$scope.data2);
	      },
	      function(err) {
	          console.log("err=>", err);
	      }
	  );	



	
});