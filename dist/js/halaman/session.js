$(function () {

	//logout
	$("#logout").click(function(){
		// swal
		swal({
				title: "Perhatian!",
				text: "Anda akan keluar",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				})
				.then((willDelete) => {
				if (willDelete) {
					// swal("Niga");
					window.location = "/faktur_v2/config/session/logout.php";         
					
				} else {
					swal("Batal Logout");
				}
				});
	
		//endswall
	  });
	//logout

});