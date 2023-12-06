<tr class="row-isi">
	<td class="namarek">
		<?= $this->input->post('namarek') ?>
		<input type="hidden" name="namarek_hidden[]" value="<?= $this->input->post('namarek') ?>">

		<input type="hidden" name="mastercoa_id_hidden[]" value="<?= $this->input->post('mastercoa_id') ?>">

		<!-- <input type="hidden" name="mastercoa_id" value="<?= $this->input->post('mastercoa_id') ?>"> -->
	</td>
	<td class="debit">
		<?= rupiah($this->input->post('debit')) ?>
		<input type="hidden" name="debit_hidden[]" value="<?= $this->input->post('debit') ?>">
	</td>
	<td class="kredit">
		<?= rupiah($this->input->post('kredit')) ?>
		<input type="hidden" name="kredit_hidden[]" value="<?= $this->input->post('kredit') ?>">
	</td>
	
	<!-- <td class="sub_total">
		<?= $this->input->post('sub_total') ?>
		<input type="hidden" name="sub_total_hidden[]" value="<?= $this->input->post('sub_total') ?>">
	</td> -->
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-mastercoa_id="<?= $this->input->post('mastercoa_id') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>