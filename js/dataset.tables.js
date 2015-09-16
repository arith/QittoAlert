/*
* Author: William Syms
* Website: williamsyms.com
* Date: 2013-05-08
*/

/* See datatables.net for
* the full documentation on how
* to use the plug-in
*/

var oTable;

$(document).ready(function(){
    
    /* Add a click handler to the rows - this could be used as a callback */
    $("#datasettable tbody tr").click( function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
     
    /* Add a click handler for the delete row */
    $('#delete').click( function() {
        var anSelected = fnGetSelected( oTable );
        if ( anSelected.length !== 0 ) {
            oTable.fnDeleteRow( anSelected[0] );
        }
    } );
     
    /* Init the table */
    oTable = $('#datasettable').dataTable({
        "sPaginationType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "dataset_processing.php",
        "language": {
          "search": "<font size=2em>Filter: </font>",
          "lengthMenu": "<font size=2em>Show _MENU_</font>",
          "infoEmpty": "<font size=2em>No records available</font>",
          "infoFiltered": "",
          "info": "<font size=2em>Showing page _PAGE_ of _PAGES_</font>"
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 3, "ASC" ]],
        "aoColumnDefs": [
                           {
                                "aTargets": [8],
                                "mData": null,
                                "mRender": function (data, type, full) {
                                    return '<center><a href=view.php?id=' + full[0] +' style="text-decoration:none;"><button id=\''+ full[0] +'\' style="font-size:11px;" class="view label label-labeled label-warning"><i class="fa fa-search"></i> View</button></a></center>';
                                }
                            }
                         ]
    }); 
    oTable.fnSetColumnVis( 0, false ); 
    oTable.fnSetColumnVis( 1, false ); 
//    oTable.fnSetColumnVis( 2, false ); 
//    oTable.fnSetColumnVis( 3, false ); 
});

/* Get the rows which are currently selected */
function fnGetSelected( oTableLocal )
{
    return oTableLocal.$('tr.row_selected');
}


