<?php

namespace App;
use App\Company;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function clientCompany() {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
