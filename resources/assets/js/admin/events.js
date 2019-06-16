(function() {
    'use strict';
    
    CONSOLEFLARE.admin.changeEvent = function () {
        $('.course-select').on('change', function() {
            var selection_id=$(this).data('id');
            var course_id=$('#course-select-'+selection_id+' option:selected').val();
            $('#batch-'+selection_id).html('<option value="" disabled selected>---Select Batch---</option>');
            $.ajax({
                type: 'POST',
                url: '/admin/course/'+course_id+'/getbatches',
                data: {course_id:course_id},
                success: function(response) {
                    var batches = jQuery.parseJSON(response);
                    if(batches.length) {
                        $.each(batches, function(key, value) {
                            $('#batch-'+selection_id).append('<option value="'+value.id+'">'+value.started_at+' | '+value.time+'</option>');
                        });
                    }
                    else {
                        $('#batch-'+selection_id).append('<option value="" disabled selected>---No Records Found---</option>');
                    }
                }
            });
        });
        
        //lectures-page
        $('.select-course').on('change', function() {
            var selection_id=$(this).data('id');
            var course_id=$('#select-course-'+selection_id+' option:selected').val();
            $('#select-batch-'+selection_id).html('<option value="" disabled selected>---Select Batch---</option>');
            $('#select-topic-'+selection_id).html('<option value="" disabled selected>---Select Batch---</option>');
            $.ajax({
                type: 'POST',
                url: '/admin/course/'+course_id+'/batchesandtopics',
                data: {course_id:course_id},
                success: function(response) {
                    var data = jQuery.parseJSON(response);
                    if(data[0].length) {
                        $.each(data[0], function(key, value) {
                            $('#select-batch-'+selection_id).append('<option value="'+value.id+'">'+value.started_at+' | '+value.time+'</option>');
                        });
                    }
                    else {
                        $('#select-batch-'+selection_id).append('<option value="" disabled selected>---No Records Found---</option>');
                    }
                    if(data[1].length) {
                        $.each(data[1], function(key, value) {
                            $('#select-topic-'+selection_id).append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                    else {
                        $('#select-topic-'+selection_id).append('<option value="" disabled selected>---No Records Found---</option>');
                    }
                }
            });
        });
    }
})();