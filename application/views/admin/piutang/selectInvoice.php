<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
                                    <div class="table-responsive">
                                        <table id="filter" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Customer</th>
                                                <!-- <th>ID Invoice (Tagihan)</th> -->
                                                <th>Tanggal</th>
                                                <th>Total Volume Gas</th>
                                                <th>Pressure Out (P)</th>
                                                <th>V (sm <sup>3</sup>)</th>
                                                <th>Jumlah Tagihan</th>
                                                <th>Status</th>

                                                <th style="text-align:center">Tindakan</th>                                            
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
                                                    <td><?php echo $u['mastercustomer_id'] ?></td> 
                                                    <!-- <td><?php echo $u['tagihan_customer_id'] ?></td>  -->
                                                    <td><?php echo date('d-m-Y', strtotime($u['tanggal'])); ?></td>
                                                    <td><?php echo $u['volumegas']?></td>
                                                    <td><?php echo $u['preasure']?></td>
                                                    <td><?php echo $u['harga']?></td>
                                                    <td>Rp <?php echo number_format($u['total_tagihan'], 0, ',', '.'); ?></td>
                                                    <td><?php 
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
                                                   </td>
                                                    <td style="text-align:center">
                                                            <!-- <a href="#" class="btn btn-info btn-sm" >View</a>    -->
                                                                                                          
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
        var no_invoice = $('#no_invoice').val();
        var dd = $('#dd').val();
        var tanggal = $('#tanggal').val();

        if(no_invoice != "" && dd != "" && tanggal != "")
        {
            document.getElementById("cari").disabled = false;
        }else{
            document.getElementById("cari").disabled = true;
            
        }
    }
</script> -->






<script type="text/javascript">
// fungsi untuk hapus data
          //pilih selector dari table id datarekening dengan class .hapusrekening
          $('#datatable').on('click','.hapuscustomer', function () {
            var mastercoa_id  =   <?php echo $u['mastercoa_id'];?>;
            swal({
                title: 'Konfirmasi',
                text: "Anda ingin menghapus ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url:"<?=base_url('customer/hapus')?>",  
                    method:"post",
                    beforeSend :function () {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                          swal.showLoading()
                        }
                      })      
                    },    
                    data:{mastercoa_id:mastercoa_id},
                    success:function(data){
                      swal(
                        'Hapus',
                        'Berhasil Terhapus',
                        'success'
                      )
                      location.reload(true);
                      //datatable.ajax.reload(null, false)
                    }
                  })
              } else if (result.dismiss === swal.DismissReason.cancel) {
                  swal(
                    'Batal',
                    'Anda membatalkan penghapusan',
                    'error'
                  )
                }
              })
            });


</script>



