<?php

     //กำหนดค่า Access-Control-Allow-Origin ให้ เครื่อง อื่น ๆ สามารถเรียกใช้งานหน้านี้ได้
     header("Access-Control-Allow-Origin: *");
    
     header("Content-Type: application/json; charset=UTF-8");
     
     header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
     
     header("Access-Control-Max-Age: 3600");
     
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
     
     $link = mysqli_connect('us-cdbr-east-04.cleardb.com', 'b1775a43a09c5e', 'a4b7fdf0', 'heroku_c8c81c89ddd0ecd');
    mysqli_set_charset($link, 'utf8');
    
?>