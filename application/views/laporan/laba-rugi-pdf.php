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

$tbl = '<h3 style="text-align: center;">Laporan Laba Rugi Periode: ' . $periode . '</h3>
    <h4 style="text-align: center;">' . $subjudul . '</h4>';

$tbl .= '<table width="100%" style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">';

$saldoTerakhir = array();
$jumlahDebit = 0;
$jumlahKredit = 0;
$lastStatus = '';

$saldo_tetap = 0;
$saldo_lancar = 0;

$total_beban = 0;
$total_pendapatan = 0;
$pajak = 0;
foreach ($dtMasterCoa as $key => $coa) {
    /* id_kelompokakun 
            * 1 - Aset/Aktiva
            * 2 - Modal
            * 3 - Kewajiban/Passiva
            * 4 - Pendapatan
            * 5 - Beban
            */
    if ($coa['id_kelompokakun'] == 4 || $coa['id_kelompokakun'] == 5) {
        $saldo = 0;
        foreach ($saldoAwal as $key => $s_awal) {
            if ($coa['kode'] == $s_awal['kode']) {
                $saldo += $s_awal['saldo_normal'];
            }
        }
        foreach ($dt as $key => $jurnal) {
            if ($jurnal['kode'] == $coa['kode']) {
                if ($jurnal['status'] == 'Modal' || $jurnal['status'] == 'Pasiva' || $jurnal['status'] == 'Pendapatan') {
                    $saldo += $jurnal['kredit'] - $jurnal['debit'];
                } else {
                    $saldo += $jurnal['debit'] - $jurnal['kredit'];
                }
            }
        }
        $saldoTerakhir[$coa['kode']] = $saldo;
        $debit = number_format(0, 2, ',', '.');
        $kredit = number_format(0, 2, ',', '.');

        if ($coa['id_kelompokakun'] == 1 || $coa['id_kelompokakun'] == 5) {
            $debit = number_format($saldoTerakhir[$coa['kode']], 2, ',', '.');
            $jumlahDebit += $saldoTerakhir[$coa['kode']];
        } else {
            $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ',', '.');
            $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
        }

        if ($coa['id_kelompokakun'] == 5) {
            if ($lastStatus != 'Beban') {
                $tbl .= "<tr><td colspan='2'><b>Beban</b></td></tr>";
                $lastStatus = 'Beban';
            }
        } 

        if ($coa['id_kelompokakun'] == 4) {
            if ($lastStatus != 'Pendapatan') {
                $tbl .= "<tr><td colspan='2'><b>Pendapatan</b></td></tr>";
                $lastStatus = 'Pendapatan';
            }
        }
        $tbl .= '
        <tr>
            <td style="display: inline-block; width: 50%;">
                <dd>' . $coa['nama'] . '</dd>
            </td>
            <td style="display: inline-block; width: 50%; text-align: right;">' . number_format($saldo, 2, ',', '.') . '</td>
        </tr>';
    }
}

foreach ($saldoTerakhir as $key => $saldo) {
    if (substr($key, 0, 2) >= "40" && substr($key, 0, 2) < 50) {            
        $total_pendapatan += $saldo;
    } else {
        $total_beban += $saldo;
    }
}   
$tbl .= '
<tr>
<td style="display: inline-block; width: 50%;"><b>Total Pendapatan</b></td>
<td style="display: inline-block; width: 50%; text-align: right;">' . number_format($total_pendapatan, 2, ',', '.') . '</td>
</tr>
<tr>
<td style="display: inline-block; width: 50%;"><b>Total Beban</b></td>
<td style="display: inline-block; width: 50%; text-align: right;">' . number_format($total_beban, 2, ',', '.') . '</td>
</tr>
<tr>
<td style="display: inline-block; width: 50%;"><b>Laba Sebelum Pajak</b></td>
<td style="display: inline-block; width: 50%; text-align: right;">' . number_format($total_pendapatan - $total_beban, 2, ',', '.') . '</td>
</tr>
<tr>
<td style="display: inline-block; width: 50%;"><dd><b>Pajak</b></dd></td>
<td style="display: inline-block; width: 50%; text-align: right;">' . number_format(0, 2, ',', '.') . '</td>
</tr>
<tr>
<td style="display: inline-block; width: 50%;"><b>Laba Bersih</b></td>
<td style="display: inline-block; width: 50%; text-align: right;">' . number_format(($total_pendapatan - $total_beban) - $pajak, 2, ',', '.') . '</td>
</tr>
</table>
';

$pdf->writeHTML($tbl, true, false, true, false, '');

// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document

$pdf->Output('Laporan Laba Rugi ' . $periode . '.pdf', 'I');
