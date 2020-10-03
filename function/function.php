<?php
function isNavigation($key)
{
	return ($key === $_REQUEST['route']) ? 'active' : '';
}

function loadView($uri, $aData = [])
{
	$file = "src/View/" . $uri . ".php";
	if (file_exists($file)) {
		include $file;
	} else {
		printf('This file %s does not exist', $uri);
	}
}

// xac nhan truy van co so du lieu
function confirmQuery($con, $res, $que)
{
	if (empty($res)) {
		die("Query: {$que} \n<br/>  Error: " . mysqli_error($con));
	}
}

// truy van co so du lieu, xac nhan lenh truy van co thuc hien khong -> roi tra ve ket qua
function resultQuery($con, $que)
{
	$res = mysqli_query($con, $que);
	confirmQuery($con, $res, $que);
	return $res;
}