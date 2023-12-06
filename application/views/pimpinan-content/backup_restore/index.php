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
                                        <li class="breadcrumb-item"><a href="#">Backup Restore</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Backup Restore</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>customer/tambah" role="button">Tambah Progress Lisensi</a> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->






                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body" style="background-color: #ececf1;">
                                        <h4 class="card-title mb-4">Form Backup Database</h4>

                                        <form action="<?php echo base_url('laporan_customer/cetakpdf');?>" method="POST" enctype="multipart/form-data"> 
                                            


                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date1">Dari Tanggal</label>
                                                            <input class="form-control" type="date" id="tglawal" name="tglawal">
                                                            <!-- <span class="text-muted">e.g "dd/mm/yyyy"</span> -->
                                                        </div>                                                    
                                                    </div>
                                                </div>  
                                                
                                            </div>



                                            <div class="row">

                                            <div class="col-lg-6">
                                                    <div class="mt-4 mt-lg-0">                                                        
                                                        <div class="mb-4">
                                                            <button type="submit" class="btn btn-info btn-mini">Backup Database</button>
                                                            <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>                                                             
                                                        </div>                                                        
                                                    </div>
                                                </div>

                                                                                   
                                        </div>                                      


                                        </form>
                                    </div>
                                </div>
                            </div>
















                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body" style="background-color: #ececf1;">
                                        <h4 class="card-title mb-4">Form Restore Database</h4>

                                        <form action="<?php echo base_url('backup_restore/restore');?>" method="POST" enctype="multipart/form-data">                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date1">Upload Db</label>
                                                            <input class="form-control" type="file"  name="datafile" id="datafile">
                                                            <!-- <span class="text-muted">e.g "dd/mm/yyyy"</span> -->
                                                        </div>                                                    
                                                    </div>
                                                </div>         
                                            </div>

                                            <div class="row">
                                              <div class="col-lg-6">
                                                  <div class="mt-4 mt-lg-0">                                                        
                                                      <div class="mb-4">
                                                            <button type="submit" class="btn btn-info btn-mini">Restore Database</button>
                                                            <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>                                                             
                                                      </div>                                                        
                                                  </div>
                                                </div>                                                                                   
                                            </div>    
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->