$(document).ready(function () {
	
});

function switchDisplay(id) {
	$("#"+id).toggle("slow");
}

function switchDisplayNew(id) {
	$("#"+id).show('slow');
	$('.content_section').hide();
	$(".divAsideDown").toggle("slow");
}
