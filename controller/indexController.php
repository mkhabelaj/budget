<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-18
 * Time: 02:38 PM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","user");
if(isset($_POST)){
    $list = json_decode($_POST['articles']);
    //print_r($list->response->docs);

    foreach ($list->response->docs as $item) {
        ?>
        <a href="<?php printItem($item->web_url)?>" target="_blank">
            <div class="colm-12 override-articles"">
                <h3><?php printItem($item->headline->main);?></h3>
                <p><?php printItem($item->snippet);?></p>
            </div>
        </a>
        <?php
    }
}