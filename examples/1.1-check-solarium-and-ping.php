<?php

require('init.php');
htmlHeader();

// check solarium version available
echo 'Solarium library version: ' . Solarium\Version::VERSION . ' - ';

// create a client instance
$client = new Solarium\Client\Client($config);

// create a ping query
$ping = $client->createPing();

// execute the ping query
try{
    $result = $client->ping($ping);
    echo 'Ping query succesful';
    echo '<br/><pre>';
    var_dump($result->getData());
}catch(Solarium\Exception $e){
    echo 'Ping query failed';
}

htmlFooter();