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

// set some text to print
$tbl = '
<h3 style="text-align: center;">Laporan Buku Besar Periode: ' . $periode . '</h3>
<h4 style="text-align: center;">' . $subjudul . '</h4>
';

foreach ($dtMasterCoa as $key => $coa) {
    $tbl .= '
<table style="line-height: 1.5;">
    <tr>
        <td>
        <b>Nama Akun: ' . $coa['nama'] . '</b>
        </td>
        <td style="text-align:right;">
        <b>Kode Akun: ' . $coa['kode'] . '</b>
        </td>
    </tr> 
</table>';

    $tbl .= '<table width="100%" style="line-height: 1.5;" border="1" cellpadding="5">        
    <tr style="text-align:center">
    <td><b>No Jurnal</b></td>
    <td><b>Tanggal</b></td>
    <td><b>Keterangan</b></td>
    <td><b>Debit</b></td>
    <td><b>Kredit</b></td>
    <td><b>Saldo</b></td>
  </tr>';

    $saldo = 0;

    $foundSaldo = false;
    foreach ($saldoAwal as $key => $s_awal) {
        if ($s_awal['kode'] == $coa['kode']) {
            $foundSaldo = true;
            $saldo .= $s_awal['saldo_normal'];
            $tbl .= '<tr>
                    <td colspan="5" style="text-align:center">Saldo Awal</td>
                    <td style="text-align:right">' . number_format($s_awal['saldo_normal'], 2, ',', '.') . '</td>
                </tr>';
        }
    }
    $foundDT = false;
    foreach ($dt as $key => $jurnal) {
        if ($jurnal['kode'] == $coa['kode']) {
            $foundDT = true;
            $tbl .= '
                <tr style="text-align:center">
                    <td>' . $jurnal['no_jurnal'] . '</td>
                    <td>' . date('d F Y', strtotime($jurnal['tanggal'])) . '</td>
                    <td>' . $jurnal['keterangan'] . '</td>
                    <td style="text-align:right">' . number_format($jurnal['debit'], 2, ',', '.') . '</td>
                    <td style="text-align:right">' . number_format($jurnal['kredit'], 2, ',', '.') . '</td>
                    <td style="text-align:right">';
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
            //number_format($saldo, 2, ",", ".");
            $tbl .= number_format($saldo, 2, ",", ".");
            $tbl .= '</td>
                </tr>';
        }
    }
    if (!$foundDT && !$foundSaldo) {
        $tbl .= '<tr style="text-align:center"><td colspan="6">Tidak Ada Data Tersedia</td></tr>';
    }

    $tbl .= '</table>';
    $tbl .= '<p></p>';
}

$pdf->writeHTML($tbl, true, false, true, false, '');

// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document

$pdf->Output('Laporan Buku Besar ' . $periode . '.pdf', 'I');
