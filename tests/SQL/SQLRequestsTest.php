<?php

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

    include "./src/sql/SQLRequests.php";

    class SQLRequestsTest extends PHPUnit\Framework\TestCase{
        function test_SQLInsertRequest(){

            $secret = new PostSecretDTO();
            $secret->simpleInit("There is no meaning to life",0,0);

            $expected = SQLInesrtRequest($secret);
            $actual = "INSERT INTO secret_table (hash, secretText, expiresAt, remainingViews) VALUES (MD5(\"There is no meaning to life\"),\"There is no meaning to life\",DATE_ADD(NOW(), INTERVAL 0 MINUTE),0)";

            assertEquals($expected, $actual);
        }
        
        function test_SQLSelectSecretRequest(){
            $secret = "There is no meaning to life";
            
            $actual = SQLSelectSecretRequest($secret);
            $expected = "SELECT * FROM secret_table WHERE hash = MD5(\"There is no meaning to life\")";

            assertEquals($expected, $actual);
        }
    
        function test_SQLSelectHashRequest(){

            $hash = "asd";

            $actual = SQLSelectHashRequest($hash);
            $expected = "SELECT * FROM secret_table WHERE hash = \"".$hash."\"";

            assertEquals($expected, $actual);
        }
    
        function test_SQLUpdateRemainingRequest(){

            $hash = "asd";

            $actual = SQLUpdateRemainingRequest($hash);
            $expected = "UPDATE secret_table SET remainingViews = remainingViews-1 WHERE hash = \"".$hash."\"";

            assertEquals($expected, $actual);
        }
    
        function test_SQLDeleteHashRequest(){

            $hash = "asd";

            $actual = SQLDeleteHashRequest($hash);
            $expected = "DELETE FROM secret_table WHERE hash=\"".$hash."\"";

            assertEquals($expected, $actual);
        }
    
        function test_SQLDeleteDataRequestTest(){

            $hash = "asd";

            $actual = SQLDeleteDateRequest($hash);
            $expected = "DELETE FROM secret_table WHERE hash=\"".$hash."\" AND expiresAt < NOW() AND expiresAt != createdAt";;

            assertEquals($expected, $actual);
        }

    }

?>