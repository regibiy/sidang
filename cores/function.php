<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($emailReceiver, $nameReceiver, $title, $content)
{
    $emailSender = "noreply@puskesmasalianyangpnk.site";
    $senderName = "Puskesmas Alianyang";
    
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;                                      
        $mail->isSMTP();                                            
        $mail->Host       = 'puskesmasalianyangpnk.site';                     
        $mail->SMTPAuth   = true;                                
        $mail->Username   = $emailSender;                        
        $mail->Password   = "ikn9pKI,DGh&";                
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
        $mail->Port       = 465;                            

        $mail->setFrom($emailSender, $senderName);
        $mail->addAddress($emailReceiver, $nameReceiver);          

        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function sendMailAdmin($emailReceiver, $nameReceiver, $title, $content)
{
    $emailSender = "noreply@puskesmasalianyangpnk.site";
    $senderName = "Puskesmas Alianyang";
    
    require '../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;                                      
        $mail->isSMTP();                                            
        $mail->Host       = 'puskesmasalianyangpnk.site';                     
        $mail->SMTPAuth   = true;                                
        $mail->Username   = $emailSender;                        
        $mail->Password   = "ikn9pKI,DGh&";                
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
        $mail->Port       = 465;                            

        $mail->setFrom($emailSender, $senderName);
        $mail->addAddress($emailReceiver, $nameReceiver);          

        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


date_default_timezone_set("Asia/Jakarta");

$jam = (date('H:i'));
$jam_sekarang = strtotime($jam);

$hari = date('Y-m-d');
$hari_ini = date('N', strtotime($hari));
if ($hari_ini >= 1 && $hari_ini <= 4) {
    $invalid = "11:30";
    $jam_invalid = strtotime($invalid);
} else {
    $invalid = "09:30";
    $jam_invalid = strtotime($invalid);
}

if ($jam_sekarang > $jam_invalid) {
    $sql = "UPDATE pendaftaran SET status_pendaftaran = 'Invalid' WHERE tanggal_berobat = CURRENT_DATE AND (status_pendaftaran = 'Menunggu' OR status_pendaftaran = 'Ditunda')";
    $result = $conn->query($sql);
}

function check_status_login_pasien()
{
    if (isset($_SESSION['status_login_pasien'])) return true;
    else return false;
}

function check_status_login_admin()
{
    if (isset($_SESSION['status_login_admin'])) return true;
    else return false;
}

function format_date($tanggal)
{
    $formatted_date = date_create($tanggal);
    return date_format($formatted_date, "d-m-Y");
}

function upload_file($file_name, $file_size, $temp_location, $target_location)
{
    $valid_ext = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, $valid_ext)) return false;
    else {
        if ($file_size > 3000000) return false;
        else {
            $new_file_name = uniqid() . "." . $ext;
            move_uploaded_file($temp_location, $target_location . $new_file_name);
            return $new_file_name;
        }
    }
}

function get_total($column_name, $table_name)
{
    global $conn;
    $sql = "SELECT COUNT($column_name) as total FROM $table_name";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    return $data;
}

function get_data($table_name)
{
    global $conn;
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    return $result;
}

function generate_queue_number($treatment_date)
{
    global $conn;
    $sql = "SELECT MAX(nomor_antrian) as nomor_antrian FROM pendaftaran WHERE tanggal_berobat = '$treatment_date'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    if ($data['nomor_antrian'] === NULL) {
        $number = 1;
        if ($number < 10) $leading_zero = "000";
        elseif ($number > 9) $leading_zero = "00";
        elseif ($number > 99) $leading_zero = "0";
        $queue_number = "O" . $leading_zero . $number;
    } else {
        $queue_number = $data['nomor_antrian'];
        $number = substr($queue_number, 1, 4);
        $number = $number + 1;
        if ($number < 10) $leading_zero = "000";
        elseif ($number > 9) $leading_zero = "00";
        elseif ($number > 99) $leading_zero = "0";
        $queue_number = "O" . $leading_zero . $number;
    }
    return $queue_number;
}

function validate_wa($target)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/validate',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'countryCode' => '62'
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: dMat+G20JoaBuZFj!oU#'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function send_wa($target, $pesan)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'message' => $pesan,
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: dMat+G20JoaBuZFj!oU#'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

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

function toaster_message()
{
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", () => {';
    echo 'let toast = new bootstrap.Toast(document.getElementById("liveToast"));'; // Inisialisasi toast
    echo 'toast.show();'; // Tampilkan toast
    echo '});';
    echo '</script>';
    unset($_SESSION['toaster']);
}
