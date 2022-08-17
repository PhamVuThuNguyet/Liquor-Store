<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();
    require('fpdf/fpdf.php');
    require('PHPMailer-master/src/PHPMailer.php');
    require('PHPMailer-master/src/Exception.php');
    require('PHPMailer-master/src/SMTP.php');
    require('PHPMailer-master/src/OAuth.php');
    require('PHPMailer-master/src/POP3.php');
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_SESSION['user'])){
            if(isset($_POST['address'])&&isset($_POST['phone'])&&isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['email'])){
            $conn = mysqli_connect("localhost", "root", "", "liquorstore");
            $iduser = $_SESSION['iduser'];
            $total_price = $_SESSION['total'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $name = $_POST['firstname']." ".$_POST['lastname'];
            $email = $_POST['email'];
            $sql = "INSERT INTO receipt(iduser, customername, total, address, phone, email, status) VALUES ($iduser, '$name', $total_price, '$address', $phone, '$email', 'Chờ xác nhận')";
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                foreach($_SESSION['cart'] as $key=>$value){
                    $item[]=$key;
                }
                $str=implode(",",$item);
                $total=0;
                $sql2="SELECT * FROM PRODUCTS WHERE id in ($str)";
                $query = mysqli_query($conn, $sql2); 
                while($row = mysqli_fetch_array($query)){
                    $idproduct = $row['id'];
                    $productname = $row['productname'];
                    $price = $row['price'];
                    $quantity = $_SESSION['cart'][$idproduct];
                    $total = $quantity*$price;
                    $sql3 = "INSERT INTO receiptdetail(idreceipt, idproduct, productname, price, quantity, total) VALUES ($last_id, $idproduct, '$productname', $price, $quantity, $total)";
                    $result3 = mysqli_query($conn, $sql3);
                    $rest = $row['quantity'] - $quantity;
                    $sql4 = "UPDATE PRODUCTS SET QUANTITY = $rest WHERE id = $idproduct";
                    $result4 = mysqli_query($conn, $sql4);
                }

                class PDF extends FPDF{
                    // Page header
                    function Header(){
                        // Arial bold 15
                        $this->SetFont('Arial','B',28);
                        // Title
                        $this->Cell(80,10,'LIQUORSTORE',1,0,'C');
                        // Line break
                        $this->Ln(20);
                    }

                    // Page footer
                    function Footer(){
                        // Position at 1.5 cm from bottom
                        $this->SetY(-15);
                        // Arial italic 8
                        $this->SetFont('Arial','I',8);
                        // Page number
                        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
                    }

                    // Colored table
                    function FancyTable($header, $data){
                        // Colors, line width and bold font
                        $this->SetFillColor(255,0,0);
                        $this->SetTextColor(255);
                        $this->SetDrawColor(128,0,0);
                        $this->SetLineWidth(.3);
                        $this->SetFont('','B');
                        // Header
                        $w = array(40, 35, 40, 45);
                        for($i=0;$i<count($header);$i++)
                            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                        $this->Ln();
                        // Color and font restoration
                        $this->SetFillColor(224,235,255);
                        $this->SetTextColor(0);
                        $this->SetFont('');
                        // Data
                        $fill = false;
                        foreach($data as $row)
                        {
                            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
                            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                            $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
                            $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
                            $this->Ln();
                            $fill = !$fill;
                        }
                        // Closing line
                        $this->Cell(array_sum($w),0,'','T');
                    }
                }

                $fpdf = new PDF();
                $fpdf->AliasNbPages();
                $fpdf->AddPage();
                $fpdf->SetFont('Arial', 'B', 24);
                $str = "--------------------------RECEIPT--------------------------"."\n";
                $fpdf->Write(10,$str);
                $fpdf->SetFont('Arial', '', 15);
                $str = "Receipt Number: ".$last_id ."\n"."Customer: ". $name ."\n\n";
                $fpdf->Write(10,$str);
                $str = "Address: ". $address . "\nPhone Number: " . $phone. "\nEmail: ". $email ."\nTotal: $".$total_price.
                "\n\n----------------------------------------------------------------------------------------------------------\n";
                $fpdf->Write(10,$str);
                $header = array('Product Name', 'Unit Price', 'Quantity', 'Total');
                $data = array();
                foreach($_SESSION['cart'] as $key=>$value){
                    $item[]=$key;
                }
                $str=implode(",",$item);
                $sql2="SELECT * FROM PRODUCTS WHERE id in ($str)";
                $query = mysqli_query($connect, $sql2); 
                while($row = mysqli_fetch_assoc($query)) {
                    $str = $row['productname'].";"."$".$row['price'].";".$_SESSION['cart'][$row['id']].";$".$_SESSION['cart'][$row['id']]*$row['price'];
                    $data[] = explode(";",$str);
                }
                $fpdf->FancyTable($header,$data);
                $mail = new PHPMailer();
                $mail->isSMTP();// Send using SMTP
                $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth   = true; // Enable SMTP authentication
                $mail->Username   = 'thunguyet8e@gmail.com'; // SMTP username
                $mail->Password   = 'lhsnssxerkkqhpfx'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                $mail->setFrom('thunguyet8e@gmail.com', 'LIQUORSTORE');
                $mail->AddAddress($email, $name);
               
                $doc = $fpdf->Output('S');
                $mail->AddStringAttachment($doc, 'hoadonliquorstore.pdf', 'base64', 'application/pdf');

                $mail->isHTML(true);
                $mail->Subject = "Thank you for ordering from Liquorstore!";
                $mail->Body = "Thank you for ordering from Liquorstore. Here is your receipt. \n We will update your receipt status for you through this email address. \n";
                $mail->AltBody = 'Thank you for ordering from Liquorstore. Here is your receipt. \n We will update your receipt status for you through this email address. \n';
                if(!$mail->Send())
                {
                echo "Mail could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
                exit;
                }
                
                echo "Mail has been sent";
            } 
            
        }else{
            echo "Ban chua nhap du thong tin, vui long nhap day du!";
        }      
        }else{
            echo "Vui long dang nhap de thanh toan";
        }
    }
?>