<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnonceRequest;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Repository\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ArticleController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        try{
            return ArticleResource::collection($this->articleRepository->getAll());
        }catch(\Exception $errors){
            Log::error("Error *index ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function getByFilter(ArticleRequest $articleRequest)
    {
        try{
            $data = $articleRequest->validated();
            return ArticleResource::collection($this->articleRepository->getByFilter($data));
        }catch(\Exception $errors){
            Log::error("Error *getByFilter ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function show($id, ArticleRequest $articleRequest)
    {
        try{
            return new ArticleResource($this->articleRepository->getById($id));
        }catch(\Exception $errors){
            Log::error("Error *show ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function store(ArticleRequest $articleRequest)
    {
        try{
            $data   = $articleRequest->validated();
            $result = $this->articleRepository->create($data);
            // return Response()->json(['data' => $result], 201);
            return new ArticleResource($result);
        }catch(\Exception $errors){
            Log::error("Error *store ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function update($id, ArticleRequest $articleRequest)
    {
        try{
            $data   = $articleRequest->validated();
            $result = $this->articleRepository->update($id, $data);
            // return Response()->json(['data' => $result], 200);
            return new ArticleResource($result);
        }catch(\Exception $errors){
            Log::error("Error *update ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function active($id, ArticleRequest $articleRequest)
    {
        try{
            $result = $this->articleRepository->active($id);
            return new ArticleResource($result);
        }catch(\Exception $errors){
            Log::error("Error *active ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function unactive($id, ArticleRequest $articleRequest)
    {
        try{
            $result = $this->articleRepository->unactive($id);
            return new ArticleResource($result);
        }catch(\Exception $errors){
            Log::error("Error *unactive ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function delete($id, ArticleRequest $articleRequest)
    {
        try{
            $result = $this->articleRepository->delete($id);
            // return Response()->json(['data' => $result], 200);
            return new ArticleResource($result);
        }catch(\Exception $errors){
            Log::error("Error *delete ArticleController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

}
