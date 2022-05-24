<?php

class Database extends PDO {

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
        parent::query("SET NAMES 'utf8'");
    }

    public function insert($table, $data) {
        ksort($data);
        $fieldName = NULL;
        $fieldValues = NULL;

        foreach ($data as $key => $value) {
            $fieldName .= $key . " = :" . $key . ", ";
        }

        foreach ($data as $key => $value) {
            $fieldValues[$key] = $value;
        }

        $fieldName = rtrim($fieldName, ", ");
        $sth = $this->prepare("INSERT INTO " . $table . " SET " . $fieldName . "");
        $nas = $sth->execute($fieldValues);

        if ($nas) {
            return TRUE;
        }

        return FALSE;
    }

    public function update($table, $data, $where) {
        ksort($data);
        $fieldName = NULL;
        $fieldValues = NULL;

        foreach ($data as $key => $value) {
            $fieldName .= $key . " = :" . $key . ", ";
        }

        foreach ($data as $key => $value) {
            $fieldValues[$key] = $value;
        }

        $fieldName = rtrim($fieldName, ", ");
        $sth = $this->prepare("UPDATE " . $table . " SET " . $fieldName . " WHERE " . $where . "");
        $nas = $sth->execute($fieldValues);

        if ($nas) {
            return TRUE;
        }

        return FALSE;
    }

    public function update_all($table, $data) {
        ksort($data);
        $fieldName = NULL;
        $fieldValues = NULL;

        foreach ($data as $key => $value) {
            $fieldName .= $key . " = :" . $key . ", ";
        }

        foreach ($data as $key => $value) {
            $fieldValues[$key] = $value;
        }

        $fieldName = rtrim($fieldName, ", ");
        $sth = $this->prepare("UPDATE " . $table . " SET " . $fieldName . "");
        $nas = $sth->execute($fieldValues);

        if ($nas) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete($table, $id) {
        $sth = $this->prepare("DELETE FROM " . $table . " WHERE id = :id");
        $array["id"] = $id;
        $nas = $sth->execute($array);

        if ($nas) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete_if($table, $data) {
        $sorgu = NULL;
        foreach ($data as $key => $value) {
            $bol = explode("@", $value);
            $sart = $bol[0];
            $sorgu .= $key . " " . $sart . " :" . $key . ", ";
        }
        foreach ($data as $key => $value) {
            $bol_2 = explode("@", $value);
            $val = $bol_2[1];
            $fieldValues[$key] = $val;
        }
        $sorgu = rtrim($sorgu, ", ");
        $sth = $this->prepare("DELETE FROM " . $table . " WHERE " . $sorgu);
        $nas = $sth->execute($fieldValues);

        if ($nas) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete_where($table, $where) {
        $nas = $this->query("DELETE FROM " . $table . " WHERE " . $where);
        if ($nas) {
            return TRUE;
        }

        return FALSE;
    }

    public function control($table, $data) {
        ksort($data);
        $fieldName = NULL;
        $fieldValues = NULL;

        foreach ($data as $key => $value) {
            if (isset($value[0])) {
                if ($value[0] == "!") {
                    $orta = "!=";
                } else {
                    $orta = "=";
                }
            }
            $fieldName .= $key . " " . $orta . " :" . $key . " AND ";
        }
        foreach ($data as $key => $value) {
            $value = str_replace("!=", "", $value);
            $fieldValues[":" . $key] = $value;
        }
        $fieldName = rtrim($fieldName, " AND");
        $sth = $this->prepare("SELECT * FROM " . $table . " WHERE " . $fieldName . "");
        $sth->execute($fieldValues);
        return $sth->rowCount();
    }

    public function liste($tablo, $order, $by, $where = false) {
        return $this->query("SELECT * FROM " . $tablo . " " . $where . " ORDER BY " . $order . " " . $by . "")->fetchAll();
    }

    public function genel_liste($tablo, $order, $by, $where = false) {
        $sth = $this->query("SELECT * FROM " . $tablo . " " . $where . " ORDER BY " . $order . " " . $by . "");
        return $sth->fetchAll();
    }

    public function veri_say($tablo, $where = false) {
        $liste = $this->query("SELECT COUNT(*) FROM " . $tablo . " " . $where . "");
        return $liste->fetchColumn();
    }

    public function select_if($tablo, $alan = "id", $where = 1) {
        return $this->query("SELECT * FROM " . $tablo . " WHERE " . $alan . " = '" . $where . "'")->fetch(PDO::FETCH_ASSOC);
    }

    public function tek_veri($tablo, $where = FALSE) {
        if ($where == TRUE) {
            $sql = "SELECT * FROM " . $tablo . " " . $where . "";
        } else {
            $sql = "SELECT * FROM " . $tablo;
        }
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function list_tables() {
        $get_all_table_query = "SHOW TABLES";
        $sth = $this->prepare($get_all_table_query);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function show_create_tables($tables) {
        $outpput = '';
        foreach ($tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $sth = $this->prepare($show_table_query);
            $sth->execute();
            $result = $sth->fetchAll();

            foreach ($result as $show_table_row) {
                $outpput .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }

            $select_query = "SELECT * FROM " . $table . "";
            $statement = $this->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for ($count = 0; $count < $total_row; $count++) {
                $single_result = $statement->fetch(PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);

                $outpput .= "\nINSERT INTO $table (";
                $outpput .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $outpput .= "'" . implode("', '", $table_value_array) . "');\n";
            }
        }

        $file_name = "Yedek_" . date("y-m-d") . ".sql";
        $file_handle = fopen($file_name, "w+");
        fwrite($file_handle, $outpput);
        fclose($file_handle);

        header('Content-Description File Transfer');
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }

    function kolon_ekle($table, $alan, $tip = "VARCHAR(255)", $yer = "AFTER", $deger = "id") {
        $sth = $this->prepare("ALTER TABLE `" . $table . "` ADD `" . $alan . "` " . $tip . " NOT NULL " . $yer . " `" . $deger . "`;");
        $sth->execute();
    }

    function kolon_duzenle($table, $alan_1, $alan_2, $tip = "VARCHAR(255)") {
        $sth = $this->prepare("ALTER TABLE `" . $table . "` CHANGE `" . $alan_1 . "` `" . $alan_2 . "` " . $tip . " CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
        $sth->execute();
    }

    function kolon_sil($table, $alan) {
        $sth = $this->prepare("ALTER TABLE `" . $table . "` DROP `" . $alan . "`;");
        $sth->execute();
    }

    function auto_increment($tablo) {
        $sth = $this->query("SHOW TABLE STATUS LIKE '" . $tablo . "'")->fetch(PDO::FETCH_ASSOC);
        return $sth['Auto_increment'];
    }

    function where_in($table, $id, $bol = FALSE) {
        if ($bol != FALSE) {
            $array = explode(",", $bol);
            foreach ($array as $val) {
                $data[] = "'" . $val . "'";
            }
        }
        $cikti = rtrim(implode(",", $data), ",");

        $query = "SELECT * FROM " . $table . " WHERE " . $id . " IN (" . $cikti . ")";
        $statement = $this->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

}
