<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemVar extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
 * @param string $variableName name of the variable we used to save the value
 * in the database
 * @description  help get a value of a variable saved in the system_var table (key value table)
 * @return dynamic returns the value of the variable



*/
    public static function getValue($variableName)
    {
        $row = self::where('name', $variableName)->first();
        return $row->value;
    }

    /**
 * @param string $variableName name of the variable we used to save the value
 * in the database
 * @description  help get a value of a variable saved in the system_var table (key value table)
 * @return dynamic returns the value of the variable's longvalue column



*/
    public static function getLongValue($variableName)
    {
        $row = self::where('name', $variableName)->first();
        return $row->long_value;
    }

    /**
     * @param void
     * @return string admin charges percentage e.g 60
     * @description help get the admin percentage share
     */
    public static function getAdminSharePercentage()
    {
        return self::getValue('admin_charges_share');
    }
}
