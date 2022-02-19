<tr>
    <td>{{ $data->id }}</td>
    <td>{{ $data->last_name }} {{  $data->first_name  }}</td>
    <td>{{ $data->email }}</td>
    @if ($currentCmt)
        @if (!$input_opened)
            <td>{{ $currentCmt->comment }}</td>
            <td>
                <a wire:click.prevent="open_input" href="#" class="btn btn-primary"><i class="la la-edit"></i></a>
            </td>
        @endif
        @if ($input_opened)
            <td>
                <textarea wire:model="cmt" class="form-control" rows="2"></textarea>
                @error('cmt')
                <span class="error text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </td>
            <td>
                <a wire:click.prevent="update" href="#" class="btn btn-primary">Cập nhật</a>
            </td>
        @endif
    @else
        <td>
            <textarea wire:model="cmt" class="form-control" rows="2"></textarea>
            @error('cmt')
            <span class="error text-danger">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </td>
        <td>
            <a wire:click.prevent="add" href="#" class="btn btn-primary"><i class="la la-plus"></i></a>
        </td>
    @endif
</tr>
