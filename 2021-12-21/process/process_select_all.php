<!-- 
	index.php인 메인페이지에 DB데이터 전체를 보여주는 코드입니다.
    create by 엄태영 2021.12.16
-->
<?php
include_once('../db/db.php');

function SelectAllUser(){
	$db = db_open();
	$querySelectAllUser = 'SELECT people_id, first_name, last_name, mid_name, address, contact, comment, filename
									FROM t_people
								LEFT JOIN t_file
								ON t_people.people_id = t_file.file_people_id
								ORDER BY people_id 
							DESC';

	$result = que($db, $querySelectAllUser);

	while ($row = mysqli_fetch_array($result)) {
		$tempData["firstName"] = $row['first_name'];
		$tempData["lastName"] = $row['last_name'];
		$tempData["midName"] = $row['mid_name'];
		$tempData["add"] = $row['address'];
		$tempData["ctt"] = $row['contact'];
		$tempData["cmt"] = $row['comment'];
		$tempData["id"] = $row['people_id'];
		$tempData["filename"] = $row['filename'];
		
		$resultData[] = $tempData;
	}
	
	return $resultData;

}


// function SelectAllFiles(){
// 	include('../db/db.php');
// 	$querySelectAllFiles = 'SELECT file_people_id, filename
// 								FROM t_file
// 								ORDER BY file_people_id
// 							DESC';

// 	$result = mysqli_query($conn, $querySelectAllFiles) or die(mysqli_error($conn));

// 	while($row = mysqli_fetch_array($result)){
// 		$tempData["file_people_id"] = $row['file_people_id'];
// 		$tempData["filename"] = $row['filename'];
// 		$fileData[] = $tempData;
// 	}

// }
?>

<script>

/** 
 	index.php인 메인페이지에서 삭제버튼 클릭시 삭제여부를 재확인하는 코드입니다..
	create by 엄태영 2021.12.16
**/
	function delChecking() {
		if (confirm("정말 삭제하시겠습니까??") == true) { //확인
			document.form.submit();
		} else { //취소
			return false;
		}
	}

	
/** 
 	index.php인 메인페이지에서 삭제버튼 클릭시 AJAX를 이용하여 process_del.php로 전송되는 코드입니다.
	create by 엄태영 2021.12.16
**/
	function clkBtn() {
		var form = $('#form1')[0];
		var data = new FormData(form);
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: '../process/process_del.php', // form을 전송할 실제 파일경로
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			success: function(data) {
				// 전송 후 성공 시 실행 코드
				console.log(data);
			},
			error: function(e) {
				// 전송 후 에러 발생 시 실행 코드
				console.log("ERROR : ", e);
			}
		});
	}
</script>