<?php
class General_Model extends CI_Model
{
	public function getJurnalByNoJurnal(string $table, string $no_jurnal){
		$data = $this->db->query("select * from $table where no_jurnal = '$no_jurnal'")->result_array();
		return count($data) > 0 ? (object)$data[0] : $data;
	}

	public function getJurnalDetailByNoJurnal(string $jurnalTable, string $detailTable, string $no_jurnal){	

		$query = $this->db->query("SELECT * FROM $jurnalTable a, $detailTable b, dt_mastercoa c where a.no_jurnal=b.no_jurnal and b.mastercoa_id=c.mastercoa_id and b.no_jurnal='$no_jurnal'");

		return $query->result_array();

	}

    public function update(string $table, string $pk, int $id, array $data)
    {
        $this->db->where($pk, $id);
		$this->db->update($table, $data);
    }

    public function updateJurnalDetail(string $table, string $no_jurnal, array $data)
	{
		// hapus detail dengan no_jurnal ini
		$details = $this->db->query("SELECT * FROM $table WHERE no_jurnal = '$no_jurnal'")->result();

		if (count($details) > 0) {
			foreach ($details as $detail) {
				$this->db->delete($table, array(
					'no_jurnal' => $detail->no_jurnal,
					'mastercoa_id' => $detail->mastercoa_id
				)); 
			}
		}

		foreach ($data as $item) {
			$this->db->insert($table, $item);
		}
	}
}