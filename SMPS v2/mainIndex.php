<?php 

require_once('Smarty-3.1.21/libs.class.php');

$smarty = new smarty();
$smarty->template_dir = 'views';
$smarty->complie_dir = 'tmp';

$smarty->display('login.php')

?>