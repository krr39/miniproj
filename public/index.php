<?php
class parsecsv{

    public function read_csv($filename){

        $data = file_get_contents($filename);
        $data = explode("\n", $data);
        $data = array_map('trim', $data);
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
                    $value = trim($value);
                    $value = str_replace("_", " ", $value);
                    $value = ucfirst($value);
                    $row[$rowkey] = "<th>".$value."</th>";
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

    public function get_html($table){
        $html = "<!DOCTYPE html>";
        $html .= "<html lang=\"en\">";
        $html .= "<head>";
        $html .= "<title>CSV Reader</title>";
        $html .= "<meta charset=\"utf-8\">";
        $html .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
        $html .= "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">";
        $html .= "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>";
        $html .= "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<div class=\"container\">";
        $html .= $table;
        $html .= "</div>";
        $html .= "</body>";

        return $html;
    }

    public function start($filename){
        $data = $this->read_csv($filename);
        $table = $this->make_table($data);
        $html = $this->get_html($table);
        return $html;
    }

}

$parsecsv = new parsecsv();
$html = $parsecsv->start("us-50.csv");
echo $html;
?>