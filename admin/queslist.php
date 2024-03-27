<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
    include_once ($filepath.'/../classes/Exam.php');


    //create a new object of the User class
    $ex = new Exam();

    

    //iterator
    $i = 0;

    

?>
<?php
  //Session::checkLogin();

?>

<div class="main">
<h1>Question List</h1>


<!-- remove question mechanism -->
<?php 

    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
        $del = $ex->delete_question_by_id($id);

        echo $del;
    }

?>

<div class="manageuser">
    <table class="tblone">
       
    <?php 
        $all_question = $ex->get_all_questions();

        if($all_question){
    ?>

        <tr>
            <th width="10%">No</th>
            <th width="70%">Question</th>
            <th width="20%">Action</th>
        </tr>
        
        <?php
        
            while($data = $all_question->fetch_assoc()){
                $i++;
        ?>
        <tr>
            <td><?php echo $i;?></td>

            <td><?php echo $data['question']?></td>
            <td>
                <a onclick="return confirm('Are you sure to Remove the question?');" href="?remove=<?php echo $data['question_no']?>">Remove</a>
            </td>
        </tr>

    <?php } } else {?>
        <tr><th>No Question Found!</th></tr>
    <?php }?>

    </table>
</div>
	
</div>
<?php include 'inc/footer.php'; ?>