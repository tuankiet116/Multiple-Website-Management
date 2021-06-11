<?php 
    require_once('./config.php');

    $database = new Database();
    $conn = $database->getConnection();
    echo var_dump($conn);
    function get_data_rows($query){
        $arr = array();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        if($stmt->rowCount()>0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($arr, $row);
            }
        }
        return $arr;
    }

    function get_data_row($query){
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $data ?? '';
    }

    // $arr_left_title = array();
    // $sql = "SELECT * FROM post_type";
    // $result = new db_query($sql);
    // if (mysqli_num_rows($result->result)) {
    //     while ($row = mysqli_fetch_assoc($result->result)) {
    //         array_push($arr_left_title, $row);
    //     }
    // }
    // unset($result, $sql);
?>