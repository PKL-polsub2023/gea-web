
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
                    <div id="content" data-url="<?= base_url('jurnal_masuk') ?>">
                    <!-- Untuk keperluan script dibawah -->



                      <!-- start page title -->
                      <div class="page-title-box">
                          <div class="row align-items-center">
                              <div class="col-md-8">
                                  <!-- <h6 class="page-title">Data Ruangan</h6> -->
                                  <ol class="breadcrumb m-0">
                                      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                      <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                                      <li class="breadcrumb-item"><a href="#">Input Transaksi Harian</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">Tambah Jurnal</li>
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
                                      <h4 class="card-title mb-4">Form Jurnal Harian Pemasukan</h4>
                                      
                                      <form action="<?php echo base_url('jurnal_masuk/proses_tambah');?>" method="POST" enctype="multipart/form-data"> 
                                         
                                        
                                      <table class="table table-bordered" style="background-color: #ececf1; border: 2px solid #ccc;">
                                        <tbody>
                                        <tr>
                                        
                                        
                                        </tr>
                                        <tr>
                                        <td style="width: 10%;">Jenis Transaksi</td>
                                        <td style="width: 30%;">
                                        <select id="example-text-input" class="form-control" name="jenis_transaksi">
                                                <option value="1">Pemasukan (IN)</option> 
                                                <option value="2">Pengeluaran (OUT)</option>
                                                <!-- <option value="3">Pengeluaran Hutang (HUT)</option>
                                                <option value="4">Pemasukan Piutang (PIU)</option> -->
                                        </select> 
                                        <!-- <input id="example-text-input" class="form-control" name="jenis_transaksi" type="text" placeholder="No Jurnal" required> -->
                                        </td>

                                        <!--
                                        <td style="width: 10%;">No Jurnal</td>
                                        <td style="width: 30%;"><input id="example-text-input" class="form-control" name="no_jurnal" type="text" placeholder="No Jurnal" required></td>
                                        -->
                                        
                                        <td style="width: 10%">keterangan</td>
                                        <td style="width: 30%" rowspan="2"><textarea rows="4" id="example-text-input" class="form-control" name="keterangan" placeholder="Keterangan"></textarea></td>
                                        </tr>
                                        <tr>
                                        <td style="width: 10%">Tanggal</td>
                                        <td style="width: 30%"><input id="example-text-input" class="form-control" name="tanggal" type="date" placeholder="Tanggal" /></td>
                                        <td style="width: 79.3438px;">&nbsp;</td>
                                        </tr>

                                        <tr>
                                        <td style="width: 10%">QTY</td>
                                        <td style="width: 30%"><input id="example-text-input" class="form-control" name="qty" type="number" placeholder="QTY" /></td>
                                        <td style="width: 10%">Status</td>
                                        <td style="width: 30%">
                                            <select id="example-text-input" class="form-control" name="status">
                                                <option value="0">belum dibayar</option> 
                                                <option value="1">sudah dibayar</option>
                                            </select> 
                                        </td>
                                        </tr>

                                        <tr>
                                        <td style="width: 10%">Harga Satuan</td>
                                        <td style="width: 30%"><input id="example-text-input" class="form-control" name="hargasatuan" type="number" placeholder="Harga Satuan" /></td>
                                        <td style="width: 79.3438px;">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                      </table>                                     


                                                    <br>                                                   
                                                        <div data-repeater-list="group-a">
                                                            <div data-repeater-item class="row">
                                                                <div  class="mb-6 col-lg-6">
                                                                    <label class="form-label" for="name">Kode</label>

                                                                    <select name="mastercoa_id" id="mastercoa_id" class="form-control">
                                                                        <option value="">Pilih Akun</option>
                                                                        <?php foreach ($datacoa as $u): ?>
                                                                            <option value="<?= $u['mastercoa_id'] ?>"><?= $u['kode'] ?> - <?= $u['nama'] ?> (<?= $u['jenis'] ?>)</option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                    
                                                                <div  class="mb-6 col-lg-6">
                                                                    <label class="form-label" for="email">Nama Rekening</label>
                                                                    <input type="text" name="namarek" id="namarek" class="form-control"/>
                                                                </div>
                    
                                                                <div  class="mb-6 col-lg-6">
                                                                    <label class="form-label" for="subject">Debit</label>
                                                                    <input type="text" name="debit_x" placeholder="0" id="debit_aw" class="form-control currency"/>
                                                                    <input type="hidden" name="debit" class="form-control"/>
                                                                </div>
                    
                                                                <div class="mb-6 col-lg-6">
                                                                    <label class="form-label" for="resume">Kredit</label>
                                                                    <input type="text" name="kredit_x" placeholder="0" class="form-control currency" id="kredit_aw">
                                                                    <input type="hidden" name="kredit" class="form-control" >
                                                                </div>

                                                                <!-- <div class="mb-6 col-lg-6">
                                                                    <label class="form-label" for="nama">Nama</label>
                                                                    <input type="text" name="nama_x" placeholder="..." class="form-control" id="nama">
                                                                    <input type="hidden" name="nama" class="form-control" >
                                                                </div> -->


                                                                <div class="col-lg-6 col-sm-6 align-self-center">
                                                                    <div class="d-grid">
                                                                        <label class="form-label" for="resume"></label>                                                                        
                                                                    </div>    
                                                                </div>
                                                                <br>
                                                                <!-- <br><br><br><br> -->



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
    const url_getakun = "<?= site_url('jurnal_masuk/getakun') ?>";

    $('tfoot').hide();  
</script>
<script src="<?=base_url()?>/assets/js/crud.js"></script>
<script>
		// $(document).ready(function(){
		// 	$('tfoot').hide()

		// 	$(document).keypress(function(event){
		//     	if (event.which == '13') {
		//       		event.preventDefault();
		// 	   	}
		// 	})

			// $('#mastercoa_id').on('change', function(){

			// 	if($(this).val() == '') reset()
			// 	else {

            //         var mastercoa_id=$(this).val();
			// 		const url_getakun = $('#content').data('url') + '/getakun'
			// 		$.ajax({
			// 			url: url_getakun,
			// 			type: 'POST',
			// 			dataType: 'json',
			// 			data: {mastercoa_id: mastercoa_id},
			// 			success: function(data){
			// 				$('#namarek').val(data.mastercoa_id)
			// 				$('input[name="debit"]').val(data.debit)
            //                 $('input[name="kredit"]').val(data.kredit)
			// 				//$('input[name="jumlah"]').val(1)
			// 				//$('input[name="satuan"]').val(data.satuan)
			// 				//$('input[name="max_hidden"]').val(data.stok)
			// 				//$('input[name="jumlah"]').prop('readonly', false)
			// 				$('button#tambah').prop('disabled', false)

			// 				//$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
			// 				//$('input[name="jumlah"]').on('keydown keyup change blur', function(){
			// 					//$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
			// 				//})
			// 			}
			// 		})
			// 	}
			// })

			// $(document).on('click', '#tambah', function(e){
			// 	const url_tambahjurnal = $('#content').data('url') + '/tambahjurnal'
			// 	const data_jurnalmasuk= {
			// 		namarek: $('select[name="namarek"]').val(),
			// 		debit: $('input[name="debit"]').val(),
			// 		kredit: $('input[name="kredit"]').val(),
			// 		//satuan: $('input[name="satuan"]').val(),
			// 		//sub_total: $('input[name="sub_total"]').val(),
			// 	}

			// 	if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_jurnalmasuk.jumlah)) {
			// 		alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
			// 	} else {
			// 		$.ajax({
			// 			url: url_tambahjurnal,
			// 			type: 'POST',
			// 			data: data_jurnalmasuk,
			// 			success: function(data){
			// 				if($('select[name="namarek"]').val() == data_jurnalmasuk.namarek) $('option[value="' + data_jurnalmasuk.namarek + '"]').hide()
			// 				reset()

			// 				$('table#isi tbody').append(data)
			// 				$('tfoot').show()

			// 				$('#total').html('<strong>' + hitung_total() + '</strong>')
			// 				$('input[name="total_hidden"]').val(hitung_total())
			// 			}
			// 		})
			// 	}

			// })


		// 	$(document).on('click', '#tombol-hapus', function(){
		// 		$(this).closest('.row-keranjang').remove()

		// 		$('option[value="' + $(this).data('namarek') + '"]').show()

		// 		if($('tbody').children().length == 0) $('tfoot').hide()
		// 	})

		// 	$('button[type="submit"]').on('click', function(){
		// 		$('input[name="kode_barang"]').prop('disabled', true)
		// 		$('select[name="namarek_barang"]').prop('disabled', true)
		// 		$('input[name="harga_barang"]').prop('disabled', true)
		// 		$('input[name="jumlah"]').prop('disabled', true)
		// 		$('input[name="sub_total"]').prop('disabled', true)
		// 	})

		// 	function hitung_total(){
		// 		let total = 0;
		// 		$('.sub_total').each(function(){
		// 			total += parseInt($(this).text())
		// 		})

		// 		return total;
		// 	}

		// 	function reset(){
		// 		$('#namarek_barang').val('')
		// 		$('input[name="kode_barang"]').val('')
		// 		$('input[name="harga_barang"]').val('')
		// 		$('input[name="jumlah"]').val('')
		// 		$('input[name="sub_total"]').val('')
		// 		$('input[name="jumlah"]').prop('readonly', true)
		// 		$('button#tambah').prop('disabled', true)
		// 	}
		// })
	</script>