<?php
header("Content-type: application/vnd-ms-excel");
//header("Content-Disposition: attachment; filename=SR-$tahun.xls");
header("Content-Disposition: attachment; filename=Support_Request_Report.xls");
?>
<br>

<table border="1" cellspacing="0" width="100%">
     <tr class="info">
          <th style="text-align:left;padding:5px 5px;">Request ID</th>
          <th style="text-align:left;padding:5px 5px;">Subject</th>
          <th style="text-align:left;padding:5px 5px;">Description</th>
          <th style="text-align:left;padding:5px 5px;">Date</th>
          <th style="text-align:left;padding:5px 5px;">Type</th>
          <th style="text-align:left;padding:5px 5px;">Site</th>
          <th style="text-align:left;padding:5px 5px;">Requested By</th>
          <th style="text-align:left;padding:5px 5px;">Closed By</th>
     </tr>
<?php 
foreach ($request as $r) {
?>
<tr>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->request_no;?></td>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->subject;?></td>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->description;?></td>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->date;?></td>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->type_name;?></td>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->site_name;?></td>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->requested_by_name;?></td>
          <td style="text-align:left;padding:5px 5px;"><?php echo $r->closed_by;?></td>
     </tr>
<?php } ?>

</table>
