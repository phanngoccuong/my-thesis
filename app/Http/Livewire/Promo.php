<?php

namespace App\Http\Livewire;

use App\Models\Promotion;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Promo extends Component
{
    public $promotedStudent;
    public $option_opened = FALSE;
    public $student_promoClass;
    public function mount($data, $latestYear, $newClass)
    {
        $this->data = $data;
        $this->latestYear = $latestYear;
        $this->newClass = $newClass;
    }
    protected $rules = [
        'student_promoClass' => 'required',
    ];
    protected $messages = [
        'student_promoClass.required' => 'Giáo viên vui lòng chọn lớp',
    ];
    public function render()
    {
        $this->promotedStudent = Promotion::where('student_id', $this->data->student_id)
            ->where('session_id', $this->latestYear->id)->first();
        return view('livewire.promo', ['data' => $this->data, 'latestYear' => $this->latestYear]);
    }
    public function open_option()
    {
        $this->option_opened = !$this->option_opened;
        $this->student_promoClass = $this->promotedStudent->classes->class_name;
    }


    public function add()
    {
        $this->validate();
        DB::table('promotions')->insert([
            'student_id' => $this->data->student_id,
            'session_id' => $this->latestYear->id,
            'class_id' => $this->student_promoClass,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $this->option_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Lên lớp thành công']);
    }
    public function update()
    {
        $this->validate();
        Promotion::where('id', $this->promotedStudent->id)->update(['class_id' => $this->student_promoClass]);
        $this->option_opened = FALSE;
        $this->emit('alert', ['type' => 'success', 'message' => 'Cập nhật lớp thành công']);
    }
}
