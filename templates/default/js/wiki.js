$(function(){
	$('.wiki_controller.info').click(function(){
		var text = $(this).text();
		if(text != ''){
			icms.modal.openAjax('/wiki/info',{'text':text});
		}
	});
});