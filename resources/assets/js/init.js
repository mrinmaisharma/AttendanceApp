(function() {
    
    'use strict';
    
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
    
    $(document).ready(function () {
        
        //switch pages
        switch ($("body").data("page-id")) {
            case 'home':
                CONSOLEFLARE.home.slider();
                CONSOLEFLARE.home.auth();
                break;
            case 'courses':
                CONSOLEFLARE.home.courses();
                CONSOLEFLARE.home.auth();
                break;
            case 'course':
                CONSOLEFLARE.home.auth();
                CONSOLEFLARE.course.upcomingBatches();
                CONSOLEFLARE.course.curriculum();
                break;
            case 'verify':
                CONSOLEFLARE.home.auth();
                CONSOLEFLARE.home.resendEmail();
                break;
            case 'login':
                CONSOLEFLARE.home.auth();
                break;
            case 'resetPassword':
                CONSOLEFLARE.home.resetPwd();
                break;
            case 'checkout':
                CONSOLEFLARE.course.checkout();
                CONSOLEFLARE.home.auth();
                break;
            case 'adminCourse':
                break;
            case 'adminCategories':
                CONSOLEFLARE.admin.update();
                break;
            case 'adminCourseTopics':
                CONSOLEFLARE.admin.create();
                CONSOLEFLARE.admin.update();
                break;
            case 'adminWebinarLinks':
                CONSOLEFLARE.admin.changeEvent();
                CONSOLEFLARE.admin.update();
                break;
            case 'adminLectures':
                CONSOLEFLARE.admin.changeEvent();
                break;
            default:
                //do nothing
                
        }
        
    });
    
})();