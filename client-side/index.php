<?php
include("../nusoap-0.9.5/lib/nusoap.php");
// première étape : désactiver le cache lors de la phase de test
ini_set("soap.wsdl_cache_enabled", "0");

// lier le client au fichier WSDL

$server_path = "http://127.0.0.1:8000/ZeMenu/server-side/?wsdl";
$clientSOAP = new SoapClient($server_path);

// executer la methode getHello
echo $clientSOAP->getHello('Marc','Assin');

?>
