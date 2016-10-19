<?php 
require_once('gateway.php');

$gateway = Gateway::getInstance();


$args = array('username', 'password', 'salt', 'hash');

echo "Original Array: <br/>";
print_r($args);
echo "<br/><br/>";



function prefix(&$param) {
    $param = ':'.$param;
}


array_walk($args, 'prefix');

echo "After: <br/>";


function bindParams($sql, $params) {
    $stmt = $gateway->dbh->prepare();
}

?>