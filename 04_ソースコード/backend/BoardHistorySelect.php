<?php
class BoardHistorySelect{
    public function boardHistorySelect(){
        if(isset($_COOKIE['history'])){
            $his_id = explode(',',$_COOKIE['history']);
            return $his_id;
    }   else{
            return null;
        }
    }
}
?>