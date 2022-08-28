<?php

session_start(); // Start session
session_destroy(); // Hapus semua session
header("location: index.php"); // Redirect ke halaman index.php


?>