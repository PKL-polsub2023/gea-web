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
                                    
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#">Daftar Aktiva</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Daftar Aktiva</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>daftar_aktiva/tambah" role="button">Tambah Daftar Aktiva</a> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        



                       












                        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <!------ Include the above in your HEAD tag ---------->

                        <div class="container">
                          <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Data Perusahaan</h4>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">


                                                  


                                                  <form action="<?php echo base_url('profil_perusahaan/ubah');?>" method="POST" enctype="multipart/form-data"> 

                                               

                                                      <div class="form-group row">
                                                        <label for="username" class="col-4 col-form-label">Nama Perusahaan</label> 
                                                        <div class="col-8">
                                                          <input id="nama" name="nama" value="<?= $dataperusahaan['nama'];?>" placeholder="Nama Perusahaan" class="form-control here" required="required" type="text">
                                                        </div>
                                                      </div>
                                                      
                                                      <!-- <div class="form-group row">
                                                        <label for="select" class="col-4 col-form-label">Display Name public as</label> 
                                                        <div class="col-8">
                                                          <select id="select" name="select" class="custom-select">
                                                            <option value="admin">Admin</option>
                                                          </select>
                                                        </div>
                                                      </div> -->
                                                      <div class="form-group row">
                                                        <label for="email" class="col-4 col-form-label">Email*</label> 
                                                        <div class="col-8">
                                                          <input id="email" name="email" value="<?php echo $dataperusahaan['email'];?>" placeholder="Email" class="form-control here" required="required" type="text">
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                        <label for="website" class="col-4 col-form-label">Website</label> 
                                                        <div class="col-8">
                                                          <input id="website" name="website" value="<?php echo $dataperusahaan['website'];?>" placeholder="website" class="form-control here" type="text">
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                        <label for="publicinfo" class="col-4 col-form-label">Alamat Kantor</label> 
                                                        <div class="col-8">
                                                          <textarea id="alamat" name="alamat" cols="40" rows="4" class="form-control"><?= $dataperusahaan['alamat'];?></textarea>
                                                        </div>
                                                      </div>
                                                      <div class="form-group row">
                                                        <label for="publicinfo" class="col-4 col-form-label">Logo Perusahaan</label> 
                                                        <div class="col-8">
                                                          <img src="<?php echo base_url()?>assets/logo/<?php echo $dataperusahaan['logo'];?>" width="200px">
                                                        <input id="logo" name="logo" value="<?= $dataperusahaan['logo'];?>" placeholder="Logo" class="form-control here" type="file">
                                                        </div>
                                                      </div>

                                                      
                                                      <!-- <div class="form-group row">
                                                        <label for="newpass" class="col-4 col-form-label">New Password</label> 
                                                        <div class="col-8">
                                                          <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
                                                        </div>
                                                      </div>  -->
                                                      <div class="form-group row">
                                                        <div class="offset-4 col-8">
                                                          <input type="hidden" name="pengaturan_id" value="<?php echo $dataperusahaan['pengaturan_id'];?>">
                                                          <button name="submit" type="submit" class="btn btn-success" style="background-color:#62d49d">Ubah Profil</button>
                                                          <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>
                                                        </div>
                                                      </div>
                                                  </form>
                                                  
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>




























                        

                    </div> 
                </div>
                



               






<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
 
