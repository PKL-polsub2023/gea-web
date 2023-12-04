

<!-- jQuery 3 -->
<script src="https://act.webseitama.com/assets/bower_components/jquery/dist/jquery.min.js"></script>


<script type="text/javascript">
$(function() {
	$("#datatable tr:even").addClass("stripe1");
	$("#datatable tr:odd").addClass("stripe2");
	$("#datatable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
</script>

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                        <tr>
                                        <th>No</th>
                                        <th>No Jurnal</th>
                                        <th>Tanggal</th>
                                        <!-- <th>No Bukti</th> -->
                                        <th>Keterangan</th>
                                        <th>No Rek</th>
                                        <th>Nama Rek</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Saldo</th>
                                    </tr>
                                    <?php
                                        if($data->num_rows()>0){
                                            $periode = date('Y')-1;
                                            
                                            $saldo = 0;
                                            $dr_sa = $this->Laporan_Account_Ledger_Model->dr_sa($no_rek,$periode);
                                            $kr_sa = $this->Laporan_Account_Ledger_Model->kr_sa($no_rek,$periode);
                                            $saldo = $dr_sa-$kr_sa;
                                            ?>
                                            <tr>
                                                <td colspan="6" align="center"><b>Saldo Awal Tahun <?php echo $periode;?></b></td>            
                                                <td align="right" width="100" ><?php echo number_format($dr_sa); ?></td>
                                                <td align="right" width="100" ><?php echo number_format($kr_sa); ?></td>
                                                <td align="right" width="100" ><?php echo number_format($saldo); ?></td>
                                            </tr>
                                            <?php
                                            $jml_dr=0;
                                            $jml_kr=0;
                                            $no =1;
                                            foreach($data->result_array() as $db){  
                                            //$tgl = $this->Laporan_Account_Ledger_Model->tgl_indo($db['tgl_jurnal']);
                                            $nama_rek = $this->Laporan_Account_Ledger_Model->CariNamaRek($db['kode']);
                                            
                                            if($db['kode'] == '101' or $db['kode'] == '102' or $db['kode'] == '103' or $db['kode'] == '104' or $db['kode'] == '105' or $db['kode'] == '106' or $db['kode'] == '107'
                                            or $db['kode'] == '121' or $db['kode'] == '122' or $db['kode'] == '123' or $db['kode'] == '124' or $db['kode'] == '125' or $db['kode'] == '126' or $db['kode'] == '127'
                                            or $db['kode'] == '501' or $db['kode'] == '502' or $db['kode'] == '503' or $db['kode'] == '504' or $db['kode'] == '505' or $db['kode'] == '506' or $db['kode'] == '507'){

                                                $saldo = $saldo+$db['debit']-$db['kredit'];
                                            }else{
                                                $saldo = $saldo-$db['debit']+$db['kredit'];
                                            }

                                            ?>    
                                            <tr>
                                                <td align="center" width="20" ><?php echo $no; ?></td>
                                                <td align="center" width="100" ><?php echo $db['no_jurnal']; ?></td>
                                                <td align="center" width="100" ><?php echo $db['tanggal']; ?></td>
                                                <td ><?php echo $db['keterangan']; ?></td>
                                                <td align="center" width="80" ><?php echo $db['kode']; ?></td>
                                                <td width="150"><?php echo $nama_rek; ?></td>            
                                                <td align="right" width="80" ><?php echo number_format($db['debit']); ?></td>
                                                <td align="right" width="80" ><?php echo number_format($db['kredit']); ?></td>
                                                <td align="right" width="80" ><?php echo number_format($saldo); ?></td>
                                        </tr>
                                        <?php
                                            $jml_dr = $jml_dr+$db['debit'];
                                            $jml_kr = $jml_kr+$db['kredit'];
                                            $no++;
                                            }
                                        }else{
                                            $jml_dr=0;
                                            $jml_kr=0;
                                        ?>
                                            <tr>
                                                <td colspan="9" align="center" >Tidak Ada Data</td>
                                            </tr>
                                        <?php	
                                        }
                                    ?>
                                    </table>




                                    </div>
                                </div> 
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        


               


