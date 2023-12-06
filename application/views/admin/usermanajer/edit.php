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
                                        <li class="breadcrumb-item"><a href="#">User Manajer</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Ubah Data</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Form Edit User</h4>
                                        <form action="<?php echo base_url('Acountmanajer/ubahsimpan');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Usernmae</label>
                                                            <input id="input-mask" name="username" value="<?= $edit['username'];?>" class="form-control input-mask">                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Password</label>
                                                            <input id="input-mask" name="password" class="form-control input-mask" type="password"> 
                                                            <span>Jika Tidak Diubah Maka Kosongkan</span>                                                           
                                                        </div>   

                                                        <div class="mb-4">
                                                        <label class="form-label" for="input-mask">Role</label>
                                                        <select class="form-select" name="role">
                                                        <option disabled>Pilih Role</option>
                                                        <option <?php if ($edit['role'] == "pimpinan") { 
                                                            echo "selected";
                                                            } ?> value="pimpinan">Pimpinan</option>
                                                        <option <?php if ($edit['role'] == "akuntan") { 
                                                            echo "selected";
                                                            } ?> value="akuntan">Akuntan</option>
                                                        <option <?php if ($edit['role'] == "admin") { 
                                                            echo "selected";
                                                            } ?> value="admin">Admin</option>
                                                        </select>    
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>





                                            <div class="col-md-2">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">  
                                                        <input name="id" value="<?= $edit['id'];?>" type="hidden">
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

                               
      
