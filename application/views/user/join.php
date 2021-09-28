<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<script src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script src="files/common.js"></script>
	<title>HTML !DOCTYPE declaration</title>
</head>
<body>

<p>회원가입</p>

<form method="post" id="frm">
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputEmail4">이메일</label>
			<input type="text" class="form-control" id="email1" name="email1">
			@
			<select class="custom-select mr-sm-2" id="email2" onchange="onchangeEmail2(this.value);" name="email2">
				<option selected>이메일 선택</option>
				<option value="naver.com">naver.com</option>
				<option value="google.com">google.com</option>
				<option value="etc">기타</option>
			</select>
			<input type="hidden" class='form-control' id='email2_2' name="email2_2">
			<button type="button" class="btn btn-primary" onclick="onclickEmailCheck();">중복확인</button>
			<input type="hidden" value="" id="email_alert_check">
		</div>
		<div class="form-group col-md-6">
			<label for="inputPassword4">비밀번호</label>
			<input type="password" class="form-control" id="psw" name="psw">
		</div>
		<div class="form-group col-md-6">
			<label for="inputPassword4">비밀번호 확인</label>
			<input type="password" class="form-control" id="psw_check">
		</div>
	</div>
	<button type="button" class="btn btn-primary" onclick="onclickBack();">뒤로</button>
	<button type="submit" class="btn btn-primary" onclick="onclickJoinMember();">회원가입</button>
</form>

<script>

	function onchangeEmail2(value){
		if(value == "etc"){
			$("#email2").remove();
			$("#email2_2").attr('type','text');
		}
	}

	function onclickEmailCheck(){
		var email1 = $("#email1").val();
		var email2 = $("#email2").val();
		var email = email1+'@'+email2;

		if(is_empty(email1) || is_empty(email2) || !is_email(email)){
			alert("값을 다시 확인 해 주세요.");
			return false;
		}else{
			$.ajax({
				url : "/auth/ajax_mailCheck",
				type : "POST",
				data : {"email" : email},
				success : function(res){
					if(res.code=="fail"){
						alert("동일한 계정이 있습니다. 다시 입력 해 주세요.");
					}else{
						$("input[id=email_alert_check").val("Y");
						alert("회원가입 가능한 이메일 입니다.");
					}
				},
				error : function(){
					alert("오류");
					return false;
				}
			});
		}
		return false;
	}

	function validationCheck(){
		var email1 =  $('#email1').val();
		var email2 =  $('#email2').val();
		var psw = $('#psw').val();
		var psw_check = $('#psw').val();
		var email_alert_check = $('#email_alert_check').val();

		if(is_email(email1)){
			alert("이메일을 다시 한번 확인 해 주세요.");
			return false;
		} else if(is_email(email2)){
			alert("이메일을 다시 한번 확인 해 주세요.");
			return false;
		} else if(is_email(psw)){
			alert("비밀번호를 다시 한번 확인 해 주세요.");
			return false;
		} else if(is_email(psw_check)){
			alert("비밀번호를 다시 한번 확인 해 주세요.");
			return false;
		}else if(psw != psw_check){
			alert("비밀번호와 비밀번호 확인이 다릅니다. 다시 한번 확인 해 주세요.");
			return false;
		} else if(email_alert_check != 'Y'){
			alert("중복확인을 해 주세요.");
			return false;
		} else{
			return true;
		}
	}

	function onclickJoinMember(){
		if(!validationCheck()){
			return false;
		}else{
			$("#frm").attr("action","/auth/new")
			$("#frm").submit();
		}
	}

	function onclickBack(){
		location.go(-1);
	}
</script>

</body>
</html>
