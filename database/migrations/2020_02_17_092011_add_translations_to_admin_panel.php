<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTranslationsToAdminPanel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $array = [
            'Invoices' => ['en'=>'Invoices','ro'=>'Plati','ru'=>'Счета'],
            'Paid' => ['en'=>'Paid','ro'=>'Achitat','ru'=>'Оплачено'],
            'Unpaid' => ['en'=>'Unpaid','ro'=>'Neachitat','ru'=>'Неоплачено'],
            'Total money' => ['en'=>'Total money','ro'=>'Total achitat','ru'=>'Всего оплачено'],
            'Create invoice' => ['en'=>'Create invoice','ro'=>'Invoice nou','ru'=>'Новый счет'],
            'Name' => ['en'=>'Name','ro'=>'Nume','ru'=>'Имя'],
            'From' => ['en'=>'From','ro'=>'Din','ru'=>'Из'],
            'To' => ['en'=>'To','ro'=>'Spre','ru'=>'В'],
            'Sum' => ['en'=>'Sum','ro'=>'Suma','ru'=>'Сумма'],
            'Status' => ['en'=>'Status','ro'=>'Statut','ru'=>'Статус'],
            'View' => ['en'=>'View','ro'=>'De vazut','ru'=>'Просмотр'],
            'Next' => ['en'=>'Next','ro'=>'Inainte','ru'=>'Далее'],
            'Prev' => ['en'=>'Prev','ro'=>'Inapoi','ru'=>'Назад'],
            'Transporter' => ['en'=>'Transporter','ro'=>'Transportator','ru'=>'Транспортная компания'],
            'Route information' => ['en'=>'Route information','ro'=>'Informatie despre ruta','ru'=>'Информация о маршруте'],
            'Direction' => ['en'=>'Direction','ro'=>'Directie','ru'=>'Направление'],
            'Location from' => ['en'=>'Location from','ro'=>'Locatie din','ru'=>'Из'],
            'Location to' => ['en'=>'Location to','ro'=>'Locatie spre','ru'=>'В'],
            'Dates' => ['en'=>'Dates','ro'=>'Datile','ru'=>'Даты'],
            'Course date' => ['en'=>'Course date','ro'=>'Data cursei','ru'=>'Дата рейса'],
            'Pay till' => ['en'=>'Pay till','ro'=>'Achitare pina la','ru'=>'Оплата до'],
            'Client information' => ['en'=>'Client information','ro'=>'Informatie despre client','ru'=>'Информация о клиенте'],
            'Contacts' => ['en'=>'Contacts','ro'=>'Contacte','ru'=>'Контакты'],
            'Number' => ['en'=>'Number','ro'=>'Numar','ru'=>'Номер'],
            'Location' => ['en'=>'Location','ro'=>'Localitatea','ru'=>'Местность'],
            'Select country' => ['en'=>'Select country','ro'=>'Selectati tara','ru'=>'Выберите страну'],
            'Enter state' => ['en'=>'Enter state','ro'=>'Introduceti regiunea','ru'=>'Введите регион'],
            'Enter city' => ['en'=>'Enter city','ro'=>'Introduceti oras','ru'=>'Введите город'],
            'Address' => ['en'=>'Address','ro'=>'Adresa','ru'=>'Адрес'],
            'Passengers' => ['en'=>'Passengers','ro'=>'Pasageri','ru'=>'Пассажиры'],
            'Offer type' => ['en'=>'Offer type','ro'=>'Oferta','ru'=>'Тип'],
            'Price' => ['en'=>'Price','ro'=>'Pretul','ru'=>'Цена'],
            'Currency' => ['en'=>'Currency','ro'=>'Valuta','ru'=>'Валюта'],
            'Generate invoice' => ['en'=>'Generate invoice','ro'=>'Generare invoice','ru'=>'Сгенерировать счет'],
            'Send SMS' => ['en'=>'Send SMS','ro'=>'Trimiterea SMS','ru'=>'Отправить СМС'],
            'Sate' => ['en'=>'State','ro'=>'Regiunea','ru'=>'Регион'],
            'City' => ['en'=>'City','ro'=>'Oras','ru'=>'Город'],
        ];

        foreach ($array as $key => $values){
            \Spatie\TranslationLoader\LanguageLine::create([
                'group' => '*',
                'key' => $key,
                'text' => $values,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
