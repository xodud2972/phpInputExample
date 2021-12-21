<!-- 
	edit.php, select.php 에서 해당 게시글에 데이터를 보여주는 코드입니다.
    create by 엄태영 2021.12.16
-->
<?php

include('../db/db.php');

$id = $_GET['id'];

$querySelectOneUser = sprintf(
    'SELECT first_name, last_name, mid_name, address, contact, comment 
        FROM t_people
    WHERE
        people_id = %d',
    $id
);

$result = mysqli_query($conn, $querySelectOneUser) or die(mysqli_error($conn));

$row = mysqli_fetch_array($result);

$firstName = $row['first_name'];
$lastName = $row['last_name'];
$mid_Name = $row['mid_name'];
$ads = $row['address'];
$ctt = $row['contact'];
$cmt = $row['comment'];
?>