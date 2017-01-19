<?php

require_once ("../inclusion/inclusion.php");
AllIncludes('header',"functions","dataB","validate");

$conn = con();

?>
<div class="row">
    <div class="colm-12"></div>
</div>
    <a href="../views/createBudget.php">Create Budget</a>
<?php
$sql ="SELECT * FROM user_budgets WHERE user_id =".$_SESSION["user_id"];
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    ?>

<div class="row">
    <div class="colm-6">
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
    </div>
    <div class="colm-6">
        <div id="addFriendList">zdf</div>
    </div>
</div>


<?php factory()->getInclusion("footer")->Inclusion();?>
