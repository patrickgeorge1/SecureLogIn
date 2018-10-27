<?php

	class func {

		public static function checkLoginState($dbh) {
			 
			 if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])) 
			 {

			 	session_start();
			 }

			 if (isset($_SESSION['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])
			) {

			 	$query = "SELECT * FROM sessions WHERE session_userid = :userid AND session_token = :token AND session_serial = :serial";



			 	$userid = $_COOKIE['userid'];
			 	$token = $_COOKIE['token'];
			 	$serial = $_COOKIE['serial'];

			 	$stmt = $dbh-> prepare($query);
			 	$stmt->execute(array(':userid' => $userid, ':token' => $token, ':serial' => $serial));

			 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
			 	if ($row['session_userid'] > 0) {

			 		if (
			 			$row['session_userid'] == $_COOKIE['userid'] &&
			 			$row['session_token'] == $_COOKIE['token'] &&
			 			$row['session_serial'] == $_COOKIE['serial']
			 		) {

			 			if (
			 				$row['session_userid'] == $_SESSION['userid'] &&
			 				$row['session_token'] == $_SESSION['token'] &&
			 				$row['session_serial'] == $_SESSION['serial']
			 			) {

			 				return true;
			 			}
			 			else 
			 			{
			 			func::createSession($_COOKIE['username'], $_COOKIE['userid'], $_COOKIE['token'], $_COOKIE['serial']);
						return true;
			 			}
			 		}
			 	}





			 }

		}

		public static function createRecord($dbh, $user_username, $user_id)
		{
			$query = "INSERT INTO sessions (session_userid, session_token, session_serial) VALUES (:user_id, :token, :serial);";
			$dbh->prepare("DELETE FROM sessions WHERE session_userid= :session_userid;")->execute(array(':session_userid' => $user_id));

			$token = func::createString(30);
			$serial = func::createString(30);


			func::createCookie($user_username, $user_id, $token, $serial);
			func::createSession($user_username, $user_id, $token, $serial);

			$stmt = $dbh->prepare($query);
			$stmt->execute(array(':user_id' => $user_id, ':token' => $token, ':serial' => $serial));


		}

		public static function createCookie($user_username, $user_id, $token, $serial)
		{
			setcookie('userid', $user_id, time() + (86400) * 30, "/");
			setcookie('username', $user_username, time() + (86400) * 30, "/");
			setcookie('token', $token, time() + (86400) * 30, "/");
			setcookie('serial', $serial, time() + (86400) * 30, "/");
		}


		public static function createSession($user_username, $user_id, $token, $serial)
		{
			if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']))
			{
				session_start();
			}
			$_SESSION['userid'] = $user_id;
			$_SESSION['token'] = $token;
			$_SESSION['serial'] = $serial;
			$_SESSION['username'] = $user_username;



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