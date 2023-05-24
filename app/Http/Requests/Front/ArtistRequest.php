<?php
declare( strict_types = 1 );

namespace App\Http\Requests\Front;

use App\Constants\UserRole;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class ArtistRequest extends FormRequest
{

     public function authorize() : bool
     {
          $artist_id = $this->route('id');
          try
          {
               $artist_id = Crypt::decrypt($artist_id);
          }
          catch( \Exception $e )
          {
               throw new \Exception("Invalid action");
          }

          return auth()->user()->isArtist() && $artist_id === auth()->user()->id;
     }

     public function rules() : array
     {
          $artist_id = $this->route('id');
          try
          {
               $artist_id = Crypt::decrypt($artist_id);
          }
          catch( \Exception $e )
          {
               throw new \Exception("Invalid action");
          }
          return [
               'first_name'        => ['required', 'string', 'max:191'],
               'last_name'         => ['required', 'string', 'max:191'],
               'user_name'         => ['required', 'string', 'max:191', Rule::unique(User::class)->ignore($artist_id)],
               'address'           => ['required', 'string', 'max:191'],
               'phone'             => ['nullable', 'numeric', 'digits:10'],
               'charge_amount'     => ['required', 'numeric'],
               'thumbnail'         => ['required', 'mimes:jepg,png,jpg', 'max:5120'],
               'intro_video'       => ['nullable', 'max:30720', 'mimes:mp4,mkv,quicktime,mov'],
          ];
     }

     public function withValidator($validator)
     {
          $validator->after(function($validator)
          {
               if( !$validator->failed() )
               {
                    $validatedData = $this->validated();
                    $validatedData['role'] = UserRole::ARTIST;
                    $this->replace($validatedData);
               }
          });
     }

}
