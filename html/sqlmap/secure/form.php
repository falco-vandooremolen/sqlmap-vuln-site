<?php
session_start();

if(!isset($_SESSION['authorized']) && $_SESSION['authorized'] !== true) {
    header("Location: ./login.php", 401, true); exit;
}

require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/vendor/autoload.php");

$connector = new My\DB("myTestDb");

if (isset($_POST['secret_token'])) {

    if ($_POST['secret_token'] === $_SESSION['anticsrf_token']) {
        $query = "SELECT * FROM users WHERE id=" . $_POST['id'] . " LIMIT 0, 1";
        $connector->getConnector()->query($query);
    }
}

function generate_secret_token()
{
    return hash('sha256', uniqid(time()));
}
$antiCsrfToken = generate_secret_token();
$_SESSION['anticsrf_token'] = $antiCsrfToken;

?>
<h1>Form CSRF protected</h1>
<form method="post">
    <input type="text" name="id">
    <input type="hidden" name="secret_token" value="<?= $antiCsrfToken; ?>">
    <input type="submit" value="Submit">
</form>