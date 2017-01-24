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
<div class="row">
    <div class="colm-6">
        <div class="form-container">
            <form id="change-currency" >
                <label for="change-currency" class="form-header">Change Currency</label>
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
        </div>
    </div>
    <div class="colm-6">
        <div class="form-container">
            <form id="upload-profile-photo" action="../controller/uploadImageController.php" method="post"enctype="multipart/form-data" >
                <label for="upload-profile-photo" class="form-header">Profile Photo</label>

                <label for="file-upload">Upload Image</label>
                <input type="file" name="image" id="image-upload" required>
                <input type="submit" value="image upload" name="submit" id="submit-image">

            </form>

        </div>

    </div>



<?php factory()->getInclusion("footer")->Inclusion() ?>
