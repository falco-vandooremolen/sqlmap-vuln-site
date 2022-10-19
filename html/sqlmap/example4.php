<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/vendor/autoload.php");

/**
 * @var \PDO $connector
 */
$connector = new My\DB("myTestDb");

if (isset($_POST['search'])) {
    $query1 = $connector->getConnector()->prepare("INSERT INTO `searches` SET `searchkey` = :search, `date` = :date");
    $query2 = $connector->getConnector()->prepare("SELECT `date` FROM `searches` WHERE `searchkey` = :search ORDER BY `date` DESC LIMIT 1");
    
    $query1->execute(
        [
            ":search" => $_POST['search'], 
            ":date" => date("Y-m-d H:i:s")
        ]);
    $result = $query2->execute([":search" => $_POST['search']]);
}

?>
<style>
    i {
        font-family: 'DeJaVu Sans Mono';
    }
</style>
<h1>My search App</h1>
<h2>SQL injection solved with PDO param binding (clean string)</h2>
<form method="post">
    <input type="text" name="search" style="width: 100%" placeholder="Search..." />
    <input type="submit" name="submitBtn" value="Search" />
</form>

<?php if (isset($_POST['search'])): ?>
    <hr />
    Last search on this term (<?= $_POST['search'] ?>) was <?= $query2->fetchAll()[0]['date'] ?>

<?php endif; ?>
<hr />
SQLMap Steps
<ol>
    <li>Scan for vulnerable forms <i>./sqlmap.py -u http://localhost:666/sqlmap/example4.php --forms --batch --flush-session</i></li>
    <li>Increase risk + level AND define posible DB engine <i>./sqlmap.py -u http://localhost:666/sqlmap/example4.php --forms --risk=3 --dbms=mysql --batch --flush-session</i></li>
</ol>
<?php include('index.php');?>