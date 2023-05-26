<?php

require 'vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;

$hosts = [
    'localhost:9200'
];

$client = ClientBuilder::create()->setHosts($hosts)->build();


function createINDEX()
{
    global $client;

    $params = [
        'index' => 'contacts',
        'body' => [
            'mappings' => [
                'properties' => [
                    'title' => [
                        'type' => 'text'
                    ],
                    'name' => [
                        'type' => 'text'
                    ],
                    'adress' => [
                        'type' => 'text'
                    ],
                    'realAdress' => [
                        'type' => 'text'
                    ],
                    'departement' => [
                        'type' => 'text'
                    ],
                    'country' => [
                        'type' => 'text'
                    ],
                    'tel' => [
                        'type' => 'text'
                    ],
                    'email' => [
                        'type' => 'text'
                    ]
                ]
            ]
        ]
    ];
    $response = $client->indices()->create($params);
    return $response;
}

function deleteINDEX()
{
    global $client;

    $indexParams = ['index' => 'contacts'];
    if ($client->indices()->exists($indexParams)->asBool() == true) {

        $params = ['index' => 'contacts'];
        $response = $client->indices()->delete($params);

        return $response;
    }
}

function readCSV(String $document)
{
    $rows   = array_map('str_getcsv', file($document));
    $header = array_shift($rows);
    $csv    = array();
    foreach ($rows as $row) {
        $csv[] = array_combine($header, $row);
    }
    return $csv;
}

function addCSVinBASE()
{
    global $client;
    $csvArray = readCSV("contacts.csv");

    foreach ($csvArray as $value) {

        $params['body'][] = [
            'index' => [
                '_index' => 'contacts',
            ]
        ];

        $params['body'][] = [
            'title'     => $value["title"],
            'name' => $value["name"],
            'adress' => $value["adress"],
            'realAdress' => $value["realAdress"],
            'departement' => $value["departement"],
            'country' => $value["country"],
            'tel' => $value["tel"],
            'email' => $value["email"],
        ];
    }

    return $client->bulk($params);
}


deleteINDEX();
createINDEX();
addCSVinBASE();
