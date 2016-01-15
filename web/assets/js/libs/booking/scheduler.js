(function ($) {
    $.fn.scheduler = function (custom) {
        var defaults = {
            dateFormat: 'YYYY-MM-DD',
            resourceAreaWidth: 230,
            editable: true,
            aspectRatio: 1.5,
            scrollTime: '00:00',
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            event: 'scheduler/event',
            _mainurl: '/'
        }
        var scheduler = this;
        var $dialog = {};
        var settings = $.extend({}, defaults, custom);
        init();

        function init() {
            $dialog.scheduler = $("<div></div>")
                    .dialog({
                        autoOpen: false,
                        resizable: false,
                        draggable: false,
                        width: '200px',
                        modal: true
                    });
            startCalendar();
        }


        function startCalendar() {
            scheduler.fullCalendar({
                resourceAreaWidth: settings.resourceAreaWidth,
                editable: settings.editable,
                theme: true,
                overlap: false,
                aspectRatio: 1.5,
                scrollTime: settings.scrollTime,
                schedulerLicenseKey: settings.schedulerLicenseKey,
                header: {
                    left: 'promptResource today prev,next',
                    center: 'title',
                    right: 'timelineMonth,timelineYear'
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
                defaultView: 'timelineMonth',
                views: {
                    timelineThreeDays: {
                        type: 'timeline',
                        duration: {days: 7}
                    },
                    timelineMonth: {
                        snapDuration: '24:00:00'
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
                },
                eventOverlap: function (stillEvent, movingEvent) {
                    return stillEvent.allDay && movingEvent.allDay;
                },
                eventDrop: function (event, delta, revertFunc, jsEvent, ui, view) {
                    postEvent(event, 'eventDrop');
                },
                eventDragStart: function (event, jsEvent, ui, view) {
                    //postEvent(event, 'eventDragStart');
                },
                eventDragStop: function (event, jsEvent, ui, view) {
                    //postEvent(event, 'eventDragStop');
                },
                eventResize: function (event, delta, revertFunc, jsEvent, ui, view) {
                    postEvent(event, 'eventResize');
                },
                eventResizeStart: function (event, jsEvent, ui, view) {
                    //postEvent(event, 'eventResizeStart');
                },
                eventResizeStop: function (event, jsEvent, ui, view) {
                    //postEvent(event, 'eventResizeStop');
                },
                eventClick: function (event, jsEvent, ui, view) {
                    postEvent(event, 'eventClick');
                },
                dayClick: function (date, jsEvent, view, resourceObj) {
                    var event = {};
                    if (title = prompt('Room name')) {
                        event.start = moment(date).format(settings.dateFormat);
                        event.end = moment(date).format(settings.dateFormat);
                        event.id = 0;
                        event.allDay = true;
                        event.title = title;
                        event.resourceId = resourceObj.id;
                        event.editable = true;
                        postEvent(event, 'dayClick');
                    }
                },
            });
        }
        function postEvent(event, action) {
            var data = calEvent(event);
            data.action = action;
            $.post(settings._mainurl + settings.event, data, function (result) {
                refetchCalendar();
            })
        }
        function refetchCalendar() {
            scheduler.fullCalendar('refetchEvents')
        }
        function calEvent(calEvent) {
            var data = {};
            data.start = moment(calEvent.start).format(settings.dateFormat);
            data.end = moment(calEvent.end).format(settings.dateFormat);
            data.end = data.end == 'Invalid date' ? data.start : data.end;
            data.id = calEvent.id;
            data.allDay = calEvent.allDay;
            data.resourceId = calEvent.resourceId;
            data.editable = calEvent.editable;
            return data;
        }
    }

})(jQuery);

$('#calendar').scheduler();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


