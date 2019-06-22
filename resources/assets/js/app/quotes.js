(function () {
    'use strict';
    
    ATTD.global.quoteOfTheDay = function () {
        
        $.ajax({
            type: 'GET',
            url: 'http://quotes.rest/qod.json?category=students',
            data: {},
            success: function(data) {
                console.log("hmm");
                // var response=jQuery.parseJSON(data);
                // console.log(data);
                // if(response.hasOwnProperty('success')) {
                //     $("#quoteOfTheDay").html(response.contents.quotes[0].quote);
                //     $("#quoteOfTheDay").append("<br><span class='pull-right'><strong>~ "+response.contents.quotes[0].author+"</strong></span>");
                // }
            }
        });
    }
})();