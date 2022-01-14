<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->routeIs('articles.store')){
            return $this->storeOrUpdate();
        }elseif(request()->routeIs('articles.update')){
            return $this->storeOrUpdate() + ['id' => 'exists:articles,id'];
        }elseif(request()->routeIs('articles.show') || request()->routeIs('articles.delete') || request()->routeIs('articles.active')
        || request()->routeIs('articles.unactive')){
            return ['id' => 'exists:articles,id'];
        }elseif(request()->routeIs('articles.index')){
            return [];
        }elseif(request()->routeIs('articles.getByFilter')){
            return $this->getByFilter();
        }
    }

    public function storeOrUpdate()
    {
        return [
            'title'            => ['bail', 'required', 'max:100'],
            'description'      => ['bail', 'required', 'max:60000'],
            'image'            => ['bail', 'nullable', 'mimes:jpg,jpeg,png'],
        ];
    }

    public function getByFilter()
    {
        return [
            'search' => 'nullable'
        ];
    }
}
