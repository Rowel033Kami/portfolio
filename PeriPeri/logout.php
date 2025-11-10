<?php
  session_start();
  session_destroy();
  echo "<script>window.alert('Logout Successfully');</script)";
  header("Location: index.php");
  exit;
  ?>
  