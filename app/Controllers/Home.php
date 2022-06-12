<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$created_time = \date_create('2022-06-12 00:00:22');
		\date_add($created_time, \date_interval_create_from_date_string('2 hours'));
		$date_input =  \date_format($created_time, 'Y-m-d H:i:s');
		echo $date_input;
		// $now = \strtotime(date('Y-m-d H:i:s'));
		// if ($created_time > $now) {
		// 	echo 'waktu habis';
		// } else {
		// 	echo 'waktu masih';
		// }
	}

	//--------------------------------------------------------------------

}
