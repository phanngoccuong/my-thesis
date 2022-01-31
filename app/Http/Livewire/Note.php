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
    public function mount($schoolLesson)
    {
        $this->lesson = $schoolLesson;
    }
    protected $rules = [
        'note' => 'required',
    ];
    public function render()
    {
        $this->currentNote = LessonNote::where('lesson_id', $this->lesson->id)->first();
        return view('livewire.note');
    }
    public function toggle_note()
    {
        $this->note_opened = !$this->note_opened;
        $this->note = $this->currentNote->note;
    }

    public function update_note()
    {
        LessonNote::where('id', $this->currentNote->id)->update(['note' => $this->note]);
        $this->note_opened = FALSE;
    }
    public function open()
    {
        $this->note_opened = !$this->note_opened;
        $this->note = '';
    }
    public function add_note()
    {
        DB::table('lesson_notes')->insert([
            'lesson_id' => $this->lesson->id,
            'note' => $this->note,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $this->note_opened = FALSE;
    }
}
