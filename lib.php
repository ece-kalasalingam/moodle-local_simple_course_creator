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
 * Code for adding a link to category menu
 * @package local
 * @subpackage simple_course_creator
 * @copyright  2019 Queen Mary University of London
 * @author     Shubhendra R Doiphode <doiphode.sunny@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

/**
 * Hook to insert a link in settings navigation menu block
 *
 * @param settings_navigation $navigation
 * @param course_context $context
 * @return void
 */
function local_simple_course_creator_extend_settings_navigation(settings_navigation $navigation, $context) {


    global $CFG, $DB,$PAGE;
    // If not in a course category context, then leave.
    if ($context == null) {
        return;
    }
    if (null == ($categorynode = $navigation->get('categorysettings'))) {
        return;
    }
    if($context->contextlevel != CONTEXT_COURSECAT) {
        return false;
    }


    if (has_capability('moodle/course:create', $context)) {
        $url = new moodle_url('/local/simple_course_creator/view.php', array('category' => $context->instanceid));
        $categorynode->add(get_string('pluginname', 'local_simple_course_creator'), $url, navigation_node::TYPE_SETTING, null, 'simple_course_create', new pix_icon('i/return', ''));
    }

}