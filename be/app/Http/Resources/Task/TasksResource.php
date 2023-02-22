<?php

namespace App\Http\Resources\Task;

use App\Models\Task;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'status' => $this->resource,
            'data' => new TaskCollection(
                Task::where('status', $this->resource)->where('title', 'LIKE', "%$request->search%")->orderBy(
                    'index',
                    'asc'
                )->get()
            ),
        ];
    }
}
