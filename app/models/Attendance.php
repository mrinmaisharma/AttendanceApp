<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Attendance extends Model
{
    use SoftDeletes;
    
    public $timestamps=true; //to allow auto updation of created_at & updated_at
    protected $fillable=['batch_id', 'student_id', 'date_of_attd', 'status'];
    protected $dates=['deleted_at'];
    
    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function batch() {
        return $this->belongsTo(Batch::class);
    }

    public function transform($data) {
        $records=[];
        foreach($data as $item) {
            $modified=new Carbon($item->updated_at);
            $date=new Carbon($item->date_of_attd);
            $end=($item->end_date==null) ? null : new Carbon($item->end_date);
            array_push($records, [
                'id'=>$item->id,
                'batch_id'=>$item->batch_id,
                'student_id'=>$item->student_id,
                'date_of_attd'=>$date->toFormattedDateString(),
                'status'=>$item->status,
                'lastmodified'=>$modified->toFormattedDateString() 
            ]);
        }
        
        return $records;
    }
}

?>