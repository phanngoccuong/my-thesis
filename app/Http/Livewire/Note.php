<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use App\Models\LessonNote;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Note extends Component
{
    public $note_opened = FALSE;
    public $note;
    public $currentNote;
    public function mount($semester, $class, $course)
    {
        $this->semester = $semester;
        $this->class = $class;
        $this->course = $course;
    }
    protected $rules = [
        'note' => 'required',
    ];
    protected $messages = [
        'note.required' => 'Giáo viên vui lòng điền thông tin',
    ];
    public function render()
    {
        $this->currentNote = LessonNote::where('semester_id', $this->semester->id)
            ->where('class_id', $this->class->id)
            ->where('course_id', $this->course->id)
            ->first();
        return view('livewire.note');
    }
    public function toggle_note()
    {
        $this->note_opened = !$this->note_opened;
        $this->note = $this->currentNote->note;
    }

    public function open()
    {
        $this->note_opened = !$this->note_opened;
        $this->note = '';
    }
    public function add_note()
    {
        $this->validate();
        DB::table('lesson_notes')->insert([
            'semester_id' => $this->semester->id,
            'class_id' => $this->class->id,
            'course_id' => $this->course->id,
            'note' => $this->note,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $this->note_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Thêm thành công']);
    }
    public function update_note()
    {
        $this->validate();
        LessonNote::where('id', $this->currentNote->id)->update(['note' => $this->note]);
        $this->note_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Cập nhật thành công']);
    }
}
