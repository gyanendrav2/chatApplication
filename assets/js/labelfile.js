$(document).ready(function(){
    $(document).on("change", "#file",function(){
    	var img_name = $("#file").val();
    	$("#filechose").html(img_name);
    })
});