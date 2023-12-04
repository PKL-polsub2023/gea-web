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
                                        <li class="breadcrumb-item"><a href="#">Jurnal Harian Pemasukan</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detail Jurnal Harian Pemasukan</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                

										<button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button> 

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


									 

									<table class="table table-bordered" style="background-color: #ececf1; border: 2px solid #ccc;">
                                        <tbody>
										
                                        <tr>
                                        <td style="width: 10%;">No Jurnal</td>
                                        <td style="width: 30%;"><input id="example-text-input" class="form-control" value="<?php echo $jurnalmasuk->no_jurnal?>" name="no_jurnal" type="text" placeholder="No Jurnal" /></td>
                                        <td style="width: 10%">keterangan</td>
                                        <td style="width: 30%" rowspan="2"><textarea rows="4" id="example-text-input" class="form-control" name="keterangan" placeholder="Keterangan"><?php echo $jurnalmasuk->keterangan?></textarea></td>
                                        </tr>
                                        <tr>
                                        <td style="width: 10%">Tanggal</td>
                                        <td style="width: 30%"><input id="example-text-input" class="form-control" value="<?php echo $jurnalmasuk->tanggal?>" name="tanggal" type="date" placeholder="Tanggal" /></td>
                                        <td style="width: 79.3438px;">&nbsp;</td>
                                        </tr>
										
                                        </tbody>
										
                                      </table> 



                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        

                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <!-- <th>Nama Akun</th> -->
                                                <th>No Jurnal</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>                                          
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $no= 0;
                                            foreach ($detail_jurnal_masuk as $u): ?> 
											                                               
                                                <tr>
                                                    <td style="width: 1%;text-align:center"><?php echo ++$no ?></td>                                                    
                                                 
                                                    <td style="width: 10%;text-align:center"><?php echo $u['no_jurnal'] ?></td>
                                                    <td style="width: 10%;text-align:right"><?= rupiah($u['debit']); ?></td>
                                                    <td style="width: 10%;text-align:right"><?= rupiah($u['kredit']); ?></td>
                                                  

                                    
                                                    </td>
                                                </tr>                                        
                                                <?php endforeach ?>
                                            </tbody> 
                                        </table>
										
                                    </div>
                                </div> 
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->



               








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



