<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $formData = $request->validated();
        // Creazione dello slug
        $slug = Project::getSlug($formData['title']);
        // Aggiunta dello slug ai dati del form
        $formData['slug'] = $slug;
        // Ottenere l'ID dell'utente
        $userId = auth()->id();
        // Aggiunta dell'ID dell'utente ai dati del form
        $formData['user_id'] = $userId;
        // Salvare l'immagine nello storage con il nome dello slug
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $slug . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads', $imageName);
            $formData['image'] = $imageName;
        }
        // Creazione di un nuovo progetto
        $newProject = Project::create($formData);
        // Reindirizzamento alla pagina di visualizzazione del progetto con il nuovo ID del progetto
        return redirect()->route('admin.projects.show', $newProject->slug);
    }



    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $formData = $request->validated();
        // Creazione dello slug
        $slug = Project::getSlug($formData['title']);
        // Aggiunta dello slug ai dati del form
        $formData['slug'] = $slug;
        // Aggiunta dell'ID dell'utente ai dati del form
        $formData['user_id'] = $project->user_id;

        if ($request->hasFile('image')) {
            // Eliminazione dell'immagine precedente
            if ($project->image) {
                Storage::delete($project->image);
            }
            // Salvataggio della nuova immagine nello storage con il nome dello slug
            $image = $request->file('image');
            $imageName = $slug . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName);
            $formData['image'] = $path;
        }

        $project->fill($formData)->save();

        return redirect()->route('admin.projects.show', $project->slug);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete('uploads/' . $project->image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('success', "Project '$project->title' has been deleted successfully");
    }
}
