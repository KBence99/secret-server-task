<?php

    /**
     * Generats an SQL request for inserting a new secret into the database
     */

    function SQLInesrtRequest(PostSecretDTO $postsecret){
        return "INSERT INTO secret_table (hash, secretText, expiresAt, remainingViews) VALUES (MD5(\"".$postsecret->secret."\"),\"".$postsecret->secret."\",DATE_ADD(NOW(), INTERVAL ".$postsecret->expireAfter." MINUTE),".$postsecret->expiresAfterViews.")";
    }

    /**
     * Generats an SQL request for selecting a secret based on its content
     */

    function SQLSelectSecretRequest(string $secret){
        return "SELECT * FROM secret_table WHERE hash = MD5(\"".$secret."\")";
    }

    /**
     * Generats an SQL request for selecting a secret based on its hashcode
     */

    function SQLSelectHashRequest(string $hash){
        return "SELECT * FROM secret_table WHERE hash = \"".$hash."\"";
    }

    /**
     * Generats an SQL request for updating a secrets remainingViews field
     */

    function SQLUpdateRemainingRequest(string $hash){
        return "UPDATE secret_table SET remainingViews = remainingViews-1 WHERE hash = \"".$hash."\"";
    }

    /**
     * Generats an SQL request for deleting a secret based on its hash
     */

    function SQLDeleteHashRequest(string $hash){
        return "DELETE FROM secret_table WHERE hash=\"".$hash."\"";
    }

    /**
     * Generats an SQL request for deleting a secret based on its hash and expiresAt field
     */

    function SQLDeleteDateRequest(string $hash){
        return "DELETE FROM secret_table WHERE hash=\"".$hash."\" AND expiresAt < NOW() AND expiresAt != createdAt";
    }

    /**
     * Runs an SQL query, might return with boolean or SQL response
     */

    function SQLQuery(mysqli $conn, string $request){
        $result = $conn->query($request);
        return $result;
    }
?>