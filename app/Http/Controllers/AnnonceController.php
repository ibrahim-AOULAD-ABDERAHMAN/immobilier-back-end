<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnonceRequest;
use App\Http\Resources\AnnonceResource;
use App\Repository\AnnonceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AnnonceController extends Controller
{
    protected $annonceRepository;

    public function __construct(AnnonceRepository $annonceRepository)
    {
        $this->annonceRepository = $annonceRepository;
    }

    public function index(AnnonceRequest $annonceRequest)
    {
        try{
            return AnnonceResource::collection($this->annonceRepository->getAll());
        }catch(\Exception $errors){
            Log::error("Error *index AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function getByFilter(AnnonceRequest $annonceRequest)
    {
        try{
            $data = $annonceRequest->validated();
            return AnnonceResource::collection($this->annonceRepository->getByFilter($data));
        }catch(\Exception $errors){
            Log::error("Error *getByFilter AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function show($id, AnnonceRequest $annonceRequest)
    {
        try{
            return new AnnonceResource($this->annonceRepository->getById($id));
        }catch(\Exception $errors){
            Log::error("Error *show AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function store(AnnonceRequest $annonceRequest)
    {
        try{
            $data   = $annonceRequest->validated();
            $result = $this->annonceRepository->create($data);
            return Response()->json(['data' => $result], 201);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *store AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function update($id, AnnonceRequest $annonceRequest)
    {
        try{
            $data   = $annonceRequest->validated();
            $result = $this->annonceRepository->update($id, $data);
            return Response()->json(['data' => $result], 200);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *update AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function active($id, AnnonceRequest $annonceRequest)
    {
        try{
            $result = $this->annonceRepository->active($id);
            return Response()->json(['data' => $result], 200);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *active AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function unactive($id, AnnonceRequest $annonceRequest)
    {
        try{
            $result = $this->annonceRepository->unactive($id);
            return Response()->json(['data' => $result], 200);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *unactive AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function delete($id, AnnonceRequest $annonceRequest)
    {
        try{
            $result = $this->annonceRepository->delete($id);
            return Response()->json(['data' => $result], 200);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *delete AnnonceController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

}
