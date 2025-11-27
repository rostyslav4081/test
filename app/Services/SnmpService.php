<?php

namespace App\Services;

class SnmpService
{
    /**
     * V této verzi NEPOUŽÍVÁME PHP rozšíření ext-snmp.
     * Všechno je jen "fake" data, aby se aplikace nezastavila
     * na chybě SNMP_VERSION_2c / snmp_* funkcí.
     */

    public function getSnmpOverview(object $device): array
    {
        // Tady si později můžeš doplnit reálné dotazy,
        // teď jen vracíme statické hodnoty.
        return [
            'online' => true,
            'cpu'    => 15,
            'ram'    => 37,
            'ports'  => [],
        ];
    }

    public function getOid(string $ip, string $oid)
    {
        // Dummy implementace – nevolá snmpget()
        return null;
    }
}
