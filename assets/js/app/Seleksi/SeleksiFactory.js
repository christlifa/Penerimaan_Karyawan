app.factory('SeleksiFactory', function ($http,$httpParamSerializerJQLike,$q,freamwork) {
	var base_url = freamwork.getUrl();
	return{

		getDataLoker : function(){
			return $http.post(base_url + '/Dashboard/getDataLoker');
		},

		getDataLowonganTr : function(Id){
			return $http.post(base_url + '/Seleksi/getDataLowonganTr/'+Id);
		},

		getDataPelamarTr : function(Id){
			return $http.post(base_url + '/Seleksi/getDataPelamarTr/'+Id);
		},

		sendEmail : function(data){
			return $http.post(base_url + '/Seleksi/sendMail/', data);
		},

		accLamaran : function(Data){
			return $http.put(base_url + '/Seleksi/accLamaran', {lamaranID : Data});
		},

		accEmail : function(Data,mData){
			var tmpDate = mData.dateInterview;
			tmpDate = new Date(tmpDate);
			console.log("tmpDate",tmpDate);
			var finalDate
			var yyyy = tmpDate.getFullYear().toString();
			var mm = (tmpDate.getMonth() + 1).toString(); // getMonth() is zero-based         
			var dd = tmpDate.getDate().toString();
			finalDate = yyyy+ '-' + (mm[1] ? mm : "0" + mm[0]) + '-' + (dd[1] ? dd : "0" + dd[0]);
			return $http.put(base_url + '/Seleksi/accEmail', {lamaranID : Data , tanggalUndangan : finalDate});
		}
	}

});