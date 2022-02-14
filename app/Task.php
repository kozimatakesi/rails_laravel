<?php

namespace App;

use DB;
use Log;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'content',
        'person_in_change',
        'user_id',
        'caution',
    ];

    public function getAllTasks() {

        $query = DB::table('tasks');
        $query->select(['*']);
        $query->where('status','=', 1);
        // $query->latest(['id']);
        $obj = $query->get();
        Log::debug('こここ'.$query->tosql());
        //$all = Task::where('status', 1)->latest('id')->get();
        return $obj;
    }
}
