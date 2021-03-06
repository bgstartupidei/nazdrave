<?php

use Phinx\Seed\AbstractSeed;

class Drink extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $text = <<<EOL
Бисерна Мускатова Ракия
Винена Ракия ЕМ Голд Спешъл Едишън
Винена Ракия Свети Илия
Винена Ракия СИ
Винена Ракия Соли Инвикто Специална
Гроздова ракия Бистра Анасонлийка
Гроздова ракия Бистра Лежала
Гроздова ракия Бистра Люта
Гроздова ракия Бистра Медена
Гроздова ракия Бистра Тройно Филтрирана
Гроздова ракия Лозовача
Гроздова ракия от Мускат Мезек
Гроздова Ракия Роял № 3
Гроздова Ракия Роял № 5
Гроздова Ракия Роял № 9
Гроздова Ракия Специална
Гроздова Ракия Сублима
Гроздова Ракия Шейтанска
Дюлева Ракия Златни Певац
Керамична юбилейна ракия Леопард
Маврудова Ракия
Мискетова Ракия Врачанска Теменуга
Новоселска Гроздова Ракия
Отлежала Винена Ракия Еркесия
Отлежала Гроздова Ракия Ретро
Отлежала Мускатова Ракия Ретро
Отлежала Мускатова ракия Царска селекция
Отлежала Ракия Ново Село
Отлежала Сливова Ракия Еркесия
Ракия Анхиало от Майстора
Ракия Анхиалска Гроздова Отлежала
Ракия Анхиалска Мускатова
Ракия Банкер
Ракия Белоградчишки скали
Ракия Бургас 63 Траминерова
Ракия Бургаска Мускатова
Ракия Бургаска Мускатова 7г.
Ракия Вилямова
Ракия Вилямовка
Ракия Вишнева
Ракия Грозден
Ракия Домашна Старосел
Ракия Дуня (Дюля)
Ракия Дюлева
Ракия Жута Дуня (Жълта Дюля)
Ракия Кайлъшка
Ракия Кайлъшка Мускатова
Ракия Кайлъшка Сливова
Ракия Кайсиева
Ракия Кехлибар
Ракия Кехлибар 5г. Резерва
Ракия Крушова
Ракия Крушова Вилмош
Ракия Лиценз 63
Ракия Лоза (Гроздова)
Ракия Лозова Природна
Ракия Лозова Природна V.S
Ракия Маврудова
Ракия Мирабела
Ракия Мирабелова
Ракия Мискетова Бастуните 50 градуса
Ракия Мискетова Културна Оригинална
Ракия Мискетова Културна Отлежала
Ракия Мискетова Културна Специална
Ракия Мискетова Люта Карабунарска
Ракия Мискетова Шаровица
Ракия Мускатова
Ракия Мускатова Любимец
Ракия Мускатова Отлежала
Ракия Мускатова Русенски Бисер
Ракия Мускатова Юбилейна 3г.
Ракия Мускатова Юбилейна 5г.
Ракия Натурална Гроздова Любимец
Ракия Натурална Русенски Бисер
Ракия от Гроздови Джибри Манастирска
Ракия от Избата
Ракия Отлежала
Ракия Отлежала 7г.
Ракия Отлежала Гроздова
Ракия Отлежала Гроздова 13 год.
Ракия Отлежала Гроздова 1939
Ракия Отлежала Гроздова Трейшън Голд
Ракия Отлежала Любимец
Ракия Отлежала Специална Аламбик
Ракия от Мускат Отонел Аристократ 2009г.
Ракия Перлова
Ракия Перлова 63
Ракия Прасковена
Ракия Ракията
Ракия Свищовска Лозница
Ракия Селекция Стомна
Ракия Сливенска Перла
Ракия Сливенска Перла 12г.
Ракия Сливенска Перла Барел 0,50л.-Вини
Ракия Сливова
Ракия Сливова Отлежала
Ракия Сливова Отлежала 3г.
Ракия Сливова Специална Резерва 25г.
Ракия Сливова Фемили Резерва 1989 Сингъл
Ракия Смокинова
Ракия Солитер 2009г.
Ракия Специална
Ракия Специална Бургас 63
Ракия Специална Гроздова от Шардоне и Совиньон Блан Рубаят
Ракия Специална Лиценз 63 Барел
Ракия Специална Селекция
Ракия Стара Золта Лозова
Ракия Стара Кайсиева
Ракия Стара Русенска Мускатова
Ракия Стара Сливова 7г.
Ракия Стралджанска Мускатова
Ракия Стралджанска Мускатова Лимитирана
Ракия Стралджанска Мускатова Прайм 0,70л.
Ракия Черешова
Ракия Ябълкова
Сливова Ракия Десетка
Сръбска Боровинкова Премиум Ракия
Сръбска Гроздова Премиум Ракия
Сръбска Гроздова Ракия
Сръбска Дюлева Премиум Ракия
Сръбска Дюлева Ракия
Сръбска Жестока Земунска Дюлева Ракия
Сръбска Жестока Земунска Крушова Ракия
Сръбска Кайсиева Премиум Ракия
Сръбска Кайсиева Ракия
Сръбска Крушова Премиум Ракия
Сръбска Крушова Ракия
Сръбска Къпинова Премиум Ракия
Сръбска Малинова Премиум Ракия
Сръбска Медена Премиум Ракия
Сръбска Сливова Премиум Ракия
Сръбска Сливова Ракия
Сръбска Специална Сливова Ракия Линцура
Сръбска Ябълкова Ракия%
Ябълкова Ракия
EOL;

        $lines = explode("\n" ,$text);
        $data = [];
        $i = 1;
        foreach($lines as $line) {
            if ($line) {
                $data[] = array(
                    'id' => $i,
                    'producer_id' => 0,
                    'barcode' => '',
                    'name' => $line,
                    'url' => '',
                    'image' => '',
                    'description' => '',
                    'rating' => 0,
                    'created' => time(),
                );
                $i++;
            }
        }
        $posts = $this->table('drink');
        $posts->insert($data)->save();
    }
}
