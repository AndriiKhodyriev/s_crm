<?php
// apt-get install snmp snmpd

namespace App\Http\Controllers;

//use OnurKose\SNMPWrapper;
use SNMPWrapper;

use App\Http\Controllers\Controller;

class SNMPController extends Controller
{

    public function getTest()
    {
        $snmp = new SNMPWrapper();
        
        $snmp::setHost('10.251.0.1', 'itstatus_ro_comm');
        
        dd($snmp::walk('.1.3.6.1.2.1.31.1.1.1.1'));
    }
}