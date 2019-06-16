(function() {
    'use strict';
    
    CONSOLEFLARE.admin.create = function() {
        
        //create course subtopic
        $(".create-subtopic-form").on('submit', function(e) {
            var token=$(this).data('token');
            var topic_id=$(this).data('id');
            var name=$("#subtopic-name-"+topic_id).val();
            var course_id=$("#course-id-"+topic_id).val();
            $.ajax({
                type: 'POST',
                url: '/admin/course/subtopic/create',
                data: {token: token, name: name, topic_id: topic_id, course_id: course_id},
                success: function(data) {
                    var response=jQuery.parseJSON(data);
                    $(".notification").css("display", 'block').removeClass('alert-warning').addClass('alert-success').delay(4000).slideUp(300).html(response.success);
                },
                error:function (request, error) {
                    var errors=jQuery.parseJSON(request.responseText);
                    var ul=document.createElement('ul');
                    $.each(errors, function (key, value) {
                        var li=document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $(".notification").css("display", 'block').removeClass('alert-success').addClass('alert-warning').delay(6000).slideUp(300).html(ul);
                }
            });
            
            e.preventDefault();
        });
        
    };
})();