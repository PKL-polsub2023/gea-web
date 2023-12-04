<?php
$this->load->library('Pdf');

// create new PDF document
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('andhika6@gmail.com');
//$pdf->SetTitle('Title of the Document');
//$pdf->SetSubject('Subject of the Document');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('times', '', 10);

//header
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// add a page
$pdf->AddPage();

$tbl = '
<h3 style="text-align: center;">Laporan Neraca Saldo Periode: ' . $periode . '</h3>
<h4 style="text-align: center;">' . $subjudul . '</h4>

<table width="100%" style="line-height: 1.5;" border="1" cellpadding="5">        
    <tr style="text-align:center">
        <td><b>Kode Akun</b></td>
        <td><b>Nama Akun</b></td>
        <td><b>Debit</b></td>
        <td><b>Kredit</b></td>
    </tr>';

$saldoTerakhir = array();
$jumlahDebit = 0;
$jumlahKredit = 0;
foreach ($dtMasterCoa as $key => $coa) {
    $saldo = 0;
    foreach ($saldoAwal as $key => $s_awal) {
        if ($coa['kode'] == $s_awal['kode']) {
            $saldo += $s_awal['saldo_normal'];
        }
    }
    foreach ($dt as $key => $jurnal) {
        if ($jurnal['kode'] == $coa['kode']) {
            /* 
             * 1 - Aset/Aktiva
             * 2 - Modal
             * 3 - Kewajiban/Passiva
             * 4 - Pendapatan
             * 5 - Beban
            */
            if ($jurnal['id_kelompokakun'] == 2 || $jurnal['id_kelompokakun'] == 3 || $jurnal['id_kelompokakun'] == 4) {
                $saldo += $jurnal['kredit'] - $jurnal['debit'];
            } else {
                $saldo += $jurnal['debit'] - $jurnal['kredit'];
            }
        }
    }
    $saldoTerakhir[$coa['kode']] = $saldo;
    $debit = number_format(0, 2, ',', '.');
    $kredit = number_format(0, 2, ',', '.');
    /* 
    * 1 - Aset/Aktiva
    * 2 - Modal
    * 3 - Kewajiban/Passiva
    * 4 - Pendapatan
    * 5 - Beban
    */
    if ($coa['id_kelompokakun'] == 1 || $coa['id_kelompokakun'] == 5) {
        $debit = number_format($saldoTerakhir[$coa['kode']], 2, ',', '.');
        $jumlahDebit += $saldoTerakhir[$coa['kode']];
    } else {
        $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ',', '.');
        $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
    }
    $tbl .= '
        <tr>
            <td style="text-align:center">' . $coa['kode'] . '</td>
            <td>' . $coa['nama'] . '</td>
            <td style="text-align:right">' . $debit . '</td>
            <td style="text-align:right">' . $kredit . '</td>
        </tr>
    ';
}
$tbl .= '
<tr>
<td colspan="2" style="text-align:center"><b>Jumlah</b></td>
<td style="text-align:right"><b>' . number_format($jumlahDebit, 2, ',', '.') . '</b></td>
<td style="text-align:right"><b>' . number_format($jumlahKredit, 2, ',', '.') . '</b></td>
</tr>
';
$tbl .= '
</table>';

$pdf->writeHTML($tbl, true, false, true, false, '');

// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document

$pdf->Output('Laporan Neraca Saldo ' . $periode . '.pdf', 'I');
