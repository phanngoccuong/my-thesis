<?php

namespace App\Http\Livewire;

use App\Models\TeacherComment;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Comment extends Component
{
    public $currentCmt;
    public $input_opened = FALSE;
    public $cmt;
    protected $rules = [
        'cmt' => 'required',
    ];
    protected $messages = [
        'cmt.required' => 'Giáo viên vui lòng nhập nhận xét',
    ];
    public function mount($data, $course, $class, $semester)
    {
        $this->data = $data;
        $this->course = $course;
        $this->class = $class;
        $this->semester = $semester;
    }
    public function render()
    {
        $this->currentCmt = TeacherComment::where('student_id', $this->data->id)
            ->where('course_id', $this->course->id)
            ->where('class_id', $this->class->id)
            ->where('semester_id', $this->semester->id)
            ->first();
        return view('livewire.comment');
    }
    public function open_input()
    {
        $this->input_opened = !$this->input_opened;
        $this->cmt = $this->currentCmt->comment;
    }
    public function add()
    {
        $this->validate();
        DB::table('teacher_comments')->insert([
            'student_id' => $this->data->id,
            'semester_id' => $this->semester->id,
            'class_id' => $this->class->id,
            'course_id' => $this->course->id,
            'comment' => $this->cmt,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $this->input_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Thêm nhận xét thành công']);
    }
    public function update()
    {
        TeacherComment::where('id', $this->currentCmt->id)->update(['comment' => $this->cmt]);
        $this->input_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Cập nhật thành công']);
    }
}
