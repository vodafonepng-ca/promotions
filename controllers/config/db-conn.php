<?php
    require 'db-config.php';

    function connect($host, $db, $user, $password)
    {
	$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

	try {
		$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $dbconn=new PDO($dsn, $user, $password, $options);
		$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return  $dbconn;
		
	} catch (PDOException $e) {
		return($e->getMessage());
	}
}

return connect($server, $db, $user, $pass);

