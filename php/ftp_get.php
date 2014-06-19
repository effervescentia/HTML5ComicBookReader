<?php
  include 'ftp_utils.php';

  $file = $_REQUEST["file"];
  $ftp_conn = ftp_access();

  if (substr($file, -4) == ".cbz") {
    unzip($ftp_conn, $file, $pages_directory);
  } else {
    unrar($ftp_conn, $file, $pages_directory);
  }
?>
