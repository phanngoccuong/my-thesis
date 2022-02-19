<?php

namespace App\Http\Livewire;

use App\Models\AbilityQuality;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Aq extends Component
{
    public $text_opened = FALSE;

    public   $self_management, $cooperate, $problem_solving, $hard_work, $self_confident, $honesty, $united;

    public $currentAQ;
    protected $rules = [
        'self_management' => 'required',
        'cooperate' => 'required',
        'problem_solving' => 'required',
        'hard_work' => 'required',
        'self_confident' => 'required',
        'honesty' => 'required',
        'united' => 'required',
    ];
    protected $messages = [
        'self_management.required' => 'Giáo viên vui lòng điền đủ thông tin',
        'cooperate.required' => 'Giáo viên vui lòng điền đủ thông tin',
        'problem_solving.required' => 'Giáo viên vui lòng điền đủ thông tin',
        'hard_work.required' => 'Giáo viên vui lòng điền đủ thông tin',
        'self_confident.required' => 'Giáo viên vui lòng điền đủ thông tin',
        'honesty.required' => 'Giáo viên vui lòng điền đủ thông tin',
        'united.required' => 'Giáo viên vui lòng điền đủ thông tin',
    ];

    public function mount($year, $class, $student)
    {
        $this->year = $year;
        $this->class = $class;
        $this->student = $student;
    }
    public function render()
    {
        $this->currentAQ = AbilityQuality::where('session_id', $this->year->id)
            ->where('class_id', $this->class->id)
            ->where('student_id', $this->student->id)
            ->first();
        return view('livewire.aq');
    }
    public function toggle()
    {
        $this->text_opened = !$this->text_opened;
        $this->self_management = $this->currentAQ->self_management;
        $this->cooperate = $this->currentAQ->cooperate;
        $this->problem_solving = $this->currentAQ->problem_solving;
        $this->hard_work = $this->currentAQ->hard_work;
        $this->self_confident = $this->currentAQ->self_confident;
        $this->honesty = $this->currentAQ->honesty;
        $this->united = $this->currentAQ->united;
    }

    public function add()
    {
        $this->validate();
        DB::table('ability_qualities')->insert([
            'session_id' => $this->year->id,
            'class_id' => $this->class->id,
            'student_id' => $this->student->id,
            'self_management' => $this->self_management,
            'cooperate' => $this->cooperate,
            'problem_solving' => $this->problem_solving,
            'hard_work' => $this->hard_work,
            'self_confident' => $this->self_confident,
            'honesty' => $this->honesty,
            'united' => $this->united,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $this->text_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Thêm đánh giá thành công']);
    }
    public function update()
    {
        $this->validate();
        AbilityQuality::where('id', $this->currentAQ->id)->update(
            [
                'self_management' => $this->self_management,
                'cooperate' => $this->cooperate,
                'problem_solving' => $this->problem_solving,
                'hard_work' => $this->hard_work,
                'self_confident' => $this->self_confident,
                'honesty' => $this->honesty,
                'united' => $this->united,
            ]
        );
        $this->text_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Cập nhật thành công']);
    }
}
