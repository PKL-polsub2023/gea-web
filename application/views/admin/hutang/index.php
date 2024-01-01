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
                                        <li class="breadcrumb-item active" aria-current="page">Hutang</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>datakwitansi/tambah" role="button">Tambah Tagihan Customer</a> -->

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
                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#cetak">Select Invoice Hutang
                                    </button>

                                    </div>
                                    <div class="card-body">

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Kwitansi</th>
                                                <th>Tanggal</th>
                                                <th>No Polisi</th>
                                                <th>Nama Driver</th>
                                                <th>Lokasi SPBG</th>
                                                <th>Volume</th>
                                                <th>Total Rupiah</th>
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
                                                    <td><?php echo $u['datakwitansi_id'] ?></td> 
                                                    <td><?php echo $u['tanggal'] ?></td>
                                                    <td><?php echo $u['no_polisi'] ?></td>
                                                    <td><?php echo $u['nama_driver'] ?></td>
                                                    <td><?php echo $u['lokasispbg'] ?></td>
                                                    <td><?php echo $u['volumegas'] ?></td>
                                                    <td><?php echo 'Rp ' . number_format($u['total'], 0, ',', '.') ?></td>
                                                    <td><?php echo ($u['status'] == 'N') ? "belum bayar" : "dibayar";?></td>
                                                    <td style="text-align:center">
                                                        <?php
                                                            if($u["status"] == "N"){
                                                                ?>
                                                                    <a onclick="return confirm('Anda Yakin Akan Memverifikasi Pembayaran Hutang ?')" href="<?= base_url('hutang/validasi_y/' . $u['datakwitansi_id']) ?>" class="btn btn-success btn-sm" style="width:35px;"><i class="fa fa-check"></i></a>                                                     
                                                                    <a href="<?= base_url('hutang/ubah/' . $u['datakwitansi_id']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>                                                     
                                                                <?php
                                                            }else{
                                                                ?>
                                                                   <button type="button" class="btn btn-primary btn-sm waves-effect waves-light"
                                                                                data-bs-toggle="modal" data-bs-target="#myModalz<?= $u['datakwitansi_id'] ?>">Faktur
                                                                    </button>
                                                                <?php
                                                            }
                                                            ?>

                                                            <a href="<?= base_url('hutang/detail/' . $u['datakwitansi_id']) ?>" class="btn btn-info btn-sm" style="width:35px;"><i class="fas fa-eye"></i></a>                                                     

                                                        
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


 <?php
 foreach ($datamaster as $u) {
    ?>
     <!-- sample modal content -->
  <div id="myModalz<?= $u['datakwitansi_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="myModalLabel">Faktur Hutang
                               </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="<?php echo base_url('hutang/faktur/'. $u['datakwitansi_id']);?>" method="POST" enctype="multipart/form-data" target="_blank"> 
                               <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">No Invoice</label>
                                    <div class="col-sm-8">
                                    <input id="input-mask" name="no_invoice" class="form-control input-mask">    
                                    </div>
                                                                                                          
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">Tanggal</label>
                                    <div class="col-sm-8">
                                    <input id="input-mask" name="tanggal" class="form-control input-mask" type="date">     
                                    </div>
                                                                                           
                                </div>
                                                        
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">Due Date</label>
                                    <div class="col-sm-8">
                                    <input id="input-mask" name="dd" class="form-control input-mask" type="date"> 
                                    </div>                                                 
                                </div>   
            

                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary waves-effect"
                                   data-bs-dismiss="modal">Close</button>
                               <button type="submit"
                                   class="btn btn-primary waves-effect waves-light">Print</button>
                           </div>
                        </form>
                       </div>
                       <!-- /.modal-content -->
                   </div>
                   <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->
    <?php
 }
 ?>

   <!-- sample modal content -->
   <div id="cetak" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="myModalLabel">Select Invoice Hutang
                               </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="<?php echo base_url('hutang/selectInvoice');?>" method="POST" enctype="multipart/form-data" target="_blank"> 
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Supplier</label>
                                   <div class="col-sm-8">
                                    <select onchange="supplier()" class="form-control" name="mastersupplier_id" id="mastersupplier_id">
                                    <option value="">Pilih Supplier</option>
                                    <?php foreach ($supplier as $u): ?>
                                               <option value="<?= $u['mastersupplier_id'] ?>"><?= $u['namaspbg'] ?> - <?= $u['lokasispbg'] ?></option>
                                           <?php endforeach ?>
                                    </select>
                                       <!-- <input class="form-control" type="text" placeholder="Artisanal kale" id="example-text-input">-->
                                   </div>
                               </div>



                               <!-- <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Rentang Tanggal</label>
                                   <div class="col-sm-8">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <input type="date" name="fromdate" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="date" name="todate" class="form-control">
                                            </div>
                                    </div>
                                        <input class="form-control currency" name="debit" type="text" placeholder="Debit" id="example-text-input" required>  
                                       
                                        <input type="text" name="debit_x" placeholder="0" id="debit" class="form-control currency" required/>
                                        <input type="hidden" name="debit" class="form-control"/>                                                           
                                   </div>
                               </div> -->

                          


                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary waves-effect"
                                   data-bs-dismiss="modal">Close</button>
                               <button type="submit" id="cari"
                                   class="btn btn-primary waves-effect waves-light" disabled>Cari</button>
                           </div>
                       </div>
                       <!-- /.modal-content -->
                   </div>
                   <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->

               








<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
 


<script>
    function supplier()
    {
        var supplier = $('#mastersupplier_id').val();
        if(supplier === "")
        {
            document.getElementById("cari").disabled = true;
        }else{
            document.getElementById("cari").disabled = false;
            
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



