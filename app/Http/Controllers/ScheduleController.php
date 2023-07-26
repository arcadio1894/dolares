<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleDestroyRequest;
use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    protected $daysOfWeek = [
        ['day' => 1, 'nameDay' => 'Lunes - Viernes'],
        ['day' => 6, 'nameDay' => 'Sábado'],
        ['day' => 7, 'nameDay' => 'Domingo'],
    ];

    public function index()
    {
        $schedules = Schedule::orderBy('day')->get();

        return view('schedule.index', [
            'schedules' => $schedules,
            'daysOfWeek' => $this->daysOfWeek
        ]);
    }

    public function store( ScheduleStoreRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $foundDay = collect($this->daysOfWeek)->firstWhere('day', $request->get('day'));
            Schedule::create([
                'day' => $request->get('day'),
                'nameDay' => $foundDay['nameDay'],
                'hourStart' => $request->get('hourStart'),
                'hourEnd' => $request->get('hourEnd'),
                'active' => 1
            ]);

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Horario guardado correctamente.',
        ], 200);
    }

    public function update( ScheduleUpdateRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $schedule = Schedule::find($request->get('schedule_id'));
            $repeatSchedule = Schedule::where('day', $request->get('day'))
                ->where('id', '<>', $schedule->id)->first();
            if (isset($repeatSchedule))
            {
                return response()->json(['message' => "El dia seleccionado ya existe en el horario, elija otro día"], 422);
            }
            $foundDay = collect($this->daysOfWeek)->firstWhere('day', $request->get('day'));

            $schedule->day = $request->get('day');
            $schedule->nameDay = $foundDay['nameDay'];
            $schedule->hourStart = $request->get('hourStart');
            $schedule->hourEnd = $request->get('hourEnd');
            $schedule->save();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Horario modificado correctamente.',
        ], 200);
    }

    public function destroy( ScheduleDestroyRequest $request, $schedule_id )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $schedule = Schedule::find($request->get('schedule_id'));

            $schedule->delete();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Horario eliminado correctamente.',
        ], 200);
    }

    public function updateStatus( Request $request )
    {
        $schedule_id = $request->get('schedule_id');
        $status = $request->get('status');

        $schedule = Schedule::find($schedule_id);
        $schedule->active = $status;
        $schedule->save();

        return response()->json([
            'message' => 'Estado actualizado con éxito'
        ], 200);
    }
}
