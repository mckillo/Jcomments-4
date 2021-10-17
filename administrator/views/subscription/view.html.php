<?php
/**
 * JComments - Joomla Comment System
 *
 * @version       4.0
 * @package       JComments
 * @author        Sergey M. Litvinov (smart@joomlatune.ru) & exstreme (info@protectyoursite.ru) & Vladimir Globulopolis
 * @copyright (C) 2006-2022 by Sergey M. Litvinov (http://www.joomlatune.ru) & exstreme (https://protectyoursite.ru) & Vladimir Globulopolis (https://xn--80aeqbhthr9b.com/ru/)
 * @license       GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Content\Administrator\Helper\ContentHelper;

class JCommentsViewSubscription extends HtmlView
{
	protected $item;
	protected $form;
	protected $state;

	function display($tpl = null)
	{
		$this->item  = $this->get('Item');
		$this->form  = $this->get('Form');
		$this->state = $this->get('State');

		$this->addToolbar();

		parent::display($tpl);
	}

	protected function addToolbar()
	{
		$userId     = Factory::getApplication()->getIdentity()->get('id');
		$canDo      = ContentHelper::getActions('com_jcomments', 'component');
		$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
		$isNew      = ($this->item->id == 0);

		Factory::getApplication()->input->set('hidemainmenu', 1);

		$title = $isNew ? Text::_('A_SUBSCRIPTION_NEW') : Text::_('A_SUBSCRIPTION_EDIT');
		ToolbarHelper::title($title);

		if (!$checkedOut && $canDo->get('core.edit'))
		{
			ToolbarHelper::apply('subscription.apply');
			ToolbarHelper::save('subscription.save');
		}

		if (!$isNew && $canDo->get('core.create'))
		{
			ToolbarHelper::save2new('subscription.save2new');
		}

		if ($isNew)
		{
			ToolbarHelper::cancel('subscription.cancel');
		}
		else
		{
			ToolbarHelper::cancel('subscription.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
