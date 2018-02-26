<?php
include('mpdf/mpdf.php');

$html .= "

<style>
        @media print {
            @page {
                margin: 0 auto; /* imprtant to logo margin */
                sheet-size: 300px 250mm; /* imprtant to set paper size */
            }
            html {
                direction: rtl;
            }
            html,body{margin:0;padding:0}
            #printContainer {
                width: 250px;
                margin: auto;
                /*padding: 10px;*/
                /*border: 2px dotted #000;*/
                text-align: justify;
            }

           .text-center{text-align: center;}
        }
    </style>

<div id='printContainer'>
<table class='table' width='100%' id='tbl'>
<tr>
<th rowspan='2'>Provident International Sch </th>
</tr>

<tr>
<td> Student ID </td>
<td> echo $sstudentID; </td>
</tr>

<tr>
<td> Student Name </td>
<td> echo $sstudent_name; </td>
</tr>

<tr>
<td> Menu</td>
<td> echo $mmenu; </td>
</tr>

<tr>
<td> Cost </td>
<td> echo $mmenu_cost; </td>
</tr>

<tr>
<td> Total Cost </td>
<td> echo $total_cost; </td>
</tr>

<tr>
<td> Date Sold </td>
<td>  echo date('d-m-Y H:i:s', time()); </td>
</tr>

</table>
";


$mpdf=new mPDF();
$mpdf->WriteHTML($html);
//$mpdf->SetDisplayMode('fullpage');
 
$mpdf->Output();

?>