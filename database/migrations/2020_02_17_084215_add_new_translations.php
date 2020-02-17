<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Spatie\TranslationLoader\LanguageLine;

class AddNewTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $array = [
            'Category' => ['en' => 'Category','ru'=>'Категория','ro'=>'Categorie'],
            'First name' => ['en' => 'First name','ru'=>'Имя','ro'=>'Numele'],
            'Last name' => ['en' => 'Last name','ru'=>'Фамилия','ro'=>'Prenumele'],
            'Quantity' => ['en' => 'Quantity','ru'=>'Количество','ro'=>'Cantitate'],
            'Unit Price' => ['en' => 'Unit Price','ru'=>'Цена за ед.','ro'=>'Preț unitar'],
            'Amount' => ['en' => 'Amount','ru'=>'Стоимость','ro'=>'Sumă'],
            'Invoice' => ['en' => 'Invoice','ru'=>'Счёт','ro'=>'Plată'],
            'Issued' => ['en' => 'Issued','ru'=>'Дата выдачи','ro'=>'Emis'],
            'Payment Due' => ['en' => 'Payment Due','ru'=>'Оплата до','ro'=>'Plată datorată'],
            'Reservation' => ['en' => 'Reservation','ru'=>'Бронирование','ro'=>'Rezervare'],
            'Phone' => ['en' => 'Phone','ru'=>'Телефон','ro'=>'Telefon'],
            'Continue' => ['en' => 'Continue','ru'=>'Продолжить','ro'=>'Continuare'],
            'Select option' => ['en' => 'Select option','ru'=>'Выберите','ro'=>'Selectați opțiunea'],
            'Payment Method' => ['en' => 'Payment Method','ru'=>'Метод оплаты','ro'=>'Metoda de plată'],
            'Another phone' => ['en' => 'Another phone','ru'=>'Другой номер','ro'=>'Alt număr de telefon'],
            'Another phone type' => ['en' => 'Another phone type','ru'=>'Тип другого номера','ro'=>'Tipul numărului'],
            'Thank you for your business!' => ['en' => 'Thank you for your business!','ru' => 'Спасибо за вашу покупку!' ,'ro' => 'Vă mulțumesc pentru afacerea dvs!'],
            'You should pay the invoice till' => ['en' => 'You should pay the invoice till','ru' => 'Вы должны оплатить счёт до' ,'ro' => 'Ar trebui să plătiți factura până '],
            'If you are not pay the invoice, reservation will be canceled' => ['en' => 'If you are not pay the invoice, reservation will be canceled','ru' => 'Если вы не оплатите счёт, то бронирование будет анулировано автоматически' ,'ro' => 'Dacă nu plătiți factura, rezervarea va fi anulată'],
            'Close' => ['en' => 'Close','ru' => 'Закрыть' ,'ro' => 'Închide'],
            'time' => ['en'=>'at', 'ru' => 'в', 'ro'=> 'la'],
            'Total' => ['en'=>'Total', 'ru' => 'Итого', 'ro' => 'Total'],
            'PAY' => ['en' => 'PAY', 'ru' => 'ОПЛАТИТЬ','ro'=> 'ACHITARE']
        ];

        foreach ($array as $key => $values){
            LanguageLine::create([
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
        //
    }
}
