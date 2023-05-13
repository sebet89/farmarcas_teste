<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActivityTypeService;

/**
 * @OA\Tag(
 *     name="ActivityTypes",
 *     description="Operações relacionadas ao tipo de atividade"
 * )
 * @OA\Schema(
 *     schema="ActivityType",
 *     type="object",
 *     required={"name"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         readOnly=true,
 *         description="ID do tipo de atividade"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nome do tipo de atividade"
 *     )
 * )
 */
class ActivityTypeController extends Controller
{
    protected $activityTypeService;

    public function __construct(ActivityTypeService $activityTypeService)
    {
        $this->activityTypeService = $activityTypeService;
    }
    
    /**
     * @OA\Get(
     *     path="/api/activity_types",
     *     tags={"ActivityTypes"},
     *     summary="Lista todos os tipos de atividades",
     *     description="Retorna uma lista de todos os tipos de atividades",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ActivityType"))
     *     )
     * )
     */
    public function index()
    {
        return $this->activityTypeService->getAllTypes();
    }

    /**
     * @OA\Get(
     *     path="/api/activity_types/{id}",
     *     tags={"ActivityTypes"},
     *     summary="Obtém um tipo de atividade",
     *     description="Retorna um tipo de atividade pelo ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do tipo de atividade a ser visualizado",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/ActivityType")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tipo de atividade não encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        return $this->activityTypeService->getTypeById($id);
    }
    
    /**
     * @OA\Post(
     *     path="/api/activity_types",
     *     tags={"ActivityTypes"},
     *     summary="Cria um novo tipo de atividade",
     *     description="Cria um novo tipo de atividade com os dados fornecidos",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityType")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/ActivityType")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitação inválida"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return $this->activityTypeService->createType($request->all());
    }

    /**
     * @OA\Put(
     *     path="/api/activity_types/{id}",
     *     tags={"ActivityTypes"},
     *     summary="Atualiza um tipo de atividade existente",
     *     description="Atualiza um tipo de atividade com os dados fornecidos",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do tipo de atividade a ser atualizado",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityType")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/ActivityType")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tipo de atividade não encontrado"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitação inválida"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->activityTypeService->updateType($request->all(), $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/activity_types/{id}",
     *     tags={"ActivityTypes"},
     *     summary="Exclui um tipo de atividade",
     *     description="Exclui um tipo de atividade pelo ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do tipo de atividade a ser excluído",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Operação bem-sucedida, sem conteúdo a ser retornado",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tipo de atividade não encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        return $this->activityTypeService->deleteType($id);
    }
}
