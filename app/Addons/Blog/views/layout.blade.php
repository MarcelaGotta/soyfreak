<div class="container page-content">
    <div class="left-column">
        {{$content}}
    </div>
    <div class="right-column">
        <div class="box" style="padding-top: 20px">
            <div class="box-content">
                <form action="{{URL::route('blogs')}}" method="get">
                    <input name="term" value="{{Input::get('term')}}" type="text" class="form-control" placeholder="{{trans('blog::global.search-blog-info')}}"/>
                    @if (Input::get('category', null))
                    <input type="hidden" value="{{Input::get('category')}}" name="category"/>
                    @endif

                    <button style="margin-top: 10px" class="btn btn-primary">{{trans('blog::global.search-blog')}}</button>
                </form>
            </div>
        </div>
        <div class="box" style="min-height: 30px">

                <ul class="nav">
                    <li><a data-ajaxify="true" href="{{URL::route('blogs')}}">{{trans('blog::global.view-blogs')}}</a> </li>

                    @if(Auth::check() and (Config::get('allow-non-admin-create-blog', true) or Auth::user()->isAdmin()))
                        <li><a data-ajaxify="true" href="{{Auth::user()->present()->url('blogs')}}">{{trans('blog::global.view-my-blogs')}}</a> </li>
                        <li><a href="{{URL::route('blog-add')}}" >{{trans('blog::global.add-new-blog')}}</a> </li>

                    @endif

                </ul>

        </div>

        <div class="box">
            <div class="box-title">{{trans('blog::global.categories')}}</div>

                <ul class="nav">
                    @foreach(app('App\\Addons\\Blog\\Classes\\BlogCategoryRepository')->getList() as $category)
                        <li><a href="{{URL::route('blogs')}}?category={{$category->id}}">{{$category->title}}</a> </li>
                    @endforeach

                </ul>

        </div>


    </div>
</div>