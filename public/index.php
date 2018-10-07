<?php
class parsecsv{

    public function read_csv($filename){
        $data = file_get_contents($filename);
        $data = explode("\r\n", $data);
        $data = array_filter($data);

        foreach($data as $key => $d){
            $d = str_getcsv ($d, ",", '"' , "\\");
            $data[$key] = $d;
        }

        return $data;
    }

    public function get_header($data){
        $header = $data[0];
        foreach($header as $key => $h){
            $header[$key] = "<th>".trim($h)."</th>";
        }
        $header = implode("\n", $header);
        $header = "<tr>".$header."</tr>";

        return $header;
    }

    public function start($filename){
        $data = $this->read_csv($filename);
        return $header = $this->get_header($data);
    }

}


$parsecsv = new parsecsv();
echo "<pre>";
$html = $parsecsv->start("csvTable.csv");
print_r($html);
?>