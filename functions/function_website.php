<?
/**
 * Hiện tên Trường
 * @param $school_id
 */
function showUserSchool($school_id){
    $sch_name = "not_found";
    $db_school = new db_query("SELECT sch_name FROM schools WHERE sch_id=" . intval($school_id));
    if($row = mysqli_fetch_assoc($db_school->result)){
        $sch_name = $row["sch_name"];
    }
    $db_school->close();
    unset($db_school);

    return $sch_name;
}

function showUserFaculty($id){
    $name = "not_found";
    $db_data = new db_query("SELECT fac_name FROM faculties WHERE fac_id=" . intval($id));
    if($row = mysqli_fetch_assoc($db_data->result)){
        $name = $row["fac_name"];
    }
    $db_data->close();
    unset($db_data);

    return $name;
}

function showUserClass($id){
    $name = "not_found";
    $db_data = new db_query("SELECT cls_name FROM classes WHERE cls_id=" . intval($id));
    if($row = mysqli_fetch_assoc($db_data->result)){
        $name = $row["cls_name"];
    }
    $db_data->close();
    unset($db_data);

    return $name;
}