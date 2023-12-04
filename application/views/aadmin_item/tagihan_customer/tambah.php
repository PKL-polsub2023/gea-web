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
                                        <h4 class="card-title mb-4">Form Tambah Tagihan Customer</h4>
                                        <form action="<?php echo base_url('tagihan_customer/simpan');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Customer</label>
                                                            <?php
                                                                $dropdownCustomer = $this->Tagihan_customer_model->dropdownCustomer();
                                                                echo form_dropdown('mastercustomer_id', $dropdownCustomer, '', 'class="form-control input-mask" ');
                                                            ?>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">ID Surat Jalan</label>
                                                            <?php
                                                                $dropSuratjalan = $this->Tagihan_customer_model->dropSuratjalan();
                                                                echo form_dropdown('suratjalan_customer_id', $dropSuratjalan, '', 'id="suratjalan_customer_id" class="form-control input-mask" ');
                                                            ?>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal Kirim</label>
                                                            <input id="input-mask" name="tanggalkirim" type="date" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tekanan Awal</label>
                                                            <input id="input-mask" name="tekananawal" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >
                                                                                                               
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tekanan Akhir</label>
                                                            <input id="input-mask" name="tekananakhir" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >
                                                                                                        
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Volume Berangkat</label>
                                                            <input id="input-mask" name="volumeberangkat" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Preasure Keluar (P)</label>
                                                            <input id="input-mask" name="preasure" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Meter Awal (V1)</label>
                                                            <input id="input-mask" name="meterawal" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Meter Akhir (V2)</label>
                                                            <input id="input-mask" name="meterakhir" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">BBM</label>
                                                            <input id="input-mask" name="bbm" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Ritase</label>
                                                            <input id="input-mask" name="ritase" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Total (Rp)</label>
                                                            <input id="input-mask" name="total" type="text" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
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

                               
      
