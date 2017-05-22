<?php
require_once("dbcontroller.php");
error_reporting(E_ALL & ~E_NOTICE);
$db_handle = new DBController();

$description = "";

$queryCondition = "";
if(!empty($_POST["description"])) {
$queryCondition .= " WHERE description LIKE '" . $_POST["description"] . "%'";
}

$orderby = " ORDER BY id desc";
$sql = "SELECT * FROM schedules " . $queryCondition;
$searchrslt = "getresult.php";					

$query =  $sql . $orderby; 
$result = $db_handle->runQuery($query);
?>
<form name="frmSearch" method="post" action="index.php">
			<div class="search-box">
			<p><input type="hidden" id="rowcount" name="rowcount" value="1" /><input type="text" placeholder="Description" name="description" size="50" id="description" class="demoInputBox" value="<?php echo $description; ?>"/><input type="button" name="go" class="btnSearch" value="Search" onclick="getresult('<?php echo $searchrslt; ?>')"></p>
			</div>
			</form>
			
		
<?php
if(!empty($result) && $_POST['rowcount']==1) { ?>
<table id="resulttbl" cellpadding="10" cellspacing="1">
        <thead>
					<tr>
          <th><strong>Date</strong></th>
          <th><strong>Time</strong></th>          
          <th><strong>Description</strong></th>
					</tr>
				</thead>
				<tbody><?php 
foreach($result as $k=>$v) {
?>
<tr id="schdlr-<?php echo $result[$k]["id"]; ?>">
<td class="date"><?php echo $result[$k]["date"]; ?></td>
<td class="time"><?php echo $result[$k]["time"]; ?></td>
<td class="description"><?php echo $result[$k]["description"]; ?></td> 
</tr>
<?php
}}
?>
<tbody>
</table>
