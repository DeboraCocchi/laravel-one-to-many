<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   if(isset($_GET['search'])){
        $search = $_GET['search'];
        $projects = Project::where('name','like',"%$search%")->get();
        }else{
            $projects = Project::orderBy("id","desc")->get();
        }
        $direction='desc';
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function orderby($direction, $column){
        $direction = $direction==='desc'? 'asc':'desc';
        $projects=Project::orderby($direction,$column)->all();
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {   /*
        $form_data=$request->all();
        if(array_key_exists('cover_image', $form_data)){
            $form_data['image_original_name']=$request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image']=Storage::put('uploads',$form_data['cover_image']);
         }
        $new_project=Project::create($form_data);
        */
        //--------------------------------------------------------

        //commentato perchè dava problemi
        // $form_data['slug']=Project::generateSlug($form_data['name']);

        //---------------------------------------------------------------

        $form_data=$request->all();
         $new_project=new Project();
         $new_project->name=$form_data['name'];
         $new_project->client_name=$form_data['client_name'];
         $new_project->summary=$form_data['summary'];
         if(array_key_exists('cover_image', $form_data)){
            $form_data['image_original_name']=$request->file('cover_image')->getClientOriginalName();
            $new_project->cover_image=Storage::put('uploads',$form_data['cover_image']);
         }

        //  @dump($new_project);
        //  @dump($new_project->cover_image);
        $new_project->save();


        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
      return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data=$request->all();

        if(array_key_exists('cover_image',$form_data)){

            if($project->cover_image){
                Storage::disk('public')->delete($project->cover_image);
            }
            $form_data['image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $project->cover_image = Storage::put('uploads', $form_data['cover_image']);
        }
        $project->update($form_data);
        // @dd($project);
        return redirect()->route('admin.projects.show', $project);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
