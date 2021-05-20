<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditorialProjectStoreRequest;
use App\Http\Resources\EditorialProjectResource;
use App\Models\EditorialProject;
use App\Models\EditorialProjectLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditorialProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EditorialProjectStoreRequest $request
     * @return EditorialProjectResource
     * @throws Exception
     */
    public function store(EditorialProjectStoreRequest $request)
    {
        DB::beginTransaction();
            try {
                $editorial_project = new EditorialProject();
                $editorial_project->title = $request->title;
                $editorial_project->publication_date = $request->publication_date;
                $editorial_project->pages = $request->pages;
                $editorial_project->price = $request->price;
                $editorial_project->cost = $request->cost;
                $editorial_project->sector_id = $request->sector_id;
                $editorial_project->author_id = $request->author_id;
                $editorial_project->save();

                $editorial_project_log = new EditorialProjectLog();
                $editorial_project_log->editorial_project_id = $editorial_project->id;
                $editorial_project_log->user_id = Auth::user()->id;
                $editorial_project_log->action = EditorialProjectLog::ACTION_CREATE;
                $editorial_project_log->save();

                DB::commit();
            } catch (Exception $exception){
                DB::rollBack();
                throw $exception;
            }

            return new EditorialProjectResource($editorial_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
