<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActivityService;

/**
 * @OA\Tag(
 *     name="Activities",
 *     description="Operações de Atividades",
 * )
 *
 * @OA\Schema(
 *     schema="Activity",
 *     type="object",
 *     required={"user_id", "activity_type_id", "title", "status"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         readOnly=true,
 *         description="ID da atividade"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="ID do usuário relacionado à atividade"
 *     ),
 *     @OA\Property(
 *         property="activity_type_id",
 *         type="integer",
 *         description="ID do tipo de atividade"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Título da atividade"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         nullable=true,
 *         description="Descrição da atividade"
 *     ),
 *     @OA\Property(
 *         property="start_date",
 *         type="string",
 *         format="date-time",
 *         nullable=true,
 *         description="Data de início da atividade"
 *     ),
 *     @OA\Property(
 *         property="due_date",
 *         type="string",
 *         format="date-time",
 *         nullable=true,
 *         description="Data de vencimento da atividade"
 *     ),
 *     @OA\Property(
 *         property="end_date",
 *         type="string",
 *         format="date-time",
 *         nullable=true,
 *         description="Data de término da atividade"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         enum={"open", "completed"},
 *         description="Status da atividade"
 *     )
 * )
 */
class ActivityController extends Controller
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * @OA\Get(
     *     path="/api/activities",
     *     tags={"Activities"},
     *     summary="Lista todas as atividades",
     *     description="Retorna uma lista de todas as atividades",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Activity"))
     *     )
     * )
     */
    public function index()
    {
        return $this->activityService->getAllActivites();
    }

    /**
     * @OA\Get(
     *     path="/api/activities/{id}",
     *     tags={"Activities"},
     *     summary="Mostra uma atividade específica",
     *     description="Retorna os detalhes de uma atividade específica",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da atividade a ser visualizada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/Activity")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Atividade não encontrada"
     *     )
     * )
     */
    public function show($id)
    {
        return $this->activityService->getActivityById($id);
    }

    /**
     * @OA\Post(
     *     path="/api/activities",
     *     tags={"Activities"},
     *     summary="Cria uma nova atividade",
     *     description="Cria uma nova atividade com os dados fornecidos",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Activity")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/Activity")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitação inválida"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return $this->activityService->createActivity($request->all());
    }

    /**
     * @OA\Put(
     *     path="/api/activities/{id}",
     *     tags={"Activities"},
     *     summary="Atualiza uma atividade existente",
     *     description="Atualiza uma atividade existente com os dados fornecidos",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID da atividade a ser atualizada",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Activity")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Activity")
     *       ),
     *      @OA\Response(
     *        response=404,
     *        description="Atividade não encontrada"
     *      ),
     *      @OA\Response(
     *       response=400,
     *          description="Solicitação inválida"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->activityService->updateActivity($request->all(), $id);
    }

    /**
 * @OA\Delete(
 *     path="/api/activities/{id}",
 *     tags={"Activities"},
 *     summary="Exclui uma atividade existente",
 *     description="Exclui uma atividade existente dado um ID",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID da atividade a ser excluída",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operação bem-sucedida",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Atividade não encontrada"
 *     )
 * )
 */
    public function destroy($id)
    {
        return $this->activityService->deleteActivity($id);
    }

    /**
     * @OA\Get(
     *     path="/api/activities/filter",
     *     tags={"Activities"},
     *     summary="Filtra atividades por range de datas",
     *     description="Retorna uma lista de atividades que se enquadram no range de datas fornecido",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Data de início do filtro",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="Data de término do filtro",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Activity"))
     *     )
     * )
     */
    public function filterByDate(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return $this->activityService->getActivitiesBetweenDates($startDate, $endDate);
    }
}
