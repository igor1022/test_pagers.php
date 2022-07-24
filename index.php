<?php

class CSV {

    private $_csv_file = null;
    private $str = null;

    public function __construct($csv_file) {
        if (file_exists($csv_file)) {
            $this->_csv_file = $csv_file;
        }
        else {
            throw new Exception("Файл \"$csv_file\" не найден");
        }
    }

    public function setCSV(Array $csv) {

        $handle = fopen($this->_csv_file, "a");

        foreach ($csv as $value) {
            fputcsv($handle, explode(";", $value), ";");
        }
        fclose($handle);
    }

    public function getCSV() {
        $handle = fopen($this->_csv_file, "r"); //Открываем csv для чтения

        $array_line_full = array();
        while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {
            $array_line_full[] = $line;
        }
        fclose($handle);
        return $array_line_full;
    }

}

try {
    $csv = new CSV("users-1.csv");
    /**
     * Чтение из CSV  (и вывод на экран в красивом виде)
     */
    echo "<h2>CSV до записи:</h2>";
    $get_csv = $csv->getCSV();
    foreach ($get_csv as $value) {
        echo "ID: " . $value[0] . "<br/>";
        echo "Name: " . $value[1] . "<br/>";
        echo "Age: " . $value[2] . "<br/>";
        echo "Email: " . $value[3] . "<br/>";
        echo "Phone: " . $value[4] . "<br/>";
        echo "Gender: " . $value[5] . "<br/>";
        echo "--------<br/>";
    }

    $arr = array($str);
    $csv->setCSV($arr);
}
catch (Exception $e) { //Если csv файл не существует, выводим сообщение
    echo "Fail " . $e->getMessage();
}
?>