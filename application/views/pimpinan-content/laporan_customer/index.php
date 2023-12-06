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
                                        <li class="breadcrumb-item"><a href="#">Laporan Customer</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Laporan Customer</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-md-block">
                                        <div class="dropdown">                                                                

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
                                        <h4 class="card-title mb-4">Form Laporan Customer</h4>

                                        <form action="<?php echo base_url('laporan_customer/cetakpdf');?>" method="POST" enctype="multipart/form-data"> 
                                            


                                            <div class="row">

                                                <div class="col-lg-4">
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date1">Dari Tanggal</label>
                                                            <input class="form-control" type="date" id="tglawal" name="tglawal">
                                                            <!-- <span class="text-muted">e.g "dd/mm/yyyy"</span> -->
                                                        </div>                                                    
                                                    </div>
                                                </div>                                             
                                                

                                                <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-0">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-email">Sampai Tanggal</label>
                                                            <input class="form-control" type="date" id="tglakhir" name="tglakhir">  
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>
                                            

                                                <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-0">                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-repeat">Jenis Laporan</label>
                                                            <select name="jenis" class="form-select" aria-label="Default select example">
                                                                <option selected>Silahkan Pilih</option>
                                                                <option value="1">Customer</option>
                                                            </select>    
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">
                                                        <button type="submit" class="btn btn-primary btn-mini">Cetak PDF</button>                                                        
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