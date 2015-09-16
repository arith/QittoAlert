<?php
require('config.php');

// DB table to use
$table = 'request';
 
// Table's primary key
$primaryKey = 'id';

$columns = array(
    array( 'db' => 'id', 'dt' => 0, 'field' => 'id', 'as' => 'id' ),
    array( 'db' => 'address', 'dt' => 1, 'field' => 'address', 'as' => 'address' ),
    array( 'db' => 'latitude', 'dt' => 2, 'field' => 'latitude', 'as' => 'latitude' ),
    array( 'db' => 'longitude', 'dt' => 3, 'field' => 'longitude', 'as' => 'longitude'),    
    array( 'db' => 'req_date', 'dt' => 4,
        'formatter' => function( $d, $row ) {
            return date( 'd M Y, g:i a', strtotime($d));
        }, 'field' => 'req_date'),    
    array( 'db' => 'status', 'dt' => 5,
        'formatter' => function($d, $row){
            if($d=="0"){
                return "<span style=\"font-size:12px; margin-right:5px;\" class=\"label label-danger pull-left\">Pending</span>";
            }
            else{
                return "<span style=\"font-size:12px; margin-right:5px;\" class=\"label label-success pull-left\">Completed</span>";
            }
        },'field' => 'status' ),    
);


require( 'ssp.class.php' );

$joinQuery = "";
$extraCondition = "";
$groupBy = ''; 

echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition, $groupBy)
     );
