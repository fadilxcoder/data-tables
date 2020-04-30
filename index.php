<?php
	$servername = '';
	$username   = '';
	$password   = '';
	$dbname     = '';
	
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
?>
<html>
    <head>
        <title>DATA TABLES</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable({
                    // "searching": false,
                    // "ordering": false
                    // "order": [[ 3, "asc" ]], // ORDER by column
                    "pageLength": 5,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                    }
                });
            });
        </script>
        <style>
            th, td{
                text-align: center !important;
            }
        </style>
    </head>
    <body>
        <table id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>SURNAME</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach(selectAll() as $data) : ?>
                <tr>
                    <td><?php echo $data['id'] ?></td>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $data['surname'] ?></td>
                    <td><?php echo $data['email'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>