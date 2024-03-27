<?php 
include 'inc/header.php'; 
//redirect to login page if user not logged in
Session::checkSession();

$total = $exm->get_all_questions();
$question_number = $total->num_rows;

$question = $total->fetch_assoc();
?>
<style>
    .start-test{
        width: 80%;
        background: lightblue;
        padding: 20px;
        border-radius: 8px;
        margin: 20px auto;
    }

    ul{
        list-style-type: none;
    }

    .start-test a{
        background: gray;
        padding: 8px 20px;
        display: block;
        margin: 10px;
        text-decoration: none;
        color: black;
        text-align: center;
    }

    .start-test a:hover{
        background: black;
        color: white;
    }
</style>
<div class="main">
<h1>Welcome to Online Exam - Start Now</h1>
	
<div class="start-test">
    <h2>Test your knowledge</h2>
    <p>This is a online MCQ based exam system</p>

    <ul>
        <li><strong>Number of Question: </strong> <?php echo $question_number;?></li>
        <li><strong>Question Type: </strong>MCQ</li>
    </ul>

    <a href="test.php?q=<?php echo $question['question_no']?>">Start Test</a>
</div>
	
  </div>
<?php include 'inc/footer.php'; ?>