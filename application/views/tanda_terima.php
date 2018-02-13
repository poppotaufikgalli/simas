<style type="text/css">
	*{
		font-family: arial;
	}

	@page{
		size: auto;
		margin: 2mm 5mm 5mm 5mm; 
	}

	body{
		margin: 0px;
	}

	.isi td{
		vertical-align: top;
		padding: 10pt;
		font-size: 7pt;
	}

	.ttd td{
		vertical-align: top;
		padding: 3pt;
		font-size: 7pt;
	}

	.isi th{
		padding: 10pt;
		font-size: 8pt;
	}
</style>
<!DOCTYPE html>
<html>
<head>
	<title>Print Tanda Terima</title>
</head>
<body>
	<div class="header">
		<table id="kop" width="100%" style="border-spacing:0;">
			<tr>
				<td width="10%"><img src="<?php echo base_url(); ?>asset/img/tpi.PNG" width="70pt"></td>
				<td width="85%" valign="top" style="text-align: center">
					<p><span style="font-weight: bold; font-size: 14pt">PEMERINTAH KOTA TANJUNGPINANG</span><br>
					<span style="font-weight: bold; font-size: 16pt">BADAN PENGELOLAAN PAJAK DAN<br>RETRIBUSI DAERAH</span><br>
					<span>Jl. Basuki Rahmat No.1a Telpon (0771) 24511 Fax (0771) 24334 e-mail: bpprdkotatanjungpinang@gmail.com, Kode Pos 29123</span></p>
				</td>
			</tr>
		</table>
		<hr>
		<p style="text-align: center"><strong><u>TANDA TERIMA SURAT KELUAR</u></strong></p>
		<table width="100%">
			<tr>
				<td width="15%">&nbsp;</td>
				<td width="70%">
					<table class="isi" width="100%" border="1px solid black" style="border-spacing:0;">
						<tr>
							<th width="5%">No</th>
							<th width="20%">Nomor / Tanggal</th>
							<th width="30%">Perihal</th>
							<th width="30%">Tujuan</th>
							<th width="15%">Ket</th>
						</tr>
						<tr height = "200px">
							<td>1</td>
							<td><?Php echo $nomor_surat.'<br>'.date('d M Y', strtotime($tgl_surat)); ?></td>
							<td><?Php echo $perihal; ?></td>
							<td>Disampaikan Kepada Yth. KEPALA <?Php echo $tujuan; ?></td>
							<td>&nbsp;</td>
						</tr>
					</table>
					<br>
					<br>
					<table class="ttd" width="100%">
						<tr>
							<td width="50%" style="text-align: center" rowspan="4">
								<?php 
									if(empty($qrcode)==false){
										echo '<img src="'.base_url('asset\img\qrImg_'.$qrcode.'.png').'" />';
									}
								?>
							</td>
							<td width="20%">Tanggal Terima</td><td> : ........................................ <?Php echo date('Y'); ?></td>
						</tr>
						<tr>
							<td width="20%">Nama Penerima</td><td> : ..................................................</td>
						</tr>
						<tr>
							<td width="20%">Nomor HP</td><td> : ...................................................</td>
						</tr>
						<tr>
							<td width="20%">Tanda Tangan</td><td> : ...................................................</td>
						</tr>
					</table>
				</td>
				<td width="15%">&nbsp;</td>
			</tr>
		</table>
		
	</div>
</body>
</html>
