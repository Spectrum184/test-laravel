<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $payload = array('id' => $this->id, 'iat' => Carbon::now()->timestamp, 'exp' => Carbon::now()->addDay(30)->timestamp);
        $jwtToken = \Firebase\JWT\JWT::encode($payload, config('app.jwtToken'));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'birthday' => $this->birthday,
            'join_date' => Carbon::now(),
            'gender' => $this->gender,
            'address' => $this->address,
            'roles' => array_map(
                function ($role) {
                    return $role['name'];
                },
                $this->roles->toArray()
            ),
            'permissions' => array_map(
                function ($permission) {
                    return $permission['name'];
                },
                $this->getAllPermissions()->toArray()
            ),
            'avatar' => config('app.url') . '/storage/avatar/' . $this->avatar,
            'jwtToken' => $jwtToken,
        ];
    }
}
