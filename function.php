<?php

class Person {
    public $id=0;
    public $name;
    public $lastname;
    public $dateofbirthday;
    public $gender;
    public $city;

    function __construct($name,$lastname,$dateofbirthday,$gender,$city){
        $this->name = $name;
        $this->lastname = $lastname;
        $this->dateofbirthday = $dateofbirthday;
        $this->gender = $gender;
        $this->city = $city;
    }
    public function save_person($name,$lastname,$dateofbirthday,$gender,$city){
        
        $duplicate =file_get_contents('data.json');
        $json_data = json_decode($duplicate,TRUE);
        foreach($json_data as $item){
            if($name == $item["name"]){
            return 10;
            //This user already exist
            }
        }
        $last_item = end($json_data);
        $last_item_id = $last_item['id'];
        $last_item_id++;
        $new_user = array('id'=>$last_item_id,'name'=>$name,'lastname'=>$lastname,'dateofbirthday'=>$dateofbirthday,'gender'=>$gender,'city'=>$city);
        array_push($json_data,$new_user);
        $encode_data=json_encode($json_data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('data.json',$encode_data);
        
        return 1;
        //save successfull
       
        
        
    }
    public function read_data(){
        $index = 0;
        $data = file_get_contents('data.json');
        $data = json_decode($data);
        foreach($data as $row){
            echo"<tr>
                <td>$row->id</td>
                <td>$row->name</td>
                <td>$row->lastname</td>
                <td>$row->dateofbirthday</td>
                <td>$row->gender</td>
                <td>$row->city</td>
                <td>
                    <a href='delete.php?index=".$index."' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>";
            $index++;
        }
    }

    public function delete_data(){
        $index = $_GET['index'];
        $data = file_get_contents('data.json');
        $data = json_decode($data);
        unset($data[$index]);
        $data = json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('data.json',$data);
        header('location:index.php');  
    }

    static function convert_birth_to_age($dateofbirthday){
        $bday= new DateTime($dateofbirthday);
        $today = new DateTime(date('m.d.y'));
        if($bday>$today){
            echo 'you are not born yet';
        }
        $diff = $today->diff($bday);
        echo 'your age is : '.$diff->y.' year '.$diff->m.' months '.$diff->d.' days';
       
    }

    static function convert_binary_to_string($gender){
        $duplicate =file_get_contents('data.json');
        $json_data = json_decode($duplicate,TRUE);
        foreach($json_data as $item){

            if($item["gender"] =="0"){  

                return Person::$gender='male';

            }else{
    
                return Person::$gender = 'female';
            }
            
        }
        

    }

    public function format_person(){
        $group_male=[];
        $group_female=[];
        $duplicate =file_get_contents('data.json');
        $json_data = json_decode($duplicate,TRUE);
        foreach($json_data as $item){

            if($item["gender"] =="0"){  

                array_push($group_male,$item);

            }else{
    
                array_push($group_female,$item);
            }
            
        }
        echo"<pre>";
        var_dump($group_male);
        echo"</pre>";

        echo"<pre>";
        var_dump($group_female);
        echo"</pre>";
    }
}

?>