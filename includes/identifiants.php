<?php
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=forum', 'root', 'root');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>
	