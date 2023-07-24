<?php

function encrypt($data)
{
    //return random numbers using aes-128-cbc algorithm
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
    //encrypt data
    //OPEN_SSL_RAW_DATA adalah mode pemrosesan data
    $ciphertext = openssl_encrypt($data, 'aes-128-cbc', 'sensitive_data', OPENSSL_RAW_DATA, $iv);
    // join between iv and chipper text
    $encrypted = $iv . $ciphertext;
    //convert binner data to ASCII
    return base64_encode($encrypted);
}

function decrypt($ciphertext)
{
    //convert ASCII to binner. $chipertext berisi iv dan chipertext
    $ciphertext = base64_decode($ciphertext);
    //split iv and chipper text, $iv berisi data biner IV untuk dekripsi data
    $iv = substr($ciphertext, 0, openssl_cipher_iv_length('aes-128-cbc'));
    //berisi data biner chipertext (teks terenkripsi) unutk proses dekripsi
    $ciphertext = substr($ciphertext, openssl_cipher_iv_length('aes-128-cbc'));
    //decrypt data
    $data = openssl_decrypt($ciphertext, 'aes-128-cbc', 'sensitive_data', OPENSSL_RAW_DATA, $iv);
    if ($data === false) {
        if (isset($_SESSION['role'])) echo "<script>window.location='../error-page.php'</script>";
        else echo "<script>window.location='error-page.php'</script>";
        exit;
    } else {
        return $data;
    }
}
