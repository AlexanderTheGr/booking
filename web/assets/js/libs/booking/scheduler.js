(function ($) {
    $.fn.scheduler = function (custom) {

        var scheduler = this;
        init();

        function init() {
            startCalendar();
        }


        function startCalendar() {
            scheduler.fullCalendar({
                resourceAreaWidth: 230,
                defaultDate: '2016-01-07',
                editable: true,
                aspectRatio: 1.5,
                scrollTime: '00:00',
                schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                header: {
                    left: 'promptResource today prev,next',
                    center: 'title',
                    right: 'timelineWeek,timelineMonth,timelineYear'
                },
                customButtons: {
                    promptResource: {
                        text: '+ room',
                        click: function () {
                            var title = prompt('Room name');
                            if (title) {
                                $('#calendar').fullCalendar(
                                        'addResource',
                                        {title: title},
                                true // scroll to the new resource?
                                        );
                            }
                        }
                    }
                },
                defaultView: 'timelineWeek',
                views: {
                    timelineThreeDays: {
                        type: 'timeline',
                        duration: {days: 7}
                    }
                },
                resourceLabelText: 'Rooms',
                resources: {// you can also specify a plain string like 'json/resources.json'
                    url: 'scheduler/resources',
                    error: function () {
                        $('#script-warning').show();
                    }
                },
                events: {// you can also specify a plain string like 'json/events.json'
                    url: 'scheduler/events',
                    error: function () {
                        $('#script-warning').show();
                    }
                }
            });
        }
    }

})(jQuery);

$('#calendar').scheduler();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


