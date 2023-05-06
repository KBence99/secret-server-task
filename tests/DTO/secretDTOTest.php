<?php

use function PHPUnit\Framework\assertEquals;

    include "./src/DTO/secretDTO.php";

    class secretDTOTest extends PHPUnit\Framework\TestCase{
        function test_constructor(){
            $input = ["asd","There is no secret to life","today","tomorrow",0];
            
            $secret = new SecretDTO($input);

            $expected = "hash: asd - secretText: \"There is no secret to life\" - createdAt: today - expiresAt: tomorrow - remainingViews: 0";

            assertEquals($expected, $secret->__toString());
        }

        function test_toJson(){
            $input = ["asd","There is no secret to life","today","tomorrow",0];

            $dto = new SecretDTO($input);

            $expected = "{\"hash\":\"asd\",\"secretText\":\"There is no secret to life\",\"createdAt\":\"today\",\"expiresAt\":\"tomorrow\",\"remainingViews\":0}";

            assertEquals($expected, $dto->toJson());
        }

        function test_toxml(){
            $input = ["asd","There is no secret to life","today","tomorrow",0];

            $dto = new SecretDTO($input);

            $expected = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
            <Secret>
                <hash>asd</hash>
                <secretText>There is no secret to life</secretText>
                <createdAt>today</createdAt>
                <expiresAt>tomorrow</expiresAt>
                <remainingViews>0</remainingViews>
            </Secret>";

            assertEquals($expected, $dto->toXML());
        }
    }

?>