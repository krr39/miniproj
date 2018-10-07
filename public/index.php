<?php
class parsecsv{
    function read_csv($filename){
        $data = file_get_contents($filename);
        $data = explode("\r\n", $data);
        $data = array_filter($data);

        foreach($data as $key => $d){
            $d = str_getcsv ($d, ",", '"' , "\\");
            $data[$key] = $d;
        }

        return $data;
    }

    public function start($filename){
        return $this->read_csv($filename);
    }

}


$parsecsv = new parsecsv();
echo "<pre>";
$html = $parsecsv->start("us-50.csv");
print_r($html);
?>