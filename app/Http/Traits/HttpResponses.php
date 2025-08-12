<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait HttpResponses
{
    /**
     * @param $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function success($data, string $message = 'success', int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status'    => $code,
            'message'   => $message,
            'data'      => $data,
        ], $code);
    }

    /**
     * @param $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function error($data, string $message = 'error', int $code = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'status'    => $code,
            'message'   => $message,
            'data'      => $data,
        ], $code);
    }

    protected function successWithPagination($data, string $message = 'success', array $pagination, int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status'    => $code,
            'message'   => $message,
            'data'      => $data,
            'pagination'=> $pagination
        ], $code);
    }

    // pagination
    protected function paging($items): array
    {
        return [
            'total' => $items->total(),
            'per_page' => $items->perPage(),
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem(),
        ];
    }
}
