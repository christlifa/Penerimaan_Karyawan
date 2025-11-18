app.factory('dashboardFactory', function ($http,$httpParamSerializerJQLike,$q,freamwork) {
	var base_url =freamwork.getUrl();
	return{
		
		
		getDataLoker : function(){
			return $http.post(base_url + '/Dashboard/getDataLoker');
		},
		// getDataDashboard : function(){
		// 	return $http.get(base_url + '/Master/Karyawan/Karyawan/getDataDashboard');
		// },
	}

});