<?php
/**
 * JComments - Joomla Comment System
 *
 * @version       3.0
 * @package       JComments
 * @author        Sergey M. Litvinov (smart@joomlatune.ru)
 * @copyright (C) 2006-2022 by Sergey M. Litvinov (http://www.joomlatune.ru) & exstreme (https://protectyoursite.ru) & Vladimir Globulopolis (https://xn--80aeqbhthr9b.com/ru/)
 * @license       GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class JCommentsViewAbout extends HtmlView
{
	/**
	 * @var   JCommentsVersion
	 * @since 4.0
	 */
	protected $version;

	function display($tpl = null)
	{
		require_once JPATH_BASE . '/components/com_jcomments/version.php';

		$this->version = new JCommentsVersion;
		ToolbarHelper::title(JText::_('A_SUBMENU_ABOUT'));
		ToolbarHelper::preferences('com_jcomments');

		parent::display($tpl);
	}
}
