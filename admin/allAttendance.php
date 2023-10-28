<?php

require "../fpdf/fpdf.php";
require "../php_functions/conn.php";

class myPDF extends FPDF{
    function header(){
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(276,20,'Attendance',0,0,'C');
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
        $this->Cell(30,10,'Date',1,0,'C');
        $this->Cell(20,10,'Users ID',1,0,'C');
        $this->Cell(60,10,'Users Name',1,0,'C');
        $this->Cell(30,10,'Time In',1,0,'C');
        $this->Cell(25,10,'StatusA',1,0,'C');
        $this->Cell(30,10,'Time Out',1,0,'C');
        $this->Cell(30,10,'Total Hours',1,0,'C');
        $this->Cell(55,10,'Location',1,0,'C');
        $this->Ln();
    }
    function viewTable($conn){
        $this->SetFont('Times', '', 12);
        $displayattendance = "SELECT * FROM attendance, users_info WHERE attendance.usersId = users_info.usersId order by date DESC";
                    if($attendance = mysqli_query($conn, $displayattendance)){
                        if(mysqli_num_rows($attendance)>0){
                            while ($row = mysqli_fetch_array($attendance, MYSQLI_ASSOC)){
                                $this->Cell(30,10,$row['date'],1,0,'C');
                                $this->Cell(20,10,$row['usersId'],1,0,'C');
                                $this->Cell(60,10,$row['usersName'],1,0,'L');
                                $time = strtotime($row['timeIn']);
                                $this->Cell(30,10,date("h:i:s A", $time),1,0,'C');
                                $this->Cell(25,10,$row['statusA'],1,0,'C');
                                $time = strtotime($row['timeOut']);
                                $this->Cell(30,10,date("h:i:s A", $time),1,0,'C');
                                $this->Cell(30,10,$row['totalHours'],1,0,'C');
                                $this->Cell(55,10,$row['location'],1,0,'C');
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
