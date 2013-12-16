<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RssController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(
	       array('rsslist' => $this->getRssList(4))
        );
    }

    public function getRssList($maxparam)
    {
        $rss = simplexml_load_file('http://www.netzwelt.de/feed/news/all/RSS2.0.xml');
        $maxitems = $maxparam;
        $itemlist = array();
        
        // print ($rss->channel->title);
        // print ("\n\r");
        foreach ($rss->channel->item as $item) {
        
        	// $ta = explode( ' ', $item->pubDate );
        	// print $ta[0] . " " . $ta[1] . " " . $ta[2] . "\t";
        
        	// print ($item->title);
        	// print ($item->description);
        	$itemlist[]=$item;
        	$maxitems--;
        	if (!$maxitems) break;
        }
        return $itemlist;
    }


}




