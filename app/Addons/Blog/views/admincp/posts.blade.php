<div class="box">
    <div class="box-title">Blog Posts</div>
    <div class="box-content">
        <form action="" method="get">
            <input name="term" value="{{Input::get('term')}}" type="text" class="form-control" placeholder="{{trans('blog::global.search-blog-info')}}"/>


            <button style="margin-top: 10px" class="btn btn-primary">{{trans('blog::global.search-blog')}}</button>
        </form>
        <hr/>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td>
                            @if($post->category)
                                {{$post->category->title}}
                            @endif
                        </td>
                        <td>
                            {{($post->status == 1) ? 'Published' : 'Not Published'}}
                        </td>
                        <td>
                            <a href="{{$post->url()}}">View Blog</a>
                            <a href="{{URl::route('admincp-blog-posts-edit', ['id' => $post->id])}}">Edit</a>
                            <a href="{{URl::route('admincp-blog-posts-delete', ['id' => $post->id])}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>