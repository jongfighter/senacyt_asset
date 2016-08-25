<?php
session_start();

// Include classes
include_once('../extLib/tbs_class.php'); // Load the TinyButStrong template engine
include_once('../extLib/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
	if (ini_get('date.timezone')=='') {
		date_default_timezone_set('UTC');
	}
}

// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------//
// Prepare some data for the demo//
// ------------------------------//

// Retrieve the user name to display//
$yourname = (isset($_POST['yourname'])) ? $_POST['yourname'] : '';
$yourname = trim(''.$yourname);
if ($yourname=='') $yourname = "(no name)";

// A recordset for merging tables//

// Other single data items//
$dept_id = $_POST['dept_id'];

// Other single data items//
$in_date = $_POST['asset_in'];
$out_date = $_POST['asset_out'];
$x_in = date("d-m-Y", strtotime($in_date));
$x_out = date("d-m-Y", strtotime($out_date)); //the date format must be converted later 

$x_desc = $_POST['asset_desc'];
$x_brand = $_POST['asset_brand'];
$x_model = $_POST['asset_model'];
$x_serial = $_POST['asset_serial'];

$x_detail = $_POST['asset_details'];

$x_barcode = $_POST['asset_barcode'];

//below must be converted into real world terms
$loc_bf = $_SESSION['location_before'];

$loc_ft = $_POST['loc_id'];
$curr_p_id = $_POST['curr_p_id']; //dar 

$p_id = $_POST['p_id']; //recibir
require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $rcv_sql ="select p_name, p_lastname, dept_id from dbo.person where p_id = {$p_id}";
            $rcv_res = mssql_query($rcv_sql,$conn);
            $rcv_row = mssql_fetch_array($rcv_res);
            $dar_sql="SELECT p_name, p_lastname, dept_id from dbo.person where p_id = {$curr_p_id};";
            $dar_res = mssql_query($dar_sql, $conn);
            $dar_row = mssql_fetch_array($dar_res);
            $rcv_dept_id = $rcv_row['dept_id'] ;
            $dar_dept_id = $dar_row['dept_id'];
            $rcv_dept_sql = "SELECT dept_name FROM dbo.Department WHERE dept_id = {$rcv_dept_id}";
            $dar_dept_sql = "SELECT dept_name FROM dbo.Department WHERE dept_id = {$dar_dept_id}";
            $rcv_dept_res = mssql_query($rcv_dept_sql, $conn);
            $dar_dept_res = mssql_query($dar_dept_sql, $conn);
            $dar_dept_row = mssql_fetch_array($dar_dept_res);
            $rcv_dept_row = mssql_fetch_array($rcv_dept_res);
            
$rcv_person = $rcv_row['p_name']." ".$rcv_row['p_lastname'];
$dar_person = $dar_row['p_name']." ".$dar_row['p_lastname'];
$dar_dept = $dar_dept_row['dept_name'];
$rcv_dept = $rcv_dept_row['dept_name'];
// -----------------
// Load the template
// -----------------

$template = '../FormulariodeUsodeEquiponuevo.xlsx';
$fn ='Formulario_de_Uso_de_Equipo_nuevo';
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

// Merge data in the first sheet
//$TBS->MergeBlock('a,b', $data);

// Merge cells (extending columns)
//$TBS->MergeBlock('cell1,cell2', $data);

// Change the current sheet


// Merge pictures of the current sheet


// Delete a sheet



// Display a sheet (make it visible)

// -----------------
// Output the result
// -----------------

// Define the name of the output file
$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = $fn."_".date('Y-m-d')."_".$rcv_person."_".$x_barcode.$save_as.".xlsx";
if ($save_as==='') {
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
} else {
	// Output the result as a file on the server.
	$TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields.
	// The script can continue.
	exit("File [$output_file_name] has been created.");
}
?>

<!--<meta http-equiv="refresh" content="0;url=form_rent.php">