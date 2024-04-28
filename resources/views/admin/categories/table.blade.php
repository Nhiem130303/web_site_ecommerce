<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="categories-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Category Parent</th>
                <th>Image</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>
                        <img src="{{ route('file.show', $category->file_id) }}" width="50" style="object-fit: cover" alt="">
                    </td>
                    <td>{{ $category->status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.categories.show', [$category->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.categories.edit', [$category->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $categories])
        </div>
    </div>
</div>
