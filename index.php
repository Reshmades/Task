<?php 
require_once("dbcontroller.php");
error_reporting(E_ALL & ~E_NOTICE);
$db_handle = new DBController();
if(isset($_POST['submit'])){
	if($_POST["date"] !=''||$_POST["time"] !='' || $_POST["description"] !=''){
//Insert Query of SQL
$result = mysql_query("INSERT INTO schedules(date, time, description) VALUES('".$_POST["date"]."','".$_POST["time"]."','".$_POST["description"]."')");
$errorMsg= "<br/><br/><span>Your Appointment is saved successfully...!!</span>";
}
else{
$errorMsg= "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
}}

?>
<html>
	<head>
	<title>Web application which handles appointments</title>
<style>body{width:610px;}
#schedules-grid {margin-bottom:30px;}
#schedules-grid  a{cursor:pointer;}
#schedules-grid .txt-heading{background-color: #D3F5B8;}
#schedules-grid table{width:100%;background-color:#F0F0F0;}
#schedules-grid table td{background-color:#FFFFFF;}
.search-box {border: 1px solid #F0F0F0;background-color:#C8EEFD;margin: 2px 0px;}
.demoInputBox {padding: 10px;border: #F0F0F0 1px solid;border-radius: 4px;margin:0px 5px}
.btnSearch{padding: 10px;border: #F0F0F0 1px solid;border-radius: 4px;margin:0px 5px;}
.perpage-link{padding: 5px 10px;border: #C8EEFD 2px solid;border-radius: 4px;margin:0px 5px;background:#FFF;cursor:pointer;}
.current-page{padding: 5px 10px;border: #C8EEFD 2px solid;border-radius: 4px;margin:0px 5px;background:#C8EEFD;}
.btnEditAction{background-color:#2FC332;padding:2px 5px;color:#FFF;text-decoration:none;}
.btnDeleteAction{background-color:#D60202;padding:2px 5px;color:#FFF;text-decoration:none;}
#btnAddAction,#btnCancel{background-color:#09F;border:0;padding:5px 10px;color:#FFF;text-decoration:none;}
#frmschedules {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
#frmschedules div{margin-bottom: 15px}
#frmschedules div label{margin-left: 5px}
.error{background-color: #FF6600;border:#AA4502 1px solid;padding: 5px 10px;color: #FFFFFF;border-radius:4px;}
.info{font-size:.8em;color: #FF6600;letter-spacing:2px;padding-left:5px;}
.hidden { display: none; }
.shown {display: block;}
#add-form {display:none;}
	
		</style>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
	<script>
	function getresult(url) {  
		
	$.ajax({
		url: url,
		type: "POST",
		data:  {rowcount:$("#rowcount").val(),description:$("#description").val()},
		success: function(data){ $("#schedules-grid").html(data); $('#add-form').hide();}
	   });
	}
	getresult("getresult.php");
	
 function validate() {
		var valid = true;	
		$(".demoInputBox").css('background-color','');
		$(".info").html('');
		
		if(!$("#add-date").val()) {
			$("#date-info").html("(required)");
			$("#add-date").css('background-color','#FFFFDF');
			valid = false;
		}
		if(!$("#add-time").val()) {
			$("#time-info").html("(required)");
			$("#add-time").css('background-color','#FFFFDF');
			valid = false;
		}
		if(!$("#category").val()) {
			$("#description-info").html("(required)");
			$("#category").css('background-color','#FFFFDF');
			valid = false;
		}
		 
		 
		return valid;
	}
	</script>
	</head>
	<body>
		<h2>Web application which handles appointments</h2>
		<?php echo $errorMsg; ?>
		<div style="text-align:right;margin:20px 0px 10px;">
		<a id="btnAddAction" onClick="$('#add-form').show(); $('#btnAddAction').hide();">New</a>
		</div>
		<div id="add-form">
		<form name="frmschedules" method="post" action="" id="frmschedules">
		<div>
		<label style="padding-top:20px;">Date</label>
		<span id="date-info" class="info"></span><br/>
		<input type="text" name="date" id="add-date" class="demoInputBox">
		</div>
		<div>
		<label>Time</label>
		<span id="time-info" class="info"></span><br/>
		<input type="text" name="time" id="add-time" class="demoInputBox">
		</div>
		<div>
		<label>Description</label> 
		<span id="description-info" class="info"></span><br/>
		<input type="text" name="description" id="category" class="demoInputBox">
		</div>
		<div>
		<input type="submit" name="submit" id="btnAddAction" value="Add" onClick="add();" />
		<input type="button" name="cancel" id="btnCancel" value="Cancel" onclick="$('#add-form').hide(); $('#btnAddAction').show();">
		</div>
		</form>
		</div>
		<div id="schedules-grid">
			<input type="hidden" name="rowcount" id="rowcount" />					
		</div>
		
		
		
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

  <script>
  $( function() {
    $( "#add-date" ).datepicker({ minDate: 0});
	$( "#add-date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$('#add-time').timepicker({});
  
  
  });
  </script>
		
	</body>
</html>