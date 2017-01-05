<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 08:15 AM
 */

require_once ("HeaderView.php");
require_once ("Footer.php");
require_once ("Database.php");
require_once ("SecurityInclude.php");
require_once ("Functions.php");
require_once ("Validation.php");
require_once ("BudgetInstance.php");
require_once ("Income.php");
require_once ("TimeLine.php");
require_once ("UserBudgetInstance.php");
require_once ("Friend.php");
require_once ("CategoryAmount.php");
require_once ("CategoryState.php");
require_once ("Category.php");
require_once ("budgetInstanceCategory.php");
require_once ("FriendRequest.php");
require_once ("User.php");
require_once ("Notification.php");


class IncludeFactory
{

    /**
     * @param String $type
     * @return Database|Footer|Functions|HeaderView|null|SecurityInclude
     */
    public function getInclusion($type)
    {
       switch ($type)
       {
           case "header":
               return new HeaderView();
               break;
           case "footer":
               return new Footer();
               break;
           case "dataB":
               return new Database();
               break;
           case "functions":
               return new Functions();
               break;
           case "security":
               return new SecurityInclude();
               break;
           case "validate":
               return new Validation();
               break;
           case "budgetI":
               return new BudgetInstance(null,null);
               break;
           case "income":
               return new Income(null,null,null);
               break;
           case "timeL":
               return new TimeLine(null,null,null,null);
               break;
           case "userBI":
               return new UserBudgetInstance(null,null);
               break;
           case "friend":
               return new Friend(null,null);
               break;
           case "categoryA":
               return new CategoryAmount(null,null,null,null);
               break;
           case "categoryS":
               return new CategoryState(null,null);
               break;
           case "category":
               return new Category(null);
               break;
           case "budgetIC":
               return new budgetInstanceCategory(null,null);
               break;
           case "friendR":
               return new FriendRequest(null,null);
               break;
           case "user":
               return new User(null,null,null,null,null,null);
               break;
           case "notification":
               return new Notification(null,null);
               break;
           default:
               return null;

       }
    }

}