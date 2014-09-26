<?php

class block_pcbook_edit_form extends block_edit_form {
 
	protected function specific_definition($mform) {
		$mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
 
		$mform->addElement('text', 'config_uri', get_string('pcbook_uri', 'block_pcbook'));
		$mform->setDefault('config_uri', 'http://server.example.com/pcbook');
		$mform->setType('config_uri', PARAM_RAW);        

		$mform->addElement('text', 'config_wstitle', get_string('pcbook_wstitle', 'block_pcbook'));
		$mform->setDefault('config_wstitle', 'Workstation availability');
		$mform->setType('config_wstitle', PARAM_RAW);        

		$mform->addElement('text', 'config_wspattern', get_string('pcbook_wspattern', 'block_pcbook'));
		$mform->setDefault('config_wspattern', '');
		$mform->setType('config_wspattern', PARAM_RAW);        

		$mform->addElement('advcheckbox', 'config_showlink', get_string('pcbook_showlink', 'block_pcbook'));
		$mform->setDefault('config_showlink', '1');
		$mform->setType('config_showlink', PARAM_RAW);        
 
	}
}


