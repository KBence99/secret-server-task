<?php

use function PHPUnit\Framework\assertTrue;

    include "./src/sql/SQLMain.php";
    include "./src/sql/SQLConnection.php";

    class SQLMainTest extends PHPUnit\Framework\TestCase{

        function test_InsertSecret(){
            
            $conn = SQLConnect();
            SQLQuery($conn,SQLDeleteHashRequest("db75fbdf810b26ee51bf2e8be1b8fbba"));
            SQLCloseConnection($conn);

            $secret = new PostSecretDTO();
            $secret->simpleInit("There is no meaning to life",2,0);

            $uploadedSecret = insertSecret($secret);

            $secret->secret = decipher($secret->secret,5);

            $inserted = $secret->secret == $uploadedSecret->secretText AND $secret->expiresAfterViews == $uploadedSecret->remainingViews;

            assertTrue($inserted);
        }

        function test_InsertDuplicate(){

            $secret = new PostSecretDTO();
            $secret->simpleInit("There is no meaning to life",2,0);

            $uploadedSecret = insertSecret($secret);

            $isNull = is_null($uploadedSecret);

            assertTrue($isNull);
        }
        
        function test_Selection(){
            $requestedSecret = requestSecret("db75fbdf810b26ee51bf2e8be1b8fbba");
            $secret = new SecretDTO(["db75fbdf810b26ee51bf2e8be1b8fbba","Ymjwj nx st rjfsnsl yt qnkj",["asd"],["asd"],0]);

            $areEqual = $requestedSecret->hash == $secret->hash
                    AND $requestedSecret->secretText == $secret->secretText
                    AND $requestedSecret->remainingViews == $secret->remainingViews;

            assertTrue($areEqual);
        }

        function test_NoMoreTries(){
            $requestedSecret = requestSecret("db75fbdf810b26ee51bf2e8be1b8fbba");

            $isNull = is_null($requestedSecret);

            assertTrue($isNull);
        }
    }

?>