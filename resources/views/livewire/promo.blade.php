<tr>
    <td>{{ $data->student->id  }}</td>
    <td>{{ $data->student->last_name }} {{ $data->student->first_name }}</td>
    <td>{{ $data->student->dateOfBirth }}</td>
    <td>{{ $data->classes->class_name }}</td>
    <td>{{ $data->year->session_name }}</td>
    <td>{{ $latestYear->session_name }}</td>
    @if ($promotedStudent)
        @if (!$option_opened)
            <td>
                {{ $promotedStudent->classes->class_name }}
            </td>
            <td>
                <a wire:click.prevent="open_option" href="#" class="btn btn-primary">Chỉnh sửa</a>
            </td>
        @endif
        @if ($option_opened)
            <td>
                <select class="form-control" wire:model="student_promoClass">
                    <option value="">Chọn lớp</option>
                    @foreach ($newClass as $key=>$value)
                        <option value="{{ $value->id }}" selected>{{ $value->class_name }}</option>
                    @endforeach
                </select>
                @error('student_promoClass')
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
        <select class="form-control" wire:model="student_promoClass">
            <option value="">Chọn lớp</option>
            @foreach ($newClass as $key=>$value)
                <option value="{{ $value->id }}">{{ $value->class_name }}</option>
            @endforeach
        </select>
        @error('student_promoClass')
            <span class="error text-danger">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </td>
    <td>
        <a wire:click.prevent="add" href="#" class="btn btn-primary">Lưu</a>
    </td>
    @endif
</tr>
