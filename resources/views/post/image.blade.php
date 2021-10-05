<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Daum에디터 - 이미지 첨부</title> 
<script src="http://127.0.0.1:8000/daumeditor/js/popup.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="http://127.0.0.1:8000/daumeditor/css/popup.css" type="text/css"  charset="utf-8"/>
<script type="text/javascript">
// <![CDATA[
	
	function done() {
		if (typeof(execAttach) == 'undefined') { //Virtual Function
	        return;
	    }
		var _mockdata = new Array();

		var _mockdata[0] = {
			'imageurl': 'http://127.0.0.1:8000/img/163328073359.jpg',
			'filename': '163328073359.jpg',
			'filesize': 640,
			'imagealign': 'C',
			'originalurl': 'http://127.0.0.1:8000/img/163328073359.jpg',
			'thumburl': 'http://127.0.0.1:8000/img/163328073359.jpg'
		};

		var _mockdata[1] = {
			'imageurl': 'http://127.0.0.1:8000/img/163328073359.jpg',
			'filename': '163328073359.jpg',
			'filesize': 640,
			'imagealign': 'C',
			'originalurl': 'http://127.0.0.1:8000/img/163328073359.jpg',
			'thumburl': 'http://127.0.0.1:8000/img/163328073359.jpg'
		};

		for (var i=0;i<_mockdata.length;i++) 
    {        
        execAttach(_mockdata[i]);    
    }
		closeWindow();
	}

	function initUploader(){
	    var _opener = PopupUtil.getOpener();
	    if (!_opener) {
	        alert('잘못된 경로로 접근하셨습니다.');
	        return;
	    }
	    
	    var _attacher = getAttacher('image', _opener);
	    registerAction(_attacher);
	}
// ]]>
</script>
</head>
<body onload="initUploader();">
<div class="wrapper">
	<div class="header">
		<h1>사진 첨부</h1>
	</div>	
	<div class="body">
		<dl class="alert">
		    <dt>사진 첨부 확인</dt>
			<form method="post" enctype="multipart/form-data" action="/imageupload">
                @csrf
				<input type="file" name="photo[]" multiple>		
				<input type="submit" value="업로드">
			</form>
		    <dd>
		    	확인을 누르시면 임시 데이터가 사진첨부 됩니다.<br /> 
				인터페이스는 소스를 확인해주세요.
			</dd>
		</dl>
	</div>
	<div class="footer">
		<p><a href="#" onclick="closeWindow();" title="닫기" class="close">닫기</a></p>
		<ul>
			<li class="submit"><a href="#" onclick="done();" title="등록" class="btnlink">등록</a> </li>
			<li class="cancel"><a href="#" onclick="closeWindow();" title="취소" class="btnlink">취소</a></li>
		</ul>
	</div>
</div>
</body>
</html>