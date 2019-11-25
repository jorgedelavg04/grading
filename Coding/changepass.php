<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>TONY_FEAR.COM</title>
	<link href="css/css.css" rel="stylesheet" type="text/css">
	
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
		
		<!-- CONTENTS -->
	  <div class="Contents">
			<img src="images/OnlineBanner.jpg" width="662">
			<div style="width:240px; height:400px; float:left; ">
				<?php
					$errors=array();
					if(isset($_REQUEST['submit'])){ // if the form was submiited
						validate_input();           // user defiend function to validate input
						if(count($errors) != 0 ){
							display_form();
						}
					}
					else{
						display_form();
					}
		
					//USER DEFINED FUNCTIONS
					function validate_input(){
						global $errors;
						
						if($_POST['newpass'] != $_POST['confnewpass']){
							$errors['newpass'] = "<font color='red'>password does not match</font>";
						}
						if($_POST['newpass']==''){
							$errors['newpass'] = "<font color='red'>please fill up the data</font>";
						}
						
						include 'includes/dbconnect.php';
						
						$sql="Update student_info_tbl set pass = '" . $_POST['newpass'] . "' where SID IN (Select SID from student_info_tbl where pass = '" . $_POST['oldpass'] . "')";
			
						$rs=odbc_exec($conn,$sql);
			
						if (!$rs){
							$errors['newpass'] = "<font color='red'>Invalid password or username</font>";
						}
						else{
							$rs=odbc_exec($conn,"Select * from student_info_tbl where userID = '" . $_POST['user'] . "' And pass = '" . $_POST['newpass'] . "'");
				
							if(odbc_fetch_row($rs)){
								$errors['newpass'] = "<font color='red'>Account Successfully Changed</font>";
							}
							else{
								$errors['newpass'] = "<font color='red'>Invalid username or password</font>";
							}
						}
			
			
						odbc_close($conn);
						
					}
		
					function display_form(){
						global $errors;
						
						?>
			
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				  				<table width="235" height="128" border="0" cellpadding="0" cellspacing="0" background="images/Welcombottom.jpg">
                      				<tr>
                        				<td width="32" height="28">&nbsp;</td>
                        				<td width="168"><font size="+2">Change Login</font></td>
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
                        				<td>Old Password:</td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td><input type="password" name="oldpass"></td>
                      				</tr>
					  				<tr>
                        				<td>&nbsp;</td>
                        				<td>New Password:</td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td><input type="password" name="newpass"></td>
                      				</tr>
					  				<tr>
                        				<td>&nbsp;</td>
                        				<td>Confirm New Password:</td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                        				<td><input type="password" name="confnewpass"></td>
                      				</tr>
                      				<tr>
                        				<td>&nbsp;</td>
                       				<td><input type="submit" name="submit" value="Change Password"></td>
                      				</tr>
					  				<tr>
                        				<td>&nbsp;</td>
                        				<td><?php echo $errors['newpass']; ?></td>
                      				</tr>
                    				</table>
        							<img src=" images/Genetic.jpg">
									<br>
								</form>
			
						<?php
					}
				?>
				
				</div>
				
				<div style="width:400px; float:right; height:400px; ">
					<br><br>
					<img src=" images/Blakbord.png" width="128" height="128">
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
		
		<!-- PERSONAL INFO -->
		<div class="PersonInfo" align="center">
			<img src=" images/tony3.jpg" width="162" height="178" border="2"><br>
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
		<?php include 'includes/footerNav.txt'; ?>
	</div>
	
	<!-- FOOTER -->
	<div class="footer" align="center" >
		Copyright © Genetic Computer Institute Davao All Rights Reserved 2009.
	</div>
	
</div>

</body>
</html>
