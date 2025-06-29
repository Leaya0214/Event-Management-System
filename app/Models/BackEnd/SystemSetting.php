<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'email',
        'logo',
        'favicon',
        'phone',
        'office_address',
        'website_banner',
        'meta_tag_author',
        'meta_tag_name',
        'meta_tag_description',
        'copy_right',
        'website_link',
        'map_link',
        'fb_link',
        'instagram_link',
        'twitter_link',
        'you_tube_link',
        'status'
    ];
}
