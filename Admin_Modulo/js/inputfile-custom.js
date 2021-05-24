'use strict';
$(function () {
  $('.inputfile').each(function () {
    var $input = $(this);
    $input.on('change', function (e) {
      var fileName = '';
      if (e.target.value){
        fileName = e.target.value.split('\\').pop();
      }
      if (fileName){
        var $fileName = $('#file_name');
        $fileName.html(fileName);
      } else {
        $fileName.html('');
      }
    });
  });
});
