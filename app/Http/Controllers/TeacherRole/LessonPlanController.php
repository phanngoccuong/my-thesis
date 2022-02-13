<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonPlanRequest;
use App\Models\Classes;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonPlan;
use App\Models\Semester;
use Brian2694\Toastr\Facades\Toastr;

class LessonPlanController extends Controller
{
    public function index($semester, $class, $course)
    {
        $semesterPlan = Semester::findOrFail($semester);
        $classPlan = Classes::findOrFail($class);
        $coursePlan = Course::findOrFail($course);
        $details = LessonPlan::where('semester_id', $semesterPlan->id)
            ->where('class_id', $classPlan->id)
            ->where('course_id', $coursePlan->id)->orderBy('date', 'asc')->get();
        return view('RoleTeacher.lesson-plan.add_page', [
            'title' => 'Chi tiết môn học',
            'semesterPlan' => $semesterPlan,
            'classPlan' => $classPlan,
            'coursePlan' => $coursePlan,
            'details' => $details
        ]);
    }
    public function store(LessonPlanRequest $request)
    {
        $plan = new LessonPlan;
        $plan->class_id = $request->class_id;
        $plan->course_id = $request->course_id;
        $plan->semester_id = $request->semester_id;
        $plan->date = $request->date;
        $plan->title = $request->title;
        $plan->save();
        Toastr::success('Thêm thành công', 'Thành công');
        return redirect()->back();
    }
    public function edit($id)
    {
        $data = LessonPlan::findOrFail($id);

        return view('RoleTeacher.lesson-plan.edit', [
            'title' => 'Chỉnh sửa tiết học',
            'data' => $data,
        ]);
    }

    public function update(LessonPlanRequest $request)
    {
        $update = [
            'id'                => $request->id,
            'class_id'          => $request->class_id,
            'semester_id'       => $request->semester_id,
            'course_id'         => $request->course_id,
            'date'              => $request->date,
            'title'             => $request->title,
        ];
        // dd($update);
        LessonPlan::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật thành công!!', 'Success');
        return redirect()->route(
            'teacher.lesson-plan.index',
            ['semester' => $request->semester_id, 'class' => $request->class_id, 'course' => $request->course_id]
        );
    }
    public function delete($id)
    {
        $delete = LessonPlan::find($id);
        $delete->delete();
        Toastr::success('Xóa thành công!!', 'Thành công');
        return redirect()->back();
    }
}
