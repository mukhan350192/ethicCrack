<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array = [
            'token' => $this->token,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'status' => $this->status,
        ];
        if ($this->type == 2){
            $array['company'] = CompanyResource::collection(DB::table('company_details')->where('id',$this->id)->get);
        }
        return $array;
    }
}
