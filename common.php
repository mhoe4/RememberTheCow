<?php

	//database connection information
	$dsn = 'mysql:dbname=mysql;host=localhost;port=3306';
	$user = 'root';
	$pword = '';

	//database connection
	try {
		$db = new PDO($dsn, $user, $pword);
	} catch (PDOException $e) {
    	die("Could not connect to the database:" . $e->getMessage());
	}

	//removes special charachters from strings
	function clean($string) {
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}

  //verifies username and password
  function verifyCredentials($cowname, $cowpassword, $db) {
    $sql = "SELECT COUNT(*) count FROM cowusers "
        . "WHERE username = '" . $cowname . "' AND "
        . "password = '" . $cowpassword . "'";
    return $db->query($sql);
  }

	//verifies if username exists
	function verifyUsername($cowname, $db) {
    $sql = "SELECT COUNT(*) count FROM cowusers "
        . "WHERE username = '" . $cowname . "'";
    return $db->query($sql);
  }

	//adds username and password to users
	function addUser($cowname, $cowpassword, $db) {
    $sql = "INSERT INTO cowusers (username, password) VALUES ('" . $cowname .  "', '" . $cowpassword . "')";
    $db->query($sql);
	}

  //queries all list items from todo table
  function getListItems($cowname, $db) {
    $sql = "SELECT * FROM todo WHERE username = '" . $cowname . "'";
    return $db->query($sql);
  }

	//inserts list item into todo table
	function addListItem($listItem, $cowname, $db) {
    $sql = "INSERT INTO todo (item, username) VALUES ('" . $listItem .  "', '" . $cowname . "')";
    $db->query($sql);
	}

  //delete list item into todo table
	function deleteListItem($id, $db) {
    $sql = "DELETE FROM todo WHERE id = " . $id;
    $db->query($sql);
	}

	//check username for correct regex
	function validateNameChars($cowname) {
		if (strlen($cowname)>=3 && strlen($cowname)<=8) {
			return preg_match('/^([a-z])+[a-z\d]+$/', $cowname);
		} else {
			return false;
		}
	}

	//check password for correct regex
	function validatePassChars($cowpassword) {
		if (strlen($cowpassword)>=6 && strlen($cowpassword)<=12) {
			return preg_match('/^([\d])+[a-zA-Z\d\!\@\#\$\%\^\&\*\(\)\_\-\+\=\|\\\"\`\~\{\[\]\}\,\.]+([\!\@\#\$\%\^\&\*\(\)\_\-\+\=\|\\\"\`\~\{\[\]\}\,\.])+$/', $cowpassword);
		} else {
			return false;
		}
	}

?>
