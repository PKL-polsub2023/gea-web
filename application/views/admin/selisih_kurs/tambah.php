
<!-- Select2 -->
<link rel="stylesheet" href="https://act.webseitama.com/assets/bower_components/select2/dist/css/select2.min.css">

<!-- Pace style -->
<link rel="stylesheet" href="https://act.webseitama.com/assets/plugins/pace/pace.min.css">
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="https://act.webseitama.com/assets/dist/autocomplite/jquery-ui.css">
<style>
  /* Menghilangkan arrow di input type number */
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>



<!-- ============================================================== -->
          <!-- Start right Content here -->
          <!-- ============================================================== -->
          <div class="main-content">

              <div class="page-content">
                  <div class="container-fluid">
                    
                  

                    <!-- Untuk keperluan script dibawah -->
                    <div id="content" data-url="<?= base_url('selisih_kurs') ?>">
                    <!-- Untuk keperluan script dibawah -->



                      <!-- start page title -->
                      <div class="page-title-box">
                          <div class="row align-items-center">
                              <div class="col-md-8">
                                  <!-- <h6 class="page-title">Data Ruangan</h6> -->
                                  <ol class="breadcrumb m-0">
                                      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                      <li class="breadcrumb-item"><a href="#">Selisih Kurs</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">Data Selisih Kurs</li>
                                  </ol>
                              </div>
                              <div class="col-md-4">
                                  <div class="float-end d-none d-md-block">
                                      <div class="dropdown">                                                                           

                                          <!-- <a class="btn btn-primary" href="<?php echo base_url()?>customer/tambah" role="button">Tambah Customer</a>
                                         <input name="customer_id" type="hidden">
                                          <button type="submit" class="btn btn-info btn-mini" id='BarisBaru'><i class='fa fa-plus fa-fw'></i> Tambah Baris</button>
                                          <button type="submit" class="btn btn-primary btn-mini">Simpan</button>-->
                                          
                                          <button disabled type="button" class="btn btn-info btn-block" id="tambah">Tambah Baris</button> 
                                          <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button> 

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
                                      <h4 class="card-title mb-4">Form Selisih Kurs</h4>
                                      
                                      <form action="<?php echo base_url('selisih_kurs/proses_tambah');?>" method="POST" enctype="multipart/form-data"> 
                                         
                                        
                                      <table class="table table-bordered" style="background-color: #ececf1; border: 2px solid #ccc;">
                                        <tbody>
                                        <tr>
                                        <td style="width: 10%;">No Jurnal</td>
                                        <td style="width: 30%;"><input id="example-text-input" class="form-control" name="no_jurnal" type="text" placeholder="No Jurnal" required></td>
                                        <td style="width: 10%">keterangan</td>
                                        <td style="width: 30%" rowspan="2"><textarea rows="4" id="example-text-input" class="form-control" name="keterangan" placeholder="Keterangan"></textarea></td>
                                        </tr>
                                        <tr>
                                        <td style="width: 10%">Tanggal</td>
                                        <td style="width: 30%"><input id="example-text-input" class="form-control" name="tanggal" type="date" placeholder="Tanggal" /></td>
                                        <td style="width: 79.3438px;">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                      </table>                                     


                                                    <br>                                                   
                                                        <div data-repeater-list="group-a">
                                                            <div data-repeater-item class="row">
                                                                <div  class="mb-2 col-lg-2">
                                                                    <label class="form-label" for="name">Kode</label>

                                                                    <select name="mastercoa_id" id="mastercoa_id" class="form-control">
                                                                        <option value="">Pilih Akun</option>
                                                                        <?php foreach ($datacoa as $u): ?>
                                                                            <option value="<?= $u['mastercoa_id'] ?>"><?= $u['kode'] ?> - <?= $u['nama'] ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                    
                                                                <div  class="mb-3 col-lg-4">
                                                                    <label class="form-label" for="email">Nama Rekening</label>
                                                                    <input type="text" name="namarek" id="namarek" class="form-control"/>
                                                                </div>
                    
                                                                <div  class="mb-3 col-lg-3">
                                                                    <label class="form-label" for="subject">Debit</label>
                                                                    <input type="text" name="debit_x" placeholder="0" id="debit" class="form-control currency"/>
                                                                    <input type="hidden" name="debit" class="form-control"/>
                                                                </div>
                    
                                                                <div class="mb-3 col-lg-3">
                                                                    <label class="form-label" for="resume">Kredit</label>
                                                                    <input type="text" name="kredit_x" placeholder="0" class="form-control currency" id="kredit">
                                                                    <input type="hidden" name="kredit" class="form-control" >
                                                                </div>
                                                                <div class="col-lg-1 col-sm-4 align-self-center">
                                                                    <div class="d-grid">
                                                                        <label class="form-label" for="resume"></label>                                                                        
                                                                    </div>    
                                                                </div>




                                                                <div class="isi">                                                                 
                                                                    <table class="table table-bordered" id="isi">
                                                                        <thead>
                                                                            <tr>
                                                                                <td width="35%">Nama Rekening</td>
                                                                                <td width="15%">Debit</td>
                                                                                <td width="15%">Kredit</td>
                                                                                <td width="15%">Aksi</td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>                                                                            
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td align="right" id="totaldebit"><strong></strong></td>
                                                                                <td align="right" id="totalkredit"><strong></strong></td>
                                                                                
                                                                                <td>
                                                                                    <!-- <input type="hidden" name="mastercoa_id"> -->
                                                                                    <input type="hidden" name="totaldebit_hidden" value="">
                                                                                    <input type="hidden" name="totalkredit_hidden" value="">
                                                                                    <!-- <input type="hidden" name="max_hidden" value=""> -->
                                                                                    <button type="submit" class="btn btn-success mt-2 mt-sm-0"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                                                                </td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
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






<!-- jQuery 3 -->
<script src="https://act.webseitama.com/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://act.webseitama.com/assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Select2 -->
<script src="https://act.webseitama.com/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- maskmoney -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script src="https://act.webseitama.com/assets/dist/autocomplite/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" src="https://act.webseitama.com/assets/plugins/PrayTimes/PrayTimes.js"></script>

<script type="text/javascript">
    const url_getakun = "<?= site_url('selisih_kurs/getakun') ?>";

    $('tfoot').hide();  
</script>
<script src="<?=base_url()?>/assets/js/crud.js"></script>