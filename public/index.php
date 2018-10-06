<?php
echo 'test123';
/**
 * Created by PhpStorm.
 * User: krutika
 * Date: 10/6/18
 * Time: 12:27 AM
 */
main::start("example.csv");
class main{
    static public function start($filename)
    {
        $records=csv::getRecords($filename);
        //$record= recordFactory::create();
        //print_r($records);

    }
}

class csv{
    static public function getRecords($filename){
        $file=fopen($filename,"r");
        $fieldNames=array();
        $count=0;
        while(! feof($file))
        {
            $record= fgetcsv($file);
            if($count == 0)
            {
                $fieldNames[]=$record;
            }
            else{
                $records[]=recordFactory::create($fieldNames, $record);
            }
            $count++;

        }
        fclose($file);
        return $records;

    }
}
class record{
    public function _construct(Array $fieldNames=null,$values =  null)
    {

                $record= array_combine($fieldNames,$values);
        print_r($record);
        $this->createProperty();

    }
    public function createProperty($name='First',$value='Krutika')
    {
        $this->{$name} = $value;
    }

}
class recordFactory{

    public static function create(Array $fieldNames=null,Array $values = null){

        $record=new record($fieldNames,$values);

        return $record;
}

}

class html{}
