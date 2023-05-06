<?php 
    /**
     * Requests a secret record from the SQP database and returns it
     */

    function requestSecret(string $hash)
    {
        $conn = SQLConnect();

        checkSecretTime($conn, $hash);

        $request = SQLSelectHashRequest($hash);
        $result = $conn->query($request);

        if ($result->num_rows > 0) {

            $record = $result->fetch_row();

            $secret = new SecretDTO($record);

            $secret->secretText = decipher($secret->secretText,5);

            if($secret->remainingViews-1 == 0){
                SQLQuery($conn,SQLDeleteHashRequest($secret->hash));
                SQLCloseConnection($conn);
                return null;
            }
            elseif($secret->remainingViews != 0){
                SQLQuery($conn,SQLUpdateRemainingRequest($secret->hash));
                $secret->remainingViews -= 1;
            }
            SQLCloseConnection($conn);
            return $secret;
        }
        else
        {
            SQLCloseConnection($conn);
            return null;
        }
    }

    /**
     * Inserts a new secret into the database then returns a DTO of it
     */

    function insertSecret(PostSecretDTO $postSecret)
    {
        $conn = SQLConnect();

        $postSecret->secret = encipher($postSecret->secret,5);

        $sql = SQLInesrtRequest($postSecret);
        
        $result = false;

        try{
            $result = SQLQuery($conn, $sql);
        }
        catch (Exception $e){

        }

        if ($result)
        {
            $request = SQLSelectSecretRequest($postSecret->secret);
            $result = SQLQuery($conn,$request);
            $record = $result->fetch_row();

            $secret = new SecretDTO($record);
            $secret->secretText = decipher($secret->secretText,5);

            SQLCloseConnection($conn);
            return $secret;
        }
        else
        {
            SQLCloseConnection($conn);
            return null;
        }
    }

    /**
     * Checks if the secret should be deleted based on datetime
     */

    function checkSecretTime(mysqli $conn ,string $hash){
        $request = SQLDeleteDateRequest($hash);
        SQLQuery($conn, $request);
    }
?>