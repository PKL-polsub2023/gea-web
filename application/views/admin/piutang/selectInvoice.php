<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <!-- <h6 class="page-title">Data Ruangan</h6> -->
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detail Piutang</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>tagihan_customer/tambah" role="button">Tambah Tagihan Customer</a> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                <div class="col col-md-3 col-3 ms-4 mt-2">
                                    <?php if($jumlahPiutang > 0) {?>
                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#myModal">Print Invoice
                                    </button>
                                    <?php } ?>
                                    </div>
                                    <div class="card-body">
                                    <h3>Invoice</h3>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Customer</th>
                                                <th>ID Invoice (Tagihan)</th>
                                                <th>Tanggal</th>
                                                <th>Total Volume Gas</th>
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
                                                    <td><?php echo $u['namaperusahaan'] ?></td> 
                                                    <td><?php echo $u['tagihan_customer_id'] ?></td> 
                                                    <td><?php echo $u['tanggal'] ?></td>
                                                    <td><?php echo $u['tekananakhir'] - $u['tekananawal']?></td>

                                                    <td><?php echo $u['total'] ?></td>
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
                                                            <a href="<?= base_url('piutang/cetakinvoice/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" >Statement</a>                                                     
                                                            <a href="<?= base_url('piutang/cetakba/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" >Berita Acara</a> 
                                                            <a href="<?= base_url('piutang/isiinvoice_satuan/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" target="_blank">PDF Invoice</a>                                                       
                                                    </td>

                                    
                                                    </td>
                                                </tr>                                        
                                                <?php }}?>
                                            </tbody> 
                                        </table>

                                    </div>
                                </div> 
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->



                <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="myModalLabel">Print Select Invoice
                               </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="<?php echo base_url('piutang/printSelectInvoice');?>" method="POST" enctype="multipart/form-data" target="_blank"> 
                               <!-- <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Customer</label>
                                   <div class="col-sm-8"> -->
                                        <input type="text" name="mastercustomer_id" value="<?= $mastercustomer_id;?>" hidden>
                                        <input type="text" name="statushutang" value="<?= $statushutang;?>" hidden>
                                        <input type="text" name="fromdate" value="<?= $fromdate;?>" class="form-control" hidden>
                                        <input type="text" name="todate" value="<?= $todate;?>" class="form-control" hidden>
                                         
                                       <!-- <input class="form-control" type="text" placeholder="Artisanal kale" id="example-text-input">-->
                                   <!-- </div>
                               </div> -->



                               <!-- <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Rentang Tanggal</label>
                                   <div class="col-sm-8">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" name="fromdate" value="<?= $fromdate;?>" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="todate" value="<?= $todate;?>" class="form-control" readonly>
                                            </div>
                                    </div>
                                                                                
                                   </div>
                               </div> -->

                               <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">No Invoice</label>
                                    <div class="col-sm-8">
                                    <input onkeyup="button()" id="no_invoice" name="no_invoice" class="form-control input-mask">    
                                    </div>
                                                                                                          
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">Tanggal</label>
                                    <div class="col-sm-8">
                                    <input onchange="button()" id="tanggal" name="tanggal" class="form-control input-mask" type="date">     
                                    </div>
                                                                                           
                                </div>
                                                        
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">Due Date</label>
                                    <div class="col-sm-8">
                                    <input onchange="button()" id="dd" name="dd" class="form-control input-mask" type="date"> 
                                    </div>                                                 
                                </div>   
            

                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary waves-effect"
                                   data-bs-dismiss="modal">Close</button>
                               <button type="submit" id="cari"
                                   class="btn btn-primary waves-effect waves-light" disabled>Print</button>
                           </div>
                        </form>
                       </div>
                       <!-- /.modal-content -->
                   </div>
                   <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->








<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
 

<script>
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
</script>






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



