<?php 
require_once('gateway.php');


function bindParams($sql, $params) {
    $gateway = Gateway::getInstance();
    $stmt = $gateway->dbh->prepare($sql);
    
    foreach ($params as $p => &$v) $stmt->bindParam($p, $v);

    $stmt->execute();
}


?>