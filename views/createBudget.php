<?php
require_once ("../inclusion/inclusion.php");
AllIncludes('header',"functions","validate");
?>
<div class="form-container">
    <form id="form" method="post" action="../controller/createBudgetController.php">
        <label for="budgetName">Budget Name</label>
        <input name="budgetName" type="text" placeholder="Budget Name" id="budgetName" required>

        <label for="income">Income</label>
        <input name="income" type="number" step="any" placeholder="Income" id="income"required>

        <label for="income-description" >Income Description</label>
        <input type="text" id="income-description"  name="description" required>

        <label for="frequency">frequency</label>
        <select id="frequency" name="frequency" required>
            <option value="weekly">Weekly</option>
            <option value="biweekly">Bi-weekly</option>
            <option value="monthly" selected>Monthly</option>
        </select>

        <label for="startDate">Start Date</label>
        <input name="startDate" type="text" id="startDate"  required>

        <label name="endDate" for="endDate";>End Date</label>
        <input name="endDate" type="text"  id="endDate"   required>

        <input type="submit" id="submit">
    </form>
</div>
<?php factory()->getInclusion("footer")->Inclusion();?>
