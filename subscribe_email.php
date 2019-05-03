<?php 
header("Content-type: application/json");
$response = [];
if (isset($_POST['email'])) {
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$data = file_get_contents('data.json');
		$data_arr = json_decode($data);
		if ( ! in_array($_POST['email'], $data_arr)) {
			array_push($data_arr, $_POST['email']);
			file_put_contents('data.json', json_encode($data_arr));
			$response['status'] = 'OK';
		} else {
			$response['status'] = 'FAILED';
			$response['message'] = 'Email sudah terdaftar.';
		}
	} else {
		$response['status'] = 'FAILED';
		$response['message'] = 'Email tidak benar.';
	}
} else {
	$response['status'] = 'FAILED';
	$response['message'] = 'Email belum diisi.';
}
echo json_encode($response);