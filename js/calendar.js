$.getScript('http://arshaw.com/js/fullcalendar-1.6.4/fullcalendar/fullcalendar.min.js',function(){
  
  var event_arr = [];
   $.each(arr, function(index, value){
	  var date = toDate(value);
	  var d = date.getDate();
	  var m = date.getMonth();
	  var y = date.getFullYear();
      event_arr.push({
		  title: index, 
		  start: new Date(y, m , d)
	  });
    });

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    editable: true,
    events: event_arr
  });
})

function toDate(variable) {
    var from = variable.split("-");
	date = new Date(from);
    return date;
}