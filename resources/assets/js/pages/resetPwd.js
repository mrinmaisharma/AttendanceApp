(function () {
    'use strict';
    
    CONSOLEFLARE.home.resetPwd = function () {
        //login
        $(".reset-pwd").on('submit', function(e) {
            var token=$(this).data('token');
            var username=$(this).data('username');
            var pwd1=$('#new_pwd1').val();
            var pwd2=$('#new_pwd2').val();
            if(pwd1!=pwd2) {
                var ul=document.createElement('ul');
                var li=document.createElement('li');
                li.appendChild(document.createTextNode('Confirm Password Does not match.'));
                ul.appendChild(li);
                $("#notification").css("display", 'block').removeClass('alert-success').addClass('alert-warning').delay(6000).slideUp(300).html(ul);
                e.preventDefault();
                return;
            }
            $("#loader").show();
            $.ajax({
                type: 'POST',
                url: '/forgotpassword/reset',
                data: {token: token, username: username, pwd: pwd1},
                success: function(data) {
                    var response=jQuery.parseJSON(data);
                    $("#loader").hide();
                    $("#notification").css("display", 'block').removeClass('alert-warning').addClass('alert-success').delay(4000).slideUp(300).html(response.success);
                    location.replace(response.uri);
                },
                error:function (request, error) {
                    $("#loader").hide();
                    var errors=jQuery.parseJSON(request.responseText);
                    var ul=document.createElement('ul');
                    $.each(errors, function (key, value) {
                        var li=document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $("#notification").css("display", 'block').removeClass('alert-success').addClass('alert-warning').delay(6000).slideUp(300).html(ul);
                }
            });
            
            e.preventDefault();
        });
    
    }
    
})();