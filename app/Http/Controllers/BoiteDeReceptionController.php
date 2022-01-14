<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoiteDeReceptionRequest;
use App\Http\Resources\BoiteDeReceptionResource;
use App\Repository\BoiteDeReceptionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BoiteDeReceptionController extends Controller
{
    protected $boiteDeReceptionRepository;

    public function __construct(BoiteDeReceptionRepository $boiteDeReceptionRepository)
    {
        $this->boiteDeReceptionRepository = $boiteDeReceptionRepository;
    }

    public function index(BoiteDeReceptionRequest $boiteDeReceptionRequest)
    {
        try{
            return BoiteDeReceptionResource::collection($this->boiteDeReceptionRepository->getAll());
        }catch(\Exception $errors){
            Log::error("Error *index BoiteDeReceptionController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function getByFilter(BoiteDeReceptionRequest $boiteDeReceptionRequest)
    {
        try{
            $data = $boiteDeReceptionRequest->validated();
            return BoiteDeReceptionResource::collection($this->boiteDeReceptionRepository->getByFilter($data));
        }catch(\Exception $errors){
            Log::error("Error *getByFilter BoiteDeReceptionController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function show($id, BoiteDeReceptionRequest $boiteDeReceptionRequest)
    {
        try{
            return new BoiteDeReceptionResource($this->boiteDeReceptionRepository->getById($id));
        }catch(\Exception $errors){
            Log::error("Error *show BoiteDeReceptionController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function store(BoiteDeReceptionRequest $boiteDeReceptionRequest)
    {
        try{
            $data   = $boiteDeReceptionRequest->validated();
            $result = $this->boiteDeReceptionRepository->create($data);
            return Response()->json(['data' => $result], 201);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *store BoiteDeReceptionController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function update($id, BoiteDeReceptionRequest $boiteDeReceptionRequest)
    {
        try{
            $data   = $boiteDeReceptionRequest->validated();
            $result = $this->boiteDeReceptionRepository->update($id, $data);
            return Response()->json(['data' => $result], 200);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *update BoiteDeReceptionController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function delete(BoiteDeReceptionRequest $boiteDeReceptionRequest)
    {
        try{
            $ids = $boiteDeReceptionRequest->validated();
            $result = $this->boiteDeReceptionRepository->delete($ids);
            return Response()->json(['data' => $result], 200);
            // return new ServiceResource($result);
        }catch(\Exception $errors){
            Log::error("Error *delete BoiteDeReceptionController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }
}
