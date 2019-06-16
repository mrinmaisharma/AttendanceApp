(function () {
    'use strict';
    
    CONSOLEFLARE.course.checkout = function () {
        var app = new Vue({
            el: '#course_checkout',
            data: {
                details: [],
                total: [],
                loading: false,
                fail: false,
                message: ''
            },
            methods: {
                displayDetails: function (time) {
                    this.loading = true;
                    setTimeout(function () {
                        axios.get('/cart/items').then(function (response) {
                            if(response.data.fail) {
                                app.fail = true;
                                app.message = response.data.fail;
                                app.loading = false
                            }
                            else {
                                app.items = response.data.items;
                                app.cartTotal = response.data.cartTotal;
                                app.loading = false;
                            }
                        });
                    }, time);
                }
            },
            created: function () {
                this.displayDetails(2000);
            }
        });
    }
})();