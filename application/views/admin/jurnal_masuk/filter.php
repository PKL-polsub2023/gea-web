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
                                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Input Transaksi Harian</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>jurnal_masuk/tambah" role="button">Tambah Jurnal Pemasukan</a>
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#filter">Filter</button> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <!-- <th>Nama Akun</th> -->
                                                <th>No Jurnal</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Total Debit</th>
                                                <th>Total Kredit</th>
                                                <th>Keterangan</th>
                                                <th>Status </th>
                                                <th style="text-align:center">Tindakan</th>                                            
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php                                                 
                                                $no = 0;
                                                $totalDebit = 0;
                                                $totalKredit = 0;
                                                    if($datajurnalmasuk){
                                                        foreach($datajurnalmasuk as $u){  
                                                            $totalDebit += $u['tot_debit'];
                                                            $totalKredit += $u['tot_kredit'];
                                                ?>                                                            
                                                <tr>
                                                    <td style="width: 1%;text-align:center"><?php echo ++$no ?></td>                                                    
                                                    <!-- <td style="width: 10%;text-align:left"><?php echo $u['kode'] ?> - <?php echo $u['nama'] ?></td>  -->
                                                    <td style="width: 10%;text-align:center"><?php echo $u['no_jurnal'] ?></td>
                                                    <td style="width: 5%;text-align:center"><?php echo date ('d/m/Y', strtotime($u['tanggal'])) ?></td>
                                                    <td style="width: 5%;text-align:center"><?php echo ($u['tipe_jurnal'] == 1) ? "Pemasukan" : "Pengeluaran";?></td>
                                                    <!-- <td style="width: 10%;text-align:right"><?php echo "Rp " . number_format($u['tot_debit'], 2, ",", "."); ?></td> -->
                                                    <td style="width: 10%;text-align:right"><?= rupiah($u['tot_debit']); ?></td>
                                                    <td style="width: 10%;text-align:right"><?= rupiah($u['tot_kredit']); ?></td>
                                                    <td style="width: 15%;text-align:center"><?php echo $u['keterangan'] ?></td>
                                                    <td style="width: 15%;text-align:center"><?php echo ($u['status'] == 0) ? "belum bayar" : "sudah bayar";?></td>
                                                    <td style="width: 5%;text-align:center">
                                                        <!-- <button class="btn btn-primary waves-effect waves-light btn-sm" data-toggle="modal" data-target="#editModal-<?php echo $u['jurnalmasuk_id'] ?>"><i class="fa fa-edit"></i></button>                                                     
                                                        <button class="btn btn-danger waves-effect waves-light btn-sm hapuscustomer" id='jurnalmasuk_id' data-toggle='modal' data-jurnalmasuk_id="<?=$u['jurnalmasuk_id']?>"><i class="fa fa-trash"></i></button> -->



                                                        <?php if ($u['status_postingan_jurnal'] == ""){ ?>
                                                       
                                                            <a href="<?= base_url('jurnal_masuk/detail/' . $u['no_jurnal']) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                            <a href="<?= base_url('jurnal_masuk/edit/' . $u['no_jurnal']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
												            <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('jurnal_masuk/hapus/' . $u['no_jurnal']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>


                                                    <?php } else if ($u['status_postingan_jurnal'] == "0"){ ?>

                                                            <a href="<?= base_url('jurnal_masuk/detail/' . $u['no_jurnal']) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                            <a href="<?= base_url('jurnal_masuk/edit/' . $u['no_jurnal']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                            <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('jurnal_masuk/hapus/' . $u['no_jurnal']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                                    <?php } else { ?>
                                                        
                                                            <a href="<?= base_url('jurnal_masuk/detail/' . $u['no_jurnal']) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                                    <?php } ?>




                                                        


                                                        
                                                    </td>

                                    
                                               
                                                </tr>                                        
                                                <?php }}?>
                                            </tbody> 
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">TOTAL</td>
                                                    <td style="text-align:right; font-weight:bold"><?= rupiah($totalDebit); ?></td>
                                                    <td style="text-align:right; font-weight:bold"><?= rupiah($totalKredit); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div> 
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


 <!-- sample modal content -->
 <div id="filter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="myModalLabel">Filter Jurnal Transaksi
                               </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="<?php echo base_url('jurnal_masuk/filter');?>" method="POST" enctype="multipart/form-data" target="_blank"> 
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">No Jurnal</label>
                                   <div class="col-sm-8">
                                        
                                       <input class="form-control" type="text" placeholder="Nomor Jurnal" id="no_jurnal" name="no_jurnal">
                                   </div>
                               </div>



                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Rentang Tanggal</label>
                                   <div class="col-sm-8">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <input  type="date" onchange="button()" id="fromdate" name="fromdate" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="date" onchange="button()" id="todate" name="todate" class="form-control">
                                            </div>
                                    </div>
                                       <!-- <input class="form-control currency" name="debit" type="text" placeholder="Debit" id="example-text-input" required>   -->
                                       
                                       <!-- <input type="text" name="debit_x" placeholder="0" id="debit" class="form-control currency" required/>
                                        <input type="hidden" name="debit" class="form-control"/>                                                           -->
                                   </div>
                               </div>

                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary waves-effect"
                                   data-bs-dismiss="modal">Close</button>
                               <button type="submit" id="cari"
                                   class="btn btn-primary waves-effect waves-light">Cari</button>
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
 





<script type="text/javascript">
// fungsi untuk hapus data
          //pilih selector dari table id datacustomer dengan class .hapuscustomer
          $('#datatable').on('click','.hapuscustomer', function () {
            var jurnalmasuk_id  =   <?php echo $u['jurnalmasuk_id'];?>;
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
                    data:{jurnalmasuk_id:jurnalmasuk_id},
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



