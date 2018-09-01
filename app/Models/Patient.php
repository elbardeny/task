<?php
/**
 * Created by PhpStorm.
 * User: elbardeny
 * Date: 9/1/18
 * Time: 1:29 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $table = 'patients';

    protected $fillable = ['first_name', 'second_name', 'family_name', 'uid'];

    public $timestamps = false;

}