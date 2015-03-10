<?php

class Database{
    private $sDatabaseName;
    private $hDatabase;

    public function __construct($_sDatabaseName){
        $this->sDatabaseName = $_sDatabaseName;
        try{
            $this->hDatabase = new PDO("sqlite:$_sDatabaseName");
            $this->hDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $eError){
            echo $eError->getMessage();
        }
    }

    public function __deconstruct(){
        $this->hDatabase = null;
    }

    public function getDatabase(){
        return($this->hDatabase);
    }

    public function execQuery($_sQuery){
        try {
            $hStatement = $this->hDatabase->query($_sQuery);
            return ($hStatement);
        }
        catch(PDOException $eError){
            echo $eError->getMessage();
        }
        return;
    }
}