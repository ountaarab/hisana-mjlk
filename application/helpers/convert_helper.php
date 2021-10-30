<?php
function csv2Json($fname)
{
    if (!file_exists($fname)) {
        return null;
    }
    try {
        //code...
        if (!($fp = fopen($fname, 'r'))) {
            die("Can't open file...");
        }

        //read csv headers
        $key = fgetcsv($fp, "1024", ",");
        $count_header = count($key);
        // parse csv rows into array
        $json = array();
        while ($row = fgetcsv($fp, "1024", ",")) {
            $count_nilai = count($row);
            if ($count_header === $count_nilai)
                $json[] = array_combine($key, $row);
        }

        // release file handle
        fclose($fp);

        // encode array to json
        return $json;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function date_indo($tgl)
{
    $ubah = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
