<?php

    require_once("connect.php");
     
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    
    //ตรวจสอบหากใช้ Method GET
    if($requestMethod == 'GET'){
        //ตรวจสอบการส่งค่า id

        if(isset($_GET['WID']) && !empty($_GET['WID'])){
            
            $W_ID = $_GET['WID'];
            
            //คำสั่ง SQL กรณี มีการส่งค่า id มาให้แสดงเฉพาะข้อมูลของ id นั้น
            $sql = "SELECT * FROM hardware WHERE State = 'Idle'";
            
        }
        else if(isset($_GET['Wash_ID']) && !empty($_GET['Wash_ID'])){
            
            $W_ID = $_GET['Wash_ID'];
            
            //คำสั่ง SQL กรณี มีการส่งค่า id มาให้แสดงเฉพาะข้อมูลของ id นั้น
            $sql = "SELECT * FROM washmachine ";
    
        }
        else{
            
            $sql = "SELECT * FROM hardware ";
        }
        
        $result = mysqli_query($link, $sql);
        
        //สร้างตัวแปร array สำหรับเก็บข้อมูลที่ได้
        $arr = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
             
             $arr[] = $row;
        }
        
        echo json_encode($arr);
    }
?>