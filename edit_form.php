<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
 
/**
 * The pcbook block links to a pcbook server and shows how many
 * computers are free.
 *
 * The pcbook home page is at http://valis.co.uk/pcbook
 *
 * @package    block_pcbook
 * @copyright  2014 Mike Dawson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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


