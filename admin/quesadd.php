<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
    include_once ($filepath.'/../classes/Exam.php');

    //create a new object of the User class
    $ex = new Exam();


    //ADD NEW QUESTION
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $add_new = $ex->add_new_question($_POST);

    }

    //get the total number of questions
    $all = $ex->get_all_questions();
    $total_question = $all->num_rows;
?>
<?php
  // Session::checkLogin();
?>

<style>
    .main-content{
        max-width: 70%;
        margin: 20px auto;
        background: lightblue;
        padding: 20px;
        border-radius: 8px;
    }

    
</style>

<div class="main">
<h1>Admin Panel - Add New Question</h1>

<!-- print the of add new question -->
<?php 

    if(isset($add_new)){
        echo $add_new;
    }

?>

    <div class="main-content">
        <form action="" method="post">
            <table class='tblone'>
               
                <tr>
                    <td>Question Number</td>
                    <td>:</td>
                    <td><input type="number" name="question_no" value="<?php echo $total_question+1;?>"></td>
                </tr>
                    
            

                <tr>
                    <td>Question</td>
                    <td>:</td>
                    <td><input type="text" name="question" placeholder="Write a question here."></td>
                </tr>

               <div class="options">

                <tr>
                    <td>Option One</td>
                    <td>:</td>
                    <td><input type="text" name="option1" placeholder="Enter option one here"></td>
                </tr>

                <tr>
                    <td>Option Two</td>
                    <td>:</td>
                    <td><input type="text" name="option2" placeholder="Enter option two here"></td>
                </tr>

                <tr>
                    <td>Option Three</td>
                    <td>:</td>
                    <td><input type="text" name="option3" placeholder="Enter option three here"></td>
                </tr>

                <tr>
                    <td>Option Four</td>
                    <td>:</td>
                    <td><input type="text" name="option4" placeholder="Enter option four here"></td>
                </tr>

                </div>


                <tr>
                    <td>Answer</td>
                    <td>:</td>
                    <td><input type="number" name="correct_ans"></td>
                </tr>

                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" name="submit" value="Add Question" >
                    </td>
                </tr>
            </table>
        </form>
    </div>


	
</div>
<?php include 'inc/footer.php'; ?>