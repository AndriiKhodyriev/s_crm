<?php
// apt-get install snmp snmpd

namespace App\Http\Controllers;

//use OnurKose\SNMPWrapper;
use SNMPWrapper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SNMPController extends Controller
{

     public function index() { 
        //$users = User::orderBy('id', 'desc')->paginate(10);

        return view('snmp.index');
    }

    public function getONUInfo(Request $request)
    {
        
    	$this->validate($request, [
            'oltIP' => 'required',
            'onuMAC'    => 'required',
        ]);
        $oltIP = $request->oltIP;
        $onuMAC = $request->onuMAC;
        
        $snmp = new SNMPWrapper();
        
        $snmp::setHost($oltIP, 'itstatus_ro_comm');
        
        
        
        //все интерфейсы на голове
        $snmpAllInterfaces = $snmp::walk('.1.3.6.1.4.1.3320.101.10.1.1.3');
    	//dd($snmpAllInterfaces);
    	if(count($snmpAllInterfaces) < 1) {
    		//$errorMsg = 'нет такой головы';
    		$response = array(
			            
			            'successMsg' => 'none',
			            'errorMsg' => '<strong>НET такой головы</strong>',
			        );
    		//echo $errorMsg;
    	} else {
    			//ищем номер нужного интерфейса по маку ОНУ
		    	foreach($snmpAllInterfaces as $snmpInterface=>$snmpWantedMac) {
		    		//echo (strtolower(str_replace(' ', '', $snmpWantedMac)) == $onuMAC);
		    		if (strtolower(str_replace(' ', '', $snmpWantedMac)) == $onuMAC) {
		    			//echo str_replace('.1.3.6.1.4.1.3320.101.10.1.1.3.', '', $snmpWantedInterface);
		    			$snmpWantedInterface = str_replace('.1.3.6.1.4.1.3320.101.10.1.1.3.', '', $snmpInterface);
		    			break;

		    		} else {
		    			$snmpWantedInterface = false;
		    		}
		    	}
	    	
		    	if ($snmpWantedInterface) {
		    		//выясняем статус онушки(online or offline)
		    		$snmpONUStatus = $snmp::walk('.1.3.6.1.2.1.2.2.1.8.'.$snmpWantedInterface);
			    	//1 - up
			    	//2- down
			    	
			    	$snmpONUStatus = $snmpONUStatus['.1.3.6.1.2.1.2.2.1.8.'.$snmpWantedInterface];
			    	if ($snmpONUStatus == 1) {
			    		$snmpONUStatus = 'ONLINE';
			    		//выясняем влан ОНУ
			    		$snmpONUVlan = $snmp::walk('.1.3.6.1.4.1.3320.101.12.1.1.3.'.$snmpWantedInterface);
			    		$snmpONUVlan = $snmpONUVlan['.1.3.6.1.4.1.3320.101.12.1.1.3.'.$snmpWantedInterface.'.1'];
			    		$successMsg = 'ОНУ в сети. Влан - <strong>'.$snmpONUVlan.'</strong>';
			    		$errorMsg = 'none';


			    	} else {
			    		$successMsg = 'none';
			    		//$snmpONUStatus = 'OFFLINE';
			    		//$snmpONUVlan = 'none';
			    		$errorMsg = '<strong>ОНУ выключена. Какой уж тут ВЛАН?!</strong>';
			    	}
			    	
			    	$response = array(
			            // 'status' => 'success',
						//'onuStatus' => $snmpONUStatus,            
			            //'onuVlan' => $snmpONUVlan,
			            'successMsg' => $successMsg,
			            'errorMsg' => $errorMsg,
			        );
		    	} else {
		    		//$succesMsg = 'none';
		    		//$errorMsg = 'На этой голове НЕТ ОНУ с таким МАК-адресом';
		    		$response = array(
			            
			            'successMsg' => 'none',
			            'errorMsg' => '<strong>На этой голове НЕТ ОНУ с таким МАК-адресом</strong>',
			        );
	    		}
	    	
	    	}
    
    	
    	//echo $errorMsg;
    	return response()->json($response);
    }
}