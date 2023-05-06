<?php

    /**
     * Class representing a secret received in a post request
     */

    class PostSecretDTO{
        public $secret;
        public $expiresAfterViews;
        public $expireAfter;

        function __construct()
        {

        }

        function __toString()
        {
            return "secret: ".$this->secret." - expiresAfterViews: ".$this->expiresAfterViews." - expiresAfter: ".$this->expireAfter;
        }

        /*
        Retrieves the neccesary informations from an URL with parameters
        */
        function parsePath($path){
            $values = explode("secret?",$path)[1];

            $parameters = explode("&",$values);

            $this->secret = urldecode(explode("=",$parameters[0])[1]);
            $this->expiresAfterViews = explode("=",$parameters[1])[1];
            $this->expireAfter = explode("=",$parameters[2])[1];
        }

        /*
        Initializing a DTO object without parsing a string. Mainly for testing
        */

        function simpleInit($secret, $expiresAfterViews, $expireAfter){
            $this->secret = $secret;
            $this->expireAfter = $expireAfter;
            $this->expiresAfterViews = $expiresAfterViews;
        }
    }

?>