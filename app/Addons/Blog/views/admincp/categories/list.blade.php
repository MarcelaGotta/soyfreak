<div class="box">
    <div class="box-title">Blog Categories</div>
    <div class="box-content">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Title</th>

                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($lists as $category)
                <tr>
                    <td>{{$category->title}}</td>
                    <td>
                        <a href="{{URL::route('admincp-blog-categories-edit', ['id' => $category->id])}}">Edit</a>
                        <a href="{{URL::route('admincp-blog-categories-delete', ['id' => $category->id])}}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>