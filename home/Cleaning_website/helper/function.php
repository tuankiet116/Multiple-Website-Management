<?php 
    require_once('../../classes/database.php');
    function get_data_rows($query){
        $arr = array();
        $result = new db_query($query);
        if(mysqli_num_rows($result->result)>0){
            while($row = mysqli_fetch_assoc($result->result)){
                array_push($arr, $row);
            }
        }
        return $arr;
    }

    function get_data_row($query){
        $result = new db_query($query);
        if(mysqli_num_rows($result->result)>0){
            $data = mysqli_fetch_array($result->result, MYSQLI_ASSOC);
        }
        return $data;
    }
?>