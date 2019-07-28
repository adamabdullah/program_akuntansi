$(document).ready(function(){
    
    $('.kode').click(function(){
        var kode = $(this).text();
        var jenis= kode.substr(0, kode.indexOf('#')); 

        if(jenis=="Bank Deposit "){
			var url = '/faktur_v2/halaman/report/kas_terima.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Bank Withdrawal "){
			var url = '/faktur_v2/halaman/report/kas_kirim.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Bank Transfer "){
			var url = '/faktur_v2/halaman/report/kas_transfer.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Expenses "){
			var url = '/faktur_v2/halaman/report/biaya.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Sales Invoice "){
			var url = '/faktur_v2/halaman/report/penjualan.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Purchase Invoice "){
			var url = '/faktur_v2/halaman/report/pembelian.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Jurnal Entry "){
			var url = '/faktur_v2/halaman/report/jurnal_entry.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Receive Payment "){
			var url = '/faktur_v2/halaman/report/receive_payment.php';
                var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="kode" value="' + kode + '" />' +
                '</form>');
                $('body').append(form);
                form.submit();

        }else if(jenis=="Purchase Payment "){
			var url = '/faktur_v2/halaman/report/purchase_payment.php';
                var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="kode" value="' + kode + '" />' +
                '</form>');
                $('body').append(form);
                form.submit();

        }

        

         
    });

});
