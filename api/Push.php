<?php

require_once("connect.php");

$data = file_get_contents("php://input");
 
//แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
$result = json_decode($data,true);
       
  //ตรวจสอบการเรียกใช้งานว่าเป็น Method PUT หรือไม่
if($requestMethod == 'PUT'){
        
    //ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
    if(isset($_GET['Wash_ID']) && !empty($_GET['Wash_ID'])){
          
        $W_ID = $_GET['Wash_ID'];

        $W_Model = $result['Machine_Model'];
        $L_Name = $result['Location_name'];
        $L_ID = $result['Location_ID'];
        
        //คำสั่ง SQL สำหรับเพิ่มข้อมูลใน Database
        $sql = "UPDATE washmachine SET Machine_Model = '$W_Model' , Location_name = '$L_Name' , Location_ID = '$L_ID' WHERE Wash_ID = $W_ID";
        
        $result = mysqli_query($link, $sql);
        
        if ($result) {
           echo json_encode(['status' => 'ok','message' => 'UPdate Data Complete']);
        } else {
           echo json_encode(['status' => 'error','message' => 'Error']);    
        }
    } 
}

?>