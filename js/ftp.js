var spin_opts = {
  lines: 12,
  length: 20,
  width: 3,
  radius: 42,
  corners: 0,
  rotate: 0,
  direction: 1,
  color: '#fff',
  speed: 1.2,
  trail: 50,
  shadow: false,
  hwaccel: true,
  className: 'spinner',
  zIndex: 2e9,
  top: '50%',
  left: '50%'
};

$(function() {
  var query = window.location.search;
  var path = decodeSpaces(query.replace('?p=', ''));

  if(query.indexOf('.cbz') != -1 || query.indexOf('.cbr') != -1) {
    ftp_get(path);
  } else if (query.indexOf('?p=') != -1) {
    ftp_list(path);
  } else {
    ftp_list('.');
  }
});

function ftp_list(direc) {
  clear_and_spin();

  $.ajax({
    type: 'POST',
    url: '/php/ftp_list.php',
    dataType: 'json',
    data: {'direc': direc},

    success: function(result) {
      $('.file-direc').html(direc);
      for (var i in result) {
        var path = result[i];
        var file_name = path.replace(direc + '/', '');
        if (path.indexOf('./') === 0) {
          path = path.substring(2);
        }
        path = encodeSpaces(path);

        if (file_name.substring(0,1) != '.') {
          $('.file-list').append('<li><a class="ftp-file" href="?p=' + path + '">' + file_name + '</a></li>');
        }
      }

      $('.spinner').fadeOut();
      $('.file-list').fadeIn();
    },
    error: function() {
      console.error('Could not retrieve FTP listing.');
    }
  });
}

function ftp_get(file) {
  clear_and_spin();

  $.ajax({
    type: 'POST',
    url: '/php/ftp_get.php',
    data: {'file': file},

    success: function(result) {
      $('.spinner').fadeOut();
      console.log(result);
      // handleJpgs('http://tmp.benteichman.ca/', result);
      $('.file-container').slideUp();
    },
    error: function() {
      console.error('Could not download file from FTP.');
    }
  });
}

function clear_and_spin() {
  $('.file-direc').empty();
  $('.file-list').hide().empty();

  var file_container = document.getElementById('file-container');
  new Spinner(spin_opts).spin(file_container);
}

function encodeSpaces(path) {
  return path.replace(/\s/g, '~');
}

function decodeSpaces(path) {
  return path.replace(/~/g, ' ');
}
