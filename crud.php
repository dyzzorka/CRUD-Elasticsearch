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
        'title' => 'Titre',
        'name' => 'Nom',
        'adress' => 'Adresse',
        'realAdress' => 'Adresse réelle',
        'departement' => 'Département',
        'country' => 'Pays',
        'tel' => 'Numéro de téléphone',
        'email' => 'Adresse e-mail'
    ];

    $createdDocument = createRecord($data);
    $createdDocumentId = $createdDocument['_id'];
    echo "Document créé avec l'ID : $createdDocumentId\n";

    $document = getRecord($createdDocumentId);
    print_r($document['_source']);

    $dataToUpdate = [
        'title' => 'Nouveau titre',
        'name' => 'Nouveau nom',
        'adress' => 'Nouvelle adresse',
        'tel' => 'Nouveau numéro de téléphone'
    ];

    $updateResponse = updateRecord($createdDocumentId, $dataToUpdate);
    echo "Document mis à jour : " . ($updateResponse['result'] == 'updated' ? 'oui' : 'non') . "\n";

    $updatedDocument = getRecord($createdDocumentId);
    print_r($updatedDocument['_source']);

    $deleteResponse = deleteRecord($createdDocumentId);
    echo "Document supprimé : " . ($deleteResponse['result'] == 'deleted' ? 'oui' : 'non') . "\n";
}


testCRUD();