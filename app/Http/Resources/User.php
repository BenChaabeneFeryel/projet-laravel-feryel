<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource{
    public function toArray($request){
        return [
            'id' => $this->id,

            'name'=> $this->name,
            'email'=> $this->email,
            'password'=> $this->password,
            'remember_token'=> $this->remember_token,
            'email_verified_at'=> $this->email_verified_at,

            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'deleted_at' => $this->deleted_at
        ];
    }
}
