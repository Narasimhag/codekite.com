<?php
include('../session.php');


///------------------ edit page -------
if(isset($_GET['page'])){

    $edit_page = $_GET['page'];
}

///------------------------------------

?>
<script type="text/javascript">
	var $code_page_name = '<?php if(isset($_GET["page"])) echo $_GET["page"]; ?>';
	var $mode = '<?php if(isset($_GET["mode"])) echo $_GET["mode"]; ?>';

    	function upSync(){
    		if($code_page_name){
    			$.ajax({
			    type: 'GET',
			    // make sure you respect the same origin policy with this url:
			    // http://en.wikipedia.org/wiki/Same_origin_policy
			    url: 'http://localhost/codekite.com/pagecode/sync.php',
			    data: 'code_page_name=' + $code_page_name + '&code='+ btoa(document.getElementById("editor").innerHTML),
			    success: function(msg){

			    }			
			});
    		} 
    	}
    	function downSync(){
    		if($mode){
    			$.ajax({
			    type: 'GET',
			    // make sure you respect the same origin policy with this url:
			    // http://en.wikipedia.org/wiki/Same_origin_policy
			    url: 'http://localhost/codekite.com/pagecode/downSync.php',
			    data: 'code_page_name=' + $code_page_name,
			    success: function(msg){
			    	document.getElementById("editor").innerHTML = (atob(msg));
			    }			
			});
    		} 
    	}
    	function invite(){
    			$user_name = document.getElementById("user_name").value
    			$.ajax({
			    type: 'GET',
			    // make sure you respect the same origin policy with this url:
			    // http://en.wikipedia.org/wiki/Same_origin_policy
			    url: 'http://localhost/codekite.com/pagecode/addinvite.php',
			    data: 'code_page_name=' + $code_page_name + '&user_name=' + $user_name,
			    success: function(msg){
			    	//alert(msg);
			    }			
			});
    		
    	}
		setInterval(function(){ 	
			upSync();
			downSync();
		},500);
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DashBoard</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script	src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/paper.css">
	<style type="text/css">
		#editor {
		    border: 15px solid #F1F1F6;
		    /* margin-top: 100px;
		    margin-left: 100px;
		    width: 300px;
		     */min-height: 500px;
		    background-color: #F1F1F6;
		    box-shadow: 0px 0px 10px #fff;
		    color: #5C1F1F;
		    outline: 0px solid transparent;
		}
		::-webkit-scrollbar-track
		{
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		    background-color: #F5F5F5;
		}
		::-webkit-scrollbar
		{
		    width: 12px;
		    background-color: #F5F5F5;
		}
		::-webkit-scrollbar-thumb
		{
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		    background-color: #555;
		}
	</style>
	<script type="text/javascript">
	function codediv2input(){
		document.getElementById("code").value = document.getElementById("editor").innerHTML;
	}
	</script>

</head>
<body>
	<!--Nav Bar code-->
	<nav class="navbar navbar-inverse" role="navigation">
  		<div class="container-fluid">
  			<div class="navbar-header">
  				<a class="navbar-brand" href="index.php">CodeKite</a>
  			</div>

  			<ul class="nav navbar-nav navbar-right">
	  			<li class="dropdown">
			         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['user_name']."&nbsp;&nbsp;&nbsp;"; ?><span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="#">Report Bugs!</a></li>
			            <li class="divider"></li>
			            <li><a href="../logout.php">Logout</a></li>
			          </ul>
	        	</li>
  			</ul>
  		</div>
  	</nav>
  	<div class="container-fluid">
	  	<div class="row">
	  		<div class="col-sm-2">
	  			<div class="btn-group-vertical" role="group" aria-label="menu">
	  				<a href="../index.php" class="btn btn-primary" style="margin:10px;">Home</a>
	  				<button class="btn btn-success" style="margin:10px;" data-toggle="modal" data-target="#invite">Invite</button>
	  				<button class="btn btn-info" style="margin:10px;" data-toggle="modal" data-target="#access">Manage Access</button>
	  				<button class="btn btn-danger" style="margin:10px;" data-toggle="modal" data-target="#delete">Delete Code Page</button>

				</div>
	  		</div>
	  		<div class="col-sm-7">
	  			<form action="new.php" method="POST" onsubmit="codediv2input()">
			  			<big><input type="text" name="code_page_name" placeholder="Give your code a name" id="code_page_name" style="margin-top:10px;margin-bottom:10px;margin-right:10px;" class="form-control" <?php if(isset($_GET['page']))echo 'value="'.$edit_page.'" readonly'; ?>></big>

			  			<div <?php if(isset($_GET['mode'])){ 
				  				if($_GET['mode'] !== "readonly"){
				  					echo 'contenteditable="false"';
				  				}
			  				}else{
			  						echo 'contenteditable="true"';
			  				}
			  			?> id="editor">
			  				<?php 

			  					if(isset($_GET['page'])){
			  						$connection = mysql_connect("localhost", "codekite", "codekite");
							    $db = mysql_select_db("codekite", $connection);
							 
							    $user_name = $_SESSION['user_name'];
							    $sqlCommand = "SELECT code FROM codepages WHERE code_page_name = '$edit_page'";
							    $query = mysql_query($sqlCommand);
							    if($query === FALSE) {
							       die(mysql_error());
							    }

							    $row = mysql_fetch_assoc($query);

							    echo (base64_decode($row['code']));
			  					}

			  				?>
			  			</div>
			  			
			  			<input type="hidden" id="user_id" name="user_id">
			  			<input type="hidden" id="code" name="code">
			  			<input type="submit" class="btn btn-warning" id="saveButton" style="margin-top:10px;margin-bottom:10px;margin-right:10px;" value="<?php if(isset($_GET['page']))echo "SAVE"; else echo "CREATE"; ?>">
	  			</form>
	  		</div>
	  		<div class="col-sm-3">
	  			<div class="well">
	  				<div class="container-fluid">
					    <div class="row-fluid">
					        <!--<div class="col-lg-12">-->
					            <div class="panel panel-primary">
					                <div class="panel-heading">
					                    <span class="glyphicon glyphicon-comment"></span> Chat
					                    <!--<div class="btn-group pull-right">
					                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
					                            <span class="glyphicon glyphicon-chevron-down"></span>
					                        </button>
					                    </div>-->
					                </div>
					                <div class="panel-body">
					                	<iframe class="" src="" height="350px" width="100%" frameborder=""></iframe>
										</div>
									</div>
									<div class="panel-footer">
										<div class="input-group">
					                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message." />
					                        <span class="input-group-btn">
					                         <button class="btn btn-warning btn-sm" id="btn-chat">Send</button></span>
                    					</div>
									</div>
					                
					            </div>
					       <!-- </div> -->
					    </div>
	  			</div>
	  		</div>
	  	</div>
	  </div>
	<!--Modal Code Begins-->
	<!--Modal for invittations-->
    <div class="modal fade" tabindex="-1" role="dialog" id="invite">
  		<div class="modal-dialog modal-sm">
    		<div class="modal-content">
      			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="exampleModalLabel">Invitation Box</h4>
     		 </div>
			<div class="modal-body">
        		<form role="form">
          			<div class="form-group">
            			<label for="user-name"  class="control-label">User Name:</label>
            			<input type="text" id="user_name" class="form-control" >
          			</div>
          			<div class="form-group">
            			<label for="permission" class="control-label">Permission:</label>
            			<select class="form-control" id="permission">
							<option value="ro">Read Only</option>
							<option value="rw">Read Write</option>
            			</select>
          			</div>
       			 </form>
      		</div>
      		<div class="modal-footer">
        		<button onclick="invite();" type="button" class="btn btn-warning" data-dismiss="modal">ADD</button>
        
      		</div>

     		</div>

      			
   			 </div>
 		 </div>
 		 <!--Modal for deletion-->
 		 <div class="modal fade" tabindex="-1" role="dialog" id="delete">
  			<div class="modal-dialog modal-sm">
	    		<div class="modal-content">
	      			<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        		<h4 class="modal-title" id="exampleModalLabel">Sure?</h4>
	     		 </div>
				<div class="modal-body">
	        		<p>Are you sure about this?</p>
	          			
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-success" id="no_button" data-dismiss="modal">No</button>
	        		<button type="button" class="btn btn-danger" id="yes_button">Yes</button>
	        
	      		</div>

	     		</div>

      			
   			 </div>
 		 </div>
 		 <!--Modal for managing access-->
 		 <div class="modal fade" tabindex="-1" role="dialog" id="access">
  			<div class="modal-dialog modal-lg">
	    		<div class="modal-content">
	      			<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        		<h4 class="modal-title" id="exampleModalLabel2">Access Manager</h4>
	     		 </div>
				<div class="modal-body">
	        		<table class="table table-bordered">
	        			<thead>
	        				<tr>
	        					<th>User Name</th>
	        					<th>Permissions</th>
	        					<th>Action</th>
	        				</tr>
	        			</thead>
	        			<tbody>
	        				<tr>
	        					<td>Praveen</td>
	        					<td>
	        						<label for="read" style="margin:5px;">Read
	        							<input type="checkbox" value="" style="margin:5px;"></label>
	        						<label for="write" style="margin:5px;">Write<input type="checkbox" value="" style="margin:5px;">

	        						</label>
	        					</td> 
	        					<td>
	        						<button class="btn btn-success">UPDATE</button> &nbsp;
	        						<button class="btn btn-error">Revoke Access</button>
	        					</td>       					
	        				</tr>

	        			</tbody>
	        		</table>
	          			
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-success" id="close2" data-dismiss="modal">Close</button>
	        		
	        
	      		</div>

	     		</div>

      			
   			 </div>
 		 </div>
	</div>
    
    </div>    
<!-- <script type="text/javascript">
	var saveSelection, restoreSelection;

	if (window.getSelection && document.createRange) {
	    saveSelection = function(containerEl) {
	        var range = window.getSelection().getRangeAt(0);
	        var preSelectionRange = range.cloneRange();
	        preSelectionRange.selectNodeContents(containerEl);
	        preSelectionRange.setEnd(range.startContainer, range.startOffset);
	        var start = preSelectionRange.toString().length;

	        return {
	            start: start,
	            end: start + range.toString().length
	        }
	    };

	    restoreSelection = function(containerEl, savedSel) {
	        var charIndex = 0, range = document.createRange();
	        range.setStart(containerEl, 0);
	        range.collapse(true);
	        var nodeStack = [containerEl], node, foundStart = false, stop = false;
	        
	        while (!stop && (node = nodeStack.pop())) {
	            if (node.nodeType == 3) {
	                var nextCharIndex = charIndex + node.length;
	                if (!foundStart && savedSel.start >= charIndex && savedSel.start <= nextCharIndex) {
	                    range.setStart(node, savedSel.start - charIndex);
	                    foundStart = true;
	                }
	                if (foundStart && savedSel.end >= charIndex && savedSel.end <= nextCharIndex) {
	                    range.setEnd(node, savedSel.end - charIndex);
	                    stop = true;
	                }
	                charIndex = nextCharIndex;
	            } else {
	                var i = node.childNodes.length;
	                while (i--) {
	                    nodeStack.push(node.childNodes[i]);
	                }
	            }
	        }

	        var sel = window.getSelection();
	        sel.removeAllRanges();
	        sel.addRange(range);
	    }
	} else if (document.selection && document.body.createTextRange) {
	    saveSelection = function(containerEl) {
	        var selectedTextRange = document.selection.createRange();
	        var preSelectionTextRange = document.body.createTextRange();
	        preSelectionTextRange.moveToElementText(containerEl);
	        preSelectionTextRange.setEndPoint("EndToStart", selectedTextRange);
	        var start = preSelectionTextRange.text.length;

	        return {
	            start: start,
	            end: start + selectedTextRange.text.length
	        }
	    };

	    restoreSelection = function(containerEl, savedSel) {
	        var textRange = document.body.createTextRange();
	        textRange.moveToElementText(containerEl);
	        textRange.collapse(true);
	        textRange.moveEnd("character", savedSel.end);
	        textRange.moveStart("character", savedSel.start);
	        textRange.select();
	    };
	}


	/*setInterval(doSave, 3000);


	function doSave() {
	    savedSelection = saveSelection( document.getElementById("editor") );
	 document.getElementById("editor").innerHTML+="Edited ";
	    if (savedSelection) {
	        restoreSelection(document.getElementById("editor"), savedSelection);
	    }
	}*/

</script> -->
<script type="text/javascript">
		
		/*function updateRequest($access_id,$user_id,$update_string,$first_position,$type){
			$.ajax({
			    type: 'GET',
			    // make sure you respect the same origin policy with this url:
			    // http://en.wikipedia.org/wiki/Same_origin_policy
			    url: 'http://localhost/codekite.com/pagecode/autoupdate.php',
			    data: 'access_id='+$access_id+'&user_id='+$user_id+'&update_string='+$update_string+'&first_position='+$first_position+'&type='+$type,
			    success: function(msg){
			        alert('return ' + msg);
			    }
			});
		}*/
		

		/*function getCaretPosition(editableDiv) {
		  var caretPos = 0,
		    sel, range;
		  if (window.getSelection) {
		    sel = window.getSelection();
		    if (sel.rangeCount) {
		      range = sel.getRangeAt(0);
		      if (range.commonAncestorContainer.parentNode == editableDiv) {
		        caretPos = range.endOffset;
		      }
		    }
		  } else if (document.selection && document.selection.createRange) {
		    range = document.selection.createRange();
		    if (range.parentElement() == editableDiv) {
		      var tempEl = document.createElement("span");
		      editableDiv.insertBefore(tempEl, editableDiv.firstChild);
		      var tempRange = range.duplicate();
		      tempRange.moveToElementText(tempEl);
		      tempRange.setEndPoint("EndToEnd", range);
		      caretPos = tempRange.text.length;
		    }
		  }
		  return caretPos;
		}
		var $user_id = "<?php echo $_SESSION['user_id']; ?>";
		var $first,$one = false,$last,$latest;

		  var $update = function () {
		  	
		  			    $first = getCaretPosition(this);
		  			    alert($first);
		  			    $one = true;
		  			
		  	
		  };
		  $('#editor').on("mouseup", $update);

		  $("#editor").keyup(function (e) {
			    if (e.keyCode == 13 || e.keyCode == 32) {
			        $last = getCaretPosition(this);
			        alert($last);
		  	      /*if(($first-$last)===1){
		  		    updateRequest($access_id,$user_id,document.getElementById("editor").innerHTML.substr($first, $first-$last),$first,"UPDATE");
		  	        }
			        
			    }
			});*/

		/*var code = document.getElementById("editor").innerHTML;
		var code2text = document.createTextNode(code);
		document.getElementById("editor").innerHTML = "";
		document.getElementById("editor").appendChild(code2text);*/
</script>

</body>
</html>