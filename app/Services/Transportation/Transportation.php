<?php


namespace App\Services\Transportation;

use Illuminate\Support\Arr;


class Transportation
{
    protected $weight;
    protected $other_params = [];

    const TRANSPORTATION_COMPANIES = [
        [
            'id' => 1,
            'name' => 'Казпочта',
            'class' => \App\Services\Transportation\Kazpost::class,
        ],
        [
            'id' => 2,
            'name' => 'DHL',
            'class' => \App\Services\Transportation\DHL::class,
        ],
    ];

    public function __construct($weight, $other_params) {
        $this->weight = $weight;
        $this->other_params = $other_params;
    }

    public static function getCompanyList() { // Получение id
        return Arr::pluck(
            self::TRANSPORTATION_COMPANIES,
            'name',
            'id'
        );
    }

    // Рассчет стоимости
    public static function calculateTransportationSum($company_id, $weight, $other_params = []) {
        $arr = Arr::where(self::TRANSPORTATION_COMPANIES, function ($val) use (& $company_id) {
            return ($val['id'] == $company_id);
        });
        sort($arr);

        if( !$arr ) throw new \Exception('Компания не найдена');

        $company = new $arr[0]['class']($weight, $other_params);
        return $company->calculate();
    }
}
