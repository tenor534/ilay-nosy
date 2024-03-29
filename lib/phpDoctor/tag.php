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

// $Id: tag.php,v 1.10 2006/12/16 21:31:17 peejeh Exp $

/** Represents a documentation tag, e.g. @since, @author, @version. Given a tag
 * (e.g. "@since 1.2"), holds tag name (e.g. "@since") and tag text (e.g.
 * "1.2"). Tags with structure or which require special processing are handled
 * by subclasses.
 *
 * @package PHPDoctor.Tags
 * @version $Revision: 1.10 $
 */
class Tag
{

	/** The name of the tag.
	 *
	 * @var str
	 */
	var $_name = NULL;

	/** The value of the tag.
	 *
	 * @var str
	 */
	var $_text = NULL;
		
	/** Reference to the root element.
	 *
	 * @var rootDoc
	 */
	var $_root = NULL;

	/** Reference to the elements parent.
	 *
	 * @var programElementDoc
	 */
	var $_parent = NULL;

	/**
	 * Constructor
	 *
	 * @param str name The name of the tag (including @)
	 * @param str text The contents of the tag
	 * @param RootDoc root The root object
	 */
	function tag($name, $text, &$root)
    {
		$this->_name = $name;
		$this->_root =& $root;
		$processedText = '';
		foreach(explode("\n", $text) as $line) {
			//$processedText .= trim($line, " \n\r\t\0\x0B*/")."\n";
			$processedText .= $line."\n"; // keep formatting
		}
		$this->_text = substr($processedText, 0, -1);
	}

	/** Get name of this tag.
	 *
	 * @return str
	 */
	function name()
    {
		return $this->_name;
	}

	/** Get display name of this tag.
	 *
	 * @return str
	 */
	function displayName()
    {
		return ucfirst(substr($this->_name, 1));
	}

	/** Get value of this tag.
	 *
	 * @return str
	 */
	function text()
    {
		return $this->_text;
	}
	
	/** Set this tags parent
	 *
	 * @param ProgramElementDoc element The parent element
	 */
	function setParent(&$element)
    {
		$this->_parent =& $element;
	}
	
	/**
	 * For documentation comment with embedded @link tags, return the array of
	 * tags. Within a comment string "This is an example of inline tags for a
	 * documentaion comment {@link Doc commentlabel}", where inside the inner
	 * braces, the first "Doc" carries exactly the same syntax as a SeeTag and
	 * the second "commentlabel" is label for the HTML link, will return an array
	 * of tags with first element as tag with comment text "This is an example of
	 * inline tags for a documentation comment" and second element as SeeTag with
	 * referenced class as "Doc" and the label for the HTML link as
	 * "commentlabel".
	 *
	 * @return Tag[] Array of tags with inline tags.
	 * @todo This method does not act as described but should be altered to do so
	 */
	function &inlineTags()
    {
		return $this->_getInlineTags($this->text());
	}
	
	/**
	 * Return the first sentence of the comment as tags. Includes inline tags
	 * (i.e. {@link reference} tags) but not regular tags. Each section of plain
	 * text is represented as a Tag of kind "Text". Inline tags are represented
	 * as a SeeTag of kind "link". The sentence ends at the first period that is
	 * followed by a space, tab, or a line terminator, at the first tagline, or
	 * at closing of a HTML block element (<p> <h1> <h2> <h3> <h4> <h5> <h6> <hr>
	 * <pre>).
	 *
	 * @return Tag[] An array of Tags representing the first sentence of the
	 * comment
	 * @todo This method does not act as described but should be altered to do so
	 */
	function &firstSentenceTags()
    {
		if (preg_match('/^(.+)\.( |\t|\r|\n|<\/p>|<\/?h[1-6]>|<hr)/sU', $this->text(), $matches)) {
			return $this->_getInlineTags($matches[1].'.'.$matches[2]);
		} else {
			$return = array(&$this);
            return $return;
		}
	}
	
	/**
	 * Parse out inline tags from within a text string
	 *
	 * @param str text
	 * @return Tag[]
	 */
	function &_getInlineTags($text)
    {
        $return = NULL;
		$tagStrings = preg_split('/{(@.+)}/sU', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
		if ($tagStrings) {
			$inlineTags = NULL;
			$phpdoctor =& $this->_root->phpdoctor();
			foreach ($tagStrings as $tag) {
				if (substr($tag, 0, 1) == '@') {
					$pos = strpos($tag, ' ');
					if ($pos !== FALSE) {
						$name = trim(substr($tag, 0, $pos));
						$text = trim(substr($tag, $pos + 1));
					} else {
						$name = $tag;
						$text = NULL;
					}
				} else {
					$name = '@text';
					$text = $tag;
				}
				$data = NULL;
				$inlineTag =& $phpdoctor->createTag($name, $text, $data, $this->_root);
				$inlineTag->setParent($this->_parent);
				$inlineTags[] = $inlineTag;
			}
			$return =& $inlineTags;
		}
		return $return;
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
		return TRUE;
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
		return TRUE;
	}

	/** Return true if this Taglet is used in package documentation.
     *
     * @return bool
     */
	function inPackage()
    {
		return TRUE;
	}

	/** Return true if this Taglet is used in class or interface documentation.
     *
     * @return bool
     */
	function inType()
    {
		return TRUE;
	}

	/** Return true if this Taglet is an inline tag.
     *
     * @return bool
     */
	function isInlineTag()
    {
		return FALSE;
	}
	
	/** Return true if this Taglet should be outputted even if it has no text content.
     *
     * @return bool
     */
	function displayEmpty()
    {
		return TRUE;
	}

}

?>