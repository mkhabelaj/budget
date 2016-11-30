<?php

require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();
factory()->getInclusion("header")->Inclusion();

$conn = con();

$sql ="SELECT * FROM user_budgets WHERE user_id =".$_SESSION["user_id"];
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){
        echo $row["name"];
    }
}

?>
<a href="../views/createBudget.php">Create Budget</a>
<br>
<table>

    <tr>
        <td>Budget</td>
    </tr>
    <tr>
        <td><a href="#">Family</a></td>
    </tr>
</table>
<?php factory()->getInclusion("footer")->Inclusion();?>
