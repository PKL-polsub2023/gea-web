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
                                        <li class="breadcrumb-item"><a href="#">Saldo Awal</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Saldo Awal</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>saldo_awal/tambah" role="button">Tambah Saldo Awal</a> -->
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#myModal">Tambah Saldo Awal
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->











                
                <!-- sample modal content -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="myModalLabel">Tambah Saldo Awal
                               </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="<?php echo base_url('saldo_awal/simpan');?>" method="POST" enctype="multipart/form-data"> 
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Periode</label>
                                   <div class="col-sm-8">
                                       <!-- <input class="form-control" type="text" placeholder="Artisanal kale" id="example-text-input">-->
                                   <select name="periode" id="periode" class="form-control" required>
                                       <option value="">Pilih Periode</option>
                                       <option value="2022">2020</option>
                                       <option value="2021">2021</option>
                                       <option value="2022">2022</option>
                                       <option value="2022">2023</option>
                                           
                                   </select> 
                                   </div>
                               </div>


                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Kode Rek</label>
                                   <div class="col-sm-8">
                                       <!-- <input class="form-control" type="text" placeholder="Artisanal kale" id="example-text-input">-->
                                   <select name="mastercoa_id" id="mastercoa_id" class="form-control" required>
                                       <option value="">Pilih Akun</option>
                                           <?php foreach ($datacoa as $u): ?>
                                               <option value="<?= $u['mastercoa_id'] ?>"><?= $u['kode'] ?> - <?= $u['nama'] ?></option>
                                           <?php endforeach ?>
                                   </select> 
                                   </div>
                               </div>


                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Nama Rek</label>
                                   <div class="col-sm-8">
                                       <input class="form-control" name="namarek" type="text" placeholder="Nama Rek" id="namarek" required>                                                            
                                   </div>
                               </div>

                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Saldo Normal</label>
                                   <div class="col-sm-8">
                                       <!-- <input class="form-control currency" name="saldo_normal" type="text" placeholder="Saldo Normal" id="example-text-input" required>   -->
                                       <input type="text" name="saldo_normal_x" placeholder="0" id="saldo_normal" class="form-control currency" required />
                                       <input type="hidden" name="saldo_normal" class="form-control"/>                                                          
                                   </div>
                               </div>


                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Debit</label>
                                   <div class="col-sm-8">
                                       <!-- <input class="form-control currency" name="debit" type="text" placeholder="Debit" id="example-text-input" required>   -->
                                       
                                       <input type="text" name="debit_x" placeholder="0" id="debit" class="form-control currency" required/>
                                        <input type="hidden" name="debit" class="form-control"/>                                                          
                                   </div>
                               </div>


                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Kredit</label>
                                   <div class="col-sm-8">
                                       <!-- <input class="form-control currency" name="kredit" type="text" placeholder="Kredit" id="example-text-input" required>                                                             -->
                                       <input type="text" name="kredit_x" placeholder="0" class="form-control currency" id="kredit">
                                        <input type="hidden" name="kredit" class="form-control" >
                                   </div>
                               </div>

                              


                               <div class="row mb-3">
                                            <label class="col-sm-4 col-form-label">Status</label>
                                            <div class="col-sm-8">
                                                <select name="status" class="form-select" aria-label="Default select example" required>
                                                        <option selected>Pilih Status</option>
                                                        <option value="1">Debit</option>
                                                        <option value="2">Kredit</option>    
                                                </select>
                                            </div>
                                        </div>



                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary waves-effect"
                                   data-bs-dismiss="modal">Close</button>
                               <button type="submit"
                                   class="btn btn-primary waves-effect waves-light">Save
                                   changes</button>
                           </div>
                       </div>
                       <!-- /.modal-content -->
                   </div>
                   <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->





















               




               


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <!-- <th>Nama Akun</th> -->
                                                <th>Kode Rek</th>
                                                <th>Nama Rek</th>
                                                <th>Saldo Normal</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                <th>Saldo Akhir</th>
                                                <th style="text-align:center">Tindakan</th>                                            
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php                                                 
                                                $no = 0;
                                                    if($datasaldoawal){
                                                        foreach($datasaldoawal as $u){  
                                                ?>                                                            
                                                <tr>
                                                    <td style="width: 1%;text-align:center"><?php echo ++$no ?></td>                                                    
                                                    <!-- <td style="width: 10%;text-align:left"><?php echo $u['kode'] ?> - <?php echo $u['nama'] ?></td>  -->
                                                    <td style="width: 10%;text-align:left"><?php echo $u['kode'] ?></td>
                                                    <td style="width: 10%;text-align:left"><?php echo $u['nama'] ?></td>
                                                    <td style="width: 10%;text-align:right"><?= rupiah($u['saldo_normal']); ?></td>
                                                    <td style="width: 10%;text-align:right"><?= rupiah($u['debit']); ?></td>
                                                    <td style="width: 10%;text-align:right"><?= rupiah($u['kredit']); ?></td>
                                                    <td style="width: 15%;text-align:right"><?= rupiah($u['saldo_akhir']); ?></td>
                                                    <td style="width: 5%;text-align:center">                                                      

                                                   
                                                        
                                                        <a href="<?= base_url('saldo_awal/ubah/' . $u['saldoawal_id']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
												        <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('saldo_awal/hapus/' . $u['saldoawal_id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>


                                                        
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
        $(document).ready(function(){
            
            $('#mastercoa_id').change(function(){ 

                if($(this).val() == '') reset()
			        else {

                            var id=$(this).val();
                            $.ajax({
                                url : "<?php echo site_url('saldo_awal/getakun');?>",
                                method : "POST",
                                data : {id: id},
                                async : true,
                                dataType : 'json',
                                success: function(data){
                                    
                                    var html = '';
                                    
                                    var i;
                                    for(i=0; i<data.length; i++){
                                        
                                        html  += data[i].nama;                            
                                    
                                    }
                                    $('#namarek').val(html);
            
                                }
                            });
                        }
                return false;
            }); 
        });
</script>









                 


               <!-- <div class="modal fade" id="edit<?php echo $u['saldoawal_id'];?>">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="myModalLabel">Edit Saldo Awal
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                           <form action="<?php echo base_url('saldo_awal/simpan');?>" method="POST" enctype="multipart/form-data"> 
                              <div class="row mb-3">
                                  <label for="example-text-input" class="col-sm-4 col-form-label">Periode</label>
                                  <div class="col-sm-8">
                                     
                                  <select name="periode" id="periode" class="form-control" required>
                                      <option selected>Silahkan Pilih</option>
                                      <option value="2022">2020</option>
                                      <option value="2021">2021</option>
                                      <option value="2022">2022</option>
                                      <option value="2022">2023</option>
                                          
                                  </select> 
                                  </div>
                              </div>


                              <div class="row mb-3">
                                  <label for="example-text-input" class="col-sm-4 col-form-label">Kode Rek</label>
                                  <div class="col-sm-8">
                                     
                                  <select name="mastercoa_id" id="mastercoa_id" class="form-control" required>
                                      <option value="">Silahkan Pilih</option>
                                          <?php foreach ($datacoa as $u): ?>
                                              <option value="<?= $u['mastercoa_id'] ?>"><?= $u['kode'] ?> - <?= $u['nama'] ?></option>
                                          <?php endforeach ?>
                                  </select> 
                                  <input type="hidden" id="mastercoa_id" name="mastercoa_id">
                                  </div>
                              </div>


                              <div class="row mb-3">
                                  <label for="example-text-input" class="col-sm-4 col-form-label">Nama Rek</label>
                                  <div class="col-sm-8">
                                      <input class="form-control" value="<?php echo $u['nama'];?>" name="namarek" type="text" placeholder="Nama Rek" id="namarek" required>                                                            
                                  </div>
                              </div>

                              <div class="row mb-3">
                                  <label for="example-text-input" class="col-sm-4 col-form-label">Saldo Normal</label>
                                  <div class="col-sm-8">
                                      <input class="form-control" value="<?php echo $u['saldo_normal'];?>" name="saldo_normal" type="text" placeholder="Saldo Normal" id="saldo_normal" required>                                                            
                                  </div>
                              </div>


                              <div class="row mb-3">
                                  <label for="example-text-input" class="col-sm-4 col-form-label">Debit</label>
                                  <div class="col-sm-8">
                                      <input class="form-control" value="<?php echo $u['debit'];?>" name="debit" type="text" placeholder="Debit" id="debit" required>                                                            
                                  </div>
                              </div>


                              <div class="row mb-3">
                                  <label for="example-text-input" class="col-sm-4 col-form-label">Kredit</label>
                                  <div class="col-sm-8">
                                      <input class="form-control" value="<?php echo $u['kredit'];?>" name="kredit" type="text" placeholder="Kredit" id="kredit" required>                                                            
                                  </div>
                              </div>

                             


                              <div class="row mb-3">
                                           <label class="col-sm-4 col-form-label">Status</label>
                                           <div class="col-sm-8">
                                               <select name="status" class="form-select" aria-label="status" required>
                                                       <option selected>Silahkan Pilih</option>
                                                       <option value="1">Debit</option>
                                                       <option value="2">Kredit</option>    
                                               </select>
                                           </div>
                                       </div>



                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary waves-effect"
                                  data-bs-dismiss="modal">Close</button>
                              <button type="submit"
                                  class="btn btn-primary waves-effect waves-light">Save
                                  changes</button>
                          </div>
                      </div>
                      
                  </div>
                
              </div> -->
             
           