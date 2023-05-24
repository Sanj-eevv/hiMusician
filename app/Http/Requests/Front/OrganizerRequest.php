<?php
declare(strict_types = 1);
namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class OrganizerRequest extends FormRequest
{
    public function authorize() : bool
    {
        $club_id = $this->route('id');
        try
        {
            $club_id = Crypt::decrypt($club_id);
        }catch(\Exception $e){
            throw new \Exception("Invalid action");
        }
         return auth()->user()->isOrganizer() && $club_id === auth()->user()->club->id;
    }

    public function rules() : array
    {
        $club_id = $this->route('id');
        try
        {
            $club_id = Crypt::decrypt($club_id);
        }catch(\Exception $e){
            throw new \Exception("Invalid action");
        }
        return [
            'club_name'                 => ['required', 'string', 'max:191'],
            'club_address'              => ['required', 'string', 'max:191'],
            'description'               => ['required', 'string'],
            'thumbnail'                 => ['required', 'mimes:jepg,png,jpg', 'max:5120'],
            'intro_video'               => ['nullable', 'max:30720', 'mimes:mp4,mkv,quicktime,mov'],
            'first_name'                => ['required', 'string', 'max:191'],
            'last_name'                 => ['required', 'string', 'max:191'],
            'phone'                     => ['nullable', 'numeric', 'digits:10'],
        ];
    }
}
