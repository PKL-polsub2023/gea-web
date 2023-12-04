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
                                        <h4 class="card-title mb-4">Form Edit Saldo Awal</h4>
                                        <form action="<?php echo base_url('saldo_awal/ubahsimpan');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-date1">Periode</label>
                                                            <select name="periode" id="periode" class="form-control" required>
                                                                <option value="<?= $edit['periode'];?>"><?= $edit['periode'];?></option>
                                                                <option value="2022">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2022">2023</option>
                                                                    
                                                            </select> 
                                                        </div>
                                                       
                                                       
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-currency">Kode Rek</label>
                                                            <select name="mastercoa_id" id="mastercoa_id" class="form-control" required>
                                                                <option value="<?= $edit['kode'];?>"><?= $edit['kode'];?></option>
                                                                    <?php foreach ($datacoa as $u): ?>
                                                                        <option value="<?= $u['mastercoa_id'] ?>"><?= $u['kode'] ?> - <?= $u['nama'] ?></option>
                                                                    <?php endforeach ?>
                                                            </select> 
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Nama Rek</label>
                                                            <input id="input-mask" name="namarek" value="<?= $edit['nama'];?>" class="form-control input-mask">                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Saldo Normal</label>
                                                            <input id="input-mask" name="saldo_normal" value="<?= $edit['saldo_normal'];?>" class="form-control input-mask">                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Debit</label>
                                                            <input id="input-mask" name="debit" value="<?= $edit['debit'];?>" class="form-control input-mask">                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Kredit</label>
                                                            <input id="input-mask" name="kredit" value="<?= $edit['kredit'];?>" class="form-control input-mask">                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Status</label>
                                                            <input id="input-mask" name="status" value="<?php if($edit['status']==1){echo 'Debit';}else{echo 'Kredit';}?>" class="form-control input-mask">                                                            
                                                        </div>

                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>





                                            <div class="col-md-2">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">  
                                                        <input name="saldoawal_id" value="<?= $edit['saldoawal_id'];?>" type="hidden">
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

                               
      
