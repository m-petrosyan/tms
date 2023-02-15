<?php

namespace App\Http\Resources\task;

use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        dd($this);
        return [
            'title' => $this->status,
            'data' => new TaskCollection(Task::where('status', $this->status)->orderBy('index','asc')->get())
        ];
    }
}
