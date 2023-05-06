<?php

use function PHPUnit\Framework\assertEquals;

    include "./src/DTO/postDTO.php";

    final class postDTOTest extends PHPUnit\Framework\TestCase{

        public function test_constructor(){
            
            $input = "/secret?secret=There%20is%20no%20meaning%20to%20life&expireAfterViews=0&expireAfter=0";

            $dto = new PostSecretDTO();
            $dto->parsePath($input);

            $expected = "secret: There is no meaning to life - expiresAfterViews: 0 - expiresAfter: 0";

            assertEquals($expected, $dto->__toString());
        }
    }

?>