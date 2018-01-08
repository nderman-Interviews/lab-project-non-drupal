<?php
require_once __DIR__ . '/../vendor/autoload.php'; // include Composer's autoloader

//creat the client object connected to the mongodb shard
$client = new MongoDB\Client("mongodb://admin:vN9yozMMgMZMHByg@assessment-api-shard-00-00-frufq.mongodb.net:27017,assessment-api-shard-00-01-frufq.mongodb.net:27017,assessment-api-shard-00-02-frufq.mongodb.net:27017/test?ssl=true&replicaSet=assessment-api-shard-0&authSource=admin");

//load the test database
$db = $client->selectDatabase('test');

//check what collections exist in the db
$collectionNames = [];
foreach ($db->listCollections() as $collectionInfo) {
    $collectionNames[] = $collectionInfo->getName();
}

if (!in_array('scores', $collectionNames)) {
//if the scores collection doesnt exist create it

    $result = $db->createCollection('scores', [
        'validator' => [
            'id'        => ['$type' => 'int'],
            'title'     => ['$type' => 'string'],
            'score'     => ['$type' => 'double'],
            'timestamp' => ['$type' => 'int'],

        ],
    ]);
}
