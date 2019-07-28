$(function () {

	//reconsiliation
    $("#tambah_data_reconsiliation").click(function(){
        $.ajax({
			url:"/faktur_v2/include/append/append_reconsiliation.php",
			method:"POST",
			data:{},
			success:function(data) 
			{
				$('#bawah').before(data);
			
			}
		});
	});

	//reconsiliation

});