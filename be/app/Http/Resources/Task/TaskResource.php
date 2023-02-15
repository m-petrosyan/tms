<?php

namespace App\Http\Resources\Task;

use App\Helpers\General;
use App\Http\Resources\User\UserResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TaskResource extends JsonResource
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
            'id' => $this->id,
            'status' => $this->status,
            'index' => $this->index,
            'title' => $this->title,
            'img' => $this->imgUrl(),
            'description' => $this->description,
            'created_by' => new UserResource($this->owner),
            'assigned_to' => new UserResource($this->assigned),
            'created_at' => $this->created_at,
        ];
    }
}
