$(document).ready(function(){
$(function() {
	$('#popupDatepicker').datepick({dateFormat: 'dd-mm-yyyy',
	minDate: new Date($('#sdate').text()),
	maxDate: new Date($('#edate').text()),
	defaultDate: new Date($('#datesel').text()),
	onSelect: function(dates){
			var startdate = $('#sdate').text();
			var enddate = $('#edate').text();
//			alert (startdate);
//			sdate = new Date(startdate);
//			edate = new Date(enddate);
//			alert(sdate);
//			alert(edate);
			var seldate = new Date(dates[0]);
//			alert (seldate);
			if ((seldate < sdate) || (seldate > edate))
				{alert('Date out of range - Please Select Again');}
			else
				{$("input[type=submit]").removeAttr("disabled");}
			},
	showTrigger: '#calImg'});
})});
