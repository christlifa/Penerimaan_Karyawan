app.factory('AdminFactory', function ($http,$httpParamSerializerJQLike,$q,freamwork) {
	var base_url = freamwork.getUrl();
	return{
		
		getDataAdmin : function(){
			return $http.get(base_url + '/Admin/getData');
		},

		saveData : function(Data){
			console.log("data save",Data);
			return $http.post(base_url + '/Admin/saveData', {
			                      Username : Data.Username,
			                      Password : Data.Password,
			                 });
		},

		deleteData : function(Data){
			return $http.put(base_url + '/Admin/deleteData', {
			                      LoginId : Data
			                 });
		},

		updateData : function(Data){
			return $http.put(base_url + '/Admin/updateData', {
			                      Username : Data.Username,
			                      Password : Data.Password,
			                      LoginId: Data.LoginId,
			                 });
		}
	}

});