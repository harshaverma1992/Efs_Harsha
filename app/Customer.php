<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable=[
        'name',
        'address',
        'cust_number',
        'city',
        'state',
        'zip',
        'email',
        'home_phone',
        'cell_phone',
    ];
	
	public static function validate($input) {
                $rules = array(
				'cust_number' => 'Required|Integer|Min:18',
                        # place-holder for validation rules
                );
				return Validator::make($input, $rules);
                # validation code
        }
    
    public function stocks() {
        return $this->hasMany('App\Stock');

        }

    public function investments()
    {
        return $this->hasMany('App\Investment');

    }


}

