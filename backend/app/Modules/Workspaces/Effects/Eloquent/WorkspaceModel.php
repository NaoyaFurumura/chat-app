<?php
namespace App\Modules\Workspaces\Effects\Eloquent;

use Illuminate\Database\Eloquent\Model;

class WorkspaceModel extends Model {
    protected $table = 'workspaces';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'image_url'
    ];
}