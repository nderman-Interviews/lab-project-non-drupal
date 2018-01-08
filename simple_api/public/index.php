<?php

require_once __DIR__ . '/../src/functions.php';
require_once __DIR__ . '/../src/db_config.php';

function validate($json)
{
    return true;
}

// GET request to /users
router('GET', '^/simple-api/score$', function () {
    global $db;

    $score = $db->scores->find(); //find all scores

    echo json_encode(iterator_to_array($score));
});

// With named parameters
router('GET', '^/simple-api/score/(?<id>\d+)$', function ($params) {
    global $db;
    $score = $db->scores->findOne(['id' => (int) $params['id']]); //find the score with id matching param

    echo json_encode($score);

});

// POST request to /users
router('POST', '^/simple-api/score$', function () {
    header('Content-Type: application/json');
    global $db;

    $scores = $db->scores;

    $json = json_decode(file_get_contents('php://input'), true);

    try {
        $insertOneResult = $scores->insertOne($json);
        echo json_encode(['result' => $insertOneResult->getInsertedCount()]);

    } catch (Exception $e) {
        echo json_encode(['result' => 0]);

    }

});

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';
