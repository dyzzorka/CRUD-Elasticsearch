<?php

require 'vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;

$hosts = [
    'localhost:9200'
];

$client = ClientBuilder::create()->setHosts($hosts)->build();

function createDocument($index, $type, $id, $data)
{
    global $client;
    
    $params = [
        'index' => $index,
        'type' => $type,
        'id' => $id,
        'body' => $data
    ];
    
    $response = $client->index($params);
    
    return $response;
}

function getDocument($index, $type, $id)
{
    global $client;
    
    $params = [
        'index' => $index,
        'type' => $type,
        'id' => $id
    ];
    
    $response = $client->get($params);
    
    return $response;
}

function updateDocument($index, $type, $id, $data)
{
    global $client;
    
    $params = [
        'index' => $index,
        'type' => $type,
        'id' => $id,
        'body' => [
            'doc' => $data
        ]
    ];
    
    $response = $client->update($params);
    
    return $response;
}

function deleteDocument($index, $type, $id)
{
    global $client;
    
    $params = [
        'index' => $index,
        'type' => $type,
        'id' => $id
    ];
    
    $response = $client->delete($params);
    
    return $response;
}

?>
