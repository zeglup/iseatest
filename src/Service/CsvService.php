<?php
/**
 * Created by PhpStorm.
 * User: Glup
 * Date: 09/12/2018
 * Time: 15:33
 */

namespace App\Service;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CsvService
{
    private $csvPath;
    private $serializer;
    private $data = [];

    public function __construct($csvPath)
    {
        $this->csvPath = $csvPath;
        $this->serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        if(file_exists($this->csvPath)) $this->data = $this->serializer->decode(file_get_contents($this->csvPath), 'csv');
    }

    public function add($data) :bool
    {
        $this->data[] = $this->serializer->encode($data, 'csv');
        if (file_put_contents($this->data, $this->csvPath))
            return true;
        else
            return false;
    }

}