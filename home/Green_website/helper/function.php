<?php 
    define("DATABASE_HOST", "localhost");
    define("DATABASE_NAME", "cleaning_introduces");
    define("DATABASE_USERNAME", "root");
    define("DATABASE_PASSWORD", "");
    define("SLAVE_DATABASE_HOST", ["localhost" => 2]);
    define("SLAVE_DATABASE_USERNAME", "");
    define("SLAVE_DATABASE_PASSWORD", "");

    function get_data_rows($query){
        $conn = new PDO("mysql:host=" . DATABASE_HOST . ";dbname=" . DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
        $arr = array();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($arr, $row);
            }
        }
        unset($stmt);
        unset($conn);
        return $arr;
        
    }

    function get_data_row($query){
        $conn = new PDO("mysql:host=" . DATABASE_HOST . ";dbname=" . DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        unset($stmt);
        unset($conn);
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