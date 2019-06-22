(function() {
    
    'use strict';
    
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
    
    $(document).ready(function () {
        
        //switch pages
        switch ($("body").data("page-id")) {
            case 'dashboard':
                ATTD.global.quoteOfTheDay();
                break;
            default:
                //do nothing
                
        }
        
    });
    
})();