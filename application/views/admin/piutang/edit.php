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
                                        <li class="breadcrumb-item"><a href="#">Tagihan Customer</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Tagihan Customer</li>
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
                                        <h4 class="card-title mb-4">Form Edit Tagihan Customer</h4>
                                        <form action="<?php echo base_url('tagihan_customer/ubahsimpan');?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div>
                                                    <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Pressure Out (P)</label>
                                                            <input onkeyup="isi_k()" id="preasure" name="preasure" value="<?= $edit['preasure'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask"  >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Customer</label>
                                                            <?php
                                                                $dropdownCustomer = $this->Tagihan_customer_model->dropdownCustomer();
                                                                echo form_dropdown('mastercustomer_id', $dropdownCustomer, $edit['mastercustomer_id'],  ' id="mastercustomer_id" class="form-control input-mask" style="background:#CCC;" readonly ');
                                                            ?>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">ID Surat Jalan</label>
                                                            <?php
                                                                $dropSuratjalan = $this->Tagihan_customer_model->dropSuratjalan();
                                                                echo form_dropdown('suratjalan_customer_id', $dropSuratjalan, $edit['suratjalan_customer_id'], 'id="suratjalan_customer_id" class="form-control input-mask" style="background:#CCC;" readonly');
                                                            ?>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">No TS - No Polisi</label>
                                                            <input id="no_ts" name="no_ts" value="<?= $edit['no_polisi'];?>" type="text" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal Kirim</label>
                                                            <input id="input-mask" name="tanggalkirim" value="<?= $edit['tanggalkirim'];?>" type="date" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>

                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal Pulang</label>
                                                            <input id="input-mask" name="tanggalpulang" value="<?= $edit['tanggalpulang'];?>" type="date" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Pressure Awal</label>
                                                            <input id="input-mask" name="tekananawal" value="<?= $edit['tekananawal'];?>"type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly>
                                                                                                                        
                                                        </div>   

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Pressure Akhir</label>
                                                            <input id="input-mask" name="tekananakhir" value="<?= $edit['tekananakhir'];?>"type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly>
                                                                                                                       
                                                        </div>
                                                        
                                                       
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Volume Berangkat</label>
                                                            <input id="input-mask" name="volumeberangkat" value="<?= $edit['volumeberangkat'];?>"type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly >
                                                                                                                        
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Volume Pulang</label>
                                                            <input onkeyup="hargaJual()" id="volumepulang" value="<?= $edit['volumepulang'];?>" name="volumepulang" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Temperature (t)</label>
                                                            <input onkeyup="isi_sc()" id="t" name="t" type="text" value="<?= $edit['t'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                     

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Meter Awal (V1)</label>
                                                            <input onkeyup="isi_vt()" id="meterawal" name="meterawal" value="<?= $edit['meterawal'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Meter Akhir (V2)</label>
                                                            <input onkeyup="isi_vt()" id="meterakhir" name="meterakhir" value="<?= $edit['meterakhir'];?>"type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Vt</label>
                                                            <input id="vt" name="vt" value="<?= $edit['vt'];?>" type="text" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">K</label>
                                                            <input id="k" name="k" type="text" value="<?= $edit['k'];?>" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Atmosphere Pressure</label>
                                                            <input id="ap" name="ap" type="text" value="<?= $edit['ap'];?>" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Standard Condition</label>
                                                            <input id="sc" name="sc" type="text" value="<?= $edit['sc'];?>" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">BBM</label>
                                                            <input id="input-mask" name="bbm" value="<?= $edit['bbm'];?>"type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly >                                                            
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Ritase</label>
                                                            <input id="input-mask" name="ritase" value="<?= $edit['ritase'];?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" style="background:#CCC;" readonly>                                                            
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Harga Jual</label>
                                                            <input style="background:#CCC;" value="<?= $edit['satuan'];?>"  id="hargacustomer" name="hargacustomer" type="text" class="form-control input-mask" readonly >                                                            
                                                        </div>


            

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Total (Sm<sup>3</sup>)</label>
                                                            <input style="background:#CCC;" value="<?= $edit['harga'];?>" id="harga" name="harga" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control input-mask" readonly >                                                            
                                                        </div>

                                                        
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                <div class="col-md-12">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">  
                                                        <input name="tagihan_customer_id" value="<?= $edit['tagihan_customer_id'];?>" type="hidden">
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
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <!-- <script>
                $(document).ready(function() {
                    var mastercustomer_id = $('#mastercustomer_id').val();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('tagihan_customer/hargaJual')?>",
                        dataType: "JSON",
                        data: { mastercustomer_id: mastercustomer_id },
                        cache: false,
                        success: function(data) {
                            $.each(data, function(mastercustomer_id, harga) {
                                $('[name="hargacustomer"]').val(data.harga);
                            });
                        }
                    });
                    return true;
                });

                </script> -->
                <script>
                    function hargaJual()
                    {
                        var hargacustomer = $("#hargacustomer").val();
                        var volumepulang = $("#volumepulang").val();
                        var harga_jual = hargacustomer * volumepulang;
                        // $("#harga").val(harga_jual);
                    }

                    function isi_vt()
                    {
                        var t = parseFloat($("#t").val());
                        var meterawal = $("#meterawal").val();
                        var meterakhir = $("#meterakhir").val();
                        var vts = meterakhir - meterawal;
                        vt = vts.toFixed(4);
                        console.log(vt);
                        $("#vt").val(vt);

                        var preasure = parseFloat($("#preasure").val());    
                        var ap = parseFloat($("#ap").val());  
                        var aps = ap.toFixed(5);
                        k = (1+(0.002*preasure));
                        var total = (vt * (aps)*(300.15 / (273.15 + t)) * k);
                        var totals = total.toFixed(3);
                        $("#harga").val(totals);

                    }

                    function isi_k()
                    {
                        var preasure = parseFloat($("#preasure").val());    
                        k = (1+(0.002*preasure));
                        ap = (1.01325 + preasure) / 1.01325
                        // k = Math.round(k * 100) / 100;
                        $("#k").val(k);
                        $("#ap").val(ap);
                        isi_vt();
                    }

                    function isi_sc()
                    {
                        var t = parseFloat($("#t").val());
                        sc = ((273+27)/(273 + t));
                        sc = Math.round(sc * 100) / 100;
                        $("#sc").val(sc);
                    }
                </script>


                               
      
