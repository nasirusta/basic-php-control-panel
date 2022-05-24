<?php

class api extends Controller
{

    function __construct()
    {
        parent::__construct();
        // parent::Login_Control();
        header('Access-Control-Allow-Origin: *');
    }

    function index()
    {
        $list = $this->genel_liste(
            "content",
            "sort",
            "ASC",
            "WHERE kategori != 242 AND kategori != 248 AND kategori != 250 AND kategori != 252 AND kategori != 254 AND kategori != 256 AND kategori != 258 AND lang = 'tr'"
        );
        $array = [];
        foreach ($list as $x => $row) {
            $array[$x]["id"] = (int) $row["id"];
            $array[$x]["url"] = $row["url"];
            $array[$x]["baslik"] = $row["baslik"];
            $array[$x]["icerik"] = $row["icerik"];
            $array[$x]["kategori"] = (int) $row["kategori"];
            $array[$x]["resim"] = $row["resim"];
        }
        echo json_encode($array);
    }

    function single_post($url)
    {
        $row = $this->model->tek_veri("content", "WHERE url = '" . $url . "'");

        $x = 0;
        $array[$x]["id"] = (int) $row["id"];
        $array[$x]["url"] = $row["url"];
        $array[$x]["baslik"] = $row["baslik"];
        $array[$x]["icerik"] = $row["icerik"];
        $array[$x]["kategori"] = (int) $row["kategori"];
        $array[$x]["resim"] = $row["resim"];
        echo json_encode($array);
    }

    function writers()
    {
        $list = $this->genel_liste(
            "kategoriler",
            "sort",
            "ASC",
            "WHERE parent = 262 AND lang = 'tr'"
        );
        $array = [];
        foreach ($list as $x => $row) {
            $text = [];
            $lastText = $this->model->tek_veri("content", "WHERE kategori = " . $row["id"] . " AND lang='tr' ORDER BY id DESC LIMIT 1");

            $text[0]["url"] = $lastText["url"];
            $text[0]["baslik"] = $lastText["baslik"];

            $array[$x]["id"] = (int) $row["id"];
            $array[$x]["url"] = $row["url"];
            $array[$x]["yazar"] = $row["baslik"];
            $array[$x]["resim"] = $row["resim"];
            $array[$x]["data"] = $text;
        }
        echo json_encode($array);
    }

    function yazar($url)
    {
        $row = $this->model->tek_veri("kategoriler", "WHERE url = '" . $url . "'");

        $x = 0;
        $array[$x]["id"] = (int) $row["id"];
        $array[$x]["url"] = $row["url"];
        $array[$x]["baslik"] = $row["baslik"];
        $array[$x]["resim"] = $row["resim"];
        echo json_encode($array);
    }
}
