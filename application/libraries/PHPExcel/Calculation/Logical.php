<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2012 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @category	PHPExcel
 * @package		PHPExcel_Calculation
 * @copyright	Copyright (c) 2006 - 2012 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license		http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version		1.7.8, 2012-10-12
 */


/** PHPExcel root directory */
if (!defined('PHPEXCEL_ROOT')) {
	/**
	 * @ignore
	 */
	define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../../');
	require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}


/**
 * PHPExcel_Calculation_Logical
 *
 * @category	PHPExcel
 * @package		PHPExcel_Calculation
 * @copyright	Copyright (c) 2006 - 2012 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_Calculation_Logical {

	/**
	 * TRUE
	 *
	 * Returns the boolean TRUE.
	 *
	 * Excel Function:
	 *		=TRUE()
	 *
	 * @access	public
	 * @category Logical Functions
	 * @return	boolean		True
	 */
	public static function TRUE() {
		return TRUE;
	}	//	function TRUE()


	/**
	 * FALSE
	 *
	 * Returns the boolean FALSE.
	 *
	 * Excel Function:
	 *		=FALSE()
	 *
	 * @access	public
	 * @category Logical Functions
	 * @return	boolean		False
	 */
	public static function FALSE() {
		return FALSE;
	}	//	function FALSE()


	/**
	 * LOGICAL_AND
	 *
	 * Returns boolean TRUE if all its arguments are TRUE; returns FALSE if one or more argument is FALSE.
	 *
	 * Excel Function:
	 *		=AND(logical1[,logical2[, ...]])
	 *
	 *		The arguments must evaluate to logical values such as TRUE or FALSE, or the arguments must be arrays
	 *			or references that contain logical values.
	 *
	 *		Boolean arguments are treated as True or False as appropriate
	 *		Integer or floating point arguments are treated as True, except for 0 or 0.0 which are False
	 *		If any argument value is a string, or a Null, the function returns a #VALUE! error, unless the string holds
	 *			the value TRUE or FALSE, in which case it is evaluated as the corresponding boolean value
	 *
	 * @access	public
	 * @category Logical Functions
	 * @param	mixed		$arg,...		Data values
	 * @return	boolean		The logical AND of the arguments.
	 */
	public static function LOGICAL_AND() {
		// Returnixed	The value of returnIfTrue or returnIfFalse determined by condition
	 */
	public static function STATEMENT_IF($condition = TRUE, $returnIfTrue = 0, $returnIfFalse = FALSE) {
		$condition		= (is_null($condition))		? TRUE :	(boolean) PHPExcel_Calculation_Functions::flattenSingleValue($condition);
		$returnIfTrue	= (is_null($returnIfTrue))	? 0 :		PHPExcel_Calculation_Functions::flattenSingleValue($returnIfTrue);
		$returnIfFalse	= (is_null($returnIfFalse))	? FALSE :	PHPExcel_Calculation_Functions::flattenSingleValue($returnIfFalse);

		return ($condition) ? $returnIfTrue : $returnIfFalse;
	}	//	function STATEMENT_IF()


	/**
	 * IFERROR
	 *
	 * Excel Function:
	 *		=IFERROR(testValue,errorpart)
	 *
	 * @access	public
	 * @category Logical Functions
	 * @param	mixed	$testValue	Value to check, is also the value returned when no error
	 * @param	mixed	$errorpart	Value to return when testValue is an error condition
	 * @return	mixed	The value of errorpart or testValue determined by error condition
	 */
	public static function IFERROR($testValue = '', $errorpart = '') {
		$testValue	= (is_null($testValue))	? '' :	PHPExcel_Calculation_Functions::flattenSingleValue($testValue);
		$errorpart	= (is_null($errorpart))	? '' :	PHPExcel_Calculation_Functions::flattenSingleValue($errorpart);

		return self::STATEMENT_IF(PHPExcel_Calculation_Functions::IS_ERROR($testValue), $errorpart, $testValue);
	}	//	function IFERROR()

}	//	class PHPExcel_Calculation_Logical
