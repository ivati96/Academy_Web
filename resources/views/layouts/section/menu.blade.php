<div class="menu">
    <ul class="nav nav-tabs nav-stacked" role="tablist">
    <li role="presentation">
    	<a href="{{ url('/publications') }}"><span class="fa fa-home"></span> Inicio
    	</a>
    </li>
    <li role="presentation">
	    <a href="{{ url('/dashboard') }}"><span class="fa fa-university"></span> Cursos
	    </a>
	</li>
	<li role="presentation">
    	<a href="#settings"><span class="fa fa-bell"></span> Notificaciones
    	</a>
    </li>
    <li role="presentation">
    	<a href="#messages"><span class="fa fa-comments-o"></span> Mensajes
    	</a>
    </li>
    <li role="presentation">
    	<a href="#settings"><span class="fa fa-file-image-o"></span> Imagenes
    	</a>
    </li>
    <li role="presentation">
    	<a href="#settings"><span class="fa fa-users"></span> Grupos
    	</a>
    </li>
  </ul>
</div>

@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		var location = window.location.href;
		$('.menu a').each(function(){
	    	var href = $(this).attr('href');
	    	if(href == location){
	    		$(this).parents('li').addClass( "active" );
	    	}
	  	});
	});
</script>
@endpush