<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TempEmail extends Model{

    protected $table = 'temp_email';
    protected $primaryKey ='m_id';
    public $timestamps =false;
}
