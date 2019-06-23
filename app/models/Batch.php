<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Batch extends Model
{
    use SoftDeletes;
    
    public $timestamps=true; //to allow auto updation of created_at & updated_at
    protected $fillable=['name', 'start_date', 'end_date', 'trainer_id'];
    protected $dates=['deleted_at'];
    
    public function transform($data) {
        $batches=[];
        foreach($data as $item) {
            $modified=new Carbon($item->updated_at);
            $end=($item->end_date==null) ? null : new Carbon($item->end_date);
            array_push($batches, [
                'id'=>$item->id,
                'name'=>$item->name,
                'start_date'=>$item->start_date,
                'end_date'=>$item->end_date,
                'trainer_id'=>$item->trainer_id,
                'lastmodified'=>$modified->toFormattedDateString()." | ".$added->format('h:i a') 
            ]);
        }
        
        return $batches;
    }
}

?>