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

    public function make_table($data){

        foreach($data as $key => $row){
            foreach($row as $rowkey => $value){
                if($key == 0){
                    $row[$rowkey] = "<th>".trim($value)."</th>";
                }else{
                    $row[$rowkey] = "<td>".trim($value)."</th>";
                }
            }
            $row = implode("\n", $row);
            $row = "<tr>".$row."</tr>";
            $data[$key] = $row;
        }

        $table = implode("\n", $data);
        $table = "<table class=\"table table-striped\">".$table."</table>";
        return $table;
    }

    public function start($filename){
        $data = $this->read_csv($filename);
        return $header = $this->make_table($data);

    }

}


$parsecsv = new parsecsv();
echo "<pre>";
$html = $parsecsv->start("us-50.csv");
print_r($html);
?>