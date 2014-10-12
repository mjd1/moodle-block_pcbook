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

class block_pcbook extends block_base {

    function get_status() {
    	$uri=$this->config->uri;
    	$wstitle=$this->config->wstitle;
    	$wspattern=$this->config->wspattern;
    	$showlink=$this->config->showlink;

    	$ctx = stream_context_create(array('http'=>array('timeout'=>2)));
    	$s=file_get_contents($uri."/api", 0, $ctx);
    	if($s===FALSE) return "<p>".get_string('connect_error', 'block_pcbook')."</p>";

    	$j=json_decode($s)->{'availability'};
    	$num_ws=0;
    	$num_booked=0;
    	$num_inuse=0;
    	foreach($j as $b) {
    		$a=get_object_vars($b);
    		$ws=$a{'hostname'};
    		$booked=$a{'booking_status'};
    		$in_use=$a{'in_use'};

    		if(!preg_match("/".$wspattern."/", $ws)) continue;

    		$num_ws++;
    		if($booked=="Booked") $num_booked++;
    		if($in_use=="In use") $num_inuse++;
    	}
    	if($num_ws==0) return "<p>".get_string('no_workstations', 'block_pcbook')."</p>";

    	$output="<h4>".$wstitle."</h4>"
    		."<ul>"
    		."<li>".$num_ws." ".get_string('workstations', 'block_pcbook')."</li>"
    		."<li>".$num_booked." ".get_string('booked', 'block_pcbook')
    		.", ".$num_inuse." ".get_string('in_use', 'block_pcbook')."</li>"
    		."<li>".($num_ws-(($num_booked>$num_inuse)?($num_booked):($num_inuse)))
    		." ".get_string('free', 'block_pcbook')."</li>"
    		."</ul>";

    	if($showlink) $output.='<p><a href="'.$uri.'">'.get_string('book_computer', 'block_pcbook').'</a></p>';

    	return $output;
    }

    public function get_content() {
    	if ($this->content !== null) { return $this->content; }
    	$this->content=new stdClass;
    	$this->content->text=$this->get_status();
    	$this->content->footer='';
    	return $this->content;
    }

    public function init() {
    	$this->title=get_string('pcbook', 'block_pcbook');
    }

    public function instance_allow_multiple() {
    	return true;
    }

}


