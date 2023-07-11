<?php
public class BoardHistorySelect{
public function boardHistorySelect(){
session_start();
if(isset($_COOKIE['history'])){
    $his_id = explode(',',$_COOKIE['history']);
    /*foreach($his_id as $row){
        echo '<li><a href="'.$row.'"></a></li>';
    }*/
    return $his_id;
}
}
}
?>