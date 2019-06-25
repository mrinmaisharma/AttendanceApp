<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Model
{
    use SoftDeletes;
    
    public $timestamps=true; //to allow auto updation of created_at & updated_at
    protected $fillable=['role', 'username', 'password'];
    protected $dates=['deleted_at'];
    
    public function transform($data) {
        $users=[];
        foreach($data as $item) {
            $modified=new Carbon($item->updated_at);
            $end=($item->end_date==null) ? null : new Carbon($item->end_date);
            array_push($users, [
                'id'=>$item->id,
                'role'=>$item->role,
                'username'=>$item->username,
                'password'=>$item->password,
                'trainer_id'=>$item->trainer_id,
                'lastmodified'=>$modified->toFormattedDateString()." | ".$modified->format('h:i a') 
            ]);
        }
        
        return $batches;
    }
}

?>