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
                                        <li class="breadcrumb-item"><a href="#">Master COA</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Master COA</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-md-block">
                                        <div class="dropdown">            
                                            
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                                            Import Excel COA
                                        </button>

                                            

                                            <a class="btn btn-primary" href="<?php echo base_url()?>master_coa/tambah" role="button">Tambah Master COA</a>

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
                                       <div class="table-responsive">
                                       <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th colspan="2">Kode</th>
                                            <th>Nama Akun</th>
                                            <th>Jenis</th>
                                            <th>Kelompok</th>
                                            <th>Bank</th>
                                            <th>No Rekening</th>
                                            <th>Atas Nama</th>
                                            <th style="text-align:center">Tindakan</th>                                            
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <?php                                                 
                                            $no = 0;
                                                if($datamastercoa){
                                                    foreach($datamastercoa as $u){  
                                            ?>                                                            
                                            <tr>
                                                <td width="5%" style="text-align:center"><?php echo ++$no ?></td>                                                    
                                                <?php 
                                                    if($u['parent_id'] == NULL){
                                                        echo '<td colspan="2" class="text-center" style="background: #EEE;">'.$u['kode'].'</td>';
                                                    }else{
                                                        echo '<td width="50px" class="text-center" style="background: #DDD;"><i class="fa fa-angle-double-right"></i></td>';
                                                        echo '<td width="50px" class="text-center" style="background: #DDD;">'.$u['kode'].'</td>';
                                                    }
                                                ?>
                                                <td><?php echo $u['namacoa'] ?></td>
                                                <td><?php echo ($u['parent_id'] == NULL) ? "PRI" : "SEC";?></td>
                                                <td><?php echo $u['kelompokakun'] ?></td>
                                                <td><?php echo $u['bank'] ?></td>
                                                <td><?php echo $u['norekening'] ?></td>
                                                <td><?php echo $u['atasnama'] ?></td>
                                                <td style="text-align:center">
                                                    <a href="<?= base_url('master_coa/ubah/' . $u['mastercoa_id']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>                                                     
                                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('master_coa/hapus/' . $u['mastercoa_id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    <!-- <button class='btn btn-danger hapuscustomer' id='mastercoa_id' data-toggle='modal' data-mastercoa_id="<?=$u['mastercoa_id']?>">Hapus</button> -->
                                                </td>

                                
                                                </td>
                                            </tr>                                        
                                            <?php }}?>
                                        </tbody> 
                                    </table>
                                       </div>                 
                                    

                                    </div>
                                </div> 
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Import Data Excel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <?php echo form_open_multipart('master_coa/import'); ?>
                                <h5>Unduh Template</h5>
                                <p>Melalui tombol berikut ini : 
                                    <a href="<?php echo base_url('mastercoa_template.xlsx'); ?>" class="btn btn-success btn-sm popover-test" title="Unduh template">coa_template.xlsx</a>
                                </p>
                                <hr>
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <h5>Upload File Excel</h5>
                                        <div></div>
                                        <input name="import_data" type="file" class="form-control m-input" multiple required>
                                    </div>
                                    <hr>
                                </div>

                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <?php echo form_submit('import_submit','Upload','class="btn btn-primary waves-effect waves-light"'); ?>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
                    



               








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



