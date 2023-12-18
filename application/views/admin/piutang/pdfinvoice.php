<style>
    
     .list{
      width:100%;
      height: 100px;
      text-align:center;
     }

     .list, .th, .td {
      /* border: 1px solid black; */
      border-collapse: collapse;
      font-size:12pt;
      text-align:center;
      }

      .biodata{
        margin-top:2em;
        margin-left:2em;
        font-size:6pt;
      }

      .head{
        border-right:1px solid black;
      }

      .data{
        font-size:16pt;
        width:100%;
      }

      .data, .th, .td {
      /* border: 1px solid black; */
      font-size:16pt;
      }

      .data2{
        margin-top:2em;
        width:100%;
        font-size:16pt;
      }

      .data2, .th, .td {
      height: 80px;
      border-top:1px solid black;
      border-right:1px solid black;
      /* border-bottom:1px solid black; */
      /* border-left:1px solid black; */
      border-collapse: collapse;
      }

      .norek{
        font-size:16pt;
      }

      .total, .th, .td {
        font-size:16pt;
      height: 50px;
      border-top:1px solid black;
      border-bottom:1px solid black; 
      border-left:1px solid black; 
      border-collapse: collapse;
      }

      .nominal, .th, .td {
        margin-top:2em;
        width:100%;
        font-size:16pt;
      height: 60px;
      border-top:1px solid black;
      border-right:1px solid black;
      border-bottom:1px solid black; 
      border-left:1px solid black; 
      border-collapse: collapse;
      }

      .font-normal{
        font-size:16pt;
        font-weight:100;
        margin-top:1em;
      }

</style>

<div class="main">
    <div>
        <table  style="border-bottom:2px solid black;">
            <tr>
                <th  style="width:20%">
                <img src="<?php echo base_url('assets/logo/gea.png'); ?>" width="200px" height="100px"/>
            </th>
                <th style="width:20%"></th>
                <th style="width:40%">
                <table>
                    <tr>
                        <th><p style="text-align:right;font-size:18pt;">PT GLOBAL ENERGY AGRAPANA</p></th>
                    </tr>
                    <tr>
                        <td> <p style="font-weight:100;text-align:right;font-size:18pt;">Jl. Otto Iskandardinata No 138 RT 50 RW 13</p></td>
                    </tr>
                    <tr>
                        <td style="height:1em"> <p style="font-weight:100;text-align:right;font-size:18pt;">Telp . 0260-4250402</p></td>
                    </tr>
                    <tr>
                        <td><p style="font-weight:100;text-align:right;font-size:18pt;">Kel.Karanganyar Kec.Subang Kabupaten Subang</p></td>
                    </tr>
                    <tr>
                        <td><p style="font-weight:100;text-align:right;font-size:18pt;">Email : globalenergyagrapana@gmail.com</p></td>
                    </tr>
                </table>
               
            </th>
            </tr>
        </table>

        <center>
            <h2><u>INVOICE</u></h2>
        </center>

        <table width="1000px">
            <tr>
                <th  style="width:300px;vertical-align:top;">
                    <table>
                        <tr>
                            <td class="data">Kepada Yth :</td>
                        </tr>
                        <tr>
                        <td class="data"><?= $detail['namaperusahaan'];?></td>
                        </tr>
                    </table>
                </th>
                <th style="width:300px">
                </th>
                <th  style="width:400px">
                    <table>
                        <tr>    
                            <td  class="data">No Invoice : <?= $no_invoice;?></td>
                            
                        </tr>
                        <tr>
                            <td  class="data">Tanggal : <?= $tanggal; ?></td>
                        </tr>
                        <tr>
                            <td  class="data">Due Date : <?= $dd;?></td>
                        </tr>
                        <tr>
                            <td  class="data">No PO :</td>
                        </tr>
                    </table>
                </th> 
            </tr>
        </table>

        <table class="data2">
            <tr>
                <th style="width:5%;border-left:1px solid black;" class="data2">QTY</th>
                <th style="width:40%" class="data2">Keterangan</th>
                <th style="width:10%" class="data2">Volume</th>
                <th style="width:15%" class="data2">Harga Satuan</th>
                <th style="width:5%" class="data2">Discount</th>
                <th style="width:25%" class="data2">Total</th>
            </tr>
            <?php                                                 
                if($datamaster){
                    foreach($datamaster as $u){  
            ?>        
            <tr>
                <td class="data2" style="width:5%;text-align:center;;border-left:1px solid black;border-bottom:1px solid black;">1</td>
                <td class="data2" style="width:40%;border-bottom:1px solid black;"><?php echo "Tagihan ".$u['namaperusahaan']." ".$u['tanggalkirim'] ?></td>
                <td class="data2" style="width:10%;border-bottom:1px solid black;"><?php echo $u['volumegas'] ?></td>
                <td class="data2" style="width:15%;border-bottom:1px solid black;"><?php echo $u['harga'] ?></td>
                <td class="data2" style="width:5%;border-bottom:1px solid black;">-</td>
                <td class="data2" style="width:30%;border-bottom:1px solid black;"><?php echo $u['total'] ?></td>
            </tr>
            <?php }}?>
            <tr>
                <td colspan="2" rowspan="5">
                <p  class="norek">
                    <!-- <i>
                    Pembayaran Mohon ditransfer ke :
                    <br>
                    PT. Global Energy Agrapana
                    <br>
                    BCA Cabang Subang
                    <br>
                    Ac . 0556.138.138
                </i> -->
                </p>
                </td>

                <td class="total" colspan="3"> &nbsp;&nbsp; Subtotal</td>
                <td style="border-bottom:1px solid black">: <?php echo $total ?></td>
            </tr>
            <tr>
                <td class="total" colspan="3"> &nbsp;&nbsp; Discount</td>
                <td style="border-bottom:1px solid black">: 0 </td>
            </tr>
            <tr>
                <td class="total" colspan="3"> &nbsp;&nbsp; Pajak</td>
                <td style="border-bottom:1px solid black">: 0 </td>
            </tr>
            <tr>
                <td class="total" colspan="3"> &nbsp;&nbsp; Biaya Pengiriman</td>
                <td style="border-bottom:1px solid black">: 0 </td>
            </tr>
            <tr>
                <td class="total" colspan="3"> &nbsp;&nbsp; Total</td>
                <td style="border-bottom:1px solid black">: <?php echo $total ?> </td>
            </tr>
        </table>

        <table class="nominal">
            <tr>
                <th><?php echo $terbilang ?> Rupiah</th>
            </tr>
        </table>

        <table class="font-normal">
            <tr>
                <td class="font-normal" style="text-align:left;width:700px" rowspan="2">
                 <p  class="font-normal">
                    <!-- <i>
                    Note :
                    <br>
                    Bukti transfer mohon di emailkan ke
                    <br>
                    <b>globalenergyagrapana@gmail.com</b> atau di kirim
                    <br>
                    by <b>WA ke No.087834212541 sdri. Nining</b>
                </i> -->
                </p>
                </td>
                <td class="font-normal" style="height:60px"></td>
            </tr>
            <tr>
                <td class="font-normal">
                    <!-- <u>Bp Fredi Ginting</u><br>Direktur Utama -->
            </td>
            </tr>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    window.print();
});
</script>