(function () {
    'use strict';
    
    CONSOLEFLARE.home.courses = function () {
        var app=new Vue({
            el: '#root',
            data: {
                featured: [],
                courses: [],
                count: 0,
                loading: false,
                
            },
            methods: {
                getCourses: function () {
                    this.loading=true;
                    axios.all(
                        [
                            axios.get('/featured'), axios.get('/get-courses')
                        ]
                    ).then(axios.spread(function (featuredResponse, coursesResponse) {
                        app.featured=featuredResponse.data.featured;
                        app.courses=coursesResponse.data.courses;
                        app.count=coursesResponse.data.count;
                        app.loading=false;
                    }));
                },
                loadMoreCourses: function() {
                    var token=$('.allcourses').data('token');
                    this.loading=true;
                    var data=$.param({next: 3, token: token, count: app.count});
                    axios.post('/load-more', data).then(function (response) {
                        app.courses=response.data.courses;
                        app.count=response.data.count;
                        app.loading=false;
                    })
                }
            },
            created: function () {
                this.getCourses();
            },
            mounted: function () {
                $('#load-more').on('click',function () {
                    app.loadMoreCourses();
                })
            }
        });
    }
})();