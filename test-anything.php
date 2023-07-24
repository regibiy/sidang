<input type="text" maxlength="6" id="inputsatu">
<br>
<input type="text" maxlength="10" id="inputdua" value="2023">

<script>
    const inputsatu = document.getElementById("inputsatu");
    const inputdua = document.getElementById("inputdua");
    let valueDua = inputdua.value;
    let a, hasilGabung;
    inputsatu.addEventListener("input", () => {
        a = inputsatu.value;
        hasilGabung = valueDua + a.substring(1, 6);
        inputdua.value = hasilGabung;
    })
</script>


<!-- <div style="display:flex;justify-content:center;align-items:center;">
    <a href='https://puskesmasalianyangpnk.site' style='text-decoration:none;
color:white;
padding:0.5rem;
background-color:blue;
width:150px;
border-radius:6px'>
        Verifikasi Email Anda</a>
</div> -->
<?php
include("action.php");

$content = "
Hai, Regi Ridho Biyantomo<br><br><br>
Terima kasih telah melakukan pendaftaran di UPT Puskesmas Alianyang. Agar proses pendaftaran akun Anda dapat diproses oleh petugas kami.
Silakan klik tombol Verifikasi Email di bawah ini untuk memverifikasi bahwa benar ini adalah Anda.
<br><br><br>
<a href='https://puskesmasalianyangpnk.site' style='text-decoration:none;color:white;padding:0.5rem;background-color:blue;width:100px;'>Verifikasi Email Anda</a>
";

// sendMail("regibiyantomo123@gmail.com", "regi", "test", $content);

// $tanggal = "2023-06-29";

// function cek_libur_nasional($tanggal)
// {
//     $timestamp = strtotime($tanggal);
//     $month = date('n', $timestamp); //ambil bulan tanpa leading zero
//     $default_date = date("Y-m-j", $timestamp); //ambil hari tanpa leading zero
//     $url = "https://api-harilibur.vercel.app/api?month=$month";
//     $curl = curl_init();
//     curl_setopt($curl, CURLOPT_URL, $url);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //return string
//     try {
//         $data = curl_exec($curl);
//         if ($data === false) {
//             throw new Exception(curl_error($curl));
//         }
//         $array_data = json_decode($data);
//         foreach ($array_data as $value) {
//             if ($default_date === $value->holiday_date) {
//                 $national_holiday = $value->holiday_name;
//                 return $national_holiday;
//             }
//         }
//     } catch (Exception $e) {
//         echo 'Error: ' . $e->getMessage();
//         die;
//     }
//     curl_close($curl);
// }

// $hai = cek_libur_nasional($tanggal);
// var_dump($hai);
// die;

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