<?php
  $conn=odbc_connect('student_odbc','','');
  if (!$conn)
    {exit("Connection Failed: " . $conn);}
?>
