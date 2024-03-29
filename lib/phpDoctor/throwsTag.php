<?php
/*
PHPDoctor: The PHP Documentation Creator
Copyright (C) 2004 Paul James <paul@peej.co.uk>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// $Id: throwsTag.php,v 1.5 2005/05/08 21:53:30 peejeh Exp $

require_once('seeTag.php');

/** Represents a throws tag.
 *
 * @package PHPDoctor.Tags
 * @version $Revision: 1.5 $
 */
class ThrowsTag extends SeeTag
{

	/**
	 * Constructor
	 *
	 * @param str text The contents of the tag
	 * @param str[] data Reference to doc comment data array
	 * @param RootDoc root The root object
	 * @param ProgramElementDoc parent The tags parent element
	 */
	function throwsTag($text, &$data, &$root)
    {
		$explode = preg_split('/[ \t]+/', $text);
		$this->_link = array_shift($explode);
		$data['throws'][$this->_link] = $this->_link;
		parent::tag('@throws', join(' ', $explode), $root);
	}

	/** Get display name of this tag.
	 *
	 * @return str
	 */
	function displayName()
    {
		return 'Throws';
	}
	
	/** Return true if this Taglet is used in constructor documentation.
     *
     * @return bool
     */
	function inConstructor()
    {
		return TRUE;
	}

	/** Return true if this Taglet is used in field documentation.
     *
     * @return bool
     */
	function inField()
    {
		return FALSE;
	}

	/** Return true if this Taglet is used in method documentation.          
     *
     * @return bool
     */
	function inMethod()
    {
		return TRUE;
	}

	/** Return true if this Taglet is used in overview documentation.
     *
     * @return bool
     */
	function inOverview()
    {
		return FALSE;
	}

	/** Return true if this Taglet is used in package documentation.
     *
     * @return bool
     */
	function inPackage()
    {
		return FALSE;
	}

	/** Return true if this Taglet is used in class or interface documentation.
     *
     * @return bool
     */
	function inType()
    {
		return FALSE;
	}

	/** Return true if this Taglet is an inline tag.
     *
     * @return bool
     */
	function isInlineTag()
    {
		return FALSE;
	}

}

?>