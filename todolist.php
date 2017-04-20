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

			<?php
				include('common.php');
				header('Cache-Control: no-cache, no-store, must-revalidate');
				session_start();
				//check if user is login and redirect to start if they are not
				if(!isset($_SESSION["username"])){
					session_destroy();
					header('Location: start.php');
				  exit();
				}

				//display username
				echo ("<h2>" . $_SESSION["username"] . "'s To-Do List</h2>");
				//fetch query data
				$list_items = getListItems($_SESSION["username"], $db);
				$list_items_info = $list_items->fetchAll();

				//display users to do list
				echo ("<ul id='todolist'>");
				if (!empty($list_items_info)) {
					foreach ($list_items_info as $item) {
						echo ("<li>");
							echo ("<form action='submit.php' method='post'>");
								echo ("<input type='hidden'' name='action' value='delete' />");
								echo ("<input type='hidden' name='id' value='" . $item['id'] . "' />");
								echo ("<input type='submit' value='Delete' />");
							echo ("</form>");
							echo ($item['item']);
						echo ("</li>");
					}
				}

				//form to add new item to to do list
				echo ("<li>");
					echo ("<form action='submit.php' method='post'>");
						echo ("<input type='hidden'' name='action' value='add' />");
						echo ("<input name='item' type='text' size='25' autofocus='autofocus' />");
						echo ("<input type='submit' value='Add' />");
					echo ("</form>");
				echo ("</li>");
				echo ("</ul>");

			//logout button
			echo("<div>");
			echo("<a href='logout.php'><strong>Log Out</strong></a>");
			echo("<em>(logged in since " . $_COOKIE["last_login"] . "</em>");
			echo("</div>");

			?>

		</div>

		<div class="headfoot">
			<p>
				&quot;Remember The Cow is nice, but it's a total copy of another site.&quot; - PCWorld<br />
				All pages and content &copy; Copyright CowPie Inc.
			</p>


		</div>
	</body>
</html>
