<?php

namespace Src\App\Dataset;

use Src\Core\Dataset;

class UnitsPhones extends Dataset
{
    public function __construct()
    {
        $this->loadJsonData("units-phones");
        $this->organizeUnitsPhonesByUnitName();
    }

    private function organizeUnitsPhonesByUnitName(): void
    {
        $unitsPhones = $this->getData();
        $unitsPhonesByUnitName = [];

        foreach($unitsPhones as $unitPhones) {
            if(empty($unitPhones)) {
                continue;
            }

            $name = $unitPhones[0]->filial;
            $unitsPhonesByUnitName[$name] = [];

            foreach($unitPhones as $unitPhone) {
                $unitPhoneFiltered = new \StdClass();
                $unitPhoneFiltered->phone = trim($unitPhone->telefone);
                $unitPhoneFiltered->owner = trim($unitPhone->depto);
                $unitPhoneFiltered->sector = trim($unitPhone->setor);

                $unitsPhonesByUnitName[$name][] = $unitPhoneFiltered;
            }
        }

        $this->setData($unitsPhonesByUnitName);
    }

    public function getUnitPhones(): array
    {
        return $this->getData();
    }

    public function getUnitPhonesByUnitId(string $idToFind): ?array
    {
        $unitsPhones = $this->getData();
        $unitsIndexes = array_keys($unitsPhones);
        $unitIndexFound = null;

        foreach($unitsIndexes as $unitsIndex) {
            if(str_contains($unitsIndex, $idToFind)) {
                $unitIndexFound = $unitsIndex;
                break;
            }
        }

        return $unitIndexFound ? $unitsPhones[$unitIndexFound]: [];
    }
}