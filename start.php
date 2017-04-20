<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Remember the Cow</title>
		<link href="cow.css" type="text/css" rel="stylesheet" />
		<link href="favicon.ico" type="image/ico" rel="shortcut icon" />
	</head>

	<body>
		<div class="headfoot">
			<h1>
				<img src="logo.gif" alt="logo" />
				Remember<br />the Cow
			</h1>
		</div>

		<div id="main">
			<p>
				The best way to manage your tasks. <br />
				Never forget the cow (or anything else) again!
			</p>

			<p>
				Log in now to manage your to-do list. <br />
				If you do not have an account, one will be created for you.
			</p>


			<?php
			//eror information
				if(isset($_GET["error"])) {
					echo "<span id='error'>Username must be 3-8 characters, begin with a lowercase letter and consist of lowercase letters and numbers!</span>";
					echo "<br>";
					echo "<br>";
					echo "<span id='error'>Password must be 6-12 characters, begin with a number and end with any character that is not a letter or a number!</span>";
					echo "<br>";
					echo "<br>";
					echo "<span id='error'>To create a new account just enter valid user credentials.</span>";
					echo "<br>";
					echo "<br>";
				}
			//login form
			?>
			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

			//login cookie displaying lost login time info
      <?php
      echo ("<p>");
      if(isset($_COOKIE["last_login"])){
        echo "<em>(last login from this computer was " . $_COOKIE["last_login"] . ")</em>";
      } else {
        echo "<em>(last login from this computer was UNKNOWN)</em>";
      }
			echo ("</p>");


      ?>
		</div>

		<div class="headfoot">
			<p>
				<q>Remember The Cow is nice, but it's a total copy of another site.</q> - PCWorld<br />
				All pages and content &copy; Copyright CowPie Inc.
			</p>

		</div>
	</body>
</html>
