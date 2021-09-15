<?php

require_once("connect.php");

$data = file_get_contents("php://input");
 
//แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
$result = json_decode($data,true);
      
                 
        $W_ID = $result['Wash_ID'];
        $W_Model = $result['Machine_Model'];
        $L_Name = $result['Location_name'];
        $L_ID = $result['Location_ID'];
        
        //คำสั่ง SQL สำหรับเพิ่มข้อมูลใน Database
        $sql = "INSERT INTO washmachine(Wash_ID,Machine_Model,Location_name,Location_ID) VALUES ('$W_ID','$W_Model','$L_Name','$L_ID')";
        
        $result = mysqli_query($link, $sql);
        
        if ($result) {
           echo json_encode(['status' => 'ok','message' => 'Insert Data Complete']);
        } else {
           echo json_encode(['status' => 'error','message' => 'Error']);    
        }

?>