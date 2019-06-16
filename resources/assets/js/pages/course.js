(function () {
    
    'use strict';
    
    CONSOLEFLARE.course.curriculum = function () {
        var course_id=$("#curriculum").data('course_id');
        var app = new Vue({
            el: '#curriculum',
            data: {
                topics: [],
                loading: false
            },
            methods: {
                getCurriculum: function () {
                    this.loading = true;
                    axios.get('/course/'+course_id+'/curriculum').then(function (response) {
                        app.topics=response.data;
                        app.loading=false;
                    });
                }
            },
            created: function () {
                this.getCurriculum();
            }
        });
    }
    
    CONSOLEFLARE.course.upcomingBatches = function () {
        var course_id=$("#upcoming-batches").data('course_id');
        var app = new Vue({
            el: '#upcoming-batches',
            data: {
                batches: [],
                count: 0,
                loading: false
            },
            methods: {
                getBatches: function () {
                    this.loading = true;
                    axios.get('/course/'+course_id+'/batches').then(function (response) {
                        app.batches=response.data.batches;
                        app.count=response.data.count;
                        app.loading=false;
                    });
                }
            },
            created: function () {
                this.getBatches();
            }
        });
    }
    
})();