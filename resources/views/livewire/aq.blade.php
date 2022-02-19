@if ($currentAQ)
    @if (!$text_opened)
    <div>
        <div class="row page-titles mx-0">
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Năm học</label>
                    <select class="form-control"
                        name="session_id" id="session_id">
                        <option value="{{ $year->id }}">{{ $year->session_name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Lớp</label>
                    <select class="form-control"
                        name="class_id" id="class_id">
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Học sinh</label>
                    <select class="form-control">
                        <option selected disabled>{{ $student->last_name }} {{ $student->first_name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2" style="padding-top: 30px;">
                <a wire:click.prevent="toggle" href="#" class="btn btn-primary">Chỉnh sửa</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong class="text-danger">
                            Năng lực<span class="text-danger">*</span></strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-primary">Tự chủ và tự học</label>
                                <p>{{ $currentAQ->self_management }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-primary">Giao tiếp và hợp tác</label>
                                <p>{{ $currentAQ->cooperate }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-primary">Giải quyết vấn đề</label>
                                <p>{{ $currentAQ->problem_solving }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong class="text-danger">
                            Phẩm chất<span class="text-danger">*</span></strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-primary">Chăm học, chăm làm</label>
                                <p>{{ $currentAQ->hard_work }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-primary">Trung thực, kỉ luật</label>
                                <p>{{ $currentAQ->honesty }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-primary">Tự tin, trách nhiệm</label>
                                <p>{{ $currentAQ->self_confident }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-primary">Đoàn kết, yêu thương</label>
                                <p>{{ $currentAQ->united }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($text_opened)

    <div>
        <div class="row page-titles mx-0">
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Năm học</label>
                    <select class="form-control"
                        name="session_id" id="session_id">
                        <option>{{ $year->session_name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Lớp</label>
                    <select class="form-control"
                        name="class_id" id="class_id">
                        <option>{{ $class->class_name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Học sinh</label>
                    <select class="form-control">
                        <option selected disabled>{{ $student->last_name }} {{ $student->first_name }}</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2" style="padding-top: 30px;">
                <a wire:click.prevent="update" class="btn btn-primary">Cập nhật</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Năng lực<span class="text-danger">*</span></strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Tự chủ và tự học</label>
                                <textarea wire:model="self_management" class="form-control" rows="3"></textarea>
                                @error('self_management')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Giao tiếp và hợp tác</label>
                                <textarea wire:model="cooperate" class="form-control"
                                rows="3"></textarea>
                                @error('cooperate')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Giải quyết vấn đề</label>
                                <textarea wire:model="problem_solving" class="form-control"
                                rows="3"></textarea>
                                @error('problem_solving')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Phẩm chất<span class="text-danger">*</span></strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Chăm học, chăm làm</label>
                                <textarea wire:model="hard_work" class="form-control"
                                rows="3"></textarea>
                                @error('hard_work')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Trung thực, kỉ luật</label>
                                <textarea wire:model="honesty" class="form-control"
                                rows="3"></textarea>
                                @error('honesty')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Tự tin, trách nhiệm</label>
                                <textarea wire:model="self_confident" class="form-control"
                            rows="3"></textarea>
                            @error('self_confident')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Đoàn kết,yêu thương</label>
                                <textarea wire:model="united" class="form-control"
                                rows="3"></textarea>
                                @error('united')
                                    <span class="error text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @else
    <div>
        <div class="row page-titles mx-0">
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Năm học</label>
                    <select class="form-control"
                        name="session_id" id="session_id">
                        <option>{{ $year->session_name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Lớp</label>
                    <select class="form-control"
                        name="class_id" id="class_id">
                        <option>{{ $class->class_name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label">Học sinh</label>
                    <select class="form-control">
                        <option selected disabled>{{ $student->last_name }} {{ $student->first_name }}</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2" style="padding-top: 30px;">
                <a wire:click.prevent="add" class="btn btn-primary">Lưu</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Năng lực<span class="text-danger">*</span></strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Tự chủ và tự học</label>
                                <textarea wire:model="self_management" class="form-control" rows="3"></textarea>
                                @error('self_management')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Giao tiếp và hợp tác</label>
                                <textarea wire:model="cooperate" class="form-control"
                                rows="3"></textarea>
                                @error('cooperate')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Giải quyết vấn đề</label>
                                <textarea wire:model="problem_solving" class="form-control"
                                rows="3"></textarea>
                                 @error('problem_solving')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Phẩm chất<span class="text-danger">*</span></strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Chăm học, chăm làm</label>
                                <textarea wire:model="hard_work" class="form-control"
                                rows="3"></textarea>
                                 @error('hard_work')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Trung thực, kỉ luật</label>
                                <textarea wire:model="honesty" class="form-control"
                                rows="3"></textarea>
                                @error('honesty')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Tự tin, trách nhiệm</label>
                                <textarea wire:model="self_confident" class="form-control"
                            rows="3"></textarea>
                            @error('self_confident')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Đoàn kết,yêu thương</label>
                                <textarea wire:model="united" class="form-control"
                                rows="3"></textarea>
                                @error('united')
                                <span class="error text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


