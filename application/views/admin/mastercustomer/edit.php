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
                                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data Customer</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <!-- <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-cog me-2"></i> Settings
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div> -->                                         

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>customer/tambah" role="button">Tambah Customer</a> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Form Edit Master Customer</h4>
                                        <form action="<?php echo base_url('master_customer/ubahsimpan');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Nama Customer</label>
                                                            <input id="input-mask" name="namaperusahaan" value="<?= $edit['namaperusahaan'];?>" class="form-control input-mask">                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Alamat</label>
                                                            <input id="input-mask" name="alamat" value="<?= $edit['alamat'];?>" class="form-control input-mask">                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Nama PIC</label>
                                                            <input id="input-mask" name="namapic" value="<?= $edit['namapic'];?>" class="form-control input-mask">                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">No Telp</label>
                                                            <input id="input-mask" name="notelp" value="<?= $edit['notelp'];?>" class="form-control input-mask">                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Radius GEA ke Lokasi</label>
                                                            <input id="input-mask" name="radius" value="<?= $edit['radius'];?>" class="form-control input-mask" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" min="0">                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>





                                            <div class="col-md-2">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">  
                                                        <input name="mastercustomer_id" value="<?= $edit['mastercustomer_id'];?>" type="hidden">
                                                        <button type="submit" class="btn btn-primary btn-mini">Ubah</button>
                                                        <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                            


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                               
      
