<?php

	// Koneksi ke database
	$conn = mysqli_connect("localhost", "root", "", "db_web");

	//Cek koneksi
	if(mysqli_connect_errno())
	{
		echo "Koneksi database gagal! : " .mysqli_connect_error();
	}
?>