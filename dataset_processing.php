<?php
require('config.php');

// DB table to use
$table = 'statistic';
 
// Table's primary key
$primaryKey = 'id';

$columns = array(
    array( 'db' => 'id', 'dt' => 0, 'field' => 'id', 'as' => 'id' ),
    array( 'db' => 'tahun', 'dt' => 1, 'field' => 'tahun', 'as' => 'tahun' ),
    array( 'db' => 'minggu', 'dt' => 2, 'field' => 'minggu', 'as' => 'minggu' ),
    array( 'db' => 'negeri', 'dt' => 3, 'field' => 'negeri', 'as' => 'negeri' ),
    array( 'db' => 'daerah', 'dt' => 4, 'field' => 'daerah', 'as' => 'daerah' ),
    array( 'db' => 'lokasi', 'dt' => 5, 'field' => 'lokasi', 'as' => 'lokasi' ),
    array( 'db' => 'kes_terkumpul', 'dt' => 6, 'field' => 'kes_terkumpul', 'as' => 'kes_terkumpul' ),
    array( 'db' => 'tempoh_wabak', 'dt' => 7, 'field' => 'tempoh_wabak', 'as' => 'tempoh_wabak' )    
);


require( 'ssp.class.php' );

$joinQuery = "";
$extraCondition = "latitude IS NOT NULL";
$groupBy = ''; 

echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition, $groupBy)
     );
