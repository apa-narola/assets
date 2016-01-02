<?php
//require_once("easyCRUD.class.php");
namespace App\Models;

Use App\Models\Base\Crud;

class Person Extends Crud
{

    # Your Table name
    protected $table = 'persons';

    # Primary Key of the Table
    protected $pk = 'id';
}

?>