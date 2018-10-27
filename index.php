<?php
	
	include_once("header.php");


?>

<section class="parent">
	<div class="child">
		
		<?php

			if (func::checkLoginState($dbh)) {

				echo 'Welcome' . $_SESSION['username'] . '!';

			}
			else {

				header("location:login.php");
			}

		?>
		
	</div>
</section>


<?php
	
	include_once("footer.php");

 
?>
