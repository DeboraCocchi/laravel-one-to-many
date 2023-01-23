<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $fillable=['name', 'client_name', 'image_originale_name','summary'];

    public static function generateSlug($string){
        $slug = Str::slug($string, '-');
        $original_slug = $slug;
        $c = 1;
        $proj_exists = Project::where('slug',$slug)->first();
        while($proj_exists){
            $slug = $original_slug . '-' . $c;
            $proj_exists = Project::where('slug',$slug)->first();
            $c++;
        }
        return $slug;
    }
}
