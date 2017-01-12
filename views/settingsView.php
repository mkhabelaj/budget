<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-12
 * Time: 12:19 PM
 */
require_once("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","header");
$sql ="SELECT * FROM currency";

$result = dataBaseManipulation($sql,con(),"result","get list of currencies",false);
?>

<form id="change-currency">
    <label for="curency">Choose Currency</label>
    <select id="curency">
        <?php
        while ($row =mysqli_fetch_assoc($result)):
            ?>
            <option value="<?php printItem($row["curency_id"]) ?>" <?php echo $selected = $row["code"] === currencyCode()? "selected":null; ?>><?php printItem($row["country"]) ?></option>
            <?php
        endwhile;
        ?>
    </select>
    <input name="change" id="curency-submit" type="submit">
</form>

<?php factory()->getInclusion("footer")->Inclusion() ?>
