<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-26
 * Time: 05:00 PM
 */
?>
<div id="addTableRow" >

    <div class="error-category"></div>
    <div class="form-container">
        <form>
            <div id="pja">
                <label for="Category">Category</label>
                <input type="text" id="Category" required>
            </div>
            <div id="aa">
                <label for="projected-amount">Projected Amount</label>
                <input type="number" id="projected-amount" step="any" required>
            </div>
            <div id="va">
                <label for="actual-amount">Actual Amount</label>
                <input type="number" id="actual-amount" step="any" required>
            </div>
            <button id="addRow" type="submit">add</button>
        </form>
    </div>
</div>
<span>Available catagory filter</span>
<div class="available-category"></div>
