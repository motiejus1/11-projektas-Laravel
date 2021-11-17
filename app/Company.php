<?php

namespace App;
use App\Client;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function companyClients() {
        return $this->hasMany(Client::class, 'company_id', 'id');
    }
}
