app.factory('login', function ($http,$httpParamSerializerJQLike,$q,freamwork) {
 var base_url = freamwork.getUrlLogin();
 return {
 	getDataLowongan : function(){
 		return $http.get(base_url + '/Loginweb/getData');
 	},

 	getDataPendidikan : function(){
 		return $http.get(base_url + '/Loginweb/getDataPendidikan');
 	},

 	saveData : function(Data,lowonganID){
 		console.log("data save",Data);
 		return $http.post(base_url + '/Loginweb/saveData', {
 		                      nama : Data.Nama,
 		                      usia : Data.Usia,
 		                      email : Data.Email,
 		                      telpon : Data.Phone,
 		                      pendidikan : Data.pendidikan,
 		                      pengalaman : Data.Pengalaman,
 		                      gaji : Data.gaji,
 		                      lowonganID : lowonganID
 		                 });
 	},

 	saveDataKemampuan : function(Data){
 		console.log("data save kemampuan",Data);
 		return $http.post(base_url + '/Loginweb/saveDataKemampuan',Data);
 	},

 }
});