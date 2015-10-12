(function(){
	if(!$("input[name='Website']").val()){
		$('button').attr('disabled',true);
	}
	
}())

function output_msg(msg_type){
	if(msg_type === "error"){
		$('.status_msg').remove();
		$("input[name='Website']").after('<div class="status_msg" style="width:100px; display:inline; color: red;"> * The website cannot be empty</div>');
	}else {
		$('.status_msg').remove();
	}
	
}

$("input[name='Website']").keyup(function(){
	if(!$(this).val()){
		$('button').attr('disabled',true);
		output_msg("error");
	}else{
		output_msg("correct");
		$('button').attr('disabled',false);
	
	}
	
});



