<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *  by default, Eloquent expects the table name to be the plural of the model name
     *  but you can override this by defining a table property on the model
     * @var string
     */
    protected $table = 'students';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    // if you want regular date with year, month, day, hour, minute, second
    protected $dateFormat = 'Y-m-d H:i:s'; // 2023-05-10 05:47:07

    protected $fillable = ['Full_name', 'Username', 'BirthDate', 'Address', 'Email', 'Password', 'Phone']; // to allow mass assignment


}
