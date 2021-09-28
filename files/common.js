function is_empty(val){
	if(val == "" || val == null || val == undefined){
		return true;
	}else{
		return false;
	}
}

function is_email(val){
	var reg_email = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;

	if(!reg_email.test(val)) {
		return false;
	} else {
		return true;
	}
}
