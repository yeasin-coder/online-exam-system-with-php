<?php
 include 'inc/header.php'; 
 //redirect to login page if user not logged in
  Session::checkSession();

  if(isset($_GET['q'])){
	$number = (int)$_GET['q'];


  $total = $exm->get_all_questions();
   $question_number = $total->num_rows;

   //get question by  id
   $question = $exm->get_question_by_id($number);
   $question_data = $question->fetch_assoc();

   //get options by id
   $options = $exm->get_options_by_id($number);

  }


  //control the process
  if($_SERVER['REQUEST_METHOD'] == "POST"){
	    $process = $pro->process_data($_POST);
  }
?>
<div class="main">
<h1>Online Exam. Question <?php echo $number?> of <?php echo $question_number?></h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question_data['question_no']?>: <?php echo $question_data['question']?></h3>
				</td>
			</tr>

			<?php 
				if(isset($options)){
					while($data = $options->fetch_assoc()){
				
			?>
			<tr>
				<td>
				 <input type="radio" name="ans" value="<?php echo $data['id']?>"/><?php echo $data['option']?>
				</td>
			</tr>

			<?php } }?>

			<tr>
			  <td>
				  <?php if($number == $question_number){?>
						<input type="submit" name="submit" value="Finish"/>
						
					<?php } else{ ?>
						<input type="submit" name="submit" value="Next Question"/>
						
					<?php }?>
					<input type="hidden" name="number" value="<?php echo $number?>"/>
			   </td>
			</tr>
			
		</table>
</div>
 </div>
<?php include 'inc/footer.php'; ?>