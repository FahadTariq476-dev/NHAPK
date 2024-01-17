<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HosteliteMetasRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Get the authenticated user's roles
       $roles = Auth::user()->roles;

       // Use pluck to get an array of role names
       $roleNames = $roles->pluck('name')->toArray();

       // Allowed role names
       $allowedRoleNames = [
           'I am Hostelites',
           'Hostel Working Staff eg. Made, Helper, Doormen / Guard',
           'Admin / Manager / Cook / Warden',
       ];

       // Check if the user has any allowed role
       $hasAllowedRole = count(array_intersect($roleNames, $allowedRoleNames)) > 0;

       if ($hasAllowedRole) {
           // User has an allowed role, proceed with the request
           return $next($request);
       } else {
           // User does not have an allowed role, you can return an unauthorized response or redirect
           // For example, redirect to the login page or show an error message
           return response('Unauthorized. You do not have permission to access this resource.', 403);
       }
    }
}
