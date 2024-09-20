<?php
/*zoznam premenných
id - id zariadenia
eled - elektrická energia - impulzy - denný prúd
elen - elektrická energia - impulzy - nočný prúd
pln - zemný plyn - impulzy
vod - voda - impulzy
tepvn - vonkajšia teplota
link: http://energia.lacomp.sk/data.php?id=AAA&eled=BBB&elen=CCC&pln=DDD&vod=EEE&tepvn=FFF
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

//SKUSOBNA
/*
if (empty ($_GET)) exit("Nic sa neposlalo");

use Illuminate\Support\Facades\Log;

// Ak chceš logovať aj URI
$logUri = substr($_SERVER["REQUEST_URI"], 0, 200);
Log::info('Žiadosť URI: ' . $logUri);


$log = "Testovací zápis: " . date("d.m.Y H:i:s") . "\n";
$file = fopen(storage_path('logs/custom_log.txt'), 'a');
if (!$file) {
    echo "Nepodarilo sa otvoriť súbor custom_log.txt";
    exit;
}
fwrite($file, $log . " " . $logUri);
fclose($file);
echo "Zápis bol úspešný.";


//kontrola na id zakaznika
/*
$file = fopen("log.txt", "a");
$riadok = ";Nebolo poslane id zakaznika." . "\n";
fwrite($file, $riadok);
fclose($file);
exit("Nebolo poslane id zakaznika.");
*/
//kontrola ak nie je poslany aspon jeden parameter
$pocitadlo = 0;
if (isset($_GET['eled'])) $pocitadlo++;
if (isset($_GET['elen'])) $pocitadlo++;
if (isset($_GET['pln'])) $pocitadlo++;
if (isset($_GET['vod'])) $pocitadlo++;
if (isset($_GET['tepvn'])) $pocitadlo++;

//ziskanie udajov z GET, neposlane parametre dostanu 0
//$vstup["id"] = htmlspecialchars($_GET['id'], ENT_QUOTES, "UTF-8");
if (isset($_GET['eled'])) {
    $vstup["eled"] = htmlspecialchars($_GET['eled'], ENT_QUOTES, "UTF-8");
} else {
    $vstup["eled"] = 0;
}
if (isset($_GET['elen'])) {
    $vstup["elen"] = htmlspecialchars($_GET['elen'], ENT_QUOTES, "UTF-8");
} else {
    $vstup["elen"] = 0;
}
if (isset($_GET['pln'])) {
    $vstup["pln"] = htmlspecialchars($_GET['pln'], ENT_QUOTES, "UTF-8");
} else {
    $vstup["pln"] = 0;
}
if (isset($_GET['vod'])) {
    $vstup["vod"] = htmlspecialchars($_GET['vod'], ENT_QUOTES, "UTF-8");
} else {
    $vstup["vod"] = 0;
}
if (isset($_GET['tepvn'])) {
    $vstup["tepvn"] = htmlspecialchars($_GET['tepvn'], ENT_QUOTES, "UTF-8");
} else {
    $vstup["tepvn"] = 0;
}

//kontrola na regularne vyrazy
$error = 0;
//if (!preg_match("/^[a-zA-Z0-9]+$/", $vstup["id"])) $error = 1;
if (!preg_match("/^[0-9]+$/", $vstup["eled"])) $error = 1;
if (!preg_match("/^[0-9]+$/", $vstup["elen"])) $error = 1;
if (!preg_match("/^[0-9]+$/", $vstup["pln"])) $error = 1;
if (!preg_match("/^[0-9]+$/", $vstup["vod"])) $error = 1;
if (!preg_match("/^-?[0-9]+$/", $vstup["tepvn"])) $error = 1;

if ($error == 1) {
    $file = fopen("log.txt", "a");
    $riadok = ";Vstup nepresiel kontrolou regularnych vyrazov." . "\n";
    fwrite($file, $riadok);
    fclose($file);
    exit("Vstup nepresiel kontrolou regularnych vyrazov.");
}
//zapis do mysql
/*
else
{
    include "grafy/pripojenie.php";
    if (!$db)
    {
        $file = fopen("l0g/log.txt","a");
        $riadok = ";Chyba pristupu do databazy - ".mysql_error()."\n";
        fwrite($file,$riadok);
        fclose($file);
        exit("Ups, stalo sa nieco nepekne :-( - " . mysql_error());
    }

    $queryString = array();
    foreach ($_GET as $key => $value) {
        $queryString[] = $key . '=' . $value;
    }
    $queryString = implode(', ', $queryString);
    $queryString = htmlspecialchars($queryString);

    $query = "INSERT INTO udaje (id_zakaznik, eled, elen, pln, vod, tepvn, data_all) VALUES ('".$vstup["id"]."',".$vstup["eled"].",".$vstup["elen"].",".$vstup["pln"].",".$vstup["vod"].",".$vstup["tepvn"].", '".$queryString."')";
    $result = mysql_query($query);
    //zapis do logu
    if ($result)
    {
        $file = fopen("l0g/log.txt","a");
        $riadok = ";OK" . "\n";
        fwrite($file,$riadok);
        fclose($file);
        echo $result." - zapis do db.";
    }
    else
    {
        $file = fopen("l0g/log.txt","a");
        $riadok = ";Zapis do tabulky neuspesny - ".mysql_error()."\n";
        fwrite($file,$riadok);
        fclose($file);
        echo $riadok;
        echo "<br>";
        echo $query;
    }
    mysql_close($db);
}

require 'data_new.php';
?>
