<?php

$request = $_POST['request'];

if($request == 1){
    $busqueda = $_POST['busqueda'];
    //$consulta1 = "SELECT * FROM ct_empleados WHERE rfc like'%".$busqueda."%'";
    //$resultado1 = mysqli_query($conexion,$consulta1);
    $resultado = DB::select("SELECT * FROM ct_empleados WHERE rfc like ?", array('%'.$busqueda.'%'));
    // while($row = mysqli_fetch_array($resultado1)){
    //     $response[] = array("value"=>utf8_encode($row['id_empleado']),"label"=>utf8_encode($row['rfc']));
    // }
    //**************************************** */
    // foreach($resultado as $row)
    // {
    //     $term = $row->term;
    //     $counter = $row->counter;
    //     $terms[] = array('term' => $term, 'counter' => $counter);
    // }
   // *****************************************************************
    echo json_encode($response);
    exit;
}

// if($request == 2){
//     $buscarid = $_POST['buscarid'];
//     $consulta2 = "SELECT * FROM ct_empleados WHERE id_empleado=".$buscarid."";
//     $resultado2 = mysqli_query($conexion,$consulta2);
//     $row = mysqli_fetch_row($resultado2); 

//     $consulta3 = "SELECT id_movimiento, codigoMovimiento, vigenciaDel, anio, qnaDeAfectacion FROM fomope WHERE rfc='$row[1]'";
//     $resultado3 = mysqli_query($conexion,$consulta3);

//     $value[0] = array( 
//             "apellido1"=>$row[3],
//             "apellido2"=>$row[4],
//             "nombre"=>$row[5],
//             "curp"=>$row[2]
//         );
//     $value[1]= 0;
//     $i = 1;
//     while($ver=mysqli_fetch_row($resultado3)){ 
//         $value[$i] = array( 
//             "id"=>$ver[0],
//             "codigo"=>$ver[1],
//             "fecha"=>$ver[2],
//             "anio"=>$ver[3],
//             "qna"=>$ver[4]
//         );
//         $i++;
//     }
//     echo json_encode($value);
//     exit;
// }