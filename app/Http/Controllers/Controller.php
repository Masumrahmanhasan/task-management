<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param mixed|null $data
     * @param string $message
     * @param int $status
     * @param bool $success
     * @return JsonResponse
     */
    public function success(mixed $data = null, string $message = "", int $status = 200, bool $success = true): JsonResponse
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        if ($data instanceof ResourceCollection && $data->resource instanceof AbstractPaginator) {
            $data = [...$data->resource->toArray(), ...$data->additional];
        } else if (!($data instanceof LengthAwarePaginator)) {
            $data = compact('data');
        } else {
            $data = $data->toArray();
        }

        $response += $data;

        if (app()->environment() === 'local') {
            $log = collect(DB::getQueryLog());
            $response['queries'] = [
                'duplicates' => $log->count() - $log->unique('query')->count(),
                'time' => $log->sum('time'),
                'log' => $log->reverse()->toArray(),
            ];
        }

        return new JsonResponse($response, $status);
    }

    /**
     * Send a failure response
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function failed(mixed $data = [], string $message = "", int $status = 400): JsonResponse
    {
        return $this->success($data, $message, $status, false);
    }

    /**
     *  Set the pagination limit
     * @param int $default
     * @param int $max
     * @return int
     */
    protected function limit(int $default = 10, int $max = 50): int
    {
        return (int) min(request()->input('limit', $default), $max);
    }
}
