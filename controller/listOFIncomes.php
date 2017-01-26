<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-13
 * Time: 12:33 PM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate");

if(isset($_POST)){
  $time_line_id = $_POST["timeLineID"];
  $budget_id = $_POST["budgetID"];

    $sql = "SELECT * FROM income WHERE time_line_id = ".$time_line_id." AND budget_instance_ID=".$budget_id;

    $result =   dataBaseManipulation($sql,con(),"result","selecting from database",false);
?>

    <?php
    while ($row = mysqli_fetch_assoc($result)):
    ?><div class="row" id="income-summary-style">
            <div id="income-list" >
                <div class="colm-3"><?php printItem($row["description"])?></div>
                <div class="colm-3"><?php printItem(currencyCode()) ?>
                <?php printItem(printItemCurrency($row["income"]))?></div>
                <div class="colm-3">
                    <button class="income-edit" data-income-id-edit="<?php printItem($row["income_id"])?>">Edit</button>
                    <button class="income-delete" data-income-id-delete="<?php printItem($row["income_id"])?>">delete</button>
                </div>
            </div>
        </div>
    <?php
        endwhile;
}

?>

<div class="row">
    <div class="colm-12">
        <div class="form-container">
            <form id="income-form-subit">
                <label for="income-form-subit" class="form-header">Income</label>
                <label for="income-description">Income description</label>
                <input type="text" id="income-description" required>
                <label for="amount-income">Amount</label>
                <input type="number" id="amount-income" step="any">
                <button data-time-line-id-submit="<?php printItem($time_line_id)?>" data-budget-id-submit="<?php printItem($budget_id)?>" type="submit" id="submit-new-income">Submit</button>
            </form>
        </div>
    </div>
</div>