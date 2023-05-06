<?Php

use function PHPUnit\Framework\assertEquals;

    include "./src/Cypher/cypher.php";

    final class CypherTest extends PHPUnit\Framework\TestCase{
            
        public function test_encode(){
            $unencoded = "abcdefg";

            $encoded_function = Encipher($unencoded, 5);
            $encoded_actual = "fghijkl";

            assertEquals($encoded_function, $encoded_actual);
        }

        public function test_decode(){
            $original = "abcdefg";

            $encoded = Encipher($original, 5);
            $decoded = Decipher($encoded,5);

            assertEquals($original, $decoded);
        }
    }

?>