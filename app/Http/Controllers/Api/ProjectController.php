<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Projects\ProjectModel;
use Illuminate\Http\Request;
// use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectController extends Controller
{
    use GeneralTrait;

    public function index(){
        
        $projects=ProjectModel::select('id','name_'.app()->getLocale())
        ->get();
        return response()->json($projects);
    }

    public function getCategoryById(Request $request) {
        $project=ProjectModel::select('id', 'description','name_'.app()->getLocale())->find($request->id);
        if (!$project) {
           return $this->returnError('404', 'Not found');
        }
        
        return $this->returnData('project', $project, 'Object Found' );
        // return response()->json($project);
    }
}
