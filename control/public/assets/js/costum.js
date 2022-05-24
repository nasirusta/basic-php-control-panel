jQuery(document).ready(function ($) {
    $('.counter').counterUp({
        delay: 100,
        time: 1200
    });
    $(".knob").knob();
});

function textCounter(field,field2,maxlimit){
	var countfield = document.getElementById(field2);
	if (field.value.length > maxlimit){
		field.value = field.value.substring( 0, maxlimit );
		return false;
	}else{
		countfield.value = maxlimit - field.value.length;
	}
}

CKEDITOR.config.entities_latin=false;