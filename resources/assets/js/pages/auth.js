(function () {
    'use strict';
    
    CONSOLEFLARE.home.auth = function () {
        //login
        $(".login-form").on('submit', function(e) {
            var token=$(this).data('token');
            var username=$("#login_username").val();
            var password=$("#password").val();
            var remember=-1;
            var uri=location.pathname;
            if($("#remember").is(':checked')) {
                remember=$('#remember').val();
            }
            $("#login_loader").show();
            $.ajax({
                type: 'POST',
                url: '/login',
                data: {token: token, username: username, password: password, remember: remember, uri: uri},
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
            
            e.preventDefault();
        });
        
        //signup
        $(".signup-form").on('submit', function(e) {
            var token=$(this).data('token');
            var username=$("#username").val();
            var fullname=$("#fullname").val();
            var email=$("#user_email").val();
            var pwd1=$("#pwd1").val();
            var pwd2=$("#pwd2").val();
            var uri=location.pathname;
            if(pwd1!=pwd2) {
                var ul=document.createElement('ul');
                var li=document.createElement('li');
                li.appendChild(document.createTextNode('Confirm Password Does not match.'));
                ul.appendChild(li);
                $("#signup_notification").css("display", 'block').removeClass('alert-success').addClass('alert-warning').delay(6000).slideUp(300).html(ul);
                e.preventDefault();
                return;
            }
            $("#signup_loader").show();
            $.ajax({
                type: 'POST',
                url: '/signup',
                data: {token: token, username: username, fullname: fullname, email: email, password: pwd1, uri: uri},
                success: function(data) {
                    var response=jQuery.parseJSON(data);
                    $("#signup_loader").hide();
                    $("#signup_notification").css("display", 'block').removeClass('alert-warning').addClass('alert-success').delay(4000).slideUp(300).html(response.success);
                    location.replace(response.uri);
                },
                error:function (request, error) {
                    var errors=jQuery.parseJSON(request.responseText);
                    var ul=document.createElement('ul');
                    $.each(errors, function (key, value) {
                        var li=document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $("#signup_notification").css("display", 'block').removeClass('alert-success').addClass('alert-warning').delay(6000).slideUp(300).html(ul);
                }
            });
            
            e.preventDefault();
        });
        
        //login
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