<?php
/**
 * Created by PhpStorm.
 * User: Glup
 * Date: 09/12/2018
 * Time: 15:33
 */

namespace App\Service;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CsvService
{
    private $csvPath;
    private $serializer;

    public function __construct($csvPath)
    {
        $this->csvPath = $csvPath;
        $this->serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
    }

    public function addClient($data)
    {
        $dateSerializer = new Serializer(array(new DateTimeNormalizer('Y-m-d')));

        $dateAsString = $dateSerializer->normalize($data->getBirthdate());
        $normalizedData = $this->serializer->normalize($data, null, [
            'attributes' => [
                'gender','forname','surname','street','zipcode','city','country','birthdate','loyaltyCardNumber'
            ]
        ]);
        $normalizedData['birthdate'] = $dateAsString;
        $serializedData = $this->serializer->encode($normalizedData, 'csv', ['csv_delimiter' => ';']);


        $tempArray = explode("\n", $serializedData); // https://github.com/symfony/symfony/pull/29283
        $serializedData = $tempArray[1] . "\n";

        $fileSystem = new Filesystem();
        $fileSystem->appendToFile($this->csvPath, $serializedData);
    }

}