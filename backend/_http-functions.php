<?php

// TODO: Add http headers on the response
function httpSuccess($body) {
    echo json_encode([
        "success" => true,
        "data" => $body,
    ]);
}

function httpError($body) {
    echo json_encode([
        "success" => false,
        "data" => $body,
    ]);
}
