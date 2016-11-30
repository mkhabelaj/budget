$(Document).ready(function () {$('#submit').prop('disabled',true);

  $('#form').keyup(function () {
      if($('#password').val() != $('#confirmPassword').val() &&
          !$('#password').input().empty()
          && !$('#confirmPassword').input().empty()){

          console.log("this is not equal");
          $('#password').css('color');

          $('#submit').prop('disabled',true);
      }else {
          console.log("this is equal");
          $('#submit').prop('disabled',false);
      }
  });

});