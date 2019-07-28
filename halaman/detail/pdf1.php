<!DOCTYPE html>
<?php 
    include('../../include/include.php');
    head();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body onload="window.print();">
<h1>
Nama Instansi <br>
<small>Email : avatar@gmp.co.id</small>
</h1>
<div class="box">
    <div class="box-header with-border">
        <h1 align="center">Jenis Bukti</h1>
    </div>
    <div class="box-body">

        <div class="row">
            
            <div class="col-md-2 col-xs-6 col-sm-2">
                <h>Dibayarkan kepada</h>
            </div>
            <div class="col-md-1 col-xs-3 col-md-1">
                <h>:</h>
            </div>
            <div class="col-md-3 col-xs-3 col-md-3">
                <h>Nama</h>
            </div>

            <div class="col-md-2 col-xs-6 col-sm-2">
                <h>No Transaksi</h>
            </div>
            <div class="col-md-1 col-xs-3 col-md-1">
                <h>:</h>
            </div>
            <div class="col-md-1 col-xs-3 col-md-3">
                <h>Nomor</h>            
            </div>

        </div>

        <div class="row">

            <div class="col-md-2 col-xs-6 col-sm-2">
                <h>Alamat</h>
            </div>
            <div class="col-md-1 col-xs-3 col-md-1">
                <h>:</h>
            </div>
            <div class="col-md-3 col-xs-3 col-md-3">
                <h>alamat</h>
            </div>

            <div class="col-md-2 col-xs-6 col-sm-6">
                <h>Tanggal</h>
            </div>
            <div class="col-md-1 col-xs-3 col-md-1">
                <h>:</h>
            </div>
            <div class="col-md-1 col-xs-3 col-md-3">
                <h>tanngal</h>            
            </div>

        </div>

        <div class="row">

            <div class="col-md-2 col-xs-6 col-sm-2">
                <h>Akun Penarikan</h>
            </div>
            <div class="col-md-1 col-xs-3 col-md-1">
                <h>:</h>
            </div>
            <div class="col-md-3 col-xs-3 col-md-3">
                <h>kas</h>
            </div>

        </div>

    </div>
    <div class="box-body">

        <table class="table table-responsive" border="1">
            <thead class="bg-navy">
                <tr>
                    <td>Kode Akun</td>
                    <td>Nama Akun</td>
                    <td>Deskripsi</td>
                    <td>Pajak</td>
                    <td>Jumlah</td>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>kode akun</td>
                    <td>nama akun</td>
                    <td>deskripsi</td>
                    <td>pajak</td>
                    <td>harga</td>
                </tr>
            </tbody>
            <tfoot class="bg-navy">
                <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td></td>
                <td>Harga</td>
                </tr>
            
            </tfoot>
        
        </table>

    </div>

    <div class="box-footer">
        
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th style="outline: 1px gray solid; text-align:center;">Dibuat oleh</th>
                    <th style="outline: 1px gray solid; text-align:center;">Diperiksa oleh</th>
                    <th style="outline: 1px gray solid; text-align:center;">Disetujui oleh</th>
                    <th style="outline: 1px gray solid; text-align:center;">Diterima oleh</th>
                </tr>

            </thead>
            <tbody >
                <tr height="100">
                    <td style="outline: 1px gray solid">&nbsp;</td>
                    <td style="outline: 1px gray solid">&nbsp;</td>
                    <td style="outline: 1px gray solid">&nbsp;</td>
                    <td style="outline: 1px gray solid">&nbsp;</td>
                </tr>

            </tbody>
        </table>
    
    </div>

</div>
    
</body>
</html>