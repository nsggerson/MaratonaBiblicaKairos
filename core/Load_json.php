<?php

namespace Core;


trait Load_json
{

    public function loadQuestion()
    {
        try {
            if (file_exists('../storage/repository/json/call.php')) {
                $c = require_once __DIR__ . "/../storage/repository/json/call.php";
                $question = require_once __DIR__ . "/../storage/repository/json/" . end($c) . ".php";
                return json_encode((object)$question, JSON_PRETTY_PRINT);
            }
            return json_encode((object)['type' => 'error', 'description' => 'File not found'], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return json_encode((object)['mess' => 'error', 'type' => $e], JSON_PRETTY_PRINT);
        }
    }

    public function getGroups()
    {
        if (file_exists('../storage/repository/json/groups.json')) {
            return  file_get_contents("../storage/repository/json/groups.json");
        } else {
            return false;
        }
    }

    public function getShowGroups()
    {
        if (file_exists('../storage/repository/json/showgroups.json')) {
            return  file_get_contents("../storage/repository/json/showgroups.json");
        } else {
            return false;
        }
    }
}
