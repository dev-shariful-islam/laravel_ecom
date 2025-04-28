<div class="form-button-action">
    @foreach ($actionButtons as $button)

        @php
            $hasPermission = false;


            foreach ($button['permissions'] as $permission) {
                if (admin()->can($permission)) {
                    $hasPermission = true;
                    break;
                }
            }

            $paramas = '';

            if (isset($button['params'])) {
                $paramas = $button['params'];
            }
        @endphp

            @if (!$hasPermission)
                @continue;
            @else
                <a href="{{(isset($button['delete']) && $button['delete'] == true) ? 'javascript:void(0)' : route($button['routeName'], $paramas)}}" class='btn btn-link {{$button['className']}} btn-lg' @if(isset($button['delete']) && $button['delete'] == true) onclick="
    confirmDelete(() => document.getElementById('{{$button['id']}}').submit())" @endif ><i class="{{$button['icon']}}" ></i></a>


                @if(isset($button['delete']) && $button['delete'] == true)
                    <form action="{{route($button['routeName'],$button['params'])}}" method="POST" id="{{$button['id']}}">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            @endif









    @endforeach














{{--
    <a href="{{route('am.admin.show', $admin->id)}}" class="btn btn-link btn-info btn-lg"><i class="fa fa-eye"></i></a>

    <a href="{{route('am.admin.edit', $admin->id)}}" class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></a>
    <a onclick="
    confirmDelete(() => document.getElementById('delete-form{{$admin->id}}').submit())" href="javascript:void(0);" class="btn btn-link btn-danger btn-lg"><i class="fa fa-trash"></i></a>
    <form action="{{route('am.admin.destroy', $admin->id)}}" method="POST" id="delete-form{{$admin->id}}">
        @csrf
        @method('DELETE')
    </form> --}}

</div>
