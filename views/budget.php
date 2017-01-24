<?php

require_once ("../inclusion/inclusion.php");
AllIncludes('header',"functions","dataB","validate");

$conn = con();

$sql ="SELECT * FROM user_budgets WHERE user_id =".$_SESSION["user_id"];
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    ?>

<div class="row">
    <div class="colm-12">
        <table id="budget-list-table">
            <tr id="budget-list-tr-header">
                <th>Budget</th>
                <th>Add Friends</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td class="budget-list-table-td">
                        <a href="../views/budgetView.php?budget_instance_id=<?php echo $row["budget_instance_id"]?>">
                            <?php echo ucfirst($row["name"]); ?>
                        </a>
                    </td>
                    <td class="budget-list-table-td">
                        <button class="addFriendToBudget open-modal" value="<?php echo $row["budget_instance_id"]?>">+</button>
                    </td>

                </tr>
                <?php
                //echo $row["name"];
            }
            }

            ?>
            <tr>
                <td colspan="2" class="budget-list-table-td">
                    <a href="../views/createBudget.php">
                        <button id="budget-list-button">Create Budget</button>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>


<?php factory()->getInclusion("footer")->Inclusion();?>
