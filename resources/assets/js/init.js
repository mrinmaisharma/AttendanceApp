(function() {
    
    'use strict';
    
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
    
    $(document).ready(function () {
        
        //switch pages
        switch ($("body").data("page-id")) {
            case 'login':
                ATTD.global.auth();
                break;
            default:
                //do nothing
                
        }
        
    });
    
})();