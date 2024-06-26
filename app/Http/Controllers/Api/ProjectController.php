<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('name', 'asc')->with('type', 'technologies')->paginate(9);
        return response()->json([
            'results' => $projects
        ]);
    }
    public function show(string $slug)
    {
        $project = Project::where('slug',$slug)->get();
        
        return response()->json([
            'results' => $project
        ]);
    }
}
