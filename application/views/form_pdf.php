<?php 
require_once APPPATH.'/third_party/mpdf/src/Mpdf.php';
     $mpdf = new mPDF(('utf-8',    // mode - default ''
               'A4',    // format - A4, for example, default ''
               0,     // font size - default 0
               '',    // default font family
               15,    // margin_left
               15,    // margin right
               16,     // margin top
               16,    // margin bottom
               9,     // margin header
               9,     // margin footer
               'P'));  // L - landscape, P - portrait

//Memulai proses untuk menyimpan variabel php dan html
ob_start();
?>
     <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
     <body style="font-size: 12pt;">

<?php 
foreach($request as $r){
$no=0;
?>
  <table border="1">
    <tr>
      <td>
        LOGO
      </td>
      <td colspan="3">NO : <?php echo $r->request_id; ?><br>Date : <?php echo $r->date; ?></td>
    </tr>
    <tr>
      <table border="0">
        <tr>
          <td>Username</td>
          <td>: <?php echo $r->username; ?></td>
        </tr>
        <tr>
          <td>Dept</td>
          <td>: <?php echo $r->dept; ?></td>
        </tr>
        <tr>
          <td>Support Request Type</td>
          <td>: <?php echo $r->dept; ?></td>
        </tr>
        <tr>
          <td>Reason</td>
          <td>: <?php echo $r->description; ?></td>
        </tr>
      </table>
    </tr>
    <tr>
      <td>Requestor<br>User<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
      <td>Acnowledge<br>Spv/Manager User<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
      <td>Approval<br>IT Manager<br><br><br><br>(Refli Chaidir)</td>
      <td>Action<br>IT Support<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
    </tr>
  </table>

<?php } ?>
<?php
//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf

$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
$html .='';
$html .='';

//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->AddPage('P');
$mpdf->WriteHTML($html);
ob_end_clean();
$mpdf->Output();
exit;
?>