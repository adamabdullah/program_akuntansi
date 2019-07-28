$(function () {

	//start rekening koran js
	
	$("#insert_rekening_koran").click(function(){
		var kode = $("#kode").val();
		var terima = $("#tgl_terima").val();
		
		//array

			//tgl
			var tgl = [];

			$(".newtgl").each(function(){
				var tmptgl = $(this).val();

				tgl.push(tmptgl);
			});

			//debit
			var debit = [];

			$(".newdebit").each(function(){
				var tmpdebit = $(this).val() || 0;

				debit.push(tmpdebit);
			});

			//kredit
			var kredit = [];
			
			$(".newkredit").each(function(){
				var tmpkredit = $(this).val() || 0;

				kredit.push(tmpkredit);
			});

			//dekripsi
			var deskripsi = [];

			$(".newdesc").each(function(){
				var tmpdesc = $(this).val();
	
				deskripsi.push(tmpdesc);
			});

			$.ajax({
				type: "POST",
				url: "/faktur_v2/config/rekonsiliasi/insert.php",
				data: {kode:kode, terima:terima, tgl:tgl, deskripsi:deskripsi, debit:debit, kredit:kredit },
				success:function(data){
					if(data=="success"){
						swal ( "Sukses" ,  "Sukses menyimpan!" ,  "success" );
						window.location = "/faktur_v2/";
					}else{
						swal ( "Oops" ,  "Sebagian atau seluruh data gagal disimpan!" ,  "error" );
					}
				}

			});
		

	});

	//start rekening koran js

});