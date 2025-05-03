<?php

namespace App\Controllers;

class InstrumentSlotController extends BaseController
{
    public function create_instrument_slots()
    {
        $data = ['title' => 'Instrument Slots'];
        if($this->request->is('get')) {
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
