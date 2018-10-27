<?php

	class func {

		public static function checkLoginState($dbh) {
			 
			 if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])) 
			 {

			 	session_start();
			 }

			 if (isset($_SESSION['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])
			) {

			 	$query = "SELECT * FROM sessions WHERE sessions_userid = :userid AND sessions_token = :token AND sessions_serial = :serial";



			 	$id = $_COOKIE['id'];
			 	$token = $_COOKIE['token'];
			 	$serial = $_COOKIE['serial'];

			 	$stmt = $dbh-> prepare($query);
			 	$stmt->execute(array(':userid' => $userid, ':token' => $token, ':serial' => $serial));

			 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
			 	if ($row['sessions_userid'] > 0) {

			 		if (
			 			$row['sessions_userid'] == $_COOKIE['id'] &&
			 			$row['sessions_token'] == $_COOKIE['token'] &&
			 			$row['sessions_serial'] == $_COOKIE['serial']
			 		) {

			 			if (
			 				$row['sessions_userid'] == $_SESSION['id'] &&
			 				$row['sessions_token'] == $_SESSION['token'] &&
			 				$row['sessions_serial'] == $_SESSION['serial']
			 			) {

			 				return true;
			 			}
			 		}
			 	}





			 }

		}

		public static function createString($len)
		{
			$string = "1257fj38f3n8GJ9DDJ4Hsj602hSHJ927smyGHeo8gEtsu7Ht7ny8H5tht4j9";
			$s = '';
			$r_new = '';
			$r_old = '';

			for ($i=1; $i < $len ; $i++) { 
				while ($r_old == $r_new) 
				{
					
					$r_new = rand(0,60);
				}
				$r_old = $r_new;

				$s = $s.$string[$r_new];
			}

			return $s;
		}
	}
?>