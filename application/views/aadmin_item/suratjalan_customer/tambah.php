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
                                        <li class="breadcrumb-item"><a href="#">Input Surat Jalan Customer</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tambah Surat Jalan Customer</li>
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
                                        <h4 class="card-title mb-4">Form Tambah Surat Jalan Customer</h4>
                                        <form action="<?php echo base_url('suratjalan_customer/simpan');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">ID Kwitansi</label>
                                                            <?php
                                                                $dropKwitansi = $this->Suratjalan_customer_model->dropdownDatakwitansi();
                                                                echo form_dropdown('datakwitansi_id', $dropKwitansi, '', 'id="datakwitansi_id" class="form-control input-mask" ');
                                                            ?>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal</label>
                                                            <input id="input-mask" name="tanggal" type="date" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">No Polisi</label>
                                                            <input id="input-mask" name="no_polisi" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Nama Driver</label>
                                                            <input id="input-mask" name="nama_driver" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Nama Supplier (Asal)</label>
                                                            <input id="input-mask" name="lokasispbg" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tekanan Awal</label>
                                                            <input id="input-mask" name="tekananawal" type="number" min="0" class="form-control input-mask" style="background:#CCC;" readonly>
                                                            Bar/Psi                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tekanan Akhir</label>
                                                            <input id="input-mask" name="tekananakhir" type="number" min="0" class="form-control input-mask" style="background:#CCC;" readonly>
                                                            Bar/Psi                                                            
                                                        </div>
                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Totalisator Awal</label>
                                                            <input id="input-mask" name="totalisatorawal" type="number" min="0" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Totalisator Akhir</label>
                                                            <input id="input-mask" name="totalisatorakhir" type="number" min="0" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Harga Satuan Supplier (RP)</label>
                                                            <input id="input-mask" name="hargasatuan" type="number" min="0" class="form-control input-mask" style="background:#CCC;" readonly>                                                  
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Volume Gas</label>
                                                            <input id="input-mask" name="volumegas" type="number" min="0" class="form-control input-mask" style="background:#CCC;" readonly>
                                                            LSP                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Total (RP)</label>
                                                            <input id="input-mask" name="total" type="number" min="0" class="form-control input-mask" style="background:#CCC;" readonly>                                                          
                                                        </div>
                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tujuan Customer</label>
                                                            <?php
                                                                $dropCustomer = $this->Suratjalan_customer_model->dropCustomer();
                                                                echo form_dropdown('mastercustomer_id', $dropCustomer, '', ' class="form-control input-mask" ');
                                                            ?>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal Kirim</label>
                                                            <input id="input-mask" name="tanggalkirim" type="date" class="form-control input-mask" >                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>





                                            <div class="col-md-2">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">                                                         
                                                        <button type="submit" class="btn btn-primary btn-mini">Tambah</button>
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

                               
      
