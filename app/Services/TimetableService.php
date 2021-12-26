<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Time;

class TimetableService
{
    public function generateTimetable($days, $class_id, $semester_id)
    {
        $calendarData = [];

        $lessons = Lesson::with('course')
            ->where('semester_id', '=', $semester_id)
            ->where('class_id', '=', $class_id)
            ->get();
        $times = Time::all();
        foreach ($times as $time) {
            $timeText = $time->time;
            $calendarData[$timeText] = [];
            $time_id = $time->id;
            foreach ($days as $index => $day) {

                $lesson = $lessons->where('day_id', '=', $day->id)
                    ->where('time_id', '=', $time_id)
                    ->first();

                if ($lesson) {
                    array_push($calendarData[$timeText], [
                        'course_name'   => $lesson->course->course_name,
                    ]);
                } else {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }
        return $calendarData;
    }
}
