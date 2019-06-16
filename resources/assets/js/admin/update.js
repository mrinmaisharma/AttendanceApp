(function() {
    'use strict';
    
    CONSOLEFLARE.admin.update = function() {
        
        
        //update course category
        $(".update-category").on('click', function(e) {
            var token=$(this).data('token');
            var id=$(this).attr('id');
            var name=$("#category-name-"+id).val();
            
            $.ajax({
                type: 'POST',
                url: '/admin/course/categories/'+id+'/edit',
                data: {token: token, name: name},
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
        
        $(".update-topic-form").on('submit', function(e) {
            var token=$(this).data('token');
            var id=$(this).data('id');
            var name=$("#topic-name-"+id).val();
            var description=$("#topic-desc-"+id).val();
            var course_id=$("#course-id-"+id).val();
            $.ajax({
                type: 'POST',
                url: '/admin/course/topic/edit',
                data: {token: token, id: id, name: name, description: description, course_id: course_id},
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
        
        //update subtopic
        $(".update-subtopic-form").on('submit', function(e) {
            var token=$(this).data('token');
            var id=$(this).data('id');
            var topic_id=$(this).data('topic');
            var name=$("#subtopicname-"+id).val();
            var selected_topic_id=$('#topicid-'+id+' option:selected').val();
            if(topic_id !== selected_topic_id) {
                topic_id=selected_topic_id;
            }
            
            $.ajax({
                type: 'POST',
                url: '/admin/course/subtopic/'+id+'/edit',
                data: {token: token, name: name, topic_id: topic_id},
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
        
        $(".update-webinar-link").on('submit', function(e) {
            var token=$(this).data('token');
            var id=$(this).data('id');
            var link=$("#webinar-link-"+id).val();
            var batch_id=$("#batch-"+id).val();
            $.ajax({
                type: 'POST',
                url: '/admin/webinar-link/'+id+'/edit',
                data: {token: token, link: link,  batch_id: batch_id},
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