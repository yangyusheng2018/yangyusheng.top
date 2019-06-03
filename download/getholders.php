<?php
require_once ("model.php");
$API = Neostrada::GetInstance();

$API->SetAPIKey('e4de7c57b6cb137a57058adfd92407e1');
$API->SetAPISecret("bysatUpU");
$API->prepare('getholders', array(
    'holderids'	=> '' // By leaving this empty, this command will return all available domain holders.
));
$API->execute();
    $results = $API->fetch();
    var_dump($results);