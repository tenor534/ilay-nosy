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

// $Id: constructorDoc.php,v 1.5 2005/05/08 21:53:30 peejeh Exp $

/** Represents a PHP constructor.
 *
 * @package PHPDoctor
 * @version $Revision: 1.5 $
 */
class ConstructorDoc extends ExecutableDoc
{

	/** Construct is a constructor.
	 *
	 * @return bool
	 */
	function isConstructor()
    {
		return TRUE;
	}

}

?>