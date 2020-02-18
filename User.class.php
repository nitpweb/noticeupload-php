<?php

class User
{
    private $dbHost     = 'localhost';
    private $dbUsername = 'root';
    private $dbPassword = '12345';
    private $dbName     = 'googleSign';
    private $userTbl    = 'users'; 

    function __construct()
    {
        if (!isset($this->db)) {
            // Connect to the database 
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    function checkUser($data = array())
    {
        if (!empty($data)) {
            // Check whether the user already exists in the database 
            $checkQuery = "SELECT * FROM " . $this->userTbl . " WHERE oauth_provider = '" . $data['oauth_provider'] . "' AND oauth_uid = '" . $data['oauth_uid'] . "'";
            $checkResult = $this->db->query($checkQuery);

            // Add modified time to the data array 
            if (!array_key_exists('modified', $data)) {
                $data['modified'] = date("Y-m-d H:i:s");
            }

            if ($checkResult->num_rows > 0) {
                // Prepare column and value format 
                $colvalSet = '';
                $i = 0;
                foreach ($data as $key => $val) {
                    $pre = ($i > 0) ? ', ' : '';
                    $colvalSet .= $pre . $key . "='" . $this->db->real_escape_string($val) . "'";
                    $i++;
                }
                $whereSql = " WHERE oauth_provider = '" . $data['oauth_provider'] . "' AND oauth_uid = '" . $data['oauth_uid'] . "'";

                // Update user data in the database 
                $query = "UPDATE " . $this->userTbl . " SET " . $colvalSet . $whereSql;
                $update = $this->db->query($query);
            } else {
                // Add created time to the data array 
                if (!array_key_exists('created', $data)) {
                    $data['created'] = date("Y-m-d H:i:s");
                }

                // Prepare column and value format 
                $columns = $values = '';
                $i = 0;
                foreach ($data as $key => $val) {
                    $pre = ($i > 0) ? ', ' : '';
                    $columns .= $pre . $key;
                    $values  .= $pre . "'" . $this->db->real_escape_string($val) . "'";
                    $i++;
                }

                // Insert user data in the database 
                $query = "INSERT INTO " . $this->userTbl . " (" . $columns . ") VALUES (" . $values . ")";
                $insert = $this->db->query($query);
            }

            // Get user data from the database 
            $result = $this->db->query($checkQuery);
            $userData = $result->fetch_assoc();
        }

        // Return user data 
        return !empty($userData) ? $userData : false;
    }
}



class Notices{

    private $dbHost     = 'localhost';
    private $dbUsername = 'root';
    private $dbPassword = '12345';
    private $dbName     = 'noticeuploadfeb2020';
    public static $ANNOUNCEMENT = 'announcements';
    public static $EVENT = 'events';
    public static $IMPORTANT = 'importants';
    public static $TENDER = 'tenders';


    function __construct()
    {
        if (!isset($this->db)) {
            // Connect to the database 
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL: " . $conn->connect_error);
            } else {
                $this->db = $conn;
                // echo "connection establised";
            }
        }
    }

    function createNotice($tname,$arr){

        echo "type".gettype($arr[4]);
        $value='';
        foreach($arr as $ar){
            $value=$value."'".($ar)."',";
        }

        $value = substr($value,0,strlen($value)-1);

        $query= "INSERT INTO ".($tname). " (name, email, title, url, opendate, closedate, tdate,id) VALUES (".$value. ")";
        $results=$this->db->query($query);
    }

    function getNotices($tname){
        $query = "select * from ".$tname;
        $result = $this->db->query($query);

        $arr = [];

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if (strtotime($row['opendate']) <= strtotime(date('Y-m-d')) && strtotime($row['closedate']) >= strtotime(date('Y-m-d'))) {
                    array_push($arr, $row);
                }
                // echo "<h3><a target='_blank' href='".$row['url']."'>" .$row['title']. "</a></h3>";
            }
        } else {
            echo "0 results";
        }
        return $arr;
    }

    function getNoticesByEmail($tname, $email)
    {
        $query = "select * from " . $tname. " where email='".$email."'";
        $result = $this->db->query($query);

        $arr = [];

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if (!(strtotime($row['opendate']) <= strtotime(date('Y-m-d')) && strtotime($row['closedate']) >= strtotime(date('Y-m-d')))) {-
                array_push($arr, $row);
                }
                // echo "<h3><a target='_blank' href='".$row['url']."'>" .$row['title']. "</a></h3>";
            }
        } else {
            echo "0 results";
        }
        return $arr;
    }


    function getNoticesByEmailcurrent($tname, $email)
    {
        $query = "select * from " . $tname . " where email='" . $email . "'";
        $result = $this->db->query($query);

        $arr = [];

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if (strtotime($row['opendate']) <= strtotime(date('Y-m-d')) && strtotime($row['closedate']) >= strtotime(date('Y-m-d'))) {
                    array_push($arr, $row);
                }
                // echo "<h3><a target='_blank' href='".$row['url']."'>" .$row['title']. "</a></h3>";
            }
        } else {
            echo "0 results";
        }
        return $arr;
    }

    
    function updateNotices($tname,$arr,$id){

        // print_r($arr);
        // echo $tname.$id;

        // $value = '';
        // foreach ($arr as $ar) {
        //     $value = $value . "'" . ($ar) . "',";
        // }

        // $value = substr($value, 0, strlen($value) - 1);

        // $query = "UPDATE " . ($tname) . " SET (title, opendate, closedate) VALUES (" . $value . ") WHERE id='".$id."'";

        $query="UPDATE ".($tname) . " SET title='".$arr[0]."' ,opendate='".$arr[1]."' ,closedate='"
        .$arr[2]."' WHERE id='".$id."'";
        $results = $this->db->query($query);
        if($results){
            echo "updated";
        }else
        {
            echo "sorry not updated";
        }
    }

    function getNoticeById($tname, $id){
        $query = "select * from ".$tname." where id='".$id."'";
        $result = $this->db->query($query);

        $notice = null;

        if ($result->num_rows > 0) {
            // output data of each row
            $notice = $result->fetch_assoc();
        } else {
            echo "0 results";
        }
        return $notice;
    }


}


