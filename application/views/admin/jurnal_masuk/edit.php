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
                        <li class="breadcrumb-item active" aria-current="page">Edit Jurnal</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">                                                                           
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

                            <form action="<?php echo base_url('jurnal_masuk/update/' . $jurnal->jurnalmasuk_id) ?>" method="POST" enctype="multipart/form-data"> 
                                <input type="hidden" name="id" value="<?= $jurnal->jurnalmasuk_id ?>" />
                        
                                <table class="table table-bordered" style="background-color: #ececf1; border: 2px solid #ccc;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 10%;">Jenis Transaksi</td>
                                            <td style="width: 30%;">
                                            <?php
                                                $dropTransaksi = array("1"=>"Pemasukan", "2"=>"Pengeluaran");
                                                // echo $jurnal->tipe_jurnal;
                                                echo form_dropdown("jenis_transaksi",$dropTransaksi, $jurnal->tipe_jurnal ,'id="example-text-input" class="form-control"');
                                            ?>
                                            <!-- <input id="example-text-input" class="form-control" name="jenis_transaksi" type="text" placeholder="No Jurnal" required> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%;">No Jurnal</td>
                                            <td style="width: 30%;"><input id="example-text-input" class="form-control" name="no_jurnal" type="text" placeholder="No Jurnal" value="<?= $jurnal->no_jurnal ?>" required readonly style="background:#CCC;"></td>
                                            <td style="width: 10%">keterangan</td>
                                            <td style="width: 30%" rowspan="2"><textarea rows="4" id="example-text-input" class="form-control" name="keterangan" placeholder="Keterangan"><?= $jurnal->keterangan ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%">Tanggal</td>
                                            <td style="width: 30%"><input id="example-text-input" class="form-control" name="tanggal" type="date" placeholder="Tanggal" value="<?= $jurnal->tanggal ?>" /></td>
                                            <td style="width: 79.3438px;">&nbsp;</td>
                                        </tr>

                                        <tr>
                                        <td style="width: 10%">QTY</td>
                                        <td style="width: 30%"><input id="example-text-input" class="form-control" name="qty" type="number" placeholder="QTY" value="<?= $jurnal->qty ?>"/></td>
                                        <td style="width: 10%">Status</td>
                                        <td style="width: 30%">
                                            <?php
                                                $dropStatus = array("0"=>"belum dibayar", "1"=>"sudah bayar");
                                                // echo $jurnal->tipe_jurnal;
                                                echo form_dropdown("status",$dropStatus, $jurnal->status ,'id="example-text-input" class="form-control"');
                                            ?>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td style="width: 10%">Harga Satuan</td>
                                        <td style="width: 30%"><input id="example-text-input" class="form-control" name="hargasatuan" type="number" placeholder="Harga Satuan" value="<?= $jurnal->hargasatuan ?>" /></td>
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
                                                        <option value="<?= $u['mastercoa_id'] ?>"><?= $u['kode'] ?> - <?= $u['nama'] ?>  (<?= $u['jenis'] ?>)</option>
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

                                            <div class="col-lg-6 col-sm-6 align-self-center">
                                                <div class="d-grid">
                                                    <label class="form-label" for="resume"></label>                                                                        
                                                </div>    
                                            </div>

                                            <br><br><br><br>
                                        
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
                                                <?php if (count($detail) > 0): ?>                                                                         
                                                    <?php foreach($detail as $item): ?>
                                                        <tr class="row-isi">
                                                            <td class="namarek">
                                                                <?= $item['nama'] ?>
                                                                <input type="hidden" name="namarek_hidden[]" value="<?= $item['nama'] ?>">
                                                                <input type="hidden" name="mastercoa_id_hidden[]" value="<?= $item['mastercoa_id'] ?>">
                                                            </td>
                                                            <td class="debit">
                                                                <?= rupiah($item['debit'], "Rp. ") ?>		
                                                                <input type="hidden" name="debit_hidden[]" value="<?= $item['debit'] ?>">
                                                            </td>
                                                            <td class="kredit">
                                                                <?= rupiah($item['kredit'], "Rp. ") ?>
                                                                <input type="hidden" name="kredit_hidden[]" value="<?= $item['kredit'] ?>">
                                                            </td>
                                                            <td class="aksi">
                                                                <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-mastercoa_id="<?= $item['mastercoa_id'] ?>">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td align="right" id="totaldebit">
                                                            <p align="left">Total Debit : <strong><span id="totaldebit_footer"><?= rupiah($jurnal->tot_debit, "Rp. ") ?></span></strong></p>
                                                        </td>
                                                        <td align="right" id="totalkredit">
                                                            <p align="left">Total Kredit : <strong><span id="totalkredit_footer"><?= rupiah($jurnal->tot_kredit, "Rp. ") ?></span></strong></p>
                                                        </td>
                                                        
                                                        <td>
                                                            <!-- <input type="hidden" name="mastercoa_id"> -->
                                                            <input type="hidden" name="totaldebit_hidden" value="<?= $jurnal->tot_debit ?>">
                                                            <input type="hidden" name="totalkredit_hidden" value="<?= $jurnal->tot_kredit ?>">
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

        </div>
    </div>
</div>

<!-- jQuery 3 -->
<script src="https://act.webseitama.com/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    const url_getakun = "<?= site_url('jurnal_masuk/getakun') ?>";
</script>
<script src="<?=base_url()?>/assets/js/crud.js"></script>