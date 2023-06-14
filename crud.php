<?php

use Elastic\Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$hosts = [
    'localhost:9200'
];


$client = ClientBuilder::create()->setHosts($hosts)->build();

function createRecord($data)
{
    global $client;

    $params = [
        'index' => 'contacts',
        'body' => $data
    ];

    $response = $client->index($params);

    return $response;
}

function getRecord($id)
{
    global $client;

    $params = [
        'index' => 'contacts',
        'id' => $id
    ];

    $response = $client->get($params);

    return $response;
}

function updateRecord($id, $data)
{
    global $client;

    $params = [
        'index' => 'contacts',
        'id' => $id,
        'body' => [
            'doc' => $data
        ]
    ];

    $response = $client->update($params);

    return $response;
}

function deleteRecord($id)
{
    global $client;

    $params = [
        'index' => 'contacts',
        'id' => $id
    ];

    $response = $client->delete($params);

    return $response;
}

function testCRUD()
{
    $data = [
        'title' => 'title',
        'name' => 'name',
        'adress' => 'adress',
        'realAdress' => 'realAdress',
        'departement' => 'departement',
        'country' => 'country',
        'tel' => 'tel',
        'email' => 'email'
    ];

    $doc = createRecord($data);
    $id = $doc['_id'];
    echo "Document créé avec l'ID : $id\n";

    $document = getRecord($id);
    print_r($document['_source']);

    $dataToUpdate = [
        'title' => 'new title',
        'name' => 'new name',
        'adress' => 'new adress',
        'tel' => 'new tel',
    ];

    $updateResponse = updateRecord($id, $dataToUpdate);
    echo "update ? : " . ($updateResponse['result'] == 'updated' ? 'yes' : 'nop') . "\n";

    $updatedDocument = getRecord($id);
    print_r($updatedDocument['_source']);

    $deleteResponse = deleteRecord($id);
    echo "delete ? : " . ($deleteResponse['result'] == 'deleted' ? 'yes' : 'no') . "\n";
}


testCRUD();