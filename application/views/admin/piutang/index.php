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
                                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detail Piutang</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                


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
                                                <th>Nama Perusahaan</th>
                                                <th>Alamat</th>
                                                <th>Nama PIC</th>
                                                <th>No Telp</th>
                                                <th>Radius GEA to Lokasi</th>
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
                                                    <td><?php echo $u['alamat'] ?></td>
                                                    <td><?php echo $u['namapic'] ?></td>
                                                    <td><?php echo $u['notelp'] ?></td>
                                                    <td><?php echo $u['radius'] ?></td>
                                                    <td style="text-align:center;">
                                                        <!-- <a href="<?= base_url('piutang/paid/' . $u['mastercustomer_id']) ?>" class="btn btn-success btn-sm">Paid</a>                                                     
                                                        <a href="<?= base_url('piutang/pending/' . $u['mastercustomer_id']) ?>" class="btn btn-warning btn-sm">Pending</a>                                                     
                                                        <a href="<?= base_url('piutang/unpayed/' . $u['mastercustomer_id']) ?>" class="btn btn-danger btn-sm">Unpayed</a>                                                      -->
                                                        <a href="<?= base_url('piutang/invoice/' . $u['mastercustomer_id']) ?>" class="btn btn-info btn-sm">Invoice</a>   
                                                        <a href="<?= base_url('piutang/pdfinvoice/' . $u['mastercustomer_id']) ?>" class="btn btn-success btn-sm" target="_blank">PDF Invoice</a>                                                     
                                                        
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



               








<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
 





<script type="text/javascript">
// fungsi untuk hapus data
          //pilih selector dari table id datacustomer dengan class .hapuscustomer
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



