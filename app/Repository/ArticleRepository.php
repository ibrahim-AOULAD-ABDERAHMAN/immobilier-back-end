<?php

namespace App\Repository;

use App\Helpers\Helper;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use PHPUnit\TextUI\Help;

use function PHPUnit\Framework\isEmpty;

class ArticleRepository implements RepositoryInterface
{
    protected $article;
    public function __construct(Article $article)
    {
        $this->article  = $article;
    }

    public function getAll()
    {
        $query = $this->article;
        if(isEmpty(Auth::user())){
            $query = $query->where('is_active', 1);
        }
        return $query->paginate(Helper::pagination);
    }

    public function getByFilter($data)
    {
        $query = $this->article;
        // if(isEmpty(Auth::user())){
        //     $query = $query->where('is_active', 1);
        // }
        if(isset($data['search']) and $data['search'] != ""){
            $query = $query->search($data['search']);
        }
        return $query->paginate(Helper::pagination);
    }

    public function getByID($id)
    {
        return $this->article->where('id', $id)->first();
    }

    public function create($data)
    {
        $article                = new $this->article;
        $article->title         = $data['title'];
        $article->description   = $data['description'];
        $article->image         = Helper::saveFile($data['image'], "articles");
        $article->is_active     = 1;
        $article->id_user       = 1; //Auth::user()->id;
        $article->save();

        return $article;
    }

    public function update($id, $data)
    {
        $article                =  $this->article->where('id', $id)->first();
        $article->title         = $data['title'];
        $article->description   = $data['description'];
        File::delete(public_path("images/articles/".$article->image));
        $article->image         = Helper::saveFile($data['image'], "articles");
        $article->update();

        return $article;
    }

    public function active($id)
    {
        $article = $this->article->where('id', $id)->first();
        $article->is_active = 1;
        $article->update();

        return $article;
    }

    public function unactive($id)
    {
        $article = $this->article->where('id', $id)->first();
        $article->is_active = 0;
        $article->update();

        return  $article;
    }

    public function delete($id)
    {
        $article   =  $this->article->where('id', $id)->first();
        File::delete(public_path("images/articles/".$article->image));
        $article->delete();
        return $article;
    }
}
