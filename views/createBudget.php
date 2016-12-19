<?php
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("header")->Inclusion();
?>

<form id="form" method="post" action="../controller/createBudgetController.php">
    <label for="budgetName">Budget Name</label>
    <input name="budgetName" type="text" placeholder="Budget Name" id="budgetName" required>

    <label for="income">Income</label>
    <input name="income" type="number" placeholder="Income" id="income"required>

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
<script type="application/javascript" src="../js/createBudget.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php factory()->getInclusion("footer")->Inclusion();?>
