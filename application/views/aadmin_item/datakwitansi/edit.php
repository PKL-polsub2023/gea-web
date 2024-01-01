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
                                        <li class="breadcrumb-item"><a href="#">Data Kwitansi</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tambah Data Kwitansi</li>
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
                                        <h4 class="card-title mb-4">Form Edit Data Kwitansi</h4>
                                        <form action="<?php echo base_url('data_kwitansi/ubahsimpan');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal Kwitansi</label>
                                                            <input id="input-mask" name="tanggal" value="<?= $edit['tanggal'];?>" type="date" class="form-control input-mask">                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal Bayar</label>
                                                            <input id="input-mask" name="tanggalbayar" value="<?= $edit['tanggalbayar'];?>" type="date" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">No Polisi</label>
                                                            <?php
                                                                echo form_dropdown('no_polisi', $kendaraan, $edit['no_polisi'], 'id="no_polisi" class="form-control input-mask" ');
                                                            ?>           
                                                            <!-- <input id="input-mask" name="no_polisi" value="<?= $edit['no_polisi'];?>" class="form-control input-mask">                                                             -->
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Nama Driver</label>
                                                            <?php
                                                                echo form_dropdown('nama_driver', $driver, $edit['nama_driver'], 'id="nama_driver" class="form-control input-mask" ');
                                                            ?>       
                                                            <!-- <input id="input-mask" name="nama_driver" value="<?= $edit['nama_driver'];?>" class="form-control input-mask">                                                             -->
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tekanan Awal</label>
                                                            <input id="input-mask" name="tekananawal" value="<?= $edit['tekananawal'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" min="0" class="form-control input-mask">
                                                            Bar/Psi                                                            
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tekanan Akhir</label>
                                                            <input id="input-mask" name="tekananakhir" value="<?= $edit['tekananakhir'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" min="0" class="form-control input-mask">
                                                            Bar/Psi                                                            
                                                        </div>
                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Totalisator Awal</label>
                                                            <input onkeyup="volume()" id="totalisator1" name="totalisatorawal" value="<?= $edit['totalisatorawal'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" min="0" class="form-control input-mask">                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Totalisator Akhir</label>
                                                            <input onkeyup="volume()" id="totalisator2" name="totalisatorakhir" value="<?= $edit['totalisatorakhir'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" min="0" class="form-control input-mask">                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Nama & Lokasi Supplier</label>
                                                            <?php
                                                                $dropSupplier = $this->Datakwitansi_model->dropSupplier();
                                                                echo form_dropdown('mastersupplier_id', $dropSupplier, $edit['mastersupplier_id'], 'id="mastersupplier_id" class="form-control input-mask" ');
                                                            ?>                                                        
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Harga Satuan Supplier</label>
                                                            <input id="hargasatuan" name="hargasatuan" value="<?= $edit['satuan_harga'];?>" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Volume Gas</label>
                                                            <input style="background:#CCC;" id="volumegas" name="volumegas" value="<?= $edit['volumegas'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" min="0" class="form-control input-mask" readonly>
                                                            LSP                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Total (RP)</label>
                                                            <input id="total" name="total" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" min="0" style="background:#CCC;" value="<?= $edit['total'];?>" readonly class="form-control input-mask">                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>





                                            <div class="col-md-2">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">  
                                                        <input name="datakwitansi_id" value="<?= $edit['datakwitansi_id'];?>" type="hidden">
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
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    function volume()
                    {
                        var awal = $("#totalisator1").val();
                        var akhir = $("#totalisator2").val();
                        var total = awal - akhir;
                        $("#volumegas").val(total);
                        document.getElementById("mastersupplier_id").value = null;
                        document.getElementById("total").value = null;
                        document.getElementById("hargasatuan").value = null;
                        
                    }
                </script>

                               
      
