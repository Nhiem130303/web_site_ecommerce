<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="products-table">
            <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Email</th>
                <th>Create At</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1?>
            @foreach($users as $user)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" object-id="{{$user->id}}" status = "{{$user->status}}" class="custom-control-input updateStatus" @if($user->status == 1) checked @endif id="{{$user->id}}">
                            <label class="custom-control-label userActiveTxt" for="{{$user->id}}">
                                @if($user->status==0)
                                    In Active
                                    @elseif($user->status==1)
                                Active
                                    @endif
                            </label>
                        </div>
                    </td>
                    <td  style="width: 120px">
                        {!! Form::open() !!}
                        <div class='btn-group'>
                            <a href=""
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href=""
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $users])
        </div>
    </div>
</div>

@push('page_scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.updateStatus', function () {
                let userId = $(this).attr('object-id');
                let status = $(this).attr('status');
                let id = $(this).attr('id');
                let txt = $(this).parent('.custom-control').find('.userActiveTxt');
                let url = "{{ route('admin.users.update_status', ['id' => 'userId']) }}";

                url = url.replace('userId', userId);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: url,
                    data: {status: status, id: userId},
                    success: function(data) {
                        console.log(data);
                        if (data['status'] === 0) {
                            $("#" + id).removeAttr("checked");
                            $("#" + id).attr("status", 0);
                            txt.text('In Active');
                        } else {
                            $("#" + id).attr("checked");
                            $("#" + id).attr("status", 1);
                            txt.text('Active');
                        }
                    }
                });

            });
        });
    </script>
@endpush
