<?php

namespace Database\Seeders;

use App\Models\ExamSession;
use App\Models\TimeSlot;
use App\Models\Exam;
use App\Models\ClassModel;
use App\Models\Room;
use Illuminate\Database\Seeder;

class ExamSessionSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 exam sessions per class (mid-term and final)
        ClassModel::all()->each(function ($class) {
            // Mid-term exam session
            $midTermSession = ExamSession::create([
                'name' => "Contrôle Continu - {$class->name_fr}",
                'class_id' => $class->id,
                'start_date' => now()->addMonths(2),
                'end_date' => now()->addMonths(2)->addDays(5),
                'status' => 'pending',
            ]);

            // Final exam session
            $finalSession = ExamSession::create([
                'name' => "Examen Final - {$class->name_fr}",
                'class_id' => $class->id,
                'start_date' => now()->addMonths(5),
                'end_date' => now()->addMonths(5)->addDays(7),
                'status' => 'pending',
            ]);

            // Create time slots and exams for each session
            $this->createTimeSlotsAndExams($midTermSession);
            $this->createTimeSlotsAndExams($finalSession);
        });
    }

    private function createTimeSlotsAndExams(ExamSession $session): void
    {
        $startDate = $session->start_date;
        $endDate = $session->end_date;
        $rooms = Room::where('is_active', true)->get();

        // Create 2 time slots per day
        for ($date = $startDate; $date <= $endDate; $date = $date->copy()->addDay()) {
            TimeSlot::create([
                'exam_session_id' => $session->id,
                'exam_date' => $date,
                'slot_number' => 1,
                'start_time' => '08:00',
                'end_time' => '10:30',
            ]);

            TimeSlot::create([
                'exam_session_id' => $session->id,
                'exam_date' => $date,
                'slot_number' => 2,
                'start_time' => '13:00',
                'end_time' => '15:30',
            ]);
        }

        // Create exams for each group/module combination
        $timeSlots = $session->timeSlots;
        $slotIndex = 0;

        foreach ($session->class->groups as $group) {
            foreach ($session->class->modules as $module) {
                if ($slotIndex >= $timeSlots->count())
                    break;

                $exam = Exam::create([
                    'exam_session_id' => $session->id,
                    'module_id' => $module->id,
                    'group_id' => $group->id,
                    'time_slot_id' => $timeSlots[$slotIndex]->id,
                    'student_count' => $group->current_students,
                    'status' => 'scheduled',
                ]);

                // Assign rooms based on student count
                $studentsRemaining = $group->current_students;
                foreach ($rooms as $room) {
                    if ($studentsRemaining <= 0)
                        break;

                    $seatsUsed = min($studentsRemaining, $room->capacity);
                    $exam->rooms()->attach($room->id, ['seats_used' => $seatsUsed]);
                    $studentsRemaining -= $seatsUsed;
                }

                $slotIndex++;
            }
        }
    }
}
