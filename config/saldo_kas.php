<?php 
include('connect.php');
include('../modal/modal.php');
$output ="";
$output .="<thead>
                <tr>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Kategori Akun</th>
                    <th>Saldo di Bank(IDR)</th>
                </tr>
            </thead>
            <tbody>"; 
            $sql = "SELECT * FROM akun WHERE kategori_akun = 'Kas & Bank'";
            $result2 = mysqli_query($connect, $sql);
            while($data2 = mysqli_fetch_array($result2))
                {
                    $sql1 = "SELECT sum(debit)-sum(kredit) AS saldo, kode_akun FROM transaksi WHERE kode_akun LIKE '%".$data2['nama_akun']."%'";
                    $res1 = mysqli_query($connect, $sql1);
                    while($data_saldo = mysqli_fetch_array($res1))
                    {
                        if($data_saldo['saldo'] != 0)
                        {
                            $output .=" <tr>
                                            <td class='tampung_nomor'>".$data2['kode_akun']."</td>
                                            <td class='kode'><p class='text-primary'>".$data2['nama_akun']."</p></td>
                                            <td>".$data2['kategori_akun']."</td>
                                            <td>".number_format($data_saldo['saldo'],2,",",".")."</td> ";
                            }
                        }
                        $output .= "</tr>";
                    }
$output .='</tbody>';
echo $output;
?>