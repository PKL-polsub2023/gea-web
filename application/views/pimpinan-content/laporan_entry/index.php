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
                                        <li class="breadcrumb-item"><a href="#">Laporan Entry</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Laporan Entry</li>
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body" style="background-color: #ececf1;">
                                        <!-- <h4 class="card-title mb-4">Form Laporan Entry</h4> -->

                                        <form target="_blank" action="<?php echo base_url('laporan_entry/cetakpdf');?>" method="POST" enctype="multipart/form-data"> 
                                            


                                            

















                                            <div class="row">

                                                <div class="col-lg-4">
                                                    <div>
                                                        
                                                     
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date1">Dari Tanggal</label>
                                                            <input class="form-control" type="date" id="tgl_awal" name="tgl_awal">    
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>


                                                <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-0">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-email">Sampai Tanggal</label>
                                                            <input class="form-control" type="date" id="tgl_akhir" name="tgl_akhir"> 
                                                        </div>
                                                       
                                                        
                                                        
                                                    </div>
                                                </div>



                                                <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-2"><br>
                                                        
                                                     
                                                        <div class="mb-4">
                                                            <button type="submit" class="btn btn-info btn-mini">Cetak PDF</button>
                                                            <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>   
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>

                                            </div>






                                       

                                            <!-- <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-0">                                                        
                                                        <div class="mb-4">
                                                            <button type="submit" class="btn btn-info btn-mini">Cetak PDF</button>
                                                            <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>                                                             
                                                        </div>                                                        
                                                    </div>
                                                </div> -->

                                                                                   
                                       

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->