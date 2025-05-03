<?php

namespace App\Controllers;

use App\Models\Department_model;

class InstrumentSlotController extends BaseController
{
    public function create_instrument_slots()
    {
        $department_model = new Department_model();
        $data = ['title' => 'Instrument Slots'];
        if($this->request->is('get')) {
            $data['department'] = $department_model->activeData();
            return view('admin/instrument_slots/create-instrument-slots',$data);
        } else if($this->request->is('post')){
            
        }
    }
    public function instrument_booking_report()
    {
        $data = ['title' => 'Instrument Slots Booking'];
        if($this->request->is('get')) {
            return view('admin/instrument_slots/instrument-booking-report',$data);
        } else if($this->request->is('post')){
            
        }
    }
}
