<?php

$tanggal = "2023-06-29";

function cek_libur_nasional($tanggal)
{
    $timestamp = strtotime($tanggal);
    $month = date('n', $timestamp); //ambil bulan tanpa leading zero
    $default_date = date("Y-m-j", $timestamp); //ambil hari tanpa leading zero
    $url = "https://api-harilibur.vercel.app/api?month=$month";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //return string
    try {
        $data = curl_exec($curl);
        if ($data === false) {
            throw new Exception(curl_error($curl));
        }
        $array_data = json_decode($data);
        foreach($array_data as $value) {
            if ($default_date === $value->holiday_date) {
                $national_holiday = $value->holiday_name;
                return $national_holiday;
            }
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        die;
    }
    curl_close($curl);
}

$hai = cek_libur_nasional($tanggal);
var_dump($hai);
die;

// ----

// $url = "https://api-harilibur.vercel.app/api?month=6";

// $curl = curl_init();
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// try {
//   $data = curl_exec($curl);
//   if ($data === false) {
//     throw new Exception(curl_error($curl));
//   }
  
//   $array_data = json_decode($data);
// //   var_dump($array_data[0]->holiday_date);
// //   die;
//   foreach($array_data as $value) {
//       if ($tanggal === $value->holiday_date) echo $value->holiday_name;
//       else "gass terus";
//   }
// } catch (Exception $e) {
//   echo 'Error: ' . $e->getMessage();
//   die;
// }

// curl_close($curl);

// -----

// include("crypt.php");

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// function sendMail($emailReceiver, $nameReceiver, $title, $content)
// {
//     $emailSender = "noreply@puskesmasalianyangpnk.my.id";
//     $senderName = "Puskesmas Alianyang";
    
//     require 'vendor/autoload.php';

//     $mail = new PHPMailer(true);

//     try {
//         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                      
//         $mail->isSMTP();                                            
//         $mail->Host       = 'puskesmasalianyangpnk.my.id';              
//         $mail->SMTPAuth   = true;                                
//         $mail->Username   = $emailSender;                        
//         $mail->Password   = "okMgx%M5sE6N";                
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
//         $mail->Port       = 465;                            

//         $mail->setFrom($emailSender, $senderName);
//         $mail->addAddress($emailReceiver, $nameReceiver);          

//         $mail->isHTML(true);
//         $mail->Subject = $title;
//         $mail->Body    = $content;

//         $mail->send();
//         echo 'Message has been sent';
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
// }


// $email = "regibiyantomo123@gmail.com";
// $nama_lengkap = "regi";
// $title = "hai";
// $content = "haha";
// sendMail($email, $nama_lengkap, $title, $content);

// -----

// function cek_libur_nasional($tanggal)
// {
//     $timestamp = strtotime($tanggal);
//     $month = date('n', $timestamp); //ambil bulan tanpa leading zero
//     $default_date = date("Y-m-j", $timestamp); //ambil hari tanpa leading zero
//     $url = "https://api-harilibur.vercel.app/api?month=$month";
//     $data = file_get_contents($url);
//     $arrayData = json_decode($data, true);
//     foreach ($arrayData as $value) {
//         if ($default_date === $value['holiday_date']) {
//             $national_holiday = $value['holiday_name'];
//             return $national_holiday;
//         }
//     }
// }


// $hasil = cek_libur_nasional(2023-07-19);
// echo "hari ini $hasil";