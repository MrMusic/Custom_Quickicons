<?php
/*
 *  package: Custom-Quickicons
 *  copyright: Copyright (c) 2024. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 2 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\Database\DatabaseInterface;

class mod_custom_quickiconInstallerScript
{
    /**
     * Minimum Joomla version to check
     *
     * @var    string
     * @since  5.0.0
     */
    private $minimumJoomlaVersion = '5.0';

    /**
     * Minimum PHP version to check
     *
     * @var    string
     * @since  5.0.0
     */
    private $minimumPHPVersion = JOOMLA_MINIMUM_PHP;


    /**
     * Function called before extension installation/update/removal procedure commences
     *
     * @param string $type The type of change (install, update or discover_install, not uninstall)
     * @param InstallerAdapter $parent The class calling this method
     * @return  boolean  True on success
     * @throws Exception
     * @since  5.0.0
     */
    public function preflight($type, $parent): bool
    {
        if ($type !== 'uninstall')
        {
            // Check for the minimum PHP version before continuing
            if (!empty($this->minimumPHPVersion) && version_compare(PHP_VERSION, $this->minimumPHPVersion, '<'))
            {
                Log::add(
                    Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPHPVersion),
                    Log::WARNING,
                    'jerror'
                );
                return false;
            }
            // Check for the minimum Joomla version before continuing
            if (!empty($this->minimumJoomlaVersion) && version_compare(JVERSION, $this->minimumJoomlaVersion, '<'))
            {
                Log::add(
                    Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomlaVersion),
                    Log::WARNING,
                    'jerror'
                );
                return false;
            }
        }
        return true;
    }

	/**
	 * Function called after extension installation/update/removal procedure commences
	 *
	 * @param string $type The type of change (install, update or discover_install, not uninstall)
	 * @param InstallerAdapter $parent The class calling this method
	 * @return  boolean  True on success
	 * @since  4.0.0
	 */
	public function postflight($type, $parent)
	{
		if ($type === 'install')
		{
        // install and enable module
        $title     = 'mod_custom_quickicon';
        $position  = 'cpanel';
        $module    = 'mod_custom_quickicon';
        $params    = '{"show_robots":"0","article_items":[],"category_items":[],"module_items":[],"custom_items":[],"show_global":"0","show_checkin":"0","show_cache":"0","show_users":"0","show_articles":"0","show_featured":"0","show_menuitems":"1","show_workflow":"0","show_banners":"0","show_finder":"0","show_newsfeeds":"0","show_tags":"0","show_redirect":"0","show_associations":"0","show_languages":"0","show_modules":"0","show_contact":"0","show_categories":"0","show_media":"0","show_plugins":"0","show_extensions":"1","show_template_styles":"0","show_template_code":"0","show_joomgallery_control_panel":"1","show_joomgallery_images":"1","show_joomgallery_upload":"1","show_joomgallery_categories":"1","show_joomgallery_configs":"1","show_joomgallery_tags":"1","ecommerce_component":"HikaShop","show_djcatalog_dashboard":"0","show_djcatalog_products":"0","show_djcatalog_categories":"0","show_djcatalog_customers":"0","show_djcatalog_orders":"0","show_djcatalog_subscriptions":"0","show_djcatalog_pricerules":"0","show_djcatalog_coupons":"0","show_djcatalog_producers":"0","show_djcatalog_vendors":"0","show_djcatalog_reviews":"0","show_djcatalog_messages":"0","show_djcatalog_pricesstock":"0","show_djcatalog_config":"0","show_eshop_dashboard":"0","show_eshop_products":"0","show_eshop_downloads":"0","show_eshop_categories":"0","show_eshop_customers":"0","show_eshop_orders":"0","show_eshop_quotes":"0","show_eshop_discounts":"0","show_eshop_coupons":"0","show_eshop_vouchers":"0","show_eshop_manufacturers":"0","show_eshop_reviews":"0","show_eshop_notify":"0","show_eshop_config":"0","show_hikashop_dashboard":"0","show_hikashop_products":"0","show_hikashop_categories":"0","show_hikashop_users":"0","show_hikashop_orders":"0","show_hikashop_discounts":"0","show_hikashop_coupons":"0","show_hikashop_carts":"0","show_hikashop_wishlist":"0","show_hikashop_waitlist":"0","show_hikashop_emailhistory":"0","show_hikashop_config":"0","show_j2store_dashboard":"0","show_j2store_products":"0","show_j2store_inventory":"0","show_j2store_vendors":"0","show_j2store_manufacturers":"0","show_j2store_orders":"0","show_j2store_customers":"0","show_j2store_coupons":"0","show_j2store_vouchers":"0","show_j2store_reports":"0","show_j2store_config":"0","show_phocacart_dashboard":"0","show_phocacart_products":"0","show_phocacart_categories":"0","show_phocacart_customers":"0","show_phocacart_orders":"0","show_phocacart_wishlists":"0","show_phocacart_rewardspoints":"0","show_phocacart_questions":"0","show_phocacart_discounts":"0","show_phocacart_coupons":"0","show_phocacart_manufacturers":"0","show_phocacart_vendors":"0","show_phocacart_reviews":"0","show_phocacart_reports":"0","show_phocacart_openingtimes":"0","show_phocacart_config":"0","show_virtuemart_products":"0","show_virtuemart_categories":"0","show_virtuemart_shoppers":"0","show_virtuemart_orders":"0","show_virtuemart_coupons":"0","show_virtuemart_reviews":"0","show_virtuemart_manufacturers":"0","show_virtuemart_salesreport":"0","show_virtuemart_inventory":"0","show_virtuemart_config":"0","context":"mod_custom_quickicon","header_icon":"fas fa-desktop","hue":"hsl(214, 63%, 20%)","layout":"_:default","moduleclass_sfx":"","cache":0,"cache_time":900,"module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}';
        $client_id = 1;
        $lang      = '*';

        // check if the module already exists
        $db    = Factory::getContainer()->get(DatabaseInterface::class);
        $query = $db->getQuery(true)
                  ->select('id')
                  ->from($db->quoteName('#__modules'))
                  ->where($db->quoteName('position').' = '.$db->quote($position))
                  ->where($db->quoteName('module').' = '.$db->quote($module));
        $db->setQuery($query);
        $module_id = $db->loadResult();

        // create module if it is not yet created
        if (empty($module_id))
        {
          $row            = Table::getInstance('module');
          $row->title     = 'Custom Quick Icons (JoomGallery)';
          $row->ordering  = 1;
          $row->position  = $position;
          $row->published = 1;
          $row->module    = $module;
          $row->access    = 1;
          $row->showtitle = 1;
          $row->params    = $params;
          $row->client_id = $client_id;
          $row->language  = $lang;
          if(!$row->store())
          {
            Factory::getApplication()->enqueueMessage(Text::_('Unable to create "'.$title.'" module!'), 'error');

            return false;
          }

          // Add menu entry
          $db      = Factory::getContainer()->get(DatabaseInterface::class);
          $query   = $db->getQuery(true);
          $columns = array('moduleid', 'menuid');
          $values  = array($row->id, 0);

          $query
            ->insert($db->quoteName('#__modules_menu'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

          $db->setQuery($query);
          $db->execute();

        }  // ende if module_id
			echo '<style>a[target="_blank"]::before {display: none};</style>';
			echo '<div class="mb-3 text-center"><img src="https://www.joomill.nl/images/logo_joomill.png" alt="Joomill Logo" /></div>';
			echo '<div class="mb-3 text-center"><strong>' . Text::_('MOD_CUSTOM_QUICKICON_XML_DESCRIPTION') . '</strong></div>';
			echo '<br>';
			echo '<h3 class="text-center">' . Text::_('MOD_CUSTOM_QUICKICON_INSTALL_THANKYOU') . '</h3>';
			echo '<br>';
			echo '<h3>' . Text::_('MOD_CUSTOM_QUICKICON_INSTALL_QUICKSTART') . ':</h3>';
			echo '<ol>';
			echo '<li><a style="text-decoration: underline;" href="index.php?option=com_modules&view=modules&client_id=1&filter[module]=mod_custom_quickicon" target="_blank">' . Text::_('MOD_CUSTOM_QUICKICON_INSTALL_QUICKSTART_SETUP1') . '</a> ';
			echo '<li>' . Text::_('MOD_CUSTOM_QUICKICON_INSTALL_QUICKSTART_SETUP2');
			echo '<li>' . Text::_('MOD_CUSTOM_QUICKICON_INSTALL_QUICKSTART_SETUP3');
			echo '</ol>';
			echo '<hr>';
			echo '<div class="text-center">' . Text::_('MOD_CUSTOM_QUICKICON_INSTALL_FOLLOWME') . ':</div>';
			echo '<div class="text-center">';
			echo '<a class="m-2" href="https://joomla.social/@joomill" target="_blank"><i class="fa-brands fa-mastodon"></i> </i></a>';
			echo '<a class="m-2" href="https://www.twitter.com/Joomill" target="_blank"><i class="fa-brands fa-brands fa-x-twitter"> </i></a>';
			echo '<a class="m-2" href="https://www.facebook.com/Joomill" target="_blank"><i class="fa-brands fa-facebook-f"> </i></a>';
			echo '<a class="m-2" href="https://www.instagram.com/Joomill" target="_blank"><i class="fa-brands fa-instagram"> </i></a>';
			echo '<a class="m-2" href="https://www.linkedin.com/in/jeroenmoolenschot/" target="_blank"><i class="fa-brands fa-linkedin"> </i></a>';
			echo '<a class="m-2" href="https://community.joomla.org/service-providers-directory/listings/67:joomill.html" target="_blank"><i class="fa-brands fa-joomla"> </i></a>';
			echo '</div>';
		}
		if ($type === 'uninstall')
		{
			echo '<style>a[target="_blank"]::before {display: none};</style>';
			echo '<div class="mb-3 text-center"><img src="https://www.joomill.nl/images/logo_joomill.png" alt="Joomill Logo" /></div>';
			echo '<hr>';
			echo '<div class="text-center">' . Text::_('MOD_CUSTOM_QUICKICON_INSTALL_FOLLOWME') . ':</div>';
			echo '<div class="text-center">';
			echo '<a class="m-2" href="https://joomla.social/@joomill" target="_blank"><i class="fa-brands fa-mastodon"></i> </i></a>';
			echo '<a class="m-2" href="https://www.twitter.com/Joomill" target="_blank"><i class="fa-brands fa-brands fa-x-twitter"> </i></a>';
			echo '<a class="m-2" href="https://www.facebook.com/Joomill" target="_blank"><i class="fa-brands fa-facebook-f"> </i></a>';
			echo '<a class="m-2" href="https://www.instagram.com/Joomill" target="_blank"><i class="fa-brands fa-instagram"> </i></a>';
			echo '<a class="m-2" href="https://www.linkedin.com/in/jeroenmoolenschot/" target="_blank"><i class="fa-brands fa-linkedin"> </i></a>';
			echo '<a class="m-2" href="https://community.joomla.org/service-providers-directory/listings/67:joomill.html" target="_blank"><i class="fa-brands fa-joomla"> </i></a>';
			echo '</div>';
		}  // ende type
		return true;
	}

}