<?php
/**
 * Created by PhpStorm.
 * User: Glup
 * Date: 10/12/2018
 * Time: 18:06
 */

namespace App\EventListener;
use App\Entity\Client;
use App\Service\CsvService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class CsvExport
{
    private $csvService;

    public function __construct(CsvService $csvService)
    {
        $this->csvService = $csvService;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Client) {
            return;
        }

        $this->csvService->addClient($entity);
    }
}