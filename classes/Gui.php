<?php
	/**
	 * Class to handle basic HTML GUI functions
	 *
	 * $Id: Gui.php,v 1.2 2004/06/07 20:03:22 soranzo Exp $
	 */
	 class GUI {

		/**
		 *Constructor
		 */
		public function __construct() {}

         /**
          * Prints a combox box
          * @param $arrOptions associative array storing options and values of combo should be Option => Value
          * @param $szName string to specify the name of the form element
          * @param bool $bBlankEntry
          * @param string $szDefault
          * @param bool $bMultiple
          * @param int $iSize
          * @return string with the generated HTML select box
          */
		public function printCombo(&$arrOptions, $szName, $bBlankEntry = true, $szDefault = '', $bMultiple = false, $iSize = 10) {
			$htmlOut = '';
			if ($bMultiple) // If multiple select combo
				$htmlOut .= "<select name=\"$szName\" id=\"$szName\" multiple=\"multiple\" size=\"$iSize\">\n";
			else
				$htmlOut .= "<select name=\"$szName\" id=\"$szName\">\n";
			if ($bBlankEntry)
				$htmlOut .= "<option value=\"\"></option>\n";				
			
			foreach ($arrOptions as $curKey => $curVal) {
				$curVal = htmlspecialchars($curVal);
				$curKey = htmlspecialchars($curKey);
				if ($curVal == $szDefault) {			
					$htmlOut .= "<option value=\"$curVal\" selected=\"selected\">$curKey</option>\n";	
				}
				else {
					$htmlOut .= "<option value=\"$curVal\">$curKey</option>\n";	
				}
			}
			$htmlOut .= "</select>\n";

			return $htmlOut;
		}
	 }

