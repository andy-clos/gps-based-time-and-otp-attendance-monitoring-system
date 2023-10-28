<?php

require "../fpdf/fpdf.php";
require "../php_functions/conn.php";

class myPDF extends FPDF{
    function header(){
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(276,20,'Leave',0,0,'C');
        $this->Ln();
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Ln();
    }
    function headerTable(){
        $this->SetFont('Times', 'B', 12);
        $this->Cell(20,10,'Users ID',1,0,'C');
        $this->Cell(60,10,'Users Name',1,0,'C');
        $this->Cell(40,10,'Leave Type',1,0,'C');
        $this->Cell(40,10,'Start Date',1,0,'C');
        $this->Cell(40,10,'End Date',1,0,'C');
        $this->Cell(40,10,'Status',1,0,'C');
        $this->Ln();
    }
    function viewTable($conn){
        $this->SetFont('Times', '', 12);
        $displayleave = "SELECT * FROM leave_apply, users_info WHERE leave_apply.usersId = users_info.usersId order by startDate";
                    if($leave = mysqli_query($conn, $displayleave)){
                        if(mysqli_num_rows($leave)>0){
                            while ($row = mysqli_fetch_array($leave, MYSQLI_ASSOC)){
                                $this->Cell(20,10,$row['usersId'],1,0,'C');
                                $this->Cell(60,10,$row['usersName'],1,0,'L');
                                $this->Cell(40,10,$row['leaveType'],1,0,'C');
                                $this->Cell(40,10,$row['startDate'],1,0,'C');
                                $this->Cell(40,10,$row['endDate'],1,0,'C');
                                $this->Cell(40,10,$row['statusL'],1,0,'C');
                                $this->Ln();
                }
            }
        } 
    }
} 

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$pdf->Output();
