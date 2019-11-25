<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>TONY_FEAR.COM</title>
	<link href="css/css.css" rel="stylesheet" type="text/css">
	<!-- THIS ESSENTIAL IN PLAYING FLASH -->
	<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
	<script type="text/javascript">
		function mhover(obj,txt){
			obj.src =txt;
		}
		function mout(obj,txt){
			obj.src =txt;
		}
	</script>
</head>

<body>

<!-- CONTAINER OF DIV'S -->
<div class="container">
	
	<!-- HEADER -->
	<div class="header">
	</div>
	
	<!-- NAVIGATOR -->
	<div class="navigator" align="center">
		<?php include 'includes/mainNav.txt'; ?>
	</div>
	
	<!-- MARQUEE INFO -->
	<div class="marqueeInfo">
		<?php include 'includes/Navmarquee.txt'; ?>
	</div>
	
	<!-- TEXT CONTAINER -->
	<div class="bodycontainer">
		<!-- Another div here for info-->
		
				<?php
					$errors=array();
					if(isset($_REQUEST['submit'])){ // if the form was submiited
						validate_input();           // user defiend function to validate input
						if(count($errors) != 0 ){
							display_form();
						}
						else{
							display_grades();
						}
					}
					else{
						display_form();
					}
		
					//USER DEFINED FUNCTIONS
					//FUNCTION TO DISPLAY RECORDSET
					function display($r){
						$f1=odbc_result($r,"Subject");
  						$f2=odbc_result($r,"Attendance");
						$f3=odbc_result($r,"AttItem");
  						$f4=odbc_result($r,"Quizzes");
						$f5=odbc_result($r,"QuiItem");
  						$f6=odbc_result($r,"OralProjectPart");
						$f7=odbc_result($r,"OralItem");
  						$f8=odbc_result($r,"Exam");
						$f9=odbc_result($r,"ExamItem");
  						$f10=odbc_result($r,"Grade");

						echo "<tr bgcolor='#00CCee'><td>" . $f1 . "</td>";
						echo "<td>" . $f2 . "</td>";
						echo "<td>" . $f3 . "</td>";
						echo "<td>" . $f4 . "</td>";
						echo "<td>" . $f5 . "</td>";
						echo "<td>" . $f6 . "</td>";
						echo "<td>" . $f7 . "</td>";
						echo "<td>" . $f8 . "</td>";
						echo "<td>" . $f9 . "</td>";
  						echo "<td>" . $f10 . "</td></tr>";
					}
					
					function validate_input(){
						global $errors;
						if(($_POST['user'] == "") && ($_POST['pass'] == "")){
							$errors['user'] = "<font color='red'>enter username or password</font>";
						}
					}
					
					function display_grades(){
							
							include 'includes/dbconnect.php';
							
							$sql="Select Subject, ((((((((((Attendance/AttItem)*60)+40)*.1)+((((Quizzes/QuiItem)*60)+40)*.6)+((((OralProjectPart/OralItem)*60)+40)*.3))/100)*60)+40)*.6)+((((Exam/ExamItem)*60)+40)*.4)) as Grade, SID,* From GRADES_TBL Where SID IN (Select SID From Student_Info_Tbl where UserID = '" . $_POST['user'] . "' and pass = '" . $_POST['pass'] . "')";
				 
							$rs=odbc_exec($conn,$sql);
							if (!$rs)
  								{exit("Error in SQL");}
			
							if(!odbc_fetch_row($rs)){
								global $errors;
								$errors['user'] = "<font color='red'>Invalid username or password</font>";
								display_form();
							}
							else{
								echo "<div style='width:640px; height:400px; float:left; ' align='center'>";
								echo "<h1>" . $_POST['user'] . "'s List of Grades</h1>";
			
								echo "<table border='1' cellspacing='0' cellpadding='0'><tr  bgcolor='#0066FF'>";
								echo "<th>Subject</th>";
								echo "<th>Attend</th>";
								echo "<th>Items</th>";
								echo "<th>Quizzes</th>";
								echo "<th>Items</th>";
								echo "<th>Oral/Project</th>";
								echo "<th>Items</th>";
								echo "<th>Exam</th>";
								echo "<th>Items</th>";
								echo "<th>Final Grade</th></tr>";
			
								display($rs);
			
								while ($row = odbc_fetch_row($rs))
								{
									display($rs);
								}
			
								echo "</table>";
								echo "</div>";
							}
							odbc_close($conn);
					}
					
					function display_form(){
						global $errors;
						?>
							<!-- CONTENTS -->
	  						<div class="Contents">
								<img src="images/OnlineBanner.jpg" width="662">
								<div style="width:240px; height:400px; float:left; ">
								<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<table width="235" height="128" border="0" cellpadding="0" cellspacing="0" background="images/Welcombottom.jpg">
                      				<tr>
                        				<td width="32" height="28">&nbsp;</td>
                        				<td width="168"><font size="+2">LOGIN USER</font></td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td>Username:</td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td><input type="text" name="user" value="<?php echo $_POST['user']; ?>"></td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td>Password:</td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td><input type="password" name="pass"></td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td><input type="submit" name="submit" value="LOG IN"><a href="changepass.php">change password</a></td>
                      				</tr>
					  				<tr>
                        				<td>&nbsp;</td>
                        				<td><?php echo $errors['user']; ?></td>
                      				</tr>
                    			</table>
        						<img src="images/Genetic.jpg">
								<br>
								<img src="images/Genetic%20Logo.JPG" width="238" height="90">
								</form>
								
								</div>
								<div style="width:400px; float:right; height:400px; ">
									<br><br>
									<img src="images/Blakbord.png" width="128" height="128">
									<br><br><br>
									In education, a grade (or mark) <br>
									is a teacher's standardized evaluation <br>
									of a student's work. In some countries, <br>
									evaluations can be expressed quantifiably, <br>
									and calculated into a numeric grade point <br>
									average (GPA), <br><br>
									which is used as a metric <br>
									by employers and others to assess and <br>
										compare students. A cumulative grade <br>
									point average (CGPA) is the mean GPA from <br>
									all terms, whereas GPA may only refer to <br>
									a single term.
								</div>
		  					</div>
							
						<?php
					}
				?>
				
		<!-- PERSONAL INFO -->
		<div class="PersonInfo" align="center">
			<img src="images/tony3.jpg" width="162" height="178" border="2"><br>
			  <br>
			<div class="inName">
				Winston Gubantes
			</div>
			<br>
		  	<div class="inOccupation" align="left">
				<?php include 'includes/infomarquee.txt'; ?>
		  	</div>
  	  </div>
	</div>
	
	
	<!-- FOOTER NAV-->
	<div class="footerNav" align="center" >
		<?php include 'includes/footernav.txt'; ?>
	</div>
	
	<!-- FOOTER -->
	<div class="footer" align="center" >
		Copyright © Genetic Computer Institute Davao All Rights Reserved 2009.
	</div>
	
</div>

</body>
</html>
