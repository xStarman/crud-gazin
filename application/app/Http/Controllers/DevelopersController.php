<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Developer;
use \Validator;

class DevelopersController extends Controller
{

    private $rules = [
        'nome' => 'required',
        'sexo' => 'required|in:M,F,O',
        'hobby' => 'required',
        'datanascimento' => 'required|date|before:today'
    ];

    private $messages = [
        'nome.required' => "O nome é obrigatório.",
        'sexo.required' => "O sexo é obrigatório.",
        'sexo.in' => "O valor informado é inválido.",
        'hobby.required' => "O hobby é obrigatório.",
        'datanascimento.required' => "A data de nascimento é obrigatória.",
        'datanascimento.date' => "Formato de data inválido.",
        'datanascimento.before' => "A data de nascimento precisa ser inferior à hoje."
    ];

    /**
     * @param Request $request
     * @return Response Developer|ValidationError
     */
    public function createDeveloper(Request $request)
    {

        $requestData = $request->all();

        $validator = Validator::make($requestData, $this->rules, $this->messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try {
            $developer = new Developer();
            $developer->fill($requestData);
            $developer->setIdadeAttribute();
            $developer->save();

            return response()->json($developer, 201);
        } catch (\Exception $e) {
            $code =  $e->getCode();
            return response()->json(["error" => "Houve um erro interno. ERRNO: $code"], 500);
        }
    }

    /**
     * @param integer $developerId
     * @param Request $request
     * @return Response Array|Developer
     */
    public function listDevelopers($developerId = null, Request $request)
    {
        if ($developerId) {
            return $this->getDeveloperById($developerId);
        }

        $q = $request->get("q", "");
        $perPage = $request->get("perPage", 15);
        $developers = Developer::where("nome", "like", "%$q%")->paginate($perPage);
        return response()->json($developers->count() ? $developers : [], $developers->count() ? 200 : 404);
    }

    /**
     * @param integer $developerId
     * @return Response Developer
     */
    private function getDeveloperById($developerId)
    {
        $developer = Developer::find($developerId);
        return response()->json($developer, $developer ? 200 : 404);
    }

    /**
     * @param integer $developerId
     * @param Request $request
     * @return Response null|ValidationError
     */
    public function updateDeveloper($developerId, Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, $this->rules, $this->messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try {
            $developer = Developer::find($developerId);

            if(!$developer){
                return response()->json(["id" => ["O id informado é inválido"]], 400);
            }
            $developer->fill($requestData);
            $developer->setIdadeAttribute();
            $developer->save();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            $code =  $e->getCode();
            return response()->json(["error" => "Houve um erro interno. ERRNO: $code"], 500);
        }
    }

    /**
     * @param integer $developerId
     * @return Response null
     */
    public function deleteDeveloper($developerId)
    {
        try {
            $developer = Developer::find($developerId);

            if(!$developer){
                return response()->json(["id" => ["O id informado é inválido"]], 400);
            }
            $developer->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            $code =  $e->getCode();
            return response()->json(["error" => "Houve um erro interno. ERRNO: $code"], 500);
        }
    }
}
