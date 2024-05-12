<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $template = "backend.role.index";
        $roles = Role::all();
        return view('backend.dashboard.layout', compact(
            'template',
            'roles'
        ));

    }
}
