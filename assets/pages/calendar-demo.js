/*
 Template Name: Xacton - Admin & Dashboard Template
 Author: Myra Studio
 File: Calendar
*/


!function($) {
  "use strict";

  var CalendarPage = function() {};

  CalendarPage.prototype.init = function() {

      //checking if plugin is available
      if ($.isFunction($.fn.fullCalendar)) {
          /* initialize the external events */
          $('#external-events .fc-event').each(function() {
              // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
              // it doesn't need to have a start or end
              var eventObject = {
                  title: $.trim($(this).text()) // use the element's text as the event title
              };

              // store the Event Object in the DOM element so we can get to it later
              $(this).data('eventObject', eventObject);

              // make the event draggable using jQuery UI
              $(this).draggable({
                  zIndex: 999,
                  revert: true, // will cause the event to go back to its
                  revertDuration: 0 //  original position after the drag
              });
          });
          
          
          /* initialize the calendar */

          var date = new Date();
          var d = date.getDate();
          var m = date.getMonth();
          var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: false, // Remove the ability to move to the next or previous month
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            droppable: false, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
            {
                title: 'ว่าง 9',
                start: new Date(y, m, d),
                className: 'bg-success',
                textColor: '#fff',
                borderColor: '#2ac14e'
                
            },
            {
                title: 'เต็ม',
                start: new Date(y, m, d + 2),
                className: 'bg-danger',
                textColor: '#fff',
                borderColor: '#f15050',
            }
            ],
            displayEventTime: false,
            

        });



          $("#add_event_form").on('submit', function(ev) {
              ev.preventDefault();

              var $event = $(this).find('.new-event-form'),
                  event_name = $event.val();

              if (event_name.length >= 3) {

                  var newid = "new" + "" + Math.random().toString(36).substring(7);
                  // Create Event Entry
                  $("#external-events").append(
                      '<div id="' + newid + '" class="fc-event">' + event_name + '</div>'
                  );


                  var eventObject = {
                      title: $.trim($("#" + newid).text()) // use the element's text as the event title
                  };

                  // store the Event Object in the DOM element so we can get to it later
                  $("#" + newid).data('eventObject', eventObject);

                  // Reset draggable
                  $("#" + newid).draggable({
                      revert: true,
                      revertDuration: 0,
                      zIndex: 999
                  });

                  // Reset input
                  $event.val('').focus();
              } else {
                  $event.focus();
              }
          });

          

      }
      else {
          alert("Calendar plugin is not installed");
      }
  },
  //init
  $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
}(window.jQuery),

//initializing 
function($) {
  "use strict";
  $.CalendarPage.init()
}(window.jQuery);