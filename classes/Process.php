<?php 
      $filepath = realpath(dirname(__FILE__));
      include_once ($filepath.'/../lib/Database.php');
      include_once ($filepath.'/../helpers/Format.php');
      include_once ($filepath.'/../lib/Session.php');
      
class Process{

    public $db;
    public $fm;
    
    //constructor function
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    //process_data
    public function process_data($data){
        $selected_ans = $this->fm->validation($data['ans']);
        $number = $this->fm->validation($data['number']);
        $next = $number + 1;

        //set the score session
        if(!isset($_Session['score'])){
            $_Session['score'] = 0;
        }
        
        //get total question
        $total = $this->get_total();

        //right ans id
        $right = $this->right_ans($number);

        if($right == $selected_ans){
            $_Session['score']++;
        }

        //redirect after all submission
        if($number == $total){
            header('Location: final.php');
            exit();
        }else{
            header("Location: test.php?q=".$next);
        }

    }

    //get total question
    private function get_total(){
        $sql = "SELECT * FROM tbl_question";
        $result = $this->db->select($sql);

        $total = $result->num_rows;
        return $total;
    }


    //get the right answer based on question no
    private function right_ans($number){
        $sql = "SELECT * FROM tbl_answer WHERE question_no = '$number' AND correct_ans = '1'";
        $result = $this->db->select($sql);
        if($result){
            $id = $result->fetch_assoc();
            return $id["id"];
        }
    }
}

?>