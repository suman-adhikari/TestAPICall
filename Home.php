<?php
/**
 * Created by PhpStorm.
 * User: Suman
 * Date: 2/2/2016
 * Time: 12:27 PM
 */

class Home {

    public function __construct(){

    }

    public $view;
    public $repo;

    public $server = '192.168.0.145';
    public $Username= 'root';
    public $Password = '';
    public $DatabaseName = 'icb_broadcaster';

    public function con(){
        $db = new \PDO("mysql:host=$this->server;dbname=$this->DatabaseName",$this->Username,$this->Password);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public function GetMsisdn($name){
        $sql = $this->con()->query("Select msisdn from FileBroadcastSubsList where ListId=(select Id from FileBroadcastSubsDetails where ListName='$name') limit 100");
        $result = $sql->fetchAll();
        return $result;
    }


    public function Index(){

        $listName = "ORGT001_11";
        $method='hello';
        $format = $_GET["format"];
        $result = $this->GetMsisdn($listName);
        //var_dump($result);exit;
        foreach($result as $row ) {
                $msisdn = $row["msisdn"];
                $ch = curl_init("http://localhost:100/TestAPI/?method=$method&format=$format&data=$msisdn"); // URL of the call
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array());
                // execute the api call
                session_write_close();
                $result = curl_exec($ch);
                echo $result . "<br>";
            // print_r(json_decode($result, true));
        }
    }

} 