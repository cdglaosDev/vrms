<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = "announce_pages";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo("App\User",'log_user', 'id');
    }

    public function annoShow()
    {
        return $this->hasMany("App\Model\AnnouncementShow",'seq_id', 'id');
    }
    public function annoFile()
    {
        return $this->hasMany("App\Model\AnnouncementFile",'seq_id', 'id');
    }
}
