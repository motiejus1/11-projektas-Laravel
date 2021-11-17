<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function clientCompany() {
        return $this->belongTo('App\Company', 'company_id', 'id');
    }
}
