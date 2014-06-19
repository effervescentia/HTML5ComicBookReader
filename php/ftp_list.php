<?php
  include 'ftp_utils.php';

  $direc = $_REQUEST["direc"];
  $ftp_conn = ftp_access();

  $file_list = ftp_nlist($ftp_conn, $direc);
  ftp_close($ftp_conn);

  echo json_encode($file_list);
?>
