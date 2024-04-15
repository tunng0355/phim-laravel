<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Film extends Model implements Searchable
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "film";
    
    protected $fillable = [
        'name',
        'poster',
        'note',
        'content',
        'category',
        'path',
        'views',
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('search', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $this->poster,
            $this->note,
            $this->content,
            $this->category,
            $this->path,

        );
    }

}
