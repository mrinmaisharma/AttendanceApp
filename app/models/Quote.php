<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Quote extends Model
{
    use SoftDeletes;
    
    public $timestamps=true; //to allow auto updation of created_at & updated_at
    protected $fillable=['type', 'quote', 'author'];
    protected $dates=['deleted_at'];
    
    public function transform($data) {
        $quotes=[];
        foreach($data as $item) {
            $modified=new Carbon($item->updated_at);
            $end=($item->end_date==null) ? null : new Carbon($item->end_date);
            array_push($quotes, [
                'id'=>$item->id,
                'type'=>$item->type,
                'quote'=>$item->quote,
                'author'=>$item->author,
                'lastmodified'=>$modified->toFormattedDateString() 
            ]);
        }
        
        return $batches;
    }
}

?>