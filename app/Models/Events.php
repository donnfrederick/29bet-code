<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'event';

    public function getEvents($id)
    {
        $query = $this->select(
            'event.id',
            'event.name',
            'event.description',
            'event.picture_of_event',
            'event_type.event_type',
            'event.type_of_promotion',
            'event.promo_config',
            'event.start_time',
            'event.end_time',
            'event.display_status',
            'event.display_to',
            'event.enable_status',
            'event.hot_status',
            'event.popup_status',
            'event.content_header',
            'event.content_body',
            'event.content_image',
            'event.content_footer',
            'event.date_created',
            )
        ->leftJoin('event_type', 'event.event_type', '=', 'event_type.id')
        ->where('event.enable_status','=','Yes')
        ->where(function ($query) use ($id) {
            // Check if $id is empty or null, if so, skip the condition
            if (!empty($id)) {
                $query->where('event.id', '=', $id);
            }
        })
        // ->groupBy('event.event_type')
        ->get();
        
        $resultData = [];
        foreach($query as $data){
            if(!empty($data->picture_of_event)){
                $event_picture = "https://cdn.29bet.com/uat-images/events/".$data->picture_of_event;
            }
            else{
                $event_picture = '';
            }

            if(!empty($data->content_image)){
                $event_picture_content = "https://cdn.29bet.com/uat-images/events/".$data->content_image;
            }
            else{
                $event_picture_content = '';
            }

            $resultData[] = [
                'id' => $data->id,
                'name' => $data->name,
                'description' => $data->description,
                'picture_of_event' => $event_picture,
                'event_type' => $data->event_type,
                'type_of_promotion' => $data->type_of_promotion,
                'promo_config' => $data->promo_config,
                'start_time' => $data->start_time,
                'end_time' => $data->end_time,
                'display_status' => $data->display_status,
                'display_to' => $data->display_to,
                'enable_status' => $data->enable_status,
                'hot_status' => $data->hot_status,
                'popup_status' => $data->popup_status,
                'content_header' => $data->content_header,
                'content_body' => $data->content_body,
                'content_image' => $event_picture_content,
                'content_footer' => $data->content_footer,
                'date_created' => $data->date_created
            ];
        }
        return $resultData;
    }
}
