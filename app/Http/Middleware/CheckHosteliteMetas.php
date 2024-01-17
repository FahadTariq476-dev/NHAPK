<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\HosteliteMeta;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckHosteliteMetas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = Auth::user()->roles;
            // Use pluck to get an array of role names
            $roleNames = $roles->pluck('name')->toArray();
            $allowedRoleNames = [
                'Who did not  decided  role yet',
                'I am Hostelites',
                'Hostel Working Staff eg. Made,  Helper, Doormen / Guard',
                'Admin / Manager / Cook / Warden',
            ];
            // Check if user has any of the allowed roles
            $hasAllowedRole = count(array_intersect($roleNames, $allowedRoleNames)) > 0;
            // Output the array of role names
            $hosteliteMetasFieldData = '';
            if($hasAllowedRole == true){
                $hosteliteMetas = HosteliteMeta::where('hostelite_id',Auth::id())->get();
                if(count($hosteliteMetas)>0){
                    $hosteliteMetasFieldData = "Filled";
                }
                else{
                    $hosteliteMetasFieldData = "Empty";
                }
            }
            else{
                $hosteliteMetasFieldData = "NotRequired";
            }
        // Share the variable with all views
        view()->share('hosteliteMetasFieldData', $hosteliteMetasFieldData);
        return $next($request);
    }
}
