<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <style type="text/css">
        div{
            margin:105px;
        } 
        table#sample td{
        	height: 20px;
        }
        </style>
    </head>
<body>
<div style="page-break-after:always; width:100%">
<br>
<table width="100%">
	<tr>
		<td align="center" style="font-family:Arial; font-size:17px;">
			<strong>SERTIFIKAT</strong>
		</td>
	</tr>
</table>
<br>
	<table width="100%" style="font-family:Arial; font-size:13px;">
		<tr>
			<td>
				<table id="sample" style="margin-top:25px;">
					<tr>
						<td height="20">Pemegang Polis<br/></td>
						<td>: </td>
						<td><?= $get_debitur->bank_name ?></td>
					</tr>
                    <tr>
						<td height="20">No. Polis<br/></td>
						<td>: </td>
						<td><?= $get_debitur->policy_id ?></td>
					</tr>
                    <tr>
						<td height="20">Nomor Tertanggung<br/></td>
						<td>:</td>
						<td><?= $get_debitur->certificate_number ?></td>
					</tr>
					<tr>
						<td height="20">Nama Tertanggung<br/></td>
						<td>:</td>
						<td><?= $get_debitur->debitur_name ?></td>
					</tr>
                    <tr>
						<td height="20">Tanggal Lahir<br/></td>
						<td>:</td>
						<td><?= date('d-m-Y', strtotime($get_debitur->datebirth)) ?></td>
					</tr>
					<tr>
						<td height="20">Jenis Asuransi<br/></td>
						<td>:</td>
						<td><?= $get_debitur->insurance_type_name ?></td>
					</tr>
                    <tr>
						<td height="20">Jumlah Kredit/Pinjaman<br/></td>
						<td>:</td>
						<td><?= $get_debitur->currency_id.'. '.number_format($get_debitur->sum_insured) ?></td>
					</tr>
					<tr>
						<td height="20">Premi Sekaligus<br/></td>
						<td>: </td>
						<td><?= $get_debitur->currency_id.'. '.number_format($get_debitur->premi + $get_debitur->premi_emep) ?></td>
					</tr>
                    <tr>
						<td height="20">Masa Berlaku<br/></td>
						<td>:</td>
						<td><?= date('d-m-Y', strtotime($get_debitur->period_start)) ?> s.d. <?= date('d-m-Y', strtotime($get_debitur->period_end)) ?> (<?= $get_debitur->period.' '.$get_debitur->term_loan_type_id ?>)</td>
					</tr>
                    <tr>
						<td height="20">Tingkat Bunga Persetujuan Kredit<br/></td>
						<td>:</td>
						<td>25.00%</td>
					</tr>                                    
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" style="text-align: justify;">
					<tr>
						<td>
							<?php echo $get_certificate_template->certificate_text ?>
						</td>
						<!-- <td >
							Apabila Tertanggung meninggal dalam masa asuransi, maka kepada pemegang polis dibayarkan Manfaat Asuransi seperti<br>
							tabel Terlampir.
						</td>
					</tr>
					<tr>
						<td >
							Sertifikat ini tunduk pada syarat-syarat umum, syarat-syarat khusus dan tambahan lainnya yang merupakan bagian mutlak dan tidak dapat dipindahkan dari polis induk.
						</td> -->
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
                    <tr>
                    	<td><br></td>
					</tr>
					<tr>
						<td>
							Jakarta, <?=date('d-m-Y', strtotime(date('Y-m-d')));?><br/>
							<strong>PT EQUITY LIFE INSURANCE</strong>
						</td>
					</tr>
                </table>         
        	</td>
        </tr>
        <!-- </table>
        <?php if($this->session->userdata('roles_id') == 2){ ?>
        <table width="100%">
        	<tr>
        		<td style="text-align:center; justify;font-size: 10px;">
        			<strong>/Copy</strong><br/>
        		</td>
        	</tr>
        </table>
        <?php } ?> -->
        </div>
</body>
</html>
