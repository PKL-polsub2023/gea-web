<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
                                    <div class="table-responsive">
                                        <table id="filter" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Vt</th>
                                                <th>Total Volume Gas</th>
                                                <th>Pressure Out (P)</th>
                                                <th>V (sm <sup>3</sup>)</th>
                                                <!-- <th>Jumlah Tagihan</th> -->
                                                <!-- <th>Status</th> -->
                                                <!-- <th style="text-align:center">Tindakan</th>                                             -->
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php                                                 
                                                $no = 0;
                                                    if($datamaster){
                                                        foreach($datamaster as $u){  
                                                ?>                                                            
                                                <tr>
                                                    <td width="5%" style="text-align:center"><?php echo ++$no ?></td>                                                    
                                                    <td><?php echo date('d-m-Y', strtotime($u['tanggal'])); ?></td>
                                                    <td><?php echo $u['vt']?></td>
                                                    <td><?php echo $u['volumegas']?></td>
                                                    <td><?php echo $u['preasure']?></td>
                                                    <td><?php echo $u['harga']?></td>
                                                    <!-- <td>Rp <?php echo number_format($u['total_tagihan'], 0, ',', '.'); ?></td> -->
                                                    <!-- <td><?php 
                                                      if($u["statushutang"] == "N"){
                                                        ?>
                                                        <span class="badge bg-danger">Belum Bayar</span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                         <span class="badge bg-danger">Sudah Bayar</span>
                                                        <?php
                                                        }
                                                       ?>
                                                   </td> -->
                                                    <!-- <td style="text-align:center">
                                                      
                                                                                                          
                                                                                                           <?php
                                                            if($u["statushutang"] == "N"){
                                                                ?>
                                                                    <a onclick="return confirm('Anda Yakin Akan Memverifikasi Pembayaran Hutang ?')" href="<?= base_url('piutang/validasi_y/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" style="width:35px;"><i class="fa fa-check"></i></a>                                                                                                         
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <?php
                                                            }
                                                            ?>                                   
                                                            <a href="<?= base_url('tagihan_customer/ubah/' . $u['tagihan_customer_id']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Ubah Pressure Out</a>
                                                            <a href="<?= base_url('piutang/cetakinvoice/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" >Statement</a>                                                     
                                                            <a href="<?= base_url('piutang/cetakba/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" >Berita Acara</a> 
                                                            <a href="<?= base_url('piutang/isiinvoice_satuan/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" target="_blank">Invoice</a>                                                       
                                                    </td> -->

                                    
                                                    </td>
                                                </tr>                                        
                                                <?php }}?>
                                            </tbody> 
                                        </table>


            


                                        <table id="filtez" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Rentang Tanggal</th>
                                                <th>Pressure Out</th>
                                                <th>Vt</th>
                                                <th>Volume (sm<sup>3</sup>)</th>
                                                <th>Total Tagihan</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php                                                 
                                                $no = 0;
                                                      
                                                ?>                                                            
                                                <tr>
                                                    <td width="5%" style="text-align:center">1</td>               
                                                    <td><?php echo $fromdate; ?> - <?php echo $todate; ?>
                                                    <input type="text" value="<?php echo $fromdate ?>" id="fromdate" hidden>
                                                    <input type="text" value="<?php echo $todate ?>" id="todate" hidden>
                                                  </td>
                                                    <td><input onkeyup="hitung()" type="text" value="<?php echo $pressure; ?>" class="form-control" id="p"></td>       
                                                    <td><?php echo $vt; ?></td>      
                                                    <td><input type="text" id="total_formatted" class="form-control" value="<?php echo $total_formatted; ?>" readonly></td>      
                                                    <td><input id="total_tagihan" type="text" class="form-control" value="<?php echo "Rp " . number_format($total_tagihan, 0, ',', '.'); ?>" readonly></td>          
                                                </tr>                                        
                                                <?php ?>
                                            </tbody> 
                                        </table>

                                     </div>
 

                            <form action="<?php echo base_url('piutang/invoicebaru');?>" method="POST" enctype="multipart/form-data">
                                        <input hidden  id="f-1"  type="text"  name="mastercustomer_id" value="<?php echo $mastercustomer_id ?>"  >
                                        <input hidden  id="f-2"  type="text"  name="total" value="<?php echo $total_formatted ?>"  >
                                        <input hidden  id="f-3"  type="text"  name="total_tagihan" value="<?php echo $total_tagihan ?>"  >
                                        <input hidden  id="f-4"  type="text"  name="dari" value="<?php echo $fromdate; ?>"  >
                                        <input hidden  id="f-5"  type="text" name="to" value="<?php echo $todate; ?> ">
                                        <input hidden  id="f-6"  type="text" name="vt" value="<?php echo $vt; ?> ">
                                        <input hidden  id="f-7"  type="text" name="ap" value="<?php echo $ap; ?> ">
                                        <input hidden  id="f-8"  type="text" name="k" value="<?php echo $k; ?> ">
                                        <input hidden  id="f-9"  type="text" name="t" value="<?php echo $t; ?> ">
                                        <input hidden  id="f-10"  type="text" name="v1" value="<?php echo $v1; ?> ">
                                        <input hidden  id="f-11"  type="text" name="v2" value="<?php echo $v2; ?> ">
                                        <input hidden  id="f-12"  type="text" name="harga_jual" value="<?php echo $harga_jual; ?> ">


                            
                               <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" for="input-mask">Pressure Out (Average)</label>
                                            <div class="col-sm-8">
                                                <input id="v0"  name="pressure" class="form-control input-mask"  value="<?php echo $pressure ?>" readonly style="background-color:grey" >    
                                            </div>                                                           
                                    </div>
                                    <div class="row mb-3">   
                                        <label class="col-sm-4 col-form-label" for="input-mask">No Invoice</label>
                                            <div class="col-sm-8">
                                                <input  id="v1"  name="no_invoice" class="form-control input-mask" required>    
                                                <input  id="v2" name="tanggal" class="form-control input-mask" type="date" value="<?php echo $fromdate; ?>" hidden> 
                                                <input  id="v3" name="dd" class="form-control input-mask" type="date" value="<?php echo $todate; ?>" hidden>     
                                            </div>
                                                                                                          
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button id="kirim" type="submit" class="btn btn-primary">Simpan & Cetak Invoice</button>
                                </div>
                            </form>

                     
                            <div class="table-responsive">
                            <h3>Riwayat Invoice</h3>
                                        <table id="riwayat-invoice" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Rentang Tanggal</th>
                                                <th>No Invoice</th>
                                                <!-- <th>Pressure Out</th> -->
                                                <th>V sm<sup>3</sup></th>
                                                <th>Total Tagihan</th>
                                                <th>Status</th>
                                                <th style="text-align:center">Tindakan</th>                                            
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php                                                 
                                                $no = 0;
                                                    if($invoice){
                                                        foreach($invoice as $inv){  
                                                ?>                                                            
                                                <tr>
                                                    <td width="5%" style="text-align:center"><?php echo ++$no ?></td>   
                                                    <td><?php echo date('d-m-Y', strtotime($inv['tgl_dari'])); ?> - <?php echo date('d-m-Y', strtotime($inv['tgl_ke'])); ?></td>  
                                                    <td width="5%"><?php echo $inv['no_invoice'] ?></td>                                               
                                                    <!-- <td><?php echo $inv['pressure'] ?></td>  -->
                                                    <td><?php echo $inv['volume'] ?></td>
                                                    <td><?php echo "Rp " . number_format($inv['total_all'], 0, ',', '.'); ?></td>
                                                    <td><?php 
                                                      if($inv["status"] == "N"){
                                                        ?>
                                                        <span class="badge bg-danger">Belum Bayar</span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                         <span class="badge bg-success">Sudah Bayar</span>
                                                        <?php
                                                        }
                                                       ?>
                                                   </td>
                                                    <td>
                                                    <?php if($inv['status'] == "N") { ?>
                                                        <button onclick="validasi('<?=$inv['id_invoice'] ?>')" href="#" class="btn btn-success btn-sm" style="width:35px;"><i class="fa fa-check"></i></button>
                                                        <button onclick="deleteInvoice('<?=$inv['id_invoice'] ?>')" href="#" class="btn btn-danger btn-sm" style="width:35px;"><i class="fa fa-trash"></i></button>
                                                    <!-- <a onclick="return confirm('Anda Yakin Akan Memverifikasi Invoice?')" href="<?= base_url('invoice/validasi_y/' . $inv['id_invoice']) ?>" class="btn btn-success btn-sm" style="width:35px;"><i class="fa fa-check"></i></a>                                                                                                          -->
                                                    <?php } ?>
                                                    
                                                    <a href="<?= base_url('invoice/cetakinvoice/' . $inv['id_invoice']) ?>" class="btn btn-success btn-sm" target="_blank" >Invoice</a>   
                                                    <a href="<?= base_url('invoice/cetak_stat/' . $inv['id_invoice']) ?>" class="btn btn-success btn-sm" target="_blank" >Statement</a>       
                                                    <a href="<?= base_url('invoice/cetakba/' . $inv['id_invoice']) ?>" class="btn btn-success btn-sm" target="_blank" >Berita Acara</a>        

                                                    </td>
            

                                    
                                                    </td>
                                                </tr>                                        
                                                <?php }}?>
                                            </tbody> 
                                        </table>
                                    </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
 


<!-- <script>
    function button()
    {
        var no_invoice = $('#v1').val();
        var dd = $('#v2').val();
        var tanggal = $('#v3').val();

        if(no_invoice != "" && dd != "" && tanggal != "")
        {
            document.getElementById("kirim").disabled = false;
        }else{
            document.getElementById("kirim").disabled = true;
            
        }
    }
</script> -->


