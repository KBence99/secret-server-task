<?php

    /**
     * Class representing a secret receieved from the SQL database
     */
    class SecretDTO{
        public $hash;
        public $secretText;
        public $createdAt;
        public $expiresAt;
        public $remainingViews;

        function __construct($record)
        {
            $this->hash = $record[0];
            $this->secretText = $record[1];
            $this->createdAt = $record[2];
            $this->expiresAt = $record[3];
            $this->remainingViews = intval($record[4]);
        }

        function __toString()
        {
            return "hash: ".$this->hash." - secretText: \"".$this->secretText."\" - createdAt: ".$this->createdAt." - expiresAt: ".$this->expiresAt." - remainingViews: ".$this->remainingViews;
        }

        /**
        * Generats a JSON string from fields
        */
        function toJson(){
            $data = ["hash" => $this->hash,
            "secretText" => $this->secretText,
            "createdAt" => $this->createdAt,
            "expiresAt" => $this->expiresAt,
            "remainingViews" =>$this->remainingViews];

            return json_encode($data);
        }

        /**
        * Generats an XML string from fields
        */
        function toXML(){
            return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
            <Secret>
                <hash>".$this->hash."</hash>
                <secretText>".$this->secretText."</secretText>
                <createdAt>".$this->createdAt."</createdAt>
                <expiresAt>".$this->expiresAt."</expiresAt>
                <remainingViews>".$this->remainingViews."</remainingViews>
            </Secret>";
        }
    }

?>