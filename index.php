<?php

    require "src/SQL/SQLMain.php";
    require "src/SQL/SQLConnection.php";
    require "src/SQL/SQLRequests.php";

    require "src/DTO/postDTO.php";
    require "src/DTO/secretDTO.php";

    require "src/cypher/cypher.php";



    $path = htmlspecialchars($_SERVER['REQUEST_URI']);
    $method =  $_SERVER['REQUEST_METHOD'];

    $accept = "";
    foreach (getallheaders() as $name => $value) {
        if($value == "application/json" or "application/xml" and $name == "Accept"){
            $accept = $value;
            break;
        }
    }

    if(preg_match("/\/secret\?/",$path) AND $method == "POST")
    {
        $secret = new PostSecretDTO();
        $secret->parsePath($path);
        $dto = insertSecret($secret);
        if(is_null($dto)){
            http_response_code(405); exit;
        }
    }
    elseif(preg_match("/\/secret\/./",$path) AND $method == "GET"){
        $key = explode("secret/",$path)[1];
        $dto = requestSecret($key);
        if(is_null($dto)){
            http_response_code(404); exit;
        }
    }
    else{
        echo "No mathcing function";
        exit;
    }

    if($accept == "application/xml"){
        header('Content-Type: application/xml; charset=utf-8');
        echo $dto->toXML();
    }
    else{
        header('Content-Type: application/json; charset=utf-8');
        echo $dto->toJson();
    }
    http_response_code(200); exit;
?>