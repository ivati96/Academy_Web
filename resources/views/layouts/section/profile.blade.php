<div class="thumbnail" style="text-align: center">
    <div class="row">
        <div class="col-md-12">
            <div class="image-news" style="background-image: url('images/unsplash_2.jpg');"></div>
        </div>
        <div class="col-md-12">
            <button class="user user-color user-fa-3 user-news" href="#" style="" data-toggle="dropdown" role="button" aria-expanded="false">
                <span>{{ str_limit(Auth::user()->name, 1, '') }}{{ str_limit(Auth::user()->last_name, 1, '') }}</span>
            </button>
        </div>
        <div class="col-md-12">
            <a href="#" style="padding-left: 8px !important;"> {{ Auth::user()->name }} {{ Auth::user()->last_name }} (<small>{{ Auth::user()->username }}</small>)</a>
        </div>
        <div class="col-md-12">
            <small style="margin-left: 8px;">{{ Auth::user()->email }}</small></li>
        </div>
    </div>
</div>