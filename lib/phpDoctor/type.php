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

// $Id: type.php,v 1.5 2005/05/08 21:53:30 peejeh Exp $

/** Represents a PHP variable type. Type can be a class or primitive data type.
 *
 * @package PHPDoctor
 * @version $Revision: 1.5 $
 */
class Type
{

	/** The name of the type.
	 *
	 * @var str
	 */
	var $_name = NULL;

	/** The number of dimensions this type has.
	 *
	 * @var int
	 */
	var $_dimension = 0;

	/** Reference to the root element.
	 *
	 * @var rootDoc
	 */
	var $_root = NULL;

	/** Constructor
     *
     * @param str name The name of the variable type
     * @param RootDoc root The RootDoc object to tie this type too
	 */
	function type($name, &$root)
    {
		while (substr($name, -2) == '[]') {
			$this->_dimension++;
			$name = substr($name, 0, -2);
		}
		$this->_name = $name;
		$this->_root =& $root;
	}

	/** Get name of this type.
	 *
	 * @return str
	 */
	function typeName()
    {
		return $this->_name;
	}

	/** Return the type's dimension information, as a string.
	 *
	 * @return str
	 */
	function dimension()
    {
		return str_repeat('[]', $this->_dimension);
	}

	/** Get qualified name of this type.
	 *
	 * @return str
     * @todo This method is still to be implemented
	 */
	function qualifiedTypeName()
    {
        return $this->typeName();
    }

	/** Returns a string representation of the type.
	 *
	 * @return str
	 */
	function toString()
    {
		return $this->_name.$this->dimension();
	}

	/** Return this type as a class.
	 *
	 * @return ClassDoc A classDoc if the type is a class, null if it is a primitive type.
	 */
	function &asClassDoc()
    {
		return $this->_root->classNamed($this->_name);
	}

}

?>