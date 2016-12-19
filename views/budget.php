<?php

require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();
factory()->getInclusion("header")->Inclusion();

$conn = con();

?>
    <a href="../views/createBudget.php">Create Budget</a>
<?php
$sql ="SELECT * FROM user_budgets WHERE user_id =".$_SESSION["user_id"];
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    ?>

    <br>
    <table>
        <tr>
            <th>Budget</th>
            <th>Add Friends</th>
        </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td>
                <a href="../views/budgetView.php?budget_instance_id=<?php echo $row["budget_instance_id"]?>"><?php echo $row["name"]; ?></a>
            </td>
            <td>
                <button class="addFriendToBudget" value="<?php echo $row["budget_instance_id"]?>">+</button>
            </td>

        </tr>
        <?php
        //echo $row["name"];
    }
}

?>

</table>
<div id="addFriendList">zdf</div>

<script type="application/javascript" src="../js/addFriendToBudget.js"></script>
<?php factory()->getInclusion("footer")->Inclusion();?>
