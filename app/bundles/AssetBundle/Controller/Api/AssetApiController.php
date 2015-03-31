<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\AssetBundle\Controller\Api;

use Mautic\ApiBundle\Controller\CommonApiController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Class AssetApiController
 *
 * @package Mautic\AssetBundle\Controller\Api
 */
class AssetApiController extends CommonApiController
{

    public function initialize (FilterControllerEvent $event)
    {
        parent::initialize($event);
        $this->model            = $this->factory->getModel('asset');
        $this->entityClass      = 'Mautic\AssetBundle\Entity\Asset';
        $this->entityNameOne    = 'asset';
        $this->entityNameMulti  = 'assets';
        $this->permissionBase   = 'asset:assets';
        $this->serializerGroups = array("assetDetails", "categoryList", "publishDetails");
    }

    /**
     * Obtains a list of assets
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getEntitiesAction ()
    {
        if (!$this->security->isGranted('asset:assets:viewother')) {
            $this->listFilters[] = array(
                'column' => 'a.createdBy',
                'expr'   => 'eq',
                'value'  => $this->factory->getUser()
            );
        }

        return parent::getEntitiesAction();
    }

    /**
     * Obtains a specific asset
     *
     * @param int $id Asset ID
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getEntityAction ($id)
    {
        return parent::getEntityAction($id);
    }
}