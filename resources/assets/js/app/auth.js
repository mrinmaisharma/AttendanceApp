(function () {
    'use strict';
    
    ATTD.global.auth = function () {
        //login
        $("#login-form").on('submit', function(e) {
            var token=$(this).data('token');
            var username=$("#login_username").val();
            var password=$("#password").val();
            var uri="/";
            // console.log();
            $("#login_loader").show();
            try {
                $.ajax({
                    type: 'POST',
                    url: '/login',
                    data: {token: token, username: username, password: password, uri: uri},
                    success: function(data) {
                        var response=jQuery.parseJSON(data);
                        $("#login_loader").hide();
                        $("#login_notification").css("display", 'block').removeClass('alert-warning').addClass('alert-success').delay(4000).slideUp(300).html(response.success);
                        location.replace(response.uri);
                    },
                    error:function (request, error) {
                        $("#login_loader").hide();
                        var errors=jQuery.parseJSON(request.responseText);
                        var ul=document.createElement('ul');
                        $.each(errors, function (key, value) {
                            var li=document.createElement('li');
                            li.appendChild(document.createTextNode(value));
                            ul.appendChild(li);
                        });
                        $("#login_notification").css("display", 'block').removeClass('alert-success').addClass('alert-warning').delay(6000).slideUp(300).html(ul);
                    }
                });
            }
            catch(err) {
                console.log(err.message);
            }
            
            e.preventDefault();
        });
                
        //forgotpwd
        $(".forgot-pwd").on('submit', function(e) {
            var token=$(this).data('token');
            var username=$("#reset_username").val();
            $("#forgot_loader").show();
            $.ajax({
                type: 'POST',
                url: '/forgotpassword',
                data: {token: token, username: username},
                success: function(data) {
                    var response=jQuery.parseJSON(data);
                    $("#forgot_loader").hide();
                    $("#forgotPwd_notification").css("display", 'block').removeClass('alert-warning').addClass('alert-success').delay(4000).slideUp(300).html(response.success);
                },
                error:function (request, error) {
                    $("#forgot_loader").hide();
                    var errors=jQuery.parseJSON(request.responseText);
                    var ul=document.createElement('ul');
                    $.each(errors, function (key, value) {
                        var li=document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $("#forgotPwd_notification").css("display", 'block').removeClass('alert-success').addClass('alert-warning').delay(6000).slideUp(300).html(ul);
                }
            });
            
            e.preventDefault();
        });
        
    }
    
})();