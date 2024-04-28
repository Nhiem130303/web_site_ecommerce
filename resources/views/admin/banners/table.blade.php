<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="banners-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Position</th>
                <th>Status</th>
                <th>Image</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($banners as $banner)
                <tr>
                    <td>{{ $banner->title }}</td>
                    <td>{{ $banner->slug }}</td>
                    <td>{{ $banner->position }}</td>
                    <td>{{ $banner->status }}</td>
                    <td>
                        <img src="{{ route('file.show', $banner->file_id) }}" width="50" style="object-fit: cover" alt="">
                    </td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.banners.destroy', $banner->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.banners.show', [$banner->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.banners.edit', [$banner->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $banners])
        </div>
    </div>
</div>
