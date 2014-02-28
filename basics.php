<?php

// File generated on 02.28.2014 5:30pm by Benftwc <benftwc@gmail.com>


function getNodes($aNids) {
	if (is_array($aNids)) {
		return node_load_multiple($aNids);
	} else {
		return node_load($aNids);
	}
}

function getNids($aParams) {

	foreach ($aParams as $sParam => $sValue) {
	
		switch ($sParam){
			case 'type':
				$query->fieldCondition('type', '=', $sValue);
				break;
				
			case 'author':
				$query->fieldCondition('uid', '=', $sValue);
				break;
				
			case 'date':
				if (isset($sValue['operator']) && isset($sValue['from'])) {
					if(isset($sValue['to']) && $sValue['operator'] === "BETWEEN"){
						$query->fieldCondition('date', 'BETWEEN', array($sValue['from'], $sValue['to']));
					} else {
						$query->fieldCondition('date', $sValue['operator'], $sValue['from']);
					}
				}
				break;
				
			case default:
				break;
		}
	}

}

function getTerms($aParams) {
	// TODO : à faire
}

function getSettings($aSettings) {
	if (is_array($aSettings)) {
		$aOutput = array();
		foreach ($aSettings as $sSetting) {
			$aOutput[$aSetting] = variable_get($sSetting, NULL);
		}
	} else {
		$aOutput[$aSettings] = variable_get($aSettings, NULL);
	}
	
	return $aOutput;
}

function setSettings($aSettings) {

	if (is_array($aSettings)) {
		foreach ($aSettings as $sSetName => $sSetValue) {
			variable_set($sSetName, $sSetValue);
		}
	} else {
		throw new DrupordovaException('setSettings array expected, ' . gettype($aSettings) . ' given.', 400);

}



class DrupordovaException extends Exception { 
        
        public function __construct($message, $code=0) 
        { 
            parent::__construct($message,$code); 
        }    

        public function __toString() 
        { 
            return "<b style='color:red'>[".$this->code . "] ".$this->message."</b>"; 
        } 
        
        
} 
