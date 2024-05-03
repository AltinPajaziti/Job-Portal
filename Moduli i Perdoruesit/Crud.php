<?php

include('config.php');

class Crud
{
    public function Create($table, $data)
    {
        global $lidhe;
        $sql = "INSERT INTO `$table` SET";
        $cnt = count($data);
        $i = 0;

        foreach ($data as $Emri => $v) {
            $vlera = mysqli_real_escape_string($lidhe, $v);

            $sql .= " `$Emri`='" . $vlera . "'";

            if (++$i < $cnt) {
                $sql .= ",";
            }
        }

        $result = mysqli_query($lidhe, $sql);

        if ($result) {
            echo "E dhëna u shtua me sukses";
        } else {
            echo "Error: " . mysqli_error($lidhe);
        }
    }
   
    public function Read($table, $condition = [], $limit = null)
{
    global $lidhe;

    $sql = "SELECT * FROM $table";

    if (count($condition) > 0) {
        $sql .= " WHERE " . $condition['kolona'] . " = '" . $condition['value'] . "'";
    }

    if (!is_null($limit)) {
        $sql .= " LIMIT " . $limit;
    }

    error_log("SQL query: $sql");

    $query = mysqli_query($lidhe, $sql);

    if (!$query) {
        $error_message = "Error in SQL query: " . mysqli_error($lidhe);
        error_log($error_message);
        return null;
    }

    $result = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    if (empty($result)) {
        // Log a message if no rows are returned
        error_log("No rows returned for the query: $sql");
    }

    // Returning an array with column names as keys
    return $result;
}

 
    public function Update($table , $data , $kushti=[]){

        global $lidhe;
        $sql = "  UPDATE`" .$table."` SET ";

        foreach($data as $qelsi => $vlera){
            $v = mysqli_real_escape_string($lidhe, $vlera);
            $sql .= " `$qelsi`='" . $v . "'";

        }
        if(count($kushti)!=0){
            $sql.= " WHERE ".$kushti['kolona']. "= '".$kushti['value']."'";
        }


        $rezultati = mysqli_query($lidhe, $sql);

        if($rezultati){
        }
        else{
            echo "Error: " . mysqli_error($lidhe);
        }

        
    }

    public function Delete($table  ,$kushti){
        global $lidhe;
        $sql = "DELETE FROM `" . $table ."`";

        if (count($kushti) > 0) {
            $sql .= " WHERE " . $kushti['kolona'] . " = '" . $kushti['value'] . "'";
        }

     


        $query = mysqli_query($lidhe, $sql);
        echo $sql ."<br>";

        if ($query) {
            echo "";
        } else {
            echo "Error executing query: " . mysqli_error($lidhe);
        }
}
}
$crud = new Crud();
// $condition = ['kolona' => 'Emri', 'value' => 'Altin'];
// $user = $crud->Read('perdoruesi', $condition);

// $crud->Read('perdoruesi', ['kolona' => 'Emri', 'value' => 'altini']);
// $crud->Update('perdoruesi', ['Emri' => "altini"],['kolona' => 'Emri', 'value' => 'Albi']);
//  $crud->Delete('perdoruesi',['kolona' => 'Emri', 'value' => 'Altin']);
// $crud->Create('perdoruesi', [
//     'Emri' => 'Altin',
//     'Mbiemri' => 'Doci',
//     'Mosha' => 30
// ]);





?>