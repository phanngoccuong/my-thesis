<div class="col-lg-4">
    <div class="card" style="max-height: 210px">
        <div class="card-body">
            @if ($currentNote)
                @if (!$note_opened)
                    <p>
                       <strong class="text-danger">Ghi chú</strong>
                        <textarea class="form-control" rows="4" readonly>{{  $currentNote->note }}</textarea>
                        <a wire:click.prevent="toggle_note" href="#" class="btn btn-primary mt-2">Chỉnh sửa</a>
                    </p>
                @endif
                @if ($note_opened)
                <div class="mt-4">
                    <textarea wire:model="note" class="form-control" rows="4"></textarea>
                    @error('note')
                        <span class="error text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button wire:click="update_note"
                            class="btn btn-sm btn-primary mt-2">Lưu</button>
                </div>
                @endif
            @else
                <a wire:click.prevent="open" href="#" class="btn btn-primary">Thêm ghi chú</a>
                @if ($note_opened)
                    <textarea wire:model="note" class="form-control" rows="4"></textarea>
                    @error('note')
                        <span class="error text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button wire:click="add_note"
                        class="btn btn-sm btn-primary mt-2">Thêm</button>
                @endif
            @endif
        </div>
    </div>
</div>
