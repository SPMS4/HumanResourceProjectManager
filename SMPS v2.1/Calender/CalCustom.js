function pophide() {
	$('#Note').val('');
	$('#Title').val('');
	$('#Startdatepicker').val('');
	$('#Enddatepicker').val('');
	$('#Link').val('');
	$('#startTimepicker').val('');
	$('#endTimepicker').val('');
	$('#selectevent').val(0);
	$(".popup").hide();
};

//hidden
//visible

/*Function eventoption(x){
	if (x === 1) {
  		document.getElementById('#Note').style.visibility = "visible";
  		document.getElementById('#Link').style.visibility = "visible";
	};
	else if (x === 2){
		document.getElementById('#Enddatepicker').style.visibility = "visible";
		document.getElementById('#Note').style.visibility = "visible";
  		document.getElementById('#Link').style.visibility = "visible";
	};
	else if (x === 3){
		document.getElementById('#Note').style.visibility = "visible";
  		document.getElementById('#Link').style.visibility = "visible";
  		document.getElementById('#startTimepicker').style.visibility = "visible";
  		document.getElementById('#endTimepicker').style.visibility = "visible";
	};
	else{}
};*/

function EventAdd() {
	$(".popup").show();
	$(".popup").focus();
};