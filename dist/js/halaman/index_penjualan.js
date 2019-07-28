
$(function () {

$("#buat_penagihan").click(function(){

    var buat = "penagihan";
    
    var url = 'new/';
         var form = $('<form action="' + url + '" method="post">' +
         '<input type="text" name="jenis" value="' + buat + '" />' +
         '</form>');
         $('body').append(form);
         form.submit();

 });  
 $("#buat_pengiriman").click(function(){

     var buat = "pengiriman";
     
     var url = 'new/';
         var form = $('<form action="' + url + '" method="post">' +
         '<input type="text" name="jenis" value="' + buat + '" />' +
         '</form>');
         $('body').append(form);
         form.submit();

 }); 
 $("#buat_pemesanan").click(function(){

     var buat = "pemesanan";
     
     var url = 'new/';
         var form = $('<form action="' + url + '" method="post">' +
         '<input type="text" name="jenis" value="' + buat + '" />' +
         '</form>');
         $('body').append(form);
         form.submit();

 });   
 $("#buat_penawaran").click(function(){

     var buat = "penawaran";
     
     var url = 'new/';
         var form = $('<form action="' + url + '" method="post">' +
         '<input type="text" name="jenis" value="' + buat + '" />' +
         '</form>');
         $('body').append(form);
         form.submit();

 });  
 
});
