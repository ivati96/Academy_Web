<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Response;
class PublicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $publications = Publication::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $date = $this->diffDate();

        if($request->ajax()){
            return [
                'posts' => view('ajax.index')->with(compact('publications'))->render(),
                'next_page' => $publications->nextPageUrl(),
            ];
        }

        return view('publications.index')->with(compact('publications', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reponse = array();
        $this->validator($request->all())->validate();
        $count_file = 0;
        $group_publication = 0;
        $type_file = 'jpg';
        $username = Auth::User()->username;

        $publications = new Publication;

        $publications->user_id = Auth::User()->id;
        $publications->message = $request->message;
        $publications->path_file = $request->path_file;
        $publications->type_file = $type_file;
        $publications->count_file = $count_file;
        $publications->group_publication = $group_publication;

        /**$publications = array(
            'user_id' => Auth::User()->id,
            'username' => Auth::User()->username,
            'message' => $request->message,
            'path_file' => $request->path_file,
            'type_file' => $type_file,
            'count_file' => $count_file,
            'group_publication' => $group_publication,
        );**/
        
        if(is_null($request->message) & is_null($request->path_file)) {
            $response = array(
                'status' => 'error',
                'msg' => 'Error no existe información'
            );
        }else{
            if($publications->save()) {
                $msg = $this->html_publication($publications, $username);

                $response = array(
                    'status' => 'success',
                    'msg' => $msg,
                );
            }
            /**Publication::create($publications);**/
        }

        return Response::json($response);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $publication = Publication::findOrFail($id);
        $publication->delete();
        $response = array(
                'status' => 'success',
                'msg' => 'La publicación ha sido eliminada',
        );
        return Response::json($response);
    }

    protected function diffDate(){
        /**Tipo, fecha_inicial, fecha_final**/
        return '1 día';   
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'message'           => 'max:240',
            'path_file'         => 'max:150',
        ]);
    }

    protected function html_publication($publication, $username){
        $image = '';
        if (!$publication['path_file'])
        $image = "<a href='#'><div class='form-group'>
                        <img class='img-responsive img-publication' src='". $publication['path_file']."' alt=''>
                    </div></a>";
        $image_profile = asset('images/unsplash_2.jpg');
        $route_profile = url('/');
        $delete = url('/publications');


        return "<div class='col-md-12 temp' id='". $publication['id']."'>
                    <div class='panel panel-default'>
                        ". $image ."
                        <div class='panel-body'>
                            <div class='form-inline'>
                                <a href='".$route_profile."' class='profile-home'>
                                   <img class='img-circle img-responsive' style='height:100%' src='".$image_profile."' alt=''>
                                </a>
                                <a class=' href='".$route_profile."'>
                                   ". $username ."
                                </a>
                                <strong class='pull-right form-group'>
                                   Hace 1 hora
                                </strong>
                            </div>
                        </div>
                        <div class='panel-body text-justify'>
                            <span class='status'>".$publication['message']."</span>
                        </div>

                         <div class='panel-footer'>
                            <div class='form-group'>
                                <div class='form-inline'>
                                    <a href='#' class='btn btn-gray form-group reactions-bottom' title='Qué chilero'>
                                        <span style='vertical-align: middle' class='fa fa-heart color-red' style='color: red;'></span>
                                    </a>
                                    <span style='margin-right: 5px;'>42</span>
                                    <a href='#' class='btn btn-gray form-group reactions-bottom' title='Opinión'>
                                        <span style='vertical-align: middle' class='fa fa-comments'></span>
                                    </a>
                                    <span style='margin-right: 5px;'>42</span>

                                    <div class='form-group pull-right'>
                                        <div class='dropdown'>
                                          <button class='btn btn-default dropdown-toggle' type='button'  data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                            <span class='fa fa-ellipsis-h'></span>
                                          </button>
                                          <ul class='dropdown-menu dropdown-menu-right' aria-spanledby='dropdownMenu1'>
                                            <li><a href='#'> <span class='fa fa-share-square-o'></span> Reenviar <span class='badge' >42</span></a></li>
                                            <li><a href='#'>Reportar</a></li>
                                            <li><a href='#'>Obtener URL</a></li>
                                            <li role='separator' class='divider'></li>
                                            <li><a href='#'>Editar</a></li>
                                            <li><a class='delete' href='". $delete . "/". $publication['id']."' data-identy = '".$publication['id']."'>Eliminar</a></li>
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='input-group'>
                                <a href='#' class='input-group-addon' title='Me Parece'>
                                    <span class='fa fa-heart-o'></span>
                                </a>
                                <input type='text' class='form-control' placeholder='{{ trans('site.add_comment') }}'>
                                
                            </div>
                        </div>
                    </div>
                </div>";
    }
}
