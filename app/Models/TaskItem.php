<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    use HasFactory;

    //Table
    protected $table = 'task_items';

    //Primary key
    protected $primaryKey = 'id';

    //timestamps
    public $timestamps = true;


    protected $fillable = [
        'name',
        'description',
        'status',
        'task_id',
    ];

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id');
    }
}
