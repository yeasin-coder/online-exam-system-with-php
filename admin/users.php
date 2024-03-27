<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
    include_once ($filepath.'/../classes/User.php');


    //create a new object of the User class
    $user = new User();

    $all_user = $user->get_all_user();

    //iterator
    $i = 0;

    //disable user functionality
    if(isset($_GET['disable'])){
        $id = $_GET['disable'];
        $disable_user = $user->disable_user_by_id($id);
    }


    //enable user functionality
    if(isset($_GET['enble'])){
        $id = $_GET['enble'];
        $enable_user = $user->enable_user_by_id($id);
    }

    //delete user functionality
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $delete_user = $user->delete_user_by_id($id);
    }

?>
<?php
  //Session::checkLogin();

?>

<div class="main">
<h1>Manage Users</h1>

<?php 
if(isset($disable_user)){
    echo $disable_user;
}

if(isset($enable_user)){
    echo $enable_user;
}
?>
<div class="manageuser">
    <table class="tblone">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

    <?php 
    
        if($all_user){ 
        while($data = $all_user->fetch_assoc()){
        
        //increase the iterator
        $i++;
    ?>
        <tr>
            <td><?php echo $i;?></td>

            <td>
                <?php 
                    if($data['status'] == '1'){
                        echo "<span class='error'>" . $data['name'] . "</span>";
                    }else{
                        echo $data['name'];
                    }
                ?>
            </td>

            <td><?php echo $data['username']?></td>
            <td><?php echo $data['email']?></td>
            <td>

            <!-- show disable only for active users -->
                <?php if($data['status'] == '0'){?>

                <a href="?disable=<?php echo $data['id']?>" onclick="return confirm('Are you sure want to Disable?')">Disable</a>

                <?php }else {?>

                <a href="?enble=<?php echo $data['id']?>" onclick="return confirm('Are you sure want to Enable?')">Enable</a>

                <?php }?>

                <a href="?delete=<?php echo $data['id']?>" onclick="return confirm('Are you sure want to Delete?')">Delete</a>
                
            </td>
        </tr>
    <?php } } else {?>
        <tr><th>No User To Show</th></tr>
    <?php }?>

    </table>
</div>
	
</div>
<?php include 'inc/footer.php'; ?>