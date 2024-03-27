<?php 


    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

class Exam{

    //some private property
    private $db;
    private $fm;
    //constructor function
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    //get all registered users
    public function get_all_questions(){
        $sql = "SELECT * FROM tbl_question";
        $result = $this->db->select($sql);
        if($result){
            return $result;
        }

    }


    //get question by id
    public function get_question_by_id($id){
        $sql = "SELECT * FROM tbl_question WHERE question_no = '$id'";
        $result = $this->db->select($sql);
        if($result){
            return $result;
        }
    }


    //get options by id
    public function get_options_by_id($id){
        $sql = "SELECT * FROM tbl_answer WHERE question_no = '$id'";
        $result = $this->db->select($sql);
        if($result){
            return $result;
        }
    }
    


     


        //delete user mechanism
        public function delete_question_by_id($id){

            $id = mysqli_real_escape_string($this->db->link, $id);
            $id = (int)$id;
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $tables = array("tbl_question","tbl_answer");

            //delete question and options
            foreach($tables as $table){
                $sql = "DELETE FROM $table WHERE question_no = '$id'";
                $result = $this->db->delete($sql);
            }
            
            
            if($result){
                $msg = "<span class='success'>Question deleted!</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Question not deleted!</span>";
                return $msg;
            }
        }



        //add new question mechanism
        public function add_new_question($data){

            //validate and sanitize question fields
            $question_no = (string)$data['question_no'];
            $question_no = mysqli_real_escape_string($this->db->link, $question_no);
            $question_no = $this->fm->validation($question_no);

            $question = $data['question'];
            $question = $this->fm->validation($question);

            //check question availability
            $check_question = $this->fm->check_question($question);
            if($check_question){
                $msg = "<span class='error'>Question Aleady Exists! Please add an unique one.</span>";
                return $msg;
            }

            $option1 = $data['option1'];
            $option1 = $this->fm->validation($option1);

            $option2 = $data['option2'];
            $option2 = $this->fm->validation($option2);

            $option3 = $data['option3'];
            $option3 = $this->fm->validation($option3);

            $option4 = $data['option4'];
            $option4 = $this->fm->validation($option4);

            //make an array with all of the options
            $options = array($option1, $option2, $option3, $option4);

            $correct_ans = (string)$data['correct_ans'];
            $correct_ans = mysqli_real_escape_string($this->db->link, $correct_ans);
            $correct_ans = $this->fm->validation($correct_ans);
       

            //insert question name in the question tabl
            $sql = "INSERT INTO tbl_question(question_no, question) VALUES('$question_no', '$question' )";
            
            $result = $this->db->insert($sql);
            if ($result) {
                //insert the options of the question into the tbl_answer table
                for($i = 0; $i < 4; $i++){
                    //check the correct answer
                    if($correct_ans == $i+1){
                        $sql = "INSERT INTO tbl_answer(question_no, correct_ans, option) VALUES('$question_no', '1', '$options[$i]' )";
                        $result = $this->db->insert($sql);
                    }else{
                        $sql = "INSERT INTO tbl_answer(question_no, option) VALUES('$question_no', '$options[$i]' )";
                        $result = $this->db->insert($sql);
                    }
                }

                if ($result) {
                    $msg = "<span class='success'>Question added successfully.</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Question not added</span>";
                    return $msg;
                }


            }

            
          



        }
        
}

?>