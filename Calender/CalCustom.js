
$(document).ready(function() {
/* initialize the external events
-----------------------------------------------------------------*/

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
revert: true,      // will cause the event to go back to its
revertDuration: 0  //  original position after the drag
});
});
/* initialize the calendar
-----------------------------------------------------------------*/

$('#calendar').fullCalendar({
header: {
left: 'prev,next today',
center: 'title',
right: 'month,agendaWeek,agendaDay'
},
editable: true,
eventLimit: true, // allow "more" link when too many events
droppable: true, // this allows things to be dropped onto the calendar !!!
drop: function(date) { // this function is called when something is dropped
// retrieve the dropped element's stored Event Object
var originalEventObject = $(this).data('eventObject');
// we need to copy it, so that multiple events don't have a reference to the same object
var copiedEventObject = $.extend({}, originalEventObject);
// assign it the date that was reported
copiedEventObject.start = date;

$(".popupdrop").show();
$(".popupdrop").focus();
// render the event on the calendar
// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
// is the "remove after drop" checkbox checked?
if ($('#drop-remove').is(':checked')) {
    // if so, remove the element from the "Draggable Events" list
    $(this).remove();}},

eventClick: function(calEvent, jsEvent, view) {
        var id = calEvent.id;
        var name = calEvent.title;
        var start = calEvent.start;
        $("#eventPop").text("you clicked the " + id + " " + name);
        $("#upId").val(id);
        $("#upTitle").val(name);
        $("#upStartDate").val(calEvent.start);
        $("#upEndDate").val(calEvent.end);
        //$(".upLink").val(calEvent.link);
        $(".popupupdate").show();
        $(".popupupdate").focus();
}
});
//$(".js-example-basic-single").select2();
});

$(function() {
$( "#Startdatepicker" ).datepicker({
dateFormat: "dd-mm-yy",
minDate: 0,
onSelect: function (date) {
var date2 = $('#Startdatepicker').datepicker('getDate');
date2.setDate(date2.getDate() + 1);
$('#Enddatepicker').datepicker('setDate', date2);
//sets minDate to dt1 date + 1
$('#Enddatepicker').datepicker('option', 'minDate', date2);
}
});
$( "#Enddatepicker" ).datepicker({
dateFormat: "dd-mm-yy",
onClose: function () {
var dt1 = $('#Startdatepicker').datepicker('getDate');
var dt2 = $('#Enddatepicker').datepicker('getDate');
//check to prevent a user from entering a date below date of dt1
if (dt2 <= dt1) {
var minDate = $('#Enddatepicker').datepicker('option', 'minDate');
$('#Enddatepicker').datepicker('setDate', minDate);
$('#Enddatepicker').datepicker('setDate', minDate);
}
}
});
//$('#startTimepicker').timepicker();
//$('#endTimepicker').timepicker();
});

function pophide() {
$('#Note').val('');
$('#Title').val('');
$('#Startdatepicker').val('');
$('#Enddatepicker').val('');
$('#Link').val('');
$('#startTimepicker').val('');
$('#endTimepicker').val('');
$('#selectevent').val(0);
$('#Enddatepicker').attr('disabled', 'disabled');
$(".popup").hide();
};

function pophideupdate() {
$(".popupupdate").hide();
};

function pophidedrop() {
$(".popupdrop").hide();
};

$('select[id="selectevent"] ').change(function () {
if ($(this).val() == "1")
$('#Enddatepicker').attr('disabled', 'disabled');
else $('#Enddatepicker').removeAttr('disabled');//.attr('disabled', '');
});


//hidden
//visible
/*Function eventoption(x) {
if (x === 2) {
$('#endname').style.visible
$('#Enddatepicker').style.visible
}
};*/

function EventAdd() {
$(".popup").show();
$(".popup").focus();
};
<!--  //$(function() {
//  $( "#Startdatepicker" ).datepicker();
//});
/*$(function formenabler(venabe){
if (venabe == "1" ){
document.getElementById('Title').disabled=false;
document.getElementById('Startdatepicker').disabled=false;
document.getElementById('Enddatepicker').disabled=true;
document.getElementById('Note').disabled=false;
document.getElementById('Link').disabled=false;
}
else if (venabe == "2"){
document.getElementById('Title').disabled=false;
document.getElementById('Startdatepicker').disabled=false;
document.getElementById('Enddatepicker').disabled=false;
document.getElementById('Note').disabled=false;
document.getElementById('Link').disabled=false;
}
else (venabe == "3"){
document.getElementById('Title').disabled=false;
document.getElementById('Startdatepicker').disabled=false;
document.getElementById('Enddatepicker').disabled=false;
document.getElementById('Note').disabled=false;
document.getElementById('Link').disabled=false;
}
});*/-->


/*function addCalanderEvent( start, end, title)
{

    Event: {
    title: 'my event',
    start: '2015-02-19',
    end: '2015-02-20'
    };

    $('#calendar').fullCalendar('renderEvent', eventObject, true);
    return eventObject;
}*/

/*function addCalanderEvent(id, start, end, title, colour)
{
    var eventObject = {
    title: 'my event',
    start: '2015-02-19',
    end: '2015-02-20',
    id: '12',
    color: 'ffffff'
    };

    $('#calendar').fullCalendar('renderEvent', eventObject, true);
    return eventObject;
}*/
/*function addCalanderEvent(id, start, end, title, colour)
{
    var eventObject = {
    title: title,
    start: start,
    end: end,
    id: id,
    color: colour
    };

    $('#calendar').fullCalendar('renderEvent', eventObject, true);
    return eventObject;
}*/