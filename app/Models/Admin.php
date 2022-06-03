<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    public function VendorPersonal()
    {
        return $this->belongsTo('App\Models\Vendor','vendor_id');
    }

    public function VendorBusiness()
    {
        return $this->belongsTo('App\Models\VendorBusinessDetail','vendor_id');
    }
    
    public function VendorBank()
    {
        return $this->belongsTo('App\Models\VendorBankDetail','vendor_id');
    }
    
}
