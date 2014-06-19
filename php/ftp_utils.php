<?php
  include 'ChromePhp.php';

  $pages_directory = "/tmp/pages";

  function ftp_access() {
      
      $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
      $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

      return $ftp_conn;
  }

  function unzip($ftp_conn, $file, $pagedir) {
    $tmpfile = "/tmp/comic.cbz";

    if (ftp_get($ftp_conn, $tmpfile, $file, FTP_BINARY)) {
      ftp_close($ftp_conn);
      $zip = new ZipArchive();
      $res = $zip->open($tmpfile);

      clr_pages($pagedir);
      if ($res === TRUE) {
        $zip->extractTo($pagedir);
        $zip->close();

        echo json_encode(scandir($pagedir));
      }
    }
  }

  function unrar($ftp_conn, $file, $pagedir) {
    $tmpfile = "/tmp/comic.cbr";

    if (ftp_get($ftp_conn, $tmpfile, $file, FTP_BINARY)) {
      ftp_close($ftp_conn);
      $rar = rar_open($tmpfile) or die("Could not open cbr file.");

      clr_pages($pagedir);
      $entries = rar_list($rar);

      foreach ($entries as $i => $entry) {
        $page = sprintf("%s/%05d.jpg", $pagedir, $i);
        $entry->extract($pagedir, $page);
        // passback($entry->getStream());
      }

      rar_close($rar);
      echo json_encode(scandir($pagedir));
    }
  }

  function clr_pages($dir) {
    if (is_dir($dir)) {
      $old_files = scandir($dir);
      foreach ($old_files as $old_file) {
        if ($old_file != "." && $old_file != "..") {
            unlink($dir."/".$old_file);
        }
      }
    }
  }

  function passback($file) {
    header("Content-Type: image/jpg");
    header("Content-Length: ".filesize($file));

    fpassthru($file);
  }
?>
