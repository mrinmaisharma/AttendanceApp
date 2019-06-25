<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Student extends Model
{
    use SoftDeletes;
    
    public $timestamps=true; //to allow auto updation of created_at & updated_at
    protected $fillable=['username', 'batch_id', 'name', 'phn_number', 'whatsapp_number', 'email', 'institute', 'address', 'city', 'state', 'pincode'];
    protected $dates=['deleted_at'];
    
    public function transform($data) {
        $students=[];
        foreach($data as $item) {
            $modified=new Carbon($item->updated_at);
            array_push($students, [
                'id'=>$item->id,
                'username'=>$item->username,
                'batch_id'=>$item->batch_id,
                'name'=>$item->name,
                'phn_number'=>$item->phn_number,
                'whatsapp_number'=>$item->whatsapp_number,
                'email'=>$item->email,
                'institute'=>$item->institute,
                'address'=>$item->address,
                'city'=>$item->city,
                'state'=>$item->state,
                'pincode'=>$item->pincode,
                'lastmodified'=>$modified->toFormattedDateString()." | ".$modified->format('h:i a') 
            ]);
        }
        
        return $students;
    }
}

?>