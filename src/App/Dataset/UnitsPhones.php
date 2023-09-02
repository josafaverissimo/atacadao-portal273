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

            $id = $unitPhones[0]->id_filial;
            $unitsPhonesByUnitName[$id] = [];

            foreach($unitPhones as $unitPhone) {
                $unitPhoneFiltered = new \StdClass();
                $unitPhoneFiltered->phone = trim($unitPhone->telefone);
                $unitPhoneFiltered->owner = trim($unitPhone->depto);
                $unitPhoneFiltered->sector = trim($unitPhone->setor);

                $unitsPhonesByUnitName[$id][] = $unitPhoneFiltered;
            }
        }

        $this->setData($unitsPhonesByUnitName);
    }

    public function getUnitPhones(): array
    {
        return $this->getData();
    }

    public function getUnitPhonesByUnitId(int $idToFind): ?array
    {
        return $this->getData()[$idToFind] ??  [];
    }
}