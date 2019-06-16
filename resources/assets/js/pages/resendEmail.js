(function () {
    'use strict';
    
    CONSOLEFLARE.home.resendEmail = function () {
        //login
        $("#resendLink").on('click', function(e) {
            var token=$(this).data('token');
            var username=$("#verify-username").val();
            $("#loader").show();
            $.ajax({
                type: 'POST',
                url: '/resend/otp',
                data: {token: token, username: username},
                success: function(data) {
                    var response=jQuery.parseJSON(data);
                    $("#loader").hide();
                    $("#notification").css("display", 'block').removeClass('alert-warning').addClass('alert-success').delay(4000).slideUp(300).html(response.success);
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