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

$tbl = '<h3 style="text-align: center;">Laporan Neraca Periode: ' . $periode . '</h3>
<h4 style="text-align: center;">' . $subjudul . '</h4>';

$tbl .= '
<table width="100%" style="line-height: 1.5;" border="1" cellpadding="5"> 
    <tr>
        <td style="font-weight:bold; text-align:center">Aktiva</td>
        <td style="font-weight:bold; text-align:center">Pasiva</td>
    </tr>
    <tr style="vertical-align: top;">
        <!-- untuk kolom pasiva-->
        <td>';
$saldoTerakhir = array();
$jumlahDebit = 0;
$jumlahKredit = 0;
$lastStatus = '';

$saldo_tetap = 0;
$saldo_lancar = 0;
foreach ($dtMasterCoa as $key => $coa) {
    if ($coa['kategori'] == 1) {
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
        $debit = number_format(0, 2, ",", ".");
        $kredit = number_format(0, 2, ",", ".");
        if ($coa['status'] == 'Aktiva' || $coa['status'] == 'Biaya' || $coa['status'] == 'Lainnya') {
            $debit = number_format($saldoTerakhir[$coa['kode']], 2, ",", ".");
            $jumlahDebit += $saldoTerakhir[$coa['kode']];
        } else {
            $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ",", ".");
            $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
        }
        if (substr($coa['kode'], 0, 2) > "10") {
            if ($lastStatus != 'Aktiva Tetap') {
                $tbl .= '<dt style="font-weight:bold;">Aktiva Tetap</dt>';
                $lastStatus = 'Aktiva Tetap';
            }
        } else {
            if ($lastStatus != 'Aktiva Lancar') {
                $tbl .= '<dt style="font-weight:bold;">Aktiva Lancar</dt>';
                $lastStatus = 'Aktiva Lancar';
            }
        }
        $tbl .= '<dd>
        <table style="width:100%;" style="line-height: 0.2; border-collapse: collapse;" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                        ' . $coa['nama'] . '
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table></dd>
        
            ';
        // tambahkan saldo aktiva tetap dan aktiva lancar
        if (substr($coa['kode'], 0, 2) > "10") {
            $saldo_tetap += $saldo;
        } else {
            $saldo_lancar += $saldo;
        }
    }
}
$tbl .= '
        </td>

        <!-- untuk kolom pasiva-->
        <td>';

$saldoTerakhir = array();
$jumlahDebit = 0;
$jumlahKredit = 0;
$lastStatus = '';

$saldo_tetapPasiva = 0;
$saldo_lancarPasiva = 0;

$total_beban = 0;
$total_pendapatan = 0;
$pajak = 0;
foreach ($dtMasterCoa as $key => $coa) {
    if ($coa['kategori'] == 2) {
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
        $debit = number_format(0, 2, ",", ".");
        $kredit = number_format(0, 2, ",", ".");
        if ($coa['status'] == 'Aktiva' || $coa['status'] == 'Biaya' || $coa['status'] == 'Lainnya') {
            $debit = number_format($saldoTerakhir[$coa['kode']], 2, ",", ".");
            $jumlahDebit += $saldoTerakhir[$coa['kode']];
        } else {
            $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ",", ".");
            $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
        }
        if (substr($coa['kode'], 0, 2) > "20") {
            if ($lastStatus != 'Modal') {
                $tbl .= '<dt style="font-weight:bold;">Modal</dt>';
                $lastStatus = 'Modal';
            }
        } else {
            if ($lastStatus != 'Pasiva Lancar') {
                $tbl .= '<dt style="font-weight:bold;">Pasiva Lancar</dt>';
                $lastStatus = 'Pasiva Lancar';
            }
        }
        $tbl .= '<dd>
        <table style="width:100%;" style="line-height: 0.2; border-collapse: collapse;" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                        ' . $coa['nama'] . '
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table></dd>';
        // tambahkan saldo modal dan pasiva lancar
        if (substr($coa['kode'], 0, 2) > "20") {
            $saldo_tetapPasiva += $saldo;
        } else {
            $saldo_lancarPasiva += $saldo;
        }
    }

    if ($coa['kategori'] != 1 && $coa['kategori'] != 2) {
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
        $debit = number_format(0, 2, ",", ".");
        $kredit = number_format(0, 2, ",", ".");
        if ($coa['status'] == 'Aktiva' || $coa['status'] == 'Biaya' || $coa['status'] == 'Lainnya') {
            $debit = number_format($saldoTerakhir[$coa['kode']], 2, ",", ".");
            $jumlahDebit += $saldoTerakhir[$coa['kode']];
        } else {
            $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ",", ".");
            $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
        }
    }
}

foreach ($saldoTerakhir as $key => $saldo) {
    if (substr($key, 0, 2) >= "40" && substr($key, 0, 2) < "50") {
        $total_pendapatan += abs($saldo);
    }

    if (substr($key, 0, 2) >= "50") {
        $total_beban += $saldo;
    }
}

$labaRugi = $total_pendapatan - $total_beban;
$tbl .= '
    <dd>
        <table style="width:100%;" style="line-height: 0.2; border-collapse: collapse;" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                    Laba Rugi Berjalan
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($labaRugi, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table></dd>';

$tbl .= '
        </td>
    </tr>   
  <tr>
    <td>
    <table style="width:100%;" style="line-height: 1; border-collapse: collapse; font-weight:bold" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                    Total Aktiva Lancar
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo_lancar, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table>
        <table style="width:100%;" style="line-height: 1; border-collapse: collapse;  font-weight:bold" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                    Total Aktiva Tetap
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo_tetap, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table>
        <table style="width:100%;" style="line-height: 1; border-collapse: collapse;  font-weight:bold" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                    Total Aktiva
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo_tetap + $saldo_lancar, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table>
    </td>  
    <td>
    <table style="width:100%;" style="line-height: 1; border-collapse: collapse;  font-weight:bold" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                    Total Pasiva Lancar
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo_lancarPasiva, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table>
        <table style="width:100%;" style="line-height: 1; border-collapse: collapse;  font-weight:bold" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                    Total Modal
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo_tetapPasiva + $labaRugi, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table>
        <table style="width:100%;" style="line-height: 1; border-collapse: collapse;  font-weight:bold" cellpadding="0">
            <tr>
                <td style="width:70%;">
                    <div style="text-align:left; padding-left 20px;">
                    Total Pasiva
                    </div>
                </td>
                <td style="width:30%;">
                    <div style="text-align:right">
                        ' . number_format($saldo_tetapPasiva + $saldo_lancarPasiva + $labaRugi, 2, ',', '.') . '
                    </div>
                </td>
            </tr>
        </table>
    </td>       
  </tr>
</table>

';


$pdf->writeHTML($tbl, true, false, true, false, '');

// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document

$pdf->Output('Laporan Neraca ' . $periode . '.pdf', 'I');
