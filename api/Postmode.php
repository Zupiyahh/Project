<?php

require_once("connect.php");

$data = file_get_contents("php://input");
 
//แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
$result = json_decode($data,true);
      
                 
        $W_ID = $result['Wash_ID'];
        $L_ID = $result['Location_ID'];
        $W_Mode = $result['Mode'];
        
        //คำสั่ง SQL สำหรับเพิ่มข้อมูลใน Database
        $sql = "INSERT INTO wash_mode(Wash_ID,Location_ID,Mode) VALUES ('$W_ID','$L_ID','$W_Mode')";
        
        $result = mysqli_query($link, $sql);
        
        if ($result) {
           echo json_encode(['status' => 'ok','message' => 'Insert Data Complete']);
        } else {
           echo json_encode(['status' => 'error','message' => 'Error']);    
        }

?>