<?php

namespace App\Services;

use App\Models\Promotion;
use App\Models\YearSession;

class PromotionService
{
    public function getPreviousSession()
    {
        $lastTwoSessions = YearSession::orderBy('id', 'desc')
            ->take(2)
            ->get()
            ->toArray();
        return (count($lastTwoSessions) < 2) ? [] : $lastTwoSessions[1];
    }
    public function getLatestSession()
    {
        $year_session = YearSession::latest()->first();
        if ($year_session) {
            return $year_session;
        } else {
            return (object) ['id' => 0];
        }
    }
    public function getAll()
    {
        return YearSession::get();
    }

    public function getClasses($session_id)
    {
        return Promotion::with('classes')->select('class_id')
            ->where('session_id', $session_id)
            ->distinct('class_id')
            ->get();
    }
}
