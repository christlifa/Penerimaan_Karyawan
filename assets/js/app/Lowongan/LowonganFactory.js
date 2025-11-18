app.factory('LowonganFactory', function ($http,$httpParamSerializerJQLike,$q,freamwork) {
	var base_url = freamwork.getUrl();
	return{
		


		getDataLowongan : function(){
			return $http.get(base_url + '/Lowongan/getData');
		},

		getDataPendidikan : function(){
			return $http.get(base_url + '/Lowongan/getDataPendidikan');
		},
		
		saveData : function(Data){
			console.log("data save",Data);
			return $http.post(base_url + '/Lowongan/saveData', {
			                      lowonganNama : Data.lowonganNama,
			                      Pengalaman : Data.Pengalaman,
			                      Pendidikan : Data.Pendidikan,
			                      usia : Data.usia,
			                      Sallary : Data.gajiNormal,
			                 });
		},

		saveDataKemampuan : function(Data){
			console.log("data save kemampuan",Data);
			return $http.post(base_url + '/Lowongan/saveDataKemampuan',Data);
		},


		deleteDataKemampuan : function(Data){
			return $http.put(base_url + '/Lowongan/deleteDataKemampuan', {
			                      lowonganID : Data
			                 });
		},

		deleteData : function(Data){
			return $http.put(base_url + '/Lowongan/deleteData', {
			                      lowonganID : Data
			                 });
		},

		updateData : function(Data){
			return $http.put(base_url + '/Lowongan/updateData', {
			                      lowonganNama : Data.lowonganNama,
			                      Pengalaman : Data.Pengalaman,
			                      Pendidikan : Data.Pendidikan,
			                      usia : Data.usia,
			                      Sallary : Data.gajiNormal,
			                      lowonganID: Data.lowonganID,
			                 });
		}
	}

});