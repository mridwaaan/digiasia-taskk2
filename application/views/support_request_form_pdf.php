<?php
	ob_start();
	$pdf = new Pdf('P', 'mm', 'A4', s, 'UTF-8', false);
	$pdf->SetTitle('Support Request Form');
	$pdf->SetHeaderMargin(20);
	$pdf->SetTopMargin(20);
	$pdf->setFooterMargin(20);
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->SetAutoPageBreak(true);
	$pdf->SetAuthor('Author');
	$pdf->SetDisplayMode('real', 'default');
	$pdf->AddPage();
	$i=0;
	foreach ($request as $r) :
	$html='<p align="center"><h2>Support Request Form</h3></p>
			<table border="1" cellpadding="10">
				<tr bgcolor="#ffffff">
					<td width="25%"><img src="http://www.supplychainleaders.com/assets/images/logos/cj_logistics_logo_1-1489507759.png"></td>
					<td colspan="3" width="75%"><h3>No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;'.$r->request_no.'<br><br>Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;'.$r->date.'</h3></td>
				</tr>
				<tr>
					<td colspan="4">
						<table  border="0">
							<tr bgcolor="#ffffff">
								<td width="24%">Name</td>
								<td width="3%">:</td>
								<td width="73%">'.$r->name.'</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>Department</td>
								<td>:</td>
								<td>'.$r->dept.'</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>Support Type</td>
								<td>:</td>
								<td>'.$r->type_name.'</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>Reason</td>
								<td>:</td>
								<td>'.$r->description.'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<table  border="0">
							<tr bgcolor="#ffffff">
								<td colspan="3">*Filled by IT<br></td>
							</tr>
							<tr bgcolor="#ffffff">
								<td width="24%">Remark</td>
								<td width="3%">:</td>
								<td width="73%">'.$r->response.'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="25%" align="center">
						Requestor<br>User<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
					</td>
					<td width="25%" align="center">
						Acnowledge<br>Spv/Manager User<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
					</td>
					<td width="25%" align="center">
						Approval<br>IT Manager<br><br><br><br>(Refli Chaidir)
					</td>
					<td width="25%" align="center">
						Action<br>IT Support<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
					</td>
				</tr>
				';

	$html.='</table>';
	$html.='<br><br>
	<table border="0" style="font-size:8pt;">
		<tr>
			<td width="12%">No Form</td>
			<td width="2%">:</td>
			<td>FM-MR-001-03</td>
		</tr>
		<tr>
			<td>No Rev</td>
			<td>:</td>
			<td>01</td>
		</tr>
		<tr>
			<td>Tanggal Terbit</td>
			<td>:</td>
			<td>5 April 2018</td>
		</tr>
	</table>
	';
	$pdf->writeHTML($html, true, false, true, false, '');
	ob_end_clean();
	$pdf->Output($r->request_no.'.pdf', 'I');
	endforeach;
?>