<?php

  //on inclut la librairie necessaire pour mettre en place le webservice
  require_once("../nusoap-0.9.5/lib/nusoap.php");
  //on initialise un nouvel objet serveur
  $server = new nusoap_server();
  // on configure en donnant un nom et un Namespace
  $server -> configureWSDL('ZeMenuWebService','ZeMenu');
  //on spécifie l'emplacement du namespace
  $server -> wsdl->schemaTargetNamespace = 'http://ZeMeu';


    //on enregistre la méthode grâce à register()
    $server->register('ReturnChaine',array('ChaineString'=>'xsd:string'),
    array('return'=>'xsd:string'),'Namespace');

    //nous créons ici la fonction ReturnChaine() qui correspond à la méthode créée
    function ReturnChaine($ChaineString) {
       return new soapval('return','string',$ChaineString);
    }

    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);


    // première étape : désactiver le cache lors de la phase de test
    ini_set("soap.wsdl_cache_enabled", "0");

    // on indique au serveur à quel fichier de description il est lié
    $serveurSOAP = new SoapServer('HelloYou.wsdl');

    // ajouter la fonction getHello au serveur
    $serveurSOAP->addFunction('getHello');

    // lancer le serveur
    if ($_SERVER['REQUEST_METHOD'] == 'POST')

    {
    	$serveurSOAP->handle();
    }
    else
    {
    	echo 'désolé, je ne comprends pas les requêtes GET, veuillez seulement utiliser POST';
    }

    function getHello($prenom, $nom)
    {
    	return 'Hello ' . $prenom . ' ' . $nom;
    }

  ?>
