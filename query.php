<?php
	$servername = 'localhost';
	$username   = 'root';
	$password   = '';
	$dbname     = 'experimental_db';
	
	$connection = new mysqli($servername, $username, $password, $dbname);
	global $connection;
	
    $connection->set_charset("utf8");

    # Errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    # Database Manipulation
    function converter($query)
    {
        $arr = array();
        while( $data = $query->fetch_assoc()):
            $arr[] = $data;
        endwhile;
        return $arr;
    }

    function selectAll()
    {
        global $connection;
        $sql    = "SELECT * FROM vip_list ORDER BY id ASC";
        $query  = $connection->query($sql);
        $result = converter($query);
        return $result;
    }

    $arr = [];
    foreach(selectAll() as $data) :
        $arr[] = [
            $data['id'],
            $data['name'],
            $data['surname'],
            $data['email'],
        ];
    endforeach;

    echo json_encode(
        [
            'data' => $arr,
        ]
    );
?>