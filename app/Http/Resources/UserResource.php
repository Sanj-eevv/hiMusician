<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Helpers\AppHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'role'       => $this->role,
            'role_id'    => $this->role_id,
            'created_at' => AppHelper::formatDate($this->created_at),
            'action'     => \View::make('dashboard.users._action')->with('r',$this)->render(),
        ];
    }
}
