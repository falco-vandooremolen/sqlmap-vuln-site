<?php

if(isset($_POST['login'])) {
    session_start();
    $_SESSION['authorized'] = true;
    
    header('Location: form.php');
} else {
    session_start();
    $_SESSION = [];
}
?>
<form method="post"><input type="submit" name="login" value="login"/></form>