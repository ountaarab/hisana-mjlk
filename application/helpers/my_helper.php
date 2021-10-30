<?php

if (!function_exists('csvToJson')) {
    function csvToJson($fname)
    {
        if (!($fp = fopen($fname, 'r'))) {
            die("Can't open file...");
        }

        //read csv headers
        $key = fgetcsv($fp, "1024", ",");

        // parse csv rows into array
        $json = array();
        while ($row = fgetcsv($fp, "1024", ",")) {
            $json[] = array_combine($key, $row);
        }

        // release file handle
        fclose($fp);

        // encode array to json
        return $json;
    }
}


if (!function_exists('en_crypt')) {
    function get_notif_wd()
    {
        $CI = &get_instance();
        $sql = "SELECT id FROM v_dataset where publish = '0' AND status = '1'";

        $query = $CI->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->num_rows();
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('en_crypt')) {
    function get_notif_opd($id_opd = null)
    {
        $CI = &get_instance();
        $sql = "SELECT id FROM v_dataset where publish = '-1' AND status = '1' AND id_opd = '" . $id_opd . "'";

        $query = $CI->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->num_rows();
        } else {
            $result = 0;
        }
        return $result;
    }
}
if (!function_exists('en_crypt')) {
    function en_crypt($string)
    {
        $output = false;
        /*
        * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
         Develop by : Fazri Ramadhan
        Email : fazri.rramadhanh@gmail.com
        */
        $security       = parse_ini_file("security.ini");
        $secret_key     = $security["encryption_key"];
        $secret_iv      = $security["iv"];
        $encrypt_method = $security["encryption_mechanism"];

        // hash
        $key    = hash("sha256", $secret_key);

        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv     = substr(hash("sha256", $secret_iv), 0, 16);

        //do the encryption given text/string/number
        $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        return $output;
    }
}


if (!function_exists('de_crypt')) {
    function de_crypt($string)
    {

        $output = false;
        /*
        * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
         Develop by : Fazri Ramadhan
        Email : fazri.rramadhanh@gmail.com
        */

        $security       = parse_ini_file("security.ini");
        $secret_key     = $security["encryption_key"];
        $secret_iv      = $security["iv"];
        $encrypt_method = $security["encryption_mechanism"];

        // hash
        $key    = hash("sha256", $secret_key);

        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash("sha256", $secret_iv), 0, 16);

        //do the decryption given text/string/number

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
}
