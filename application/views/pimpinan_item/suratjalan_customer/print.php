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
        font-size:10px;
        width:100%;
      }

      .data, .th, .td {
      /* border: 1px solid black; */
      height: 30px;
      border-right:1px solid black;
      border-bottom:1px solid black;
      border-collapse: collapse;
      font-size:8pt;
      text-align:center;
      }

      .data2{
        font-size:8pt;
      }

      .data2, .th, .td {
      font-size:8pt;
      }

      .data3{
        font-size:8pt;
        margin-top:2em;
        width:100%;
      }

      .data3, .th, .td {
      height: 40px;
      font-size:8pt;
      border-top:1px solid black;
      border-right:1px solid black;
      border-bottom:1px solid black;
      border-collapse: collapse;
      }


      .isian{
        margin-top:2em;
        margin-left:1em;
        margin-right:1em;
        border: 1px solid black;
      }

      .ttd{
        height:100px;
        border-top:1px solid black;
      border-right:1px solid black;
      border-bottom:1px solid black;
      border-collapse: collapse;
      }

      .nama{
        height:20px;
        border-top:1px solid black;
      border-right:1px solid black;
      border-bottom:1px solid black;
      border-collapse: collapse;
      }
      .akhir{
        height: 30px;
        margin-top:3em;
        width:100%;
        font-size:8pt;
        border-top:1px solid black;
        border-collapse: collapse;
      }
      .abu {
    filter: grayscale(100%);
  }

</style>

<div class="main" style="border:1px solid black;height:750px">
    <div>
        <table  style="border-bottom:1px solid black;">
            <tr>
                <th class="head"  style="width:20%">
                <img class="abu" src="<?php echo base_url('assets/logo/gea.png'); ?>" width="200px" height="100px"/>
            </th>
                <th class="head" style="width:60%"><H1>SURAT JALAN</H1></th>
                <th  style="width:20%"><h6>Kantor: Jl Raya Otista No. 138 Karanganyar, Subang. No Telp: 02604250402</h6></th>
            </tr>
        </table>
        <table class="biodata">
            <tr>
                <td style="width:50%" >
                    <table>
                        <tr>
                            <td>Tempat Pengisian</td>
                            <td>:</td>
                            <td><?= $edit['namaspbg'];?></td>
                        </tr>
                        <tr>
                            <td>Driver</td>
                            <td>:</td>
                            <td><?= $edit['nama_driver'];?></td>
                        </tr>
                        <tr>
                            <td>No Surat Jalan</td>
                            <td>:</td>
                            <td>........../CNG/............/202.....</td>
                        </tr>
                    </table>
                </td>

                <td colspan="3" style="width:10%">
                </td>

                <td colspan="3">
                    <table>
                        <tr style="vertical-align:top">
                            <td>Tujuan</td>
                            <td>:</td>
                            <td colspan="3"><?= $edit['tujuan'];?></td>
                        </tr>
                        <tr>
                            <td style="height:40px"></td>
                        </tr>
                    </table>
                </td>

        
            </tr>

        </table>

        <div class="isian">
        <table class="data">
            <tr class="data">
                <th style="width:14%" class="data" rowspan="2">HARI/TANGGAL</th>
                <th style="width:14%" class="data" rowspan="2">NO GTM</th>
                <th style="width:14%" class="data" rowspan="2">NO POLISI</th>
                <th style="width:14%" class="data" colspan="2" >JAM</th>
                <th style="width:14%" class="data" colspan="2" >PRESSURE</th>
                <th style="width:14%" class="data" colspan="2" >METERING</th>
                <th style="width:14%"  rowspan="2">TOTAL VOLUME</th>
            </tr>
            <tr class="data">
                <th style="width:7%" class="data">AWAL</th>
                <th style="width:7%" class="data">AKHIR</th>
                <th style="width:7%" class="data">AWAL</th>
                <th style="width:7%" class="data">AKHIR</th>
                <th style="width:7%" class="data">AWAL</th>
                <th style="width:7%" class="data">AKHIR</th>
            </tr>
            <tr class="data">
                <td class="data" style="width:10%" ><?= $edit['tanggal'];?></td>
                <td class="data" style="width:10%" >NO GTM</td>
                <td class="data" style="width:10%" ><?= $edit['no_polisi'];?></td>
                <td class="data" style="width:10%" >JAM AWAL</td>
                <td class="data" style="width:10%" >JAM AKHIR</td>
                <td class="data" style="width:10%" ><?= $edit['tekananawal'];?></td>
                <td class="data" style="width:10%" ><?= $edit['tekananakhir'];?></td>
                <td class="data" style="width:10%" ><?= $edit['totalisatorawal'];?></td>
                <td class="data" style="width:10%" ><?= $edit['totalisatorakhir'];?></td>
                <td class="data" style="width:10%" ><?= $edit['total'];?></td>
            </tr>
        </table>
        <table class="data2">
            <tr>
                <td style="width:50%" >
                    <table>
                        <tr height="40px">
                            <td class="data2">BERANGKAT DARI TEMPAT PENGISIAN</td>
                            <td class="data2">:</td>
                            <td class="data2">.........../....................../......</td>
                        </tr>
                        <tr>
                            <td class="data2">SAMPAI DI CUSTOMER</td>
                            <td class="data2">:</td>
                            <td class="data2">.........../....................../......</td>
                        </tr>
                    </table>
                </td>

                <td style="width:50%" >
                    <table>
                        <tr height="40px">
                            <td class="data2">PREASURE SAMPAI DI CUSTOMER</td>
                            <td class="data2">:</td>
                            <td class="data2">........................../......</td>
                        </tr>
                        <tr>
                            <td class="data2">PREASURE HABIS DI CUSTOMER</td>
                            <td class="data2">:</td>
                            <td class="data2">........................../......</td>
                        </tr>
                    </table>
                </td>

                <td style="width:30%" >
                    <table>
                        <tr height="40px">
                            <td class="data2">METERING</td>
                            <td class="data2">:</td>
                            <td class="data2">..........</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="data3">
            <tr >
                <th style="width:20%"  class="data3">OPERATOR</th>
                <th style="width:15%"  >SECURITY</th>
                <th style="width:15%"  class="data3">DISPATCHER</th>
                <th style="width:20%"  class="data3">DRIVER/TRANSPORTER</th>
                <th style="width:40%" >CUSTOMER</th>
            </tr>
            <tr class="data3">
                <td class="ttd"></td>
                <td ></td>
                <td class="ttd"></td>
                <td class="ttd"></td>
                <td></td>
            </tr>
            <tr class="data3">
                <td class="nama"></td>
                <td style="text-align:end"><b>|</b></td>
                <td class="nama"></td>
                <td class="nama"></td>
                <td></td>
            </tr>
        </table>

        <table class="akhir">
            <tr  class="akhir">
                <td style="width:20%"   class="akhir">LEMBAR:</td>
                <td style="width:20%"   class="akhir">1. PT GLOBAL ENERGY AGRAPANA (Putih)</td>
                <td style="width:20%"   class="akhir">2. Security (Pink)</td>
                <td style="width:20%"   class="akhir">3. Customer (Hijau)</td>
            </tr>
        </table>
        </div>
 

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    window.print();
});
</script>