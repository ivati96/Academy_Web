@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.section.profile')
            @include('layouts.section.menu')
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div id="comment_status" class="panel panel-default">
                        <div class="panel-body text-justify">
                                <div style="margin-bottom: 15px;">
                                    <div id="group_comment" class="input-group">
                                      <input id="message" type="text" name="message" class="form-control tarea" placeholder="{{ trans('site.notice_state') }}">
                                      <a class="input-group-addon fa fa-camera-retro" title="{{ trans('site.add_image') }}"></a>
                                    </div>
                                </div>
                                <input id="path_file" type="text" name="path_file" class="form-control" style="display: none" required>
                        </div>
                        <div class="panel-footer">
                            <button id="publication" class="btn btn-primary">
                                    Publicar
                                </button>
                        </div>
                    </div>
                </div>
            </div>
                
            <div id="publications" data-next-page="{{ $publications->nextPageUrl() }}" class="row">
                @foreach($publications as $publication)
                <div class="col-md-12" id="{{ $publication->id }}">
                    <div class="panel panel-default">
                        @if (!empty($publication -> path_file))
                            <div class="form-group">
                                <img class="img-responsive img-publication" src="{{ url($publication -> path_file) }}" alt="">
                            </div>
                        @endif
                        <div class="panel-body">
                            <div class="form-inline">
                                <a href="{{ url('/') }}" class="profile-home">
                                   <img class="img-circle img-responsive" style="height:100%" src="{{ url('./images/unsplash_2.jpg') }}" alt="">
                                </a>
                                <a class="" href="{{ url('/profile/'. $publication->user -> username) }}">
                                   {{ $publication -> user -> username }}
                                </a>
                                <strong class="pull-right form-group">
                                   Hace {{ $date }}
                                </strong>
                            </div>
                        </div>
                        @if (!is_null($publication -> message))
                        <div class="panel-body text-justify">
                            <span class="status">{{ $publication -> message }}</span>
                        </div>
                        @endif

                         <div class="panel-footer">
                            <div class="form-group">
                                <div class="form-inline">
                                    <a href="#" class="btn btn-gray form-group reactions-bottom" title="Qué chilero">
                                        <span style="vertical-align: middle" class="fa fa-heart color-red" style="color: red;"></span>
                                    </a>
                                    <span style="margin-right: 5px;">42</span>
                                    <a href="#" class="btn btn-gray form-group reactions-bottom" title="Opinión">
                                        <span style="vertical-align: middle" class="fa fa-comments"></span>
                                    </a>
                                    <span style="margin-right: 5px;">42</span>

                                    <div class="form-group pull-right">
                                        <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <span class="fa fa-ellipsis-h"></span>
                                          </button>
                                          <ul class="dropdown-menu dropdown-menu-right" aria-spanledby="dropdownMenu1">
                                            <li><a href="#"> <span class="fa fa-share-square-o"></span> Reenviar <span class="badge" >42</span></a></li>
                                            <li><a href="#">Reportar</a></li>
                                            <li><a href="#">Obtener URL</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#">Editar</a></li>
                                            <li><a class="delete" href="{{ route('publications.destroy',  $publication -> id) }}" data-identy = "{{ $publication -> id }}">Eliminar</a></li>
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <div class="profile-home form-group" >
                                    <span class="img-circle img-responsive profile-comment" style="height:100%; background-image: url({{ url('./images/unsplash_2.jpg') }});"  />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ trans('site.add_comment') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
        <div class="col-md-3">
            @include('layouts.section.footer')
            @include('layouts.section.aside')
        </div>
    </div>
@endsection
@push('scripts')
    <script>
     
    </script>
@endpush