<?php

/**
*  XHtmlSimpleElement 
* 
*  Used to generate Xhtml-Code for simple xhtml elements 
*  (i.e. elements, that can't contain child elements)
* 
* 
*  @author	Felix Meinhold
* 
*/
class XHtmlSimpleElement {
	public $_element;
	public $_siblings = array();
	public $_htmlcode;
	public $_attributes = array();

	
	/**
	* Constructor
	* 
	* @param	string	The element's name. Defaults to name of the 
	* derived class
	* 
	*/
	public function __construct($element = null) {

		$this->_element = $this->is_element();
		
	}

	public function set_style($style) {
		$this->set_attribute('style', $style);
	}
	
	public function set_class($class) {
		$this->set_attribute('class', $class);
	}

	
	public function is_element() {
		return 
			str_replace('xhtml_', '', strtolower(get_class($this)));
	}

	/**
	* Private function generates xhtml
	* @access private	
	*/
	public function _html() {
		$this->_htmlcode = "<";
		foreach ($this->_attributeCollection as $attribute => $value) {
			if (!empty($value)) $this->_htmlcode .= " {$attribute}=\"{$value}\"";
		}
		$this->_htmlcode .= "/>";
		
		return $this->_htmlcode;
	}
	
   /**
    * Returns xhtml code
    *  
    */
	public function fetch() {
		return $this->_html();
	}
	/**
	* Echoes xhtml
	* 
	*/	
	public function show()  {
		echo $this->fetch();
	}

	public function set_attribute($attr, $value) {
		$this->_attributes[$attr] = $value;
	}


}

/**
*  XHtmlElement 
* 
*  Used to generate Xhtml-Code for xhtml elements 
*  that can contain child elements
* 
* 
*/
class XHtmlElement extends XHtmlSimpleElement {
	public $_text     = null;
	public $_htmlcode = "";
	public $_siblings = array();

	public function __construct($text = null) {
		XHtmlSimpleElement::__construct();
		
		if ($text) $this->set_text($text);
	}

   /*
	* Adds an xhtml child to element
	* 
	* @param	XHtmlElement 	The element to become a child of element
	*/
	public function add(&$object) {
		array_push($this->_siblings, $object);
	}


 	/*
	* The CDATA section of Element
	* 
	* @param	string	Text
	*/
	public function set_text($text) {
		if ($text) $this->_text = htmlspecialchars($text);	
	}

	public function fetch() {
		return $this->_html();
	}


	public function _html() {

		$this->_htmlcode = "<{$this->_element}";
		foreach ($this->_attributes as $attribute =>$value) {
			if (!empty($value))	$this->_htmlcode .= " {$attribute} =\"{$value}\"";
		}
		$this->_htmlcode .= ">";

		
		if ($this->_text) { 
			$this->_htmlcode .= $this->_text;
		}
	
		foreach ($this->_siblings as $obj) {
			$this->_htmlcode .= $obj->fetch();
		}		

		$this->_htmlcode .= "</{$this->_element}>";
		
		return $this->_htmlcode;
	}

	/*
	* Returns siblings of Element
	* 
	*/
	public function get_siblings() {
		return $this->_siblings;
	}
	
	public function has_siblings() {
		return (count($this->_siblings) != 0);
	}
}

class XHTML_Button extends XHtmlElement {
	public function __construct($name, $text = null) {
		parent::__construct();
		
		$this->set_attribute("name", $name);
		
		if ($text) $this->set_text($text);
	}
}


class XHTML_Option extends XHtmlElement {
	public function __construct($text, $value = null) {
		XHtmlElement::__construct(null);
		$this->set_text($text);
	}
}


class XHTML_Select extends XHTMLElement {
	public $_data;

	public function __construct($name, $multiple = false, $size = null) {
		XHtmlElement::__construct();

		$this->set_attribute("name", $name);
		if ($multiple) $this->set_attribute("multiple","multiple");
		if ($size) $this->set_attribute("size",$size);
		
		
	}
	
	public function set_data(&$data, $delim = ",") {
		switch (gettype($data)) {
			case "string":
				$this->_data = explode($delim, $data);
				break;
			case "array":
				$this->_data = $data;
				break;
				
			default:
				break;
		}
	}
	
	public function fetch() {
		if (isset($this->_data) && $this->_data) {
			foreach ($this->_data as $value) { $this->add(new XHTML_Option($value)); }
		}
		return parent::fetch();
	}
	
}



