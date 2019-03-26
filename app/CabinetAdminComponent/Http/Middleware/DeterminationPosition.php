<?php

namespace App\CabinetAdminComponent\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DeterminationPosition
{
    public function handle($request, Closure $next)
    {
        if (session('position', 0) != 0) {
            return $next($request);
        }

        $user = Auth::user();

        abort_if($user->admin == null, 500);

        if ($user->hasRole('СуперАдмин')) {

            session([
                'position' => ['role' => 'super_admin']
            ]);

        } elseif ($user->hasRole('АдминСтраны')) {

            session([
                'position' => ['role' => 'country_admin']
            ]);

        } elseif ($user->hasRole('АдминГорода')) {

            session([
                'position' =>
                    [
                        'role' => 'city_admin',
                        'locality_id' => $user->admin->locality_id
                    ]
            ]);

        } elseif ($user->hasRole('АдминРайона')) {

            session([
                'position' =>
                    [
                        'role' => 'district_admin',
                        'locality_id' => $user->admin->locality_id
                    ]
            ]);

        } elseif ($user->hasRole('АдминШколы')) {
            abort_if($user->admin->school == null, 500);

            session([
                'position' =>
                    [
                        'role' => 'school_admin',
                        'school_id' => $user->admin->school->id
                    ]
            ]);

        } elseif ($user->hasRole('КлассныйРуководитель')) {
            abort_if($user->admin->class == null, 500);

            session([
                'position' =>
                    [
                        'role' => 'class_admin',
                        'class_id' => $user->admin->class->id
                    ]
            ]);

        } else {
            abort(403);
        }

        return $next($request);
    }
}
