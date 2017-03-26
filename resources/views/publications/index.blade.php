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
     $(document).ready(function(){
        // $('#publication').prop( "disabled", true );                
        // $('#message').keyup(function(){
        //     if($(this).val().length !=0)
        //         $('#publication').prop( "disabled", false );
        //     else
        //         $('#publication').prop( "disabled", true );
        // });

        // Crear Publicación
        $("#publication").click(function(e){
            e.preventDefault();
            var message = $("#message").val();
            var path_file = $("#path_file").val();
            var data = { message: message, path_file: path_file };
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: {!! json_encode(url('/publications')) !!},
                type: "POST",
            });
            $.ajax({
                data: { 'message': message, 'path_file': path_file},
                dataType: 'json',
                success: function(data){
                    if(data.status == 'success'){
                        html = emojis(data.msg);
                        $("#publications").prepend(html);
                        e.preventDefault();
                        $("#message").val('');
                    }

                    if(data.status == 'error'){
                        alert(data.msg);
                    }
                   
                }
            });
        return false;
        });


        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            var id = $(this).data('identy');
            $('body').MessageModal({
                type: 'question',
                title: 'Eliminar publicación',
                message: 'La publicación ya no se mostrará mas adelante...',
                okText: 'Eliminar',
                okValue: 'Eliminar',
                okClass: 'btn btn-primary',
                ok: true,
                okFunction:  function () {
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: deleteUrl,
                        type: "DELETE",
                    });

                    $.ajax({
                        success: function (data) {
                            $('#' + id).remove();

                            $('body').MessageModal({show: false});
                        }
                    });
                }
            });
        });

        $('#message').focusout(function(){
            var data = $('#message').text();

            var input = '<div id="group_comment" class="input-group">'
                +'<input id="message" type="text" name="message" class="form-control tarea" placeholder="" required>'
                +'<a class="input-group-addon fa fa-camera-retro"></a>'
                +'</div>';

            if ($('#message').length) {
                $("#group_comment").replaceWith(input);
            }
        });      

        $('#message').click(function(){
            
            var photo = '@lang("site.take_photo")';
            var picture = '@lang("site.add_picture")';

            var area = '<div id="group_comment" class="input-group">'
                +'<textarea id="message" type="text" name="message" class="form-control textarea_comment" placeholder="" required>'
                +'</textarea>'
                +'<span class="input-group-addon span-group-comment">'
                +'<a class="fa fa-camera fa-comment_" title="'+ photo +'"></a>'
                +'<a class="fa fa-picture-o fa-comment_" title="'+ picture +'"></a>'
                +'<a class="fa fa-camera-retro fa-comment_"></a>'
                +'</span>'
                +'</div>';
            
            $("#group_comment").replaceWith(area);
            $('#message').focus();
        });

        $(window).scroll(fetchPosts);
 
        function fetchPosts() {
            var page = $('#publications').data('next-page');
            
            if(page !== null) {
                clearTimeout( $.data( this, "scrollCheck" ) );
                $.data( this, "scrollCheck", setTimeout(function() {
                    var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 200;
     
                    if(scroll_position_for_posts_load >= $(document).height()) {
                        $.get(page, function(data){
                            $('#publications').append(data.posts);
                            $('#publications').data('next-page', data.next_page);

                            $('.temp').remove();

                        });
                    }
                }, 350))
            }
        }
    });
    </script>
@endpush