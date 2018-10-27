<?php

	class func {

		public static function checkLoginState($dbh) {
			 
			 if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])) 
			 {

			 	session_start();
			 }

			 if (isset($_SESSION['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])patrick25
			) {

			 	$id = $_COOKIE['id'];
			 	$token = $_COOKIE['token'];
			 	$serial = $_COOKIE['serial'];

			 	
			 }

		}
	}
?>