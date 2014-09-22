<?php
  include 'ChromePhp.php';

  $pages_directory = "/tmp/pages";

  function ftp_access() {
      $ftp_server = "192.168.10.30";
      $ftp_username = "benteichman";
      $ftp_userpass = "M#n4g3r1e";

      ChromePhp::log('getting new access token');
      $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
      $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

      return $ftp_conn;
  }

  function unzip($ftp_conn, $file, $pagedir) {
    $tmpfile = "/tmp/comic.cbz";

    if (ftp_get($ftp_conn, $tmpfile, $file, FTP_BINARY)) {
      ftp_close($ftp_conn);
      ChromePhp::log('CBZ downloaded');
      $zip = new ZipArchive();
      $res = $zip->open($tmpfile);

      clr_pages($pagedir);
      // if ($res === TRUE) {
      //   $zip->extractTo($pagedir);
      //   $zip->close();
      //   safe_unlink($tmpfile);
      //
      //   echo json_encode(scandir($pagedir));
      // }

      for ($i = 0; $i < $zip->numFiles; $i++) {
        $name = $zip->getNameIndex($i);
        ChromePhp::log($name);
        $stream = $zip->getStream($name);
        ChromePhp::log($stream);
        if ($stream) {
          $image = stream_get_contents($stream);
          $encoded = base64_encode($image);
          ChromePhp::log("sending now");
          echo $encoded;
        } else {
          ChromePhp::log("Error getting stream!");
        }
      }
    }
  }

  function unrar($ftp_conn, $file, $pagedir) {
    $tmpfile = "/tmp/comic.cbr";

    if (ftp_get($ftp_conn, $tmpfile, $file, FTP_BINARY)) {
      ftp_close($ftp_conn);
      ChromePhp::log('CBR downloaded');
      $rar = rar_open($tmpfile) or die("Could not open cbr file.");

      clr_pages($pagedir);
      $entries = rar_list($rar);

      // foreach ($entries as $i => $entry) {
      $entry = $entries[0];
      ChromePhp::log("Entry: $entry");
      // $page = sprintf("%s/%05d.jpg", $pagedir, $i);
      $file = $entry->getStream();
      $e = new Exception;
      var_dump($e->getTraceAsString());
      ChromePhp::log("Stream: $file");
      if ($file) {
        $image = stream_get_contents($file);
        $encoded = base64_encode($image);
        ChromePhp::log("sending now");
        echo $encoded;
      } else {
        ChromePhp::log("Error getting stream!");
      }
      // exit;
      // $entry->extract($pagedir, $page);
      // }

      rar_close($rar);
      // safe_unlink($tmpfile);
      // echo json_encode(scandir($pagedir));
    }
  }

  function clr_pages($dir) {
    safe_unlink("/tmp/comic.cbz");
    safe_unlink("/tmp/comic.cbr");

    if (is_dir($dir)) {
      $old_files = scandir($dir);
      foreach ($old_files as $old_file) {
        if ($old_file != "." && $old_file != "..") {
            unlink($dir."/".$old_file);
        }
      }
    }
  }

  function safe_unlink($file) {
    if (is_file($file)) {
      unlink($file);
    }
  }
?>
