<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJenisPeralatan extends Model
{
    protected $primary = 'id';

    protected $table = 'master_jenis_peralatan';

    public $timestamps = false;
}
