app.factory('LamaranFactory', function ($http,$httpParamSerializerJQLike,$q,freamwork) {
	var base_url = freamwork.getUrl();
	return{
		getDataLowongan : function(){
			return $http.get(base_url + '/Lamaran/getDataLowongan');
		},

		getDataPelamar : function(Id){
			return $http.get(base_url + '/Lamaran/getDataPelamar/'+Id);
		},
	}

});