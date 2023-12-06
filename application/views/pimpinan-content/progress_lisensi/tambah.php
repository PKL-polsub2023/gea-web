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
                                        <li class="breadcrumb-item"><a href="#">Progress Lisensi</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Progress Lisensi</li>
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

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>customer/tambah" role="button">Tambah Progress Lisensi</a> -->

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
                                        <h4 class="card-title mb-4">Form Tambah Progress Lisensi</h4>
                                        <form action="<?php echo base_url('progress_lisensi/update');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>
                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date2">Berkas sedang dalam proses pengajuan ke Kemenaker RI</label>
                                                            <select name="berkas_pengajuan" class="form-select" aria-label="Default select example">
                                                                <option selected>Silahkan Pilih</option>
                                                                <option value="1">Sudah</option>
                                                                <option value="0">Belum</option>
                                                            </select>                                                             
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date2">Tgl Proses</label>
                                                            <input type="date" class="form-control" name="tgl_proses" placeholder="Tgl Proses" id="example-text-input">                                                     
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date2">Lisensi dan SKP telah selesai dari Kemenaker RI</label>
                                                            <select name="lisensi_skp" class="form-select" aria-label="Default select example">
                                                                <option selected>Silahkan Pilih</option>
                                                                <option value="1">Sudah</option>
                                                                <option value="0">Belum</option>
                                                            </select>                                                             
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mt-4 mt-lg-0">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-repeat">Dokumen Perpanjangan Proses Pengiriman ke Client</label>
                                                            <select name="dokumen_perpanjangan" class="form-select" aria-label="Default select example">
                                                                <option selected>Silahkan Pilih</option>
                                                                <option value="1">Sudah</option>
                                                                <option value="0">Belum</option>
                                                            </select>    
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanda Terima Dokumen</label>
                                                            <select name="tanda_terima" class="form-select" aria-label="Default select example">
                                                                <option selected>Silahkan Pilih</option>
                                                                <option value="1">Sudah</option>
                                                                <option value="0">Belum</option>
                                                            </select>    
                                                            
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask"></label>
                                                            <input name="customer_id" value="<?php echo $detail->customer_id ?>" type="hidden">
                                                            <button type="submit" class="btn btn-primary btn-mini">Proses</button>
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
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                               
      
