<?php
session_start();
?> 
<html>
<head>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
<link rel="stylesheet" type="text/css" href="css/style4.css">
<link href="syntaxhighlighter_3.0.83/styles/shCore.css" rel="stylesheet" type="text/css" />
<link href="syntaxhighlighter_3.0.83/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style type="text/css">
  .syntaxhighlighter { 
     overflow-y: auto !important; 
     overflow-x: auto !important; 
  }
  .syntaxhighlighter {
  width: 100% !important;
  margin: 1em 0 1em 0 !important;
  position: relative !important;
  overflow: auto !important;
  font-size: 1em !important;
  border: 1px solid #808080 !important;
  max-height: 390px;
}
 
</style>
<script>
Stamp = new Date();
function func_on_submit()
{
	//alert("Hello");
	var hour=0,min=0,sec=0;
	var Stamp1 = new Date();
	var diff=Stamp1-Stamp; 
	diff= parseInt(diff/1000);
	if (diff>=60)
	{
		sec=diff%60;
		diff=parseInt(diff/60);
		if(diff>=60)
		{
			min=diff%60;
			diff=parseInt(diff/60);
			hour=diff;
		}
		else
			min=diff;
	}
	else
	sec=diff;
	var new_time=document.getElementById("new_time");
	//alert("Hello1");
	//alert(new_time.innerHTML+'difference is '+diff); 
	var str=hour+'h '+min+'m '+sec+'s';
	//new_time.innerHTML=new_time.innerHTML+'<br/>difference is '+str;
	document.getElementById("time_spent").value=str;
	//alert("Function called and time spent = "+str);
}
function display_hint()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("hint_box").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","return_hint.php",true);
	xmlhttp.send();
	document.getElementById("viewed_hint").value=1;
}
</script>
</head>
<body>
<div class="header" >
    <!--h1>Aspiring Minds</h1-->
	 <img src="am_image.png" style="position: relative; left: 2%; top:17px;" alt="Smiley face" height="60" width="204" border=1> 
	 <h1>Automata Code Evaluation</h1>
	 <p>Welcome <?php echo $_SESSION['username'] ?></p>
    <!--h3>Less important heading here</h3-->
    <!--p>Some additional information here.</p-->
</div>
<div style="position: relative; left: 0%; top:40px;" class="assignment">
	<div style="" class="container-fluid" >
		<div style="background-color:#004f9f; position: relative; left: 0%; top:-38; height:40; color: #ffffff;  font-size:20px; " class="row">
		  <div style="position: relative; top:10;" class="col-md-3">Function Name: <?php echo $_SESSION['function_name'] ?></div>
		  <div style="position: relative; top:10;" class="col-md-3">Class Name: <?php echo $_SESSION['class_name'] ?></div>
		  <div style="position: relative; top:10;" class="col-md-3">Language: <?php echo $_SESSION['language'] ?></div>
		  <div style="position: relative; top:10;" class="col-md-3"><a href="signout.php" style="color: #ffffff;  font-size:20px;">Sign Out</a></div>
		</div>
		<div style="" class="row">
		  <div style="" class="col-md-6">
			<div style="" width="80%" height="70%">
				<!--iframe src="code_to_be_rated.html" style="overflow:visible; position: relative; top:-15; " scrolling="yes" width="90%" height="70%">
				  <p>Your browser does not support iframes.</p>
				</iframe-->
				<div id="code">
				<pre class='brush: cpp' >
				<?php echo $_SESSION['source_code'] ?>
				  </pre>

				  <script src="syntaxhighlighter_3.0.83/scripts/shCore.js"></script>
				  <script src="syntaxhighlighter_3.0.83/scripts/shBrushCpp.js"></script>
				  <script>
					SyntaxHighlighter.all()
				  </script>
				</div>			
			</div>
		  </div>
		  <div style="position: relative;" class="col-md-3">
			<form class="form-horizontal" onsubmit="func_on_submit()" method="post" action="update_tables.php">
			  <div class="form-group">
				<label for="Grade" class="col-sm-3 control-label">Grade</label>
				<div class="col-sm-10">				  
				   <select class="form-control" id="human_grades" name="human_grades"  placeholder="Grade" required>				  
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
				   </select> 
				</div>
			  </div>
			  <div class="form-group">
				<label for="Algorithm" class="col-sm-3 control-label">Algorithm</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="algorithm" name="algorithm" placeholder="Algorithm" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="Complexity" class="col-sm-3 control-label">Complexity</label>
				<div class="col-sm-10">
				  <select class="form-control" id="complexity" name="complexity" placeholder="Grade" required>
				   <?php
				  $complexityTable=array("-1"=>"Complexity cannot be determined.","1"=>"O(1)","2"=>"O(log N)","3"=>"O(N)","3.5"=>"O(N logN)",
				  "4"=>"O(N<sup>2</sup>)","5"=>"O(N<sup>3</sup>)","6"=>"O(N<sup>4</sup>)","7"=>"Exponential Complexity");
				  $num = count($complexityTable);
				  foreach($complexityTable as $key => $value) 
				  {
					echo "<option value='$value' > $value </option>";
				  }
				  ?>
					  <!--option value="O(1)">O(1)</option>
					  <option value="O(log log n)">O(log log n)</option>
					  <option value="O(log n)">O(log n)</option>
					  <option value="O(n)">O(n)</option>
					  <option value="O(n log n)">O(n log n)</option>
					  <option value="O(n^2)">O(n^2)</option>
					  <option value="O(n^3)">O(n^3)</option>
					  <option value="O(2^n)">O(2^n)</option-->
				   </select> 
				</div>
			  </div>
			  <div class="form-group">
				<label for="Comment" class="col-sm-3 control-label">Comment</label>
				<div class="col-sm-10">
				
				​<textarea style="width:100%" id="txtArea" name="comment" rows="6" cols="60" ></textarea>
				  <!--input type="text area" class="form-control" id="comment" placeholder="Comment"-->
				</div>
			  </div>		
			  <input type="hidden" id="time_spent" name="time_spent" value="0h 0m 0s" />
			  <input type="hidden" id="viewed_hint" name="viewed_hint" value="0" />
			  <div class="form-group">
				<div class="col-sm-offset-0 col-sm-7">
				  <button type="button" class="btn btn-default" id="displayhint"  onclick="display_hint()">Display Hint</button>
				</div>
				<div class="col-sm-offset-0 col-sm-1">
				  <button type="submit" class="btn btn-default">Next</button>
				</div>
			  </div>
			</form>
			<div id="hint_box">
			<p>Here hint will be shown</p>
			</div>
		  </div>
		  <div style="" class="col-md-3">
		  <div class="CSSTableGenerator" >
                <table >
                    <tr>
                        <td>
                            SCORE
                        </td>
                        <td >
                            INTERPRETATION
                        </td>
                    </tr>
                    <tr>
                        <td >
                            1
                        </td>
                        <td>
                            Gibberish Code
                        </td>
                    </tr>
                    <tr>
                        <td >
                           2
                        </td>
                        <td>
                            Emerging basic structures
                        </td>
                    </tr>
                    <tr>
                        <td >
                           3
                        </td>
                        <td>
                            Inconsistent logical structures
                        </td>                       
                    </tr>
                    <tr>
                        <td >
                          4
                        </td>
                        <td>
                            Correct with silly errors
                        </td>
                    </tr>
					<tr>
                        <td >
                          5
                        </td>
                        <td>
                            Correct code but no edge-case handling
                        </td>
                    </tr>
					<tr>
                        <td >
                          6
                        </td>
                        <td>                            
							Completely correct and but inefficient
                        </td>
                    </tr>
					<tr>
                        <td >
                          7
                        </td>
                        <td> 
                            Completely correct and efficient
                        </td>
                    </tr>
                </table>
            </div>
			<br/>
			<br/>
			<a href="detailedRuberic.php" style="color:#ffffff; text-decoration: none;" target="_blank" class="a_demo_four" >Click here for detailed interpretation.</a>
		  </div>
		</div>
	</div>
</div>
<footer id="main">
  <a href="#">Aspiring Minds</a> | <a href="#">Raters Login Page</a>
</footer>
</body>
</html>