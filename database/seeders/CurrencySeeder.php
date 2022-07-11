<?php

namespace Database\Seeders;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data  = file_get_contents('https://www.cbr.ru/scripts/XML_daily.asp?date_req=' . Carbon::now()->format('d/m/Y'));
        $xml   = simplexml_load_string($data);
        $json  = json_encode($xml);
        $array = json_decode($json,TRUE);

        foreach ($array['Valute'] as $valute) {

            $currency = [
                'valueID'  => $valute['@attributes']['ID'],
                'numCode'  => $valute['NumCode'],
                'charCode' => $valute['CharCode'],
                'name'     => $valute['Name'],
            ];

            $data  = file_get_contents('https://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' . Carbon::now()->subDays(30)->format('d/m/Y') . '&date_req2=' . Carbon::now()->format('d/m/Y') . '&VAL_NM_RQ=' . $currency['valueID']);
            $xml   = simplexml_load_string($data);
            $json  = json_encode($xml);
            $_array = json_decode($json,TRUE);

            foreach ($_array['Record'] as $dateValute) {
                $currency['value'] = (float) str_replace(',', '.', $dateValute['Value']);
                $currency['date']  = Carbon::createFromFormat('d.m.Y', $dateValute['@attributes']['Date']);

                Currency::create($currency);
            }
        }
    }
}
